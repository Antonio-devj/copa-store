<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedido Confirmado | Copa Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black font-sans antialiased flex flex-col min-h-screen">

    <main class="max-w-xl mx-auto px-4 py-24 text-center my-auto">
        <span class="text-4xl">⬛</span>
        <h1 class="text-4xl font-black uppercase tracking-tighter mt-6 mb-2">Pedido Confirmado.</h1>
        <p class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-8">Código do pedido: #000{{ $order->id }}</p>
        
        <div class="border-t border-b border-gray-200 py-6 mb-8 text-left space-y-2">
            <div class="flex justify-between text-sm font-bold uppercase tracking-wide">
                <span class="text-gray-400">Status</span>
                <span class="text-black">{{ strtoupper($order->status) }}</span>
            </div>
            <div class="flex justify-between text-base font-black">
                <span>Total Pago</span>
                <span>R$ {{ number_format($order->total_price, 2, ',', '.') }}</span>
            </div>
        </div>

        <p class="text-sm text-gray-600 mb-8 leading-relaxed">
            Obrigado por comprar na Copa Store. O resumo da sua transação de alta performance foi processado e o seu equipamento já está sendo preparado para envio.
        </p>

        <a href="{{ route('home') }}" class="inline-block bg-black text-white px-8 py-4 text-xs font-bold uppercase tracking-widest hover:bg-gray-900 transition-colors">
            Voltar para a Loja
        </button>
    </main>

</body>
</html>