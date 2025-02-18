<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnggotaEkskul extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $table = 'data_anggota_ekskul';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nis',
        'jurusan',
        'email',
        'no_hp',
        'pp',
        'id_pembina',
    ];

    // Relasi ke User (Pembina)
    public function pembina(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pembina');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
}
