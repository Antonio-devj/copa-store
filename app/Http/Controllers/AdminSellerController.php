<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminSellerController extends Controller
{
    // 1. Mostra a lista de solicitações e vendedores ativos
    public function index()
    {
        // Busca todos os usuários que têm algum status de vendedor
        $sellers = User::whereNotNull('seller_status')->latest()->get();
        return view('admin.sellers.index', compact('sellers'));
    }

    // 2. Aprova o vendedor e define a comissão (opcional)
    public function approve(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $user->update([
            'role' => 'vendedor',
            'seller_status' => 'aprovado',
            // Se você criou a coluna 'commission' na tabela users, descomente a linha abaixo:
            // 'commission' => $request->commission 
        ]);

        return redirect()->back()->with('success', 'Vendedor aprovado com sucesso!');
    }

    // 3. Rejeita a solicitação e limpa os dados
    public function reject($id)
    {
        $user = User::findOrFail($id);
        
        $user->update([
            'seller_status' => null,
            'seller_code' => null
        ]);

        return redirect()->back()->with('success', 'Solicitação rejeitada.');
    }
}