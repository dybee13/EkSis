<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

}
