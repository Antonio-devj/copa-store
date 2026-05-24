<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Listar todos os pedidos da loja
    public function index()
    {
        // Bloqueio manual de segurança caso tentem burlar pela URL
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Acesso negado.');
        }

        // Puxa os pedidos trazendo junto os dados do usuário que comprou
        $orders = Order::with('user')->latest()->get();

        return view('admin.orders', compact('orders'));
    }

    // Atualizar o status do pedido (ex: Processando -> Enviado)
    public function updateStatus(Request $request, $id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Acesso negado.');
        }

        $request->validate([
            'status' => 'required|string|in:processando,enviado,entregue,cancelado'
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status do pedido #' . $id . ' atualizado com sucesso!');
    }
}