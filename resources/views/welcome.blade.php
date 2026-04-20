<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FIJRI POS - Smart POS for Modern Business</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|outfit:400,500,600,700" rel="stylesheet" />
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
        <style>
            body { font-family: 'Instrument Sans', sans-serif; }
            .font-outfit { font-family: 'Outfit', sans-serif; }
            .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
            .dark .glass { background: rgba(30, 41, 59, 0.7); }
            @keyframes fade-in { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
            .animate-fade-in { animation: fade-in 0.8s ease-out forwards; }
        </style>
        <script>
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark');
            }
        </script>
    </head>
    <body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased">
        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800">
            <!-- Navigation -->
            <header class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex items-center justify-between h-20">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-amber-600 rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/20">
                            <span class="text-white font-bold text-xl font-outfit">F</span>
                        </div>
                        <span class="text-xl font-bold font-outfit tracking-tight">FIJRI <span class="text-amber-600">POS</span></span>
                    </div>
                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/admin') }}" class="px-5 py-2 bg-amber-600 text-white rounded-lg font-medium hover:bg-amber-700 transition-all text-sm">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-amber-600 dark:hover:text-indigo-400 transition-colors">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-900 dark:text-slate-100 rounded-lg font-medium hover:border-amber-600 dark:hover:border-indigo-400 transition-all text-sm">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </nav>
            </header>

            <!-- Hero Body -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24 grid lg:grid-cols-2 gap-12 items-center">
                <div class="animate-fade-in">
                    <h1 class="text-5xl lg:text-7xl font-bold font-outfit leading-tight mb-6">
                        Smart POS for <br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-orange-600">Modern Business</span>
                    </h1>
                    <p class="text-lg text-slate-600 dark:text-slate-300 mb-8 max-w-xl leading-relaxed">
                        Manage your inventory, sales, and suppliers with ease. FIJRI POS provides the tools you need to grow your retail business efficiently.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#catalog" class="px-8 py-4 bg-amber-600 text-white rounded-xl font-semibold shadow-xl shadow-amber-500/30 hover:-translate-y-1 transition-all">Explore Catalog</a>
                        <div class="flex items-center gap-3 px-6 py-4 rounded-xl border border-slate-200 dark:border-slate-700 glass cursor-default">
                            <span class="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-200">v{{ app()->version() }} Reliable System</span>
                        </div>
                    </div>
                </div>
                <div class="relative animate-fade-in [animation-delay:200ms]">
                    <div class="absolute -inset-4 bg-gradient-to-r from-amber-500/20 to-orange-500/20 blur-2xl rounded-3xl"></div>
                    <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-700 p-2">
                        <!-- CSS Mockup Dashboard -->
                        <div class="bg-slate-50 dark:bg-slate-950 rounded-xl overflow-hidden aspect-video relative flex flex-col">
                            <div class="h-8 bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 flex items-center px-4 gap-2">
                                <span class="w-2 h-2 rounded-full bg-red-400"></span>
                                <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                                <span class="w-2 h-2 rounded-full bg-green-400"></span>
                            </div>
                            <div class="flex-1 p-6 flex gap-6">
                                <div class="w-1/3 space-y-4">
                                    <div class="h-20 bg-amber-600/10 rounded-lg border border-amber-600/20 p-4">
                                        <div class="h-2 w-12 bg-amber-600/30 rounded mb-2"></div>
                                        <div class="h-4 w-20 bg-amber-600 rounded"></div>
                                    </div>
                                    <div class="h-20 bg-purple-600/10 rounded-lg border border-purple-600/20 p-4">
                                        <div class="h-2 w-12 bg-purple-600/30 rounded mb-2"></div>
                                        <div class="h-4 w-20 bg-purple-600 rounded"></div>
                                    </div>
                                </div>
                                <div class="flex-1 space-y-4">
                                    <div class="h-full bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-700 p-4 flex flex-col">
                                        <div class="h-4 w-32 bg-slate-200 dark:bg-slate-700 rounded mb-4"></div>
                                        <div class="flex-1 flex items-end gap-2 px-4">
                                            <div class="flex-1 h-[40%] bg-indigo-500/40 rounded-t"></div>
                                            <div class="flex-1 h-[70%] bg-indigo-500/60 rounded-t"></div>
                                            <div class="flex-1 h-[50%] bg-indigo-500/40 rounded-t"></div>
                                            <div class="flex-1 h-[90%] bg-indigo-500 rounded-t"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-amber-600 rounded-2xl shadow-2xl flex flex-col items-center justify-center text-white rotate-6 hover:rotate-0 transition-all duration-500">
                            <span class="text-3xl font-bold font-outfit">2B+</span>
                            <span class="text-[10px] uppercase tracking-widest font-semibold opacity-70 text-center px-2">Transactions Handled</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Catalog Section -->
        <section id="catalog" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 border-t border-slate-100 dark:border-slate-800 mt-12">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6 animate-fade-in">
                <div>
                    <h2 class="text-4xl font-bold font-outfit mb-3 text-slate-900 dark:text-white">Katalog Barang</h2>
                    <p class="text-slate-600 dark:text-slate-400">Explore our newest arrivals and featured products.</p>
                </div>
                <!-- Filters -->
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ !request('kategori') ? 'bg-amber-600 text-white shadow-lg shadow-amber-500/20' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700' }} transition-all">
                        All Items
                    </a>
                    @foreach($kategoris as $kat)
                        <a href="{{ route('home', ['kategori' => $kat->kategori_id]) }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request('kategori') == $kat->kategori_id ? 'bg-amber-600 text-white shadow-lg shadow-amber-500/20' : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700' }} transition-all">
                            {{ $kat->kategori_nama }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($barangs as $barang)
                    <div class="group bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 p-4 hover:shadow-2xl hover:border-amber-600/30 transition-all duration-300 animate-fade-in">
                        <div class="aspect-square bg-slate-50 dark:bg-slate-950 rounded-xl mb-4 flex items-center justify-center text-slate-300 dark:text-slate-700 relative overflow-hidden">
                            <svg class="w-16 h-16 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span class="absolute top-3 right-3 px-2 py-1 bg-white/80 dark:bg-slate-900/80 backdrop-blur rounded-md text-[10px] font-bold uppercase tracking-wider text-amber-600 border border-slate-100 dark:border-slate-800">
                                {{ $barang->barang_kode }}
                            </span>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between items-start gap-2">
                                <h3 class="font-bold text-lg leading-tight group-hover:text-amber-600 dark:group-hover:text-indigo-400 transition-colors uppercase text-slate-800 dark:text-slate-200">{{ $barang->barang_nama }}</h3>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-amber-600 dark:text-amber-400">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</span>
                                <span class="bg-indigo-50 dark:bg-indigo-900/30 text-amber-600 dark:text-indigo-300 px-2 py-0.5 rounded text-[10px] font-bold uppercase">{{ $barang->kategori->kategori_nama }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-xs font-medium border-t border-slate-50 dark:border-slate-800 pt-3 mt-3">
                                @php $stock = $barang->stoks->sum('stok_jumlah'); @endphp
                                <div class="flex items-center gap-1.5 {{ $stock < 10 ? 'text-rose-500' : 'text-emerald-500' }}">
                                    <span class="w-2 h-2 rounded-full {{ $stock < 10 ? 'bg-rose-500' : 'bg-emerald-500' }}"></span>
                                    Stock: {{ $stock }}
                                </div>
                            </div>
                            @if($barang->stoks->first() && $barang->stoks->first()->supplier)
                                <div class="pt-2">
                                    <a href="{{ route('suppliers.show', $barang->stoks->first()->supplier_id) }}" class="text-[11px] text-slate-400 hover:text-amber-600 dark:hover:text-indigo-400 transition-colors flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                                        {{ $barang->stoks->first()->supplier->supplier_nama }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center border-2 border-dashed border-gray-100 dark:border-[#3e3e3a] rounded-3xl">
                        <span class="text-gray-400 font-medium italic">No products found in this category.</span>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-16 animate-fade-in">
                {{ $barangs->appends(request()->query())->links() }}
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-12">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <div class="flex items-center justify-center gap-2 mb-6">
                    <div class="w-8 h-8 bg-amber-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm font-outfit">F</span>
                    </div>
                    <span class="text-lg font-bold font-outfit tracking-tight text-slate-400 dark:text-slate-500">FIJRI <span class="text-amber-600/50 dark:text-amber-400/50">POS</span></span>
                </div>
                <p class="text-sm text-slate-500 dark:text-slate-400">&copy; {{ date('Y') }} FIJRI POS. Built for PWL UTS. All rights reserved.</p>
            </div>
        </footer>
    </body>
</html>
