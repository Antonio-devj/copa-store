<x-app-layout>
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-8 border-b border-gray-200 pb-4">
                <h1 class="text-3xl font-black uppercase tracking-tighter text-black">Catálogo de Produtos</h1>
                <a href="{{ route('admin.products.create') }}" class="bg-black text-white px-4 py-2 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">
                    + Novo Produto
                </a>
            </div>

            @if(session('success'))
                <div class="bg-black text-white text-xs font-bold uppercase tracking-widest p-4 mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border border-gray-200 overflow-hidden shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 bg-[#f6f6f6] text-[11px] font-black uppercase tracking-widest text-gray-500">
                            <th class="p-4 w-20">Foto</th>
                            <th class="p-4">Produto</th>
                            <th class="p-4">País</th>
                            <th class="p-4">Preço</th>
                            <th class="p-4">Estoque Real</th>
                            <th class="p-4 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="p-4">
                                    <div class="w-12 h-12 bg-gray-100 flex items-center justify-center overflow-hidden border border-gray-200">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" class="object-cover w-full h-full">
                                        @else
                                            <span class="text-[9px] text-gray-400 font-bold uppercase">N/A</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4 font-bold text-black">
                                    {{ $product->name }}
                                    <span class="block text-[10px] uppercase font-black text-gray-400">{{ $product->category }}</span>
                                </td>
                                <td class="p-4 uppercase text-xs font-bold text-gray-600">{{ $product->country->name }}</td>
                                <td class="p-4 font-black text-black">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                                <td class="p-4 font-mono text-xs">{{ $product->stock }} un</td>
                                <td class="p-4 text-right space-x-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-xs font-bold uppercase tracking-wider text-black hover:underline">Editar</a>
                                    
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja remover este produto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold uppercase tracking-wider text-red-600 hover:underline">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-gray-400 uppercase font-bold tracking-widest text-xs">Nenhum produto cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>