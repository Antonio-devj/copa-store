<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-black tracking-tighter uppercase text-black">
                        Copa Store.
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ route('home') }}" class="text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-black transition-colors">
                        ← Ver Vitrine de Produtos
                    </a>

                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold uppercase tracking-widest {{ request()->routeIs('admin.orders.index') ? 'text-black border-b-2 border-black py-5' : 'text-gray-500 hover:text-black' }} transition-colors">
                            📦 Gerenciar Pedidos
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-6">
                <span class="text-xs font-bold uppercase tracking-widest text-gray-400">
                    {{ Auth::user()->name }} ({{ Auth::user()->role === 'admin' ? 'Admin' : 'Cliente' }})
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs font-bold uppercase tracking-widest text-red-600 hover:underline">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>