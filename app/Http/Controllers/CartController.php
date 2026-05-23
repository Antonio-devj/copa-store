<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        // Valida se veio a quantidade e o tamanho
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'size' => 'required|string'
        ]);

        $product = Product::with('country')->findOrFail($id);
        $cart = session()->get('cart', []);
        
        $size = $request->size;
        $quantity = $request->quantity;

        // Criamos uma chave única combinando o ID do produto e o tamanho escolhido
        $cartKey = $id . '_' . $size;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            $cart[$cartKey] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "size" => $size,
                "category" => $product->category,
                "country" => $product->country->name,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produto adicionado ao carrinho!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produto removido!');
    }
}