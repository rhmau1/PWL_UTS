<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class m_kategori extends Model
{
    protected $table = 'm_kategori';

    protected $primaryKey = 'kategori_id';

    public $timestamps = false;

    protected $fillable = [
        'kategori_kode',
        'kategori_nama',
    ];
}
