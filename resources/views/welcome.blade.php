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
            <div class="flex gap-6 text-sm font-bold tracking-widest uppercase">
                @auth
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : url('/dashboard') }}" class="hover:text-gray-500 transition-colors">
                        Painel
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-gray-500 transition-colors">Entrar</a>
                    <a href="{{ route('register') }}" class="hover:text-gray-500 transition-colors">Cadastrar</a>
                @endauth
            </div>
        </div>
    </nav>

    @if($selectedCountry)
        <header class="bg-black text-white py-16 md:py-24">
            <div class="max-w-7xl mx-auto px-4">
                <h1 class="text-6xl md:text-8xl font-black uppercase tracking-tighter mb-4">
                    {{ $selectedCountry->name }}
                </h1>
                
                <div class="mb-10">
                    <span class="border border-white px-4 py-2 text-xs font-bold uppercase tracking-widest">
                        {{ $selectedCountry->titles_count }} {{ $selectedCountry->titles_count == 1 ? 'Título Mundial' : 'Títulos Mundiais' }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 text-gray-300">
                    <div>
                        <h3 class="text-sm font-bold text-white uppercase tracking-widest mb-3">A História</h3>
                        <p class="text-base leading-relaxed">{{ $selectedCountry->history }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white uppercase tracking-widest mb-3">Rumo à Copa</h3>
                        <p class="text-base leading-relaxed">{{ $selectedCountry->journey }}</p>
                    </div>
                </div>
            </div>
        </header>
    @else
        <header class="bg-[#f5f5f5] py-20 md:py-32 text-center">
            <div class="max-w-4xl mx-auto px-4">
                <h1 class="text-5xl md:text-7xl font-black uppercase tracking-tighter text-black mb-6">
                    A Grandeza Espera.
                </h1>
                <p class="text-lg md:text-xl font-medium text-gray-600 mb-8">
                    Equipamentos oficiais de alta performance das maiores seleções do mundo.
                </p>
            </div>
        </header>
    @endif

    <main class="max-w-7xl mx-auto px-4 py-12">
        
        <div class="border-b border-gray-200 mb-12 overflow-x-auto">
            <div class="flex gap-8 min-w-max pb-px">
                <a href="{{ route('home') }}" class="py-4 text-sm font-bold uppercase tracking-widest transition-colors {{ !request('pais') ? 'border-b-2 border-black text-black' : 'text-gray-400 hover:text-black border-b-2 border-transparent' }}">
                    Ver Todos
                </a>
                @foreach($countries as $country)
                    <a href="{{ route('home', ['pais' => $country->id]) }}" class="py-4 text-sm font-bold uppercase tracking-widest transition-colors {{ request('pais') == $country->id ? 'border-b-2 border-black text-black' : 'text-gray-400 hover:text-black border-b-2 border-transparent' }}">
                        {{ $country->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($products as $product)
                <div class="group cursor-pointer flex flex-col">
                    
                    <div class="bg-[#f6f6f6] aspect-square flex items-center justify-center overflow-hidden mb-4 relative">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-cover w-full h-full mix-blend-multiply transition-transform duration-500 group-hover:scale-105">
                        @else
                            <span class="text-gray-400 font-bold uppercase text-xs tracking-widest">Sem Imagem</span>
                        @endif
                        
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="absolute bottom-4 left-4 right-4 opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-10">
                             @csrf
                                 <button type="submit" class="w-full bg-black text-white py-3 font-bold uppercase tracking-widest text-sm hover:bg-gray-900 transition-colors">
                                     Comprar Agora
                                 </button>
                        </form>
                    </div>
                    
                    <div class="flex flex-col flex-grow">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">{{ $product->country->name }}</span>
                        <h2 class="text-base font-bold text-black mb-2">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $product->description }}</p>
                        
                        <div class="mt-auto">
                            <span class="text-lg font-black text-black">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-24 border border-dashed border-gray-300">
                    <p class="text-black font-bold uppercase tracking-widest text-lg">Nenhum lançamento disponível no momento.</p>
                </div>
            @endforelse
        </div>

    </main>

    <footer class="bg-black text-white mt-20 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center md:text-left grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <h2 class="text-2xl font-black uppercase tracking-tighter">Copa Store.</h2>
            <p class="text-sm font-bold text-gray-500 uppercase tracking-widest md:text-right">
                © {{ date('Y') }} Todos os direitos reservados.
            </p>
        </div>
    </footer>

</body>
</html>