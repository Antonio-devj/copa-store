<x-app-layout>
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 border-b border-gray-200 pb-4">
                <h1 class="text-2xl font-black uppercase tracking-tighter text-black">Editar Equipamento</h1>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Nome do Produto</label>
                    <input type="text" name="name" value="{{ $product->name }}" class="w-full border-gray-300 text-sm p-3 rounded-none focus:border-black focus:ring-0" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Preço (R$)</label>
                        <input type="number" name="price" step="0.01" value="{{ $product->price }}" class="w-full border-gray-300 text-sm p-3 rounded-none focus:border-black focus:ring-0" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Estoque</label>
                        <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border-gray-300 text-sm p-3 rounded-none focus:border-black focus:ring-0" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Categoria</label>
                        <select name="category" class="w-full border-gray-300 text-sm p-3 rounded-none focus:border-black focus:ring-0" required>
                            <option value="vestuario" {{ $product->category === 'vestuario' ? 'selected' : '' }}>Vestuário (Camisas)</option>
                            <option value="calcado" {{ $product->category === 'calcado' ? 'selected' : '' }}>Calçado (Chuteiras)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Seleção / País</label>
                        <select name="country_id" class="w-full border-gray-300 text-sm p-3 rounded-none focus:border-black focus:ring-0" required>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ $product->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Substituir Imagem</label>
                    <input type="file" name="image" class="w-full border border-gray-300 text-sm p-2 rounded-none file:bg-black file:text-white file:border-none file:px-3 file:py-1 file:text-xs file:font-bold file:uppercase file:tracking-widest cursor-pointer">
                    @if($product->image)
                        <div class="mt-3 text-xs text-gray-400 uppercase font-bold">Imagem Atual Cadastrada no Servidor.</div>
                    @endif
                </div>

                <div class="pt-4 flex gap-4">
                    <button type="submit" class="flex-1 bg-black text-white py-3 font-bold uppercase tracking-widest text-xs hover:bg-gray-800 transition-colors">
                        Atualizar Produto
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="border border-gray-300 text-gray-500 px-6 py-3 font-bold uppercase tracking-widest text-xs hover:text-black hover:border-black transition-colors text-center">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>