<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenEkskul extends Model
{
    use HasFactory;

    protected $table = 'absen_ekskul';

    protected $fillable = ['id_anggota', 'id_ekskul', 'status', 'tanggal'];

    public function anggota()
    {
        return $this->belongsTo(AnggotaEkskul::class, 'id_anggota');
    }

    public function ekskul()
    {
        return $this->belongsTo(Ekskuls::class, 'id_ekskul');
    }
}
