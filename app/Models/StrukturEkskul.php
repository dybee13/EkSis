<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StrukturEkskul extends Model
{
    protected $table = 'struktur_ekskuls';
    protected $fillable = ['id_ekskul', 'ketua_ekskul', 'waketu_ekskul', 'bendahara'];
    use HasFactory;

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function ekskul() : BelongsTo
    {
        return $this->belongsTo(Ekskuls::class, 'id_ekskul');
    }

    public function anggotaEkskul() : BelongsTo
    {
        return $this->belongsTo(Ekskuls::class, 'id_anggota_ekskul');
    }

    public function informasiEkskul(): HasMany
    {
        return $this->hasMany(InformasiEkskul::class, 'id_struktur');
    }
}
