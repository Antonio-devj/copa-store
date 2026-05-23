<x-app-layout>
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#f6f6f6] border border-gray-200 overflow-hidden shadow-sm p-8 max-w-xl mx-auto text-center mt-12">
                <span class="text-[10px] font-black uppercase tracking-widest bg-black text-white px-3 py-1.5 inline-block mb-4">
                    Painel de Controle
                </span>
                
                <h2 class="text-3xl font-black uppercase tracking-tighter text-black mb-2">
                    Olá, {{ Auth::user()->name }}
                </h2>
                <p class="text-xs text-gray-500 uppercase tracking-widest mb-6">Você está conectado ao sistema.</p>

                <div class="border-t border-gray-200 pt-6">
                    <p class="text-xs text-gray-600 mb-4">Use o link no topo esquerdo <strong>"← Ver Vitrine de Produtos"</strong> para retornar à loja, selecionar tamanhos, calçados e testar o carrinho de compras com este perfil.</p>
                    
                    <a href="{{ route('home') }}" class="w-full bg-black text-white py-3 font-bold uppercase tracking-widest text-xs hover:bg-gray-800 transition-colors text-center block">
                        Ir para a Vitrine agora
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>