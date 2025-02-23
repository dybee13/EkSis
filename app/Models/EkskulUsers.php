<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EkskulUsers extends Model
{
    use HasFactory;
    protected $table = 'ekskul_users';
    protected $fillable = ['id_user', 'id_ekskul',];

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke Ekskul
    public function ekskul(): BelongsTo
    {
        return $this->belongsTo(Ekskuls::class, 'id_ekskul');
    }
}
