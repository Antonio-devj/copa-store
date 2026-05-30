<x-app-layout>
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h1 class="text-3xl font-black uppercase tracking-tighter text-black">Gestão de Parceiros</h1>
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-500">Aprove ou rejeite solicitações de novos vendedores</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-emerald-50 text-emerald-600 p-4 border border-emerald-200 text-xs font-bold uppercase tracking-widest">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border border-gray-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#f9f9f9] border-b border-gray-200 text-[10px] uppercase tracking-widest text-gray-500">
                            <th class="p-4 font-bold">Usuário</th>
                            <th class="p-4 font-bold">Contato / Local</th>
                            <th class="p-4 font-bold">Código Solicitado</th>
                            <th class="p-4 font-bold">Status</th>
                            <th class="p-4 font-bold text-right">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($sellers as $seller)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="p-4">
                                    <div class="font-bold text-black uppercase tracking-tight">{{ $seller->name }}</div>
                                    <div class="text-xs text-gray-400 font-bold tracking-widest">{{ $seller->email }}</div>
                                    <div class="text-[10px] text-gray-400 mt-1 uppercase tracking-widest">CPF: {{ $seller->cpf }}</div>
                                </td>
                                <td class="p-4">
                                    <div class="font-bold text-black text-xs tracking-widest">{{ $seller->phone }}</div>
                                    <div class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ $seller->city }} - {{ $seller->state }}</div>
                                </td>
                                <td class="p-4">
                                    <span class="bg-gray-100 text-black px-2 py-1 font-black uppercase tracking-widest text-xs">
                                        {{ $seller->seller_code }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    @if($seller->seller_status === 'pendente')
                                        <span class="text-amber-500 font-bold uppercase tracking-widest text-[10px] bg-amber-50 px-2 py-1">⏳ Pendente</span>
                                    @elseif($seller->seller_status === 'aprovado')
                                        <span class="text-emerald-600 font-bold uppercase tracking-widest text-[10px] bg-emerald-50 px-2 py-1">✓ Aprovado</span>
                                    @endif
                                </td>
                                <td class="p-4 text-right flex justify-end gap-2">
                                    @if($seller->seller_status === 'pendente')
                                        <form action="{{ route('admin.sellers.approve', $seller->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="commission" value="10"> 
                                            <button type="submit" class="bg-black text-white px-4 py-2 text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 transition-colors">
                                                Aprovar
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.sellers.reject', $seller->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja rejeitar este parceiro?');">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-white border border-gray-300 text-red-600 px-4 py-2 text-[10px] font-black uppercase tracking-widest hover:bg-red-50 transition-colors">
                                                Rejeitar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-xs font-bold uppercase tracking-widest text-gray-400">
                                    Nenhuma solicitação de parceiro encontrada.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>