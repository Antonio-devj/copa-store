<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seu Carrinho | Copa Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black font-sans antialiased">

    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-black tracking-tighter uppercase">Copa Store.</a>
            <a href="{{ route('home') }}" class="text-sm font-bold uppercase tracking-widest hover:underline">Continuar Comprando</a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-black uppercase tracking-tighter mb-8">Seu Carrinho</h1>

        @if(session('success'))
            <div class="bg-black text-white text-xs font-bold uppercase tracking-widest p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <div class="lg:col-span-2 space-y-6">
                    @foreach($cart as $id => $item)
                        <div class="flex border-b border-gray-200 pb-6 items-center">
                            <div class="w-24 h-24 bg-[#f6f6f6] flex-shrink-0 flex items-center justify-center p-2">
                                @if($item['image'])
                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="object-cover w-full h-full mix-blend-multiply">
                                @else
                                    <span class="text-gray-400 font-bold text-[10px]">SEM FOTO</span>
                                @endif
                            </div>
                            
                            <div class="ml-6 flex-grow">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $item['country'] }}</span>
                                <h2 class="text-base font-bold uppercase tracking-tight text-black">{{ $item['name'] }}</h2>
                                <p class="text-sm text-gray-500 mt-1">Quantidade: {{ $item['quantity'] }}</p>
                                
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="text-xs font-bold uppercase tracking-widest text-red-600 hover:underline">Remover</button>
                                </form>
                            </div>

                            <div class="text-right">
                                <span class="text-base font-black text-black">R$ {{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="bg-[#f6f6f6] p-8 h-fit flex flex-col">
                    <h2 class="text-xl font-black uppercase tracking-tight mb-6">Resumo do Pedido</h2>
                    
                    <div class="flex justify-between border-b border-gray-200 pb-4 mb-4 text-sm font-medium text-gray-600">
                        <span>Subtotal</span>
                        <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between border-b border-gray-200 pb-4 mb-6 text-base font-black text-black">
                        <span>Total</span>
                        <span>R$ {{ number_format($total, 2, ',', '.') }}</span>
                    </div>

                    <button class="w-full bg-black text-white py-4 font-bold uppercase tracking-widest text-sm hover:bg-gray-900 transition-colors">
                        Finalizar Compra
                    </button>
                </div>

            </div>
        @else
            <div class="text-center py-24 border border-dashed border-gray-200">
                <p class="text-gray-500 font-bold uppercase tracking-widest text-sm mb-4">Seu carrinho está vazio.</p>
                <a href="{{ route('home') }}" class="inline-block bg-black text-white px-6 py-3 text-xs font-bold uppercase tracking-widest hover:bg-gray-900 transition-colors">Ver Lançamentos</a>
            </div>
        @endif
    </main>

</body>
</html>