<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalEkskul extends Model
{
    use HasFactory;

    protected $table = 'jadwal_ekskul';

    protected $fillable = ['id_ekskul', 'hari', 'jam_mulai', 'jam_selesai'];

    public function ekskul()
    {
        return $this->belongsTo(Ekskuls::class, 'id_ekskul');
    }
}