<x-app-layout>
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-12 border-b border-gray-200 pb-6 flex flex-wrap justify-between items-center gap-4">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-widest bg-black text-white px-2.5 py-1">
                        {{ Auth::user()->role === 'admin' ? 'Painel Administrativo' : 'Minha Conta' }}
                    </span>
                    <h1 class="text-4xl font-black uppercase tracking-tighter text-black mt-3">Olá, {{ Auth::user()->name }}</h1>
                    <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">Acompanhe os seus equipamentos de elite adquiridos.</p>
                </div>
                
                <a href="{{ route('home') }}" class="bg-black text-white px-5 py-3 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">
                    ← Ir para a Vitrine
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <div class="lg:col-span-2 space-y-6">
                    <h2 class="text-lg font-black uppercase tracking-tight text-black border-b border-gray-100 pb-2">Meu Histórico de Compras</h2>
                    
                    @forelse($myOrders as $order)
                        <div class="border border-gray-200 p-6 bg-white shadow-sm">
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 border-b border-gray-100 pb-4 mb-4 text-xs">
                                <div>
                                    <span class="font-bold text-gray-400 uppercase tracking-wider block">Pedido</span>
                                    <span class="font-black text-sm text-black">#000{{ $order->id }}</span>
                                </div>
                                <div>
                                    <span class="font-bold text-gray-400 uppercase tracking-wider block">Data</span>
                                    <span class="font-bold text-gray-700">{{ $order->created_at->format('d/m/Y \à\s H:i') }}</span>
                                </div>
                                <div>
                                    <span class="font-bold text-gray-400 uppercase tracking-wider block">Total</span>
                                    <span class="font-black text-sm text-black">R$ {{ number_format($order->total_price, 2, ',', '.') }}</span>
                                </div>
                                <div>
                                    <span class="font-bold text-gray-400 uppercase tracking-wider block mb-1">Status</span>
                                    <span class="inline-block px-2.5 py-0.5 text-[10px] font-black uppercase tracking-widest
                                        {{ $order->status === 'processando' ? 'bg-amber-100 text-amber-800' : '' }}
                                        {{ $order->status === 'enviado' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $order->status === 'entregue' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $order->status === 'cancelado' ? 'bg-red-100 text-red-800' : '' }}
                                    ">
                                        {{ $order->status }}
                                    </span>
                                </div>
                            </div>

                            <p class="text-xs text-gray-500 font-medium italic">
                                @if($order->status === 'processando')
                                    O pagamento foi confirmado. Estamos a preparar e a embalar os tamanhos selecionados no nosso stock.
                                @elseif($order->status === 'enviado')
                                    Excelente notícia! O seu equipamento de elite foi despachado e já se encontra com a transportadora a caminho da sua morada.
                                @elseif($order->status === 'entregue')
                                    Entrega efetuada. O equipamento já está pronto para entrar em campo. Obrigado por comprar na Copa Store!
                                @else
                                    Este pedido foi cancelado e o processo de reembolso foi iniciado.
                                @endif
                            </p>
                        </div>
                    @empty
                        <div class="border border-dashed border-gray-300 p-12 text-center text-gray-400 uppercase font-bold tracking-widest text-xs">
                            Ainda não efetuou nenhuma compra na Copa Store.
                        </div>
                    @endforelse
                </div>

                <div class="bg-[#f6f6f6] border border-gray-200 p-6">
                    <h3 class="text-xs font-black uppercase tracking-widest text-black border-b border-gray-200 pb-3 mb-4">Dados da Sua Conta</h3>
                    <div class="space-y-3 text-xs uppercase font-bold tracking-wide text-gray-600">
                        <div>
                            <span class="text-gray-400 block text-[10px]">Nome Associado</span>
                            <span class="text-black">{{ Auth::user()->name }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block text-[10px]">E-mail de Login</span>
                            <span class="text-black inline-block lowercase font-mono">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>