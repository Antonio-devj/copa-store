<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Copa Store | Equipamentos Oficiais</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-black font-sans antialiased selection:bg-black selection:text-white">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-black tracking-tighter uppercase">
                Copa Store.
            </a>
            <div class="flex items-center gap-8 text-sm font-bold tracking-widest uppercase">
                @auth
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : url('/dashboard') }}" class="hover:text-gray-500 transition-colors">
                        Painel
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-gray-500 transition-colors">Entrar</a>
                @endauth

                <a href="{{ route('cart.index') }}" class="relative flex items-center p-2 hover:text-gray-500 transition-colors" title="Ver meu carrinho">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <span class="absolute -top-1 -right-1 bg-black text-white text-[10px] font-black w-4 h-4 flex items-center justify-center rounded-full">
                        {{ is_array(session('cart')) ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
                    </span>
                </a>
            </div>
        </div>
    </nav>

    @if($selectedCountry)
        <header class="bg-black text-white py-16">
            <div class="max-w-7xl mx-auto px-4">
                <h1 class="text-6xl font-black uppercase tracking-tighter mb-4">{{ $selectedCountry->name }}</h1>
                <div class="mb-6">
                    <span class="border border-white px-4 py-2 text-xs font-bold uppercase tracking-widest">
                        ⭐ {{ $selectedCountry->titles_count }} Títulos
                    </span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-300 text-sm">
                    <div><p>{{ $selectedCountry->history }}</p></div>
                    <div><p>{{ $selectedCountry->journey }}</p></div>
                </div>
            </div>
        </header>
    @else
        <header class="bg-[#f5f5f5] py-20 text-center">
            <h1 class="text-5xl md:text-6xl font-black uppercase tracking-tighter mb-4">A Grandeza Espera.</h1>
            <p class="text-sm font-bold tracking-widest text-gray-500 uppercase">Equipamentos e Calçados de Alta Performance</p>
        </header>
    @endif

    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="border-b border-gray-200 mb-12 flex gap-8 overflow-x-auto text-sm font-bold uppercase tracking-widest">
            <a href="{{ route('home') }}" class="py-4 {{ !request('pais') ? 'border-b-2 border-black text-black' : 'text-gray-400' }}">Todos</a>
            @foreach($countries as $country)
                <a href="{{ route('home', ['pais' => $country->id]) }}" class="py-4 {{ request('pais') == $country->id ? 'border-b-2 border-black text-black' : 'text-gray-400' }}">{{ $country->name }}</a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($products as $product)
                <div class="flex flex-col border border-gray-100 p-2 hover:shadow-lg transition-shadow">
                    
                    <div class="bg-[#f6f6f6] aspect-square flex items-center justify-center overflow-hidden mb-4">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="object-cover w-full h-full mix-blend-multiply">
                        @else
                            <span class="text-gray-400 font-bold text-xs tracking-widest">NO IMAGE</span>
                        @endif
                    </div>
                    
                    <div class="flex flex-col flex-grow">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $product->country->name }}</span>
                        <h2 class="text-sm font-bold text-black uppercase tracking-tight mb-1">{{ $product->name }}</h2>
                        <span class="text-base font-black text-black mb-4">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                        
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto space-y-3">
                            @csrf
                            
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="block text-[10px] font-bold uppercase text-gray-500 mb-1">
                                        {{ $product->category === 'calcado' ? 'Número' : 'Tamanho' }}
                                    </label>
                                    <select name="size" class="w-full bg-white border border-gray-300 text-xs font-bold p-2 rounded-none focus:border-black focus:ring-0" required>
                                        @if($product->category === 'calcado')
                                            <option value="38">38</option>
                                            <option value="39">39</option>
                                            <option value="40" selected>40</option>
                                            <option value="41">41</option>
                                            <option value="42">42</option>
                                            <option value="43">43</option>
                                        @else
                                            <option value="P">P</option>
                                            <option value="M" selected>M</option>
                                            <option value="G">G</option>
                                            <option value="GG">GG</option>
                                        @endif
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-[10px] font-bold uppercase text-gray-500 mb-1">Qtd</label>
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full bg-white border border-gray-300 text-xs font-bold p-2 rounded-none focus:border-black focus:ring-0" required>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-black text-white py-2.5 text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">
                                Adicionar à Sacola
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-400 py-12 uppercase font-bold tracking-widest text-xs">Sem produtos.</p>
            @endforelse
        </div>
    </main>
</body>
</html>