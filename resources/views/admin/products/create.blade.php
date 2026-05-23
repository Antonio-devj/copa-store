<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar Novo Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Nome do Produto</label>
                                <input type="text" name="name" class="w-full border-gray-300 rounded shadow-sm" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">País da Seleção</label>
                                <select name="country_id" class="w-full border-gray-300 rounded shadow-sm" required>
                                    <option value="">Selecione um país...</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Preço (R$)</label>
                                <input type="number" step="0.01" name="price" class="w-full border-gray-300 rounded shadow-sm" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Quantidade em Estoque</label>
                                <input type="number" name="stock" class="w-full border-gray-300 rounded shadow-sm" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Descrição</label>
                            <textarea name="description" rows="3" class="w-full border-gray-300 rounded shadow-sm" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Imagem do Produto</label>
                            <input type="file" name="image" class="w-full border border-gray-300 p-2 rounded">
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">
                                Salvar Produto
                            </button>
                            <a href="{{ route('admin.products.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>