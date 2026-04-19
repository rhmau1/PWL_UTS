<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class t_stok extends Model
{
    //
    protected $table = 't_stok';
    protected $primaryKey = 'stok_id';
    public $timestamps = false;
    protected $fillable = [
        'barang_id',
        'user_id',
        'supplier_id',
        'stok_jumlah',
        'stok_tanggal',
    ];

    public function barang()
    {
        return $this->belongsTo(m_barang::class, 'barang_id');
    }

    public function user()
    {
        return $this->belongsTo(m_user::class, 'user_id');
    }

    public function supplier()
    {
        return $this->belongsTo(m_supplier::class, 'supplier_id');
    }
}
