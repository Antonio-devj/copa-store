<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Exibir a página do carrinho
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }

    // Adicionar item ao carrinho
    public function add($id)
    {
        $product = Product::with('country')->findOrFail($id);
        $cart = session()->get('cart', []);

        // Se o produto já está no carrinho, só aumenta a quantidade
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // Se não está, adiciona as informações básicas dele
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "country" => $product->country->name,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produto adicionado ao carrinho!');
    }

    // Remover item do carrinho
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