<x-app-layout>
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-8 border-b border-gray-200 pb-4">
                <h1 class="text-3xl font-black uppercase tracking-tighter text-black">Painel de Pedidos Globais</h1>
                <span class="text-xs font-bold uppercase tracking-widest bg-black text-white px-3 py-1">ADMIN</span>
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
                            <th class="p-4">Pedido</th>
                            <th class="p-4">Cliente</th>
                            <th class="p-4">Data</th>
                            <th class="p-4">Total</th>
                            <th class="p-4">Status Atual</th>
                            <th class="p-4 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4 font-bold text-black">#000{{ $order->id }}</td>
                                <td class="p-4">
                                    <div class="font-bold text-gray-900">{{ $order->user->name }}</div>
                                    <div class="text-xs text-gray-400">{{ $order->user->email }}</div>
                                </td>
                                <td class="p-4 text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-4 font-black text-black">R$ {{ number_format($order->total_price, 2, ',', '.') }}</td>
                                <td class="p-4">
                                    <span class="px-2.5 py-1 text-[10px] font-black uppercase tracking-wider rounded-none
                                        {{ $order->status === 'processando' ? 'bg-amber-100 text-amber-800' : '' }}
                                        {{ $order->status === 'enviado' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $order->status === 'entregue' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $order->status === 'cancelado' ? 'bg-red-100 text-red-800' : '' }}
                                    ">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="inline-flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="bg-white border border-gray-300 text-xs font-bold p-1 rounded-none focus:border-black focus:ring-0">
                                            <option value="processando" {{ $order->status == 'processando' ? 'selected' : '' }}>Processando</option>
                                            <option value="enviado" {{ $order->status == 'enviado' ? 'selected' : '' }}>Enviado</option>
                                            <option value="entregue" {{ $order->status == 'entregue' ? 'selected' : '' }}>Entregue</option>
                                            <option value="cancelado" {{ $order->status == 'cancelado' ? 'selected' : '' }}>Cancelar</option>
                                        </select>
                                        <button type="submit" class="bg-black text-white px-2 py-1 text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">
                                            Atualizar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-gray-400 uppercase font-bold tracking-widest text-xs">Nenhum pedido realizado na loja até o momento.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>