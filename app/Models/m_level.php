<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class m_level extends Model
{
    protected $table = 'm_level';
    protected $primaryKey = 'level_id';
    public $timestamps = false;
    protected $fillable = [
        'level_kode',
        'level_nama',
      ];
}
