<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class m_user extends Authenticatable implements FilamentUser
{
    use Notifiable;

    //
    protected $table = 'm_user';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'level_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function level()
    {
        return $this->belongsTo(m_level::class, 'level_id', 'level_id');
    }
}
