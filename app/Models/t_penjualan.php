<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class t_penjualan extends Model
{
    protected $table = 't_penjualan';

    protected $primaryKey = 'penjualan_id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'pembeli',
        'penjualan_kode',
        'penjualan_tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(m_user::class, 'user_id');
    }

    public function details()
    {
        return $this->hasMany(t_penjualan_detail::class, 'penjualan_id');
    }
}
