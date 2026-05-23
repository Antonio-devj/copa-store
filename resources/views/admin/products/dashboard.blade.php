<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel do Vendedor (Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Bem-vindo, {{ Auth::user()->name }}!</h3>
                    <p class="mb-4">Este é o seu centro de controle da Copa Store.</p>
                    
                    <a href="{{ route('admin.products.index') }}" class="inline-block bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                        Gerenciar Produtos
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>