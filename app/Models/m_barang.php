<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class m_barang extends Model
{
    //
    protected $table = 'm_barang';

    protected $primaryKey = 'barang_id';

    public $timestamps = false;

    protected $fillable = [
        'barang_kode',
        'barang_nama',
        'harga_beli',
        'harga_jual',
        'kategori_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(m_kategori::class, 'kategori_id');
    }
}
