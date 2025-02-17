<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'no_hp',
        'nip',
        'nis',
        'kelas',
        'jurusan',
        'pp',
        'role',
        'password',
    ];

    // Relasi ke Ekskul yang diampu (melalui ekskul_users)
    public function ekskuls(): BelongsToMany
    {
        return $this->belongsToMany(Ekskuls::class, 'ekskul_users', 'id_user', 'id_ekskul');
    }

    // Relasi ke Data Anggota (sebagai pembina)
    public function anggota(): HasMany
    {
        return $this->hasMany(AnggotaEkskul::class, 'id_pembina');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
