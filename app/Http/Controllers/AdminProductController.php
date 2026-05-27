<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    // O construtor antigo e problemático foi removido daqui!

    // Listagem de produtos para o Admin
    public function index()
    {
        $products = Product::with('country')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // Tela de cadastro
    public function create()
    {
        $countries = Country::all();
        return view('admin.products.create', compact('countries'));
    }

    // Salvar novo produto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|in:vestuario,calcado',
            'country_id' => 'required|exists:countries,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    // Tela de edição
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $countries = Country::all();
        return view('admin.products.edit', compact('product', 'countries'));
    }

    // Atualizar produto existente
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|in:vestuario,calcado',
            'country_id' => 'required|exists:countries,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    // Excluir produto
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->back()->with('success', 'Produto removido do catálogo!');
    }
}