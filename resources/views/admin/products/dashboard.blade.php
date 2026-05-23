<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel de Controle | Copa Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black font-sans antialiased">

    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-3xl font-black tracking-tighter uppercase">
                Copa Store.
            </a>
            <div class="flex items-center gap-6 text-sm font-bold tracking-widest uppercase">
                <a href="/" class="hover:text-gray-500 transition-colors border-b border-black pb-1">
                    Ir para a Vitrine
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 hover:underline uppercase tracking-widest font-bold text-sm">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-16 text-center">
        <span class="text-[10px] font-black uppercase tracking-widest bg-black text-white px-3 py-1.5">
            {{ Auth::user()->role === 'admin' ? 'Acesso Administrativo' : 'Conta de Cliente' }}
        </span>
        
        <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter mt-6 mb-2">
            Olá, {{ Auth::user()->name }}
        </h1 >
        <p class="text-sm text-gray-500 uppercase tracking-widest mb-12">Você está conectado com sucesso.</p>

        <div class="border border-gray-200 p-8 max-w-md mx-auto bg-[#f6f6f6] text-left space-y-6 shadow-sm">
            <h3 class="text-sm font-black uppercase tracking-widest text-black border-b border-gray-200 pb-3">Ambiente de Testes</h3>
            
            <div>
                <p class="text-xs text-gray-500 mb-3 font-medium">Para simular o fluxo de compras, selecionar tamanhos de calçados/roupas e testar o fechamento de pedidos com este perfil logado:</p>
                <a href="/" class="w-full bg-black text-white py-4 font-bold uppercase tracking-widest text-xs hover:bg-gray-800 transition-colors text-center block">
                    Acessar Vitrine de Produtos
                </a>
            </div>
        </div>
    </main>

</body>
</html>