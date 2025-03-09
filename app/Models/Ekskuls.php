<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ekskuls extends Model
{
    use HasFactory;


    protected $table = 'ekskuls';
    protected $fillable = ['nama_ekskul'];

    // Relasi ke User (melalui ekskul_users)
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ekskul_users', 'id_ekskul', 'id_user');
    }

    public function ekskulUsers()
    {
        return $this->hasMany(EkskulUsers::class, 'ekskul_id');
    }

    public function strukturEkskul(): HasOne
    {
        return $this->hasOne(StrukturEkskul::class, 'id_ekskul');
    }

    public function informasiEkskul(): HasOne
    {
        return $this->hasOne(InformasiEkskul::class, 'id_ekskul');
    }
    public function anggotaEkskul(): HasMany
    {
        return $this->hasMany(AnggotaEkskul::class, 'id_ekskul');
    }
    public function blogs(): HasMany
    {
        return $this->hasMany(Blogs::class, 'id_ekskul');
    }

}
