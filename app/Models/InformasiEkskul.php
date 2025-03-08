<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InformasiEkskul extends Model
{
    protected $table = 'informasi_ekskuls';
    protected $fillable = ['id_ekskul', 'id_struktur','tgl_berdiri', 'logo', 'jadwal', 'deskripsi']; 
    use HasFactory;
    
    protected $casts = [
        'tgl_berdiri' => 'date', // Konversi otomatis ke objek Carbon
    ];

    public function ekskul() : BelongsTo
    {
        return $this->belongsTo(Ekskuls::class, 'id_ekskul');
    }

    public function strukturEkskul() : BelongsTo
    {
        return $this->belongsTo(StrukturEkskul::class, 'id_ekskul');
    }
}
