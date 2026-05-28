<x-app-layout>
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <a href="{{ route('dashboard') }}" class="text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-black transition-colors">
                    ← Voltar ao Painel
                </a>
            </div>

            <div class="border border-gray-200 p-8 bg-[#f9f9f9]">
                <h1 class="text-3xl font-black uppercase tracking-tighter mb-2 text-black">Torne-se um Parceiro</h1>
                <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-8 border-b border-gray-200 pb-6">Preencha seus dados de segurança para avaliação</p>

                <form action="{{ route('seller.register.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="cpf" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1">CPF (Apenas números)</label>
                        <input type="text" name="cpf" id="cpf" value="{{ old('cpf') }}" required maxlength="14"
                               class="w-full bg-white border border-gray-300 text-sm font-bold p-3 focus:border-black focus:ring-0" placeholder="000.000.000-00">
                        @error('cpf') <span class="text-xs text-red-500 font-bold mt-1 uppercase tracking-widest block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1">Telefone / WhatsApp</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required maxlength="20"
                               class="w-full bg-white border border-gray-300 text-sm font-bold p-3 focus:border-black focus:ring-0" placeholder="(00) 90000-0000">
                        @error('phone') <span class="text-xs text-red-500 font-bold mt-1 uppercase tracking-widest block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="city" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1">Cidade</label>
                            <input type="text" name="city" id="city" value="{{ old('city') }}" required maxlength="100"
                                   class="w-full bg-white border border-gray-300 text-sm font-bold p-3 focus:border-black focus:ring-0">
                            @error('city') <span class="text-xs text-red-500 font-bold mt-1 uppercase tracking-widest block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="state" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1">Estado (UF)</label>
                            <input type="text" name="state" id="state" value="{{ old('state') }}" required maxlength="2"
                                   class="w-full bg-white border border-gray-300 text-sm font-bold p-3 uppercase focus:border-black focus:ring-0" placeholder="SP">
                            @error('state') <span class="text-xs text-red-500 font-bold mt-1 uppercase tracking-widest block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <label for="seller_code" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-1">Crie seu Cupom Exclusivo (Sem espaços)</label>
                        <input type="text" name="seller_code" id="seller_code" value="{{ old('seller_code') }}" required maxlength="20"
                               class="w-full bg-white border border-gray-300 text-lg font-black uppercase tracking-widest p-3 focus:border-black focus:ring-0" placeholder="EX: MEUNOME2024">
                        <p class="text-[10px] text-gray-400 mt-2 uppercase tracking-widest font-bold">Esse é o código que os clientes usarão para comprar com você.</p>
                        @error('seller_code') <span class="text-xs text-red-500 font-bold mt-1 uppercase tracking-widest block">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-black text-white py-4 text-sm font-black uppercase tracking-widest hover:bg-gray-800 transition-colors">
                            Enviar Dados para Análise
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>