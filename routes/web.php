<?php

use App\Models\m_barang;
use App\Models\m_supplier;
use App\Models\m_kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $query = m_barang::with(['kategori', 'stoks']);

    if ($request->has('kategori')) {
        $query->where('kategori_id', $request->kategori);
    }

    $barangs = $query->latest('barang_id')->paginate(8);
    $kategoris = m_kategori::all();

    return view('welcome', compact('barangs', 'kategoris'));
})->name('home');

Route::get('/login', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('login');

Route::get('/suppliers/{id}', function ($id) {
    $supplier = m_supplier::with(['barangs' => function($q) {
        $q->distinct();
    }])->findOrFail($id);
    
    return view('suppliers.show', compact('supplier'));
})->name('suppliers.show');
