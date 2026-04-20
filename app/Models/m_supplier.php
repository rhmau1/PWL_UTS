<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class m_supplier extends Model
{
    //
    protected $table = 'm_supplier';

    protected $primaryKey = 'supplier_id';

    public $timestamps = false;

    protected $fillable = [
        'supplier_kode',
        'supplier_nama',
        'supplier_alamat',
    ];

    public function stoks()
    {
        return $this->hasMany(t_stok::class, 'supplier_id');
    }

    public function barangs()
    {
        return $this->hasManyThrough(
            m_barang::class,
            t_stok::class,
            'supplier_id',
            'barang_id',
            'supplier_id',
            'barang_id'
        );
    }
}
