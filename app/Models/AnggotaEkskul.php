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
        'id_ekskul',
        'name',
        'nis',
        'jurusan',
        'email',
        'no_hp',
        'pp',
    ];

    // Relasi ke ekskul
    public function ekskul() : BelongsTo
    {
        return $this->belongsTo(Ekskuls::class, 'id_ekskul');
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalEkskul::class, 'id_anggota');
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
