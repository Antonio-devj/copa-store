<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Listar todos os pedidos da loja
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Acesso negado.');
        }

        $orders = Order::with('user')->latest()->get();

        return view('admin.orders', compact('orders'));
    }

    // Atualizar o status do pedido de forma explícita e infalível
    public function updateStatus(Request $request, $id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Acesso negado.');
        }

        $request->validate([
            'status' => 'required|string|in:processando,enviado,entregue,cancelado'
        ]);

        // Busca o pedido
        $order = Order::findOrFail($id);
        
        // Atribuição direta (ignora qualquer ausência do fillable no Model)
        $order->status = $request->status;
        $order->save(); 

        return redirect()->back()->with('success', 'Status do pedido #' . $id . ' atualizado para ' . strtoupper($request->status) . '!');
    }
}