<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SellerRegisterController extends Controller
{
    // Exibe o formulário de cadastro de vendedor
    public function showForm()
    {
        // Se o usuário já solicitou ou já é vendedor, redireciona
        if (auth()->user()->role === 'vendedor' || auth()->user()->seller_status === 'pendente') {
            return redirect()->route('dashboard')->with('info', 'Sua solicitação está em análise ou você já é um vendedor.');
        }

        return view('seller.register');
    }

    // Processa o envio dos dados de segurança
    public function store(Request $request)
    {
        $request->validate([
            'cpf' => 'required|string|max:14|unique:users,cpf,' . auth()->id(),
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:2',
            'seller_code' => 'required|string|max:20|alpha_num|unique:users,seller_code',
        ], [
            'seller_code.unique' => 'Este código de cupom já está sendo usado por outro vendedor.',
            'cpf.unique' => 'Este CPF já está cadastrado no sistema.',
        ]);

        $user = User::findOrFail(auth()->id());
        
        $user->update([
            'cpf' => $request->cpf,
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => strtoupper($request->state),
            'seller_code' => strtoupper($request->seller_code),
            'seller_status' => 'pendente' // Aguardando o Admin
        ]);

        return redirect()->route('dashboard')->with('success', 'Sua inscrição foi enviada com sucesso! O administrador revisará seus dados de segurança.');
    }
}