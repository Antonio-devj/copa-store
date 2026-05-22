<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Country;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Listagem de produtos para o vendedor
    public function index()
    {
        $products = Product::with('country')->get();
        return view('admin.products.index', compact('products'));
    }

    // Formularo para criar novo produto
    public function create()
    {
        $countries = Country::all(); // Precisamos dos países para o <select> do formulário
        return view('admin.products.create', compact('countries'));
    }

    // Lógica para salvar o produto no banco (com upload de imagem)
    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Lógica de Upload da Foto do Produto
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produto criado com sucesso!');
    }
}