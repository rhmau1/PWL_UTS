<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class t_penjualan_detail extends Model
{
    protected $table = 't_penjualan_detail';

    protected $primaryKey = 'detail_id';

    public $timestamps = false;

    protected $fillable = [
        'penjualan_id',
        'barang_id',
        'harga',
        'jumlah',
    ];

    public function penjualan()
    {
        return $this->belongsTo(t_penjualan::class, 'penjualan_id');
    }

    public function barang()
    {
        return $this->belongsTo(m_barang::class, 'barang_id');
    }
}
