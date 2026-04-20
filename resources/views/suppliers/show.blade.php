<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $supplier->supplier_nama }} - FIJRI POS</title>
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
            @keyframes slide-up { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
            .animate-slide-up { animation: slide-up 0.5s ease-out forwards; }
        </style>
        <script>
            if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark');
            }
        </script>
    </head>
    <body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation -->
            <header class="border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900">
                <nav class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="w-8 h-8 bg-amber-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                            <span class="text-white font-bold text-sm font-outfit">F</span>
                        </div>
                        <span class="font-bold font-outfit tracking-tight">FIJRI <span class="text-amber-600">POS</span></span>
                    </a>
                    <a href="{{ route('home') }}" class="text-sm font-medium text-slate-500 dark:text-slate-400 hover:text-amber-600 dark:hover:text-amber-400 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        Back to Home
                    </a>
                </nav>
            </header>

            <main class="flex-1 max-w-7xl mx-auto px-4 py-12 w-full">
                <!-- Supplier Info Card -->
                <div class="bg-amber-600 rounded-3xl p-8 lg:p-12 mb-12 relative overflow-hidden shadow-2xl shadow-amber-500/20 animate-slide-up">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 -mr-20 -mt-20 rounded-full blur-3xl"></div>
                    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8 text-white">
                        <div>
                            <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-xs font-bold uppercase tracking-widest mb-4">Official Supplier</span>
                            <h1 class="text-4xl lg:text-5xl font-bold font-outfit mb-4 uppercase">{{ $supplier->supplier_nama }}</h1>
                            <div class="flex items-center gap-6 opacity-80 text-sm">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                                    Code: <span class="font-bold">{{ $supplier->supplier_kode }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                    {{ $supplier->supplier_alamat }}
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 text-center">
                            <span class="block text-3xl font-bold font-outfit mb-1">{{ $supplier->barangs->count() }}</span>
                            <span class="text-[10px] uppercase tracking-wider font-bold opacity-70 leading-none">Products Provided</span>
                        </div>
                    </div>
                </div>

                <!-- Product List -->
                <h2 class="text-3xl font-bold font-outfit mb-8 animate-slide-up [animation-delay:100ms] text-slate-900 dark:text-white">Daftar Produk yang Dikirim</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 animate-slide-up [animation-delay:200ms]">
                    @forelse($supplier->barangs as $barang)
                        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 p-4 flex flex-col hover:border-amber-600 dark:hover:border-indigo-400 transition-all group">
                            <div class="aspect-square bg-slate-50 dark:bg-slate-950 rounded-xl mb-4 flex items-center justify-center text-slate-300 dark:text-slate-700 relative overflow-hidden">
                                <svg class="w-12 h-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                <span class="absolute top-3 right-3 px-2 py-1 bg-white/80 dark:bg-slate-900/80 rounded-md text-[9px] font-bold uppercase tracking-wider text-amber-600">
                                    {{ $barang->barang_kode }}
                                </span>
                            </div>
                            <h3 class="font-bold mb-2 uppercase group-hover:text-amber-600 dark:group-hover:text-indigo-400 transition-colors text-slate-800 dark:text-slate-200">{{ $barang->barang_nama }}</h3>
                            <div class="mt-auto pt-4 flex items-center justify-between border-t border-slate-50 dark:border-slate-800">
                                <span class="text-sm font-bold text-amber-600 dark:text-amber-400">Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</span>
                                <span class="text-[10px] font-bold text-amber-600 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/30 px-2 py-0.5 rounded uppercase">{{ $barang->kategori->kategori_nama }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 text-center border-2 border-dashed border-gray-100 dark:border-[#3e3e3a] rounded-3xl">
                            <span class="text-gray-400 font-medium italic">This supplier has no products listed yet.</span>
                        </div>
                    @endforelse
                </div>
            </main>

            <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-8 mt-auto">
                <div class="max-w-7xl mx-auto px-4 text-center text-xs text-slate-500 dark:text-slate-400">
                    &copy; {{ date('Y') }} FIJRI POS. Supplier Portal.
                </div>
            </footer>
        </div>
    </body>
</html>
