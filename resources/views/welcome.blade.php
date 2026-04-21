<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FIJRI POS</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        body { font-family: sans-serif; }
    </style>
</head>

<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100">

    <!-- NAVBAR -->
    <header class="bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">

            <div class="flex items-center gap-2 font-semibold">
                <div class="w-8 h-8 bg-amber-600 text-white flex items-center justify-center rounded">
                    F
                </div>
                FIJRI POS
            </div>

            <div class="flex items-center gap-4 text-sm">
                @auth
                    <a href="/admin" class="px-4 py-2 bg-amber-600 text-white rounded hover:bg-amber-700">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('filament.admin.auth.login') }}" class="text-slate-600 dark:text-slate-400 hover:text-amber-600">
                        Masuk
                    </a>
                @endauth
            </div>

        </div>
    </header>


    <!-- HERO -->
    <section class="border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 py-16">

            <h1 class="text-3xl md:text-4xl font-semibold mb-4">
                Sistem Point of Sale
            </h1>

            <p class="text-slate-600 dark:text-slate-400 max-w-2xl mb-6">
                Kelola penjualan, stok barang, dan supplier dengan lebih mudah dan terstruktur dalam satu sistem.
            </p>

            <a href="#catalog"
               class="inline-block px-6 py-3 bg-amber-600 text-white rounded-lg text-sm hover:bg-amber-700">
                Lihat Data Barang
            </a>

        </div>
    </section>


    <!-- CATALOG -->
    <section id="catalog" class="max-w-7xl mx-auto px-4 py-12">

        <!-- HEADER -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Daftar Barang</h2>
            <p class="text-sm text-slate-500">
                Data barang yang tersedia dalam sistem.
            </p>
        </div>

        <!-- FILTER -->
        <div class="flex flex-wrap gap-2 mb-6">

            <a href="{{ route('home') }}"
               class="px-3 py-1.5 rounded-md text-sm border
               {{ !request('kategori') ? 'bg-amber-600 text-white border-amber-600' : 'bg-white dark:bg-slate-800 border-slate-300 dark:border-slate-700 text-slate-600 dark:text-slate-300' }}">
                Semua
            </a>

            @foreach($kategoris as $kat)
                <a href="{{ route('home', ['kategori' => $kat->kategori_id]) }}"
                   class="px-3 py-1.5 rounded-md text-sm border
                   {{ request('kategori') == $kat->kategori_id ? 'bg-amber-600 text-white border-amber-600' : 'bg-white dark:bg-slate-800 border-slate-300 dark:border-slate-700 text-slate-600 dark:text-slate-300' }}">
                    {{ $kat->kategori_nama }}
                </a>
            @endforeach

        </div>


        <!-- LIST -->
        <div class="space-y-3">

            @forelse($barangs as $barang)
                @php $stock = $barang->stoks->sum('stok_jumlah'); @endphp

               <div class="grid grid-cols-12 items-center p-4 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-lg">

    <!-- NAMA -->
    <div class="col-span-6">
        <h3 class="font-medium">
            {{ $barang->barang_nama }}
        </h3>
        <p class="text-sm text-slate-500">
            {{ $barang->kategori->kategori_nama }}
        </p>
    </div>

    <!-- HARGA -->
    <div class="col-span-3 text-sm text-slate-600 dark:text-slate-400 text-right">
        Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}
    </div>

    <!-- STOK -->
    <div class="col-span-3 text-sm font-medium text-right
        {{ $stock < 10 ? 'text-red-500' : 'text-green-500' }}">
        {{ $stock }}
    </div>

</div>

            @empty
                <div class="text-center py-12 text-slate-500">
                    Tidak ada data barang.
                </div>
            @endforelse

        </div>


        <!-- PAGINATION -->
        <div class="mt-10">
            {{ $barangs->appends(request()->query())->links() }}
        </div>

    </section>


    <!-- FOOTER -->
    <footer class="text-center py-6 text-sm text-slate-500 border-t border-slate-200 dark:border-slate-800">
        © {{ date('Y') }} FIJRI POS
    </footer>

</body>
</html>