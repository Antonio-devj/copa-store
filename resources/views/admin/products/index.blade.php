<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lista de Produtos') }}
            </h2>
            <a href="{{ route('admin.products.create') }}" class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700">
                + Novo Produto
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="p-3">ID</th>
                                <th class="p-3">País</th>
                                <th class="p-3">Nome</th>
                                <th class="p-3">Preço</th>
                                <th class="p-3">Estoque</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3">{{ $product->id }}</td>
                                    <td class="p-3 font-semibold">{{ $product->country->name }}</td>
                                    <td class="p-3">{{ $product->name }}</td>
                                    <td class="p-3">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                                    <td class="p-3">{{ $product->stock }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>