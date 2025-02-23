<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekskuls extends Model
{
    use HasFactory;
    protected $table = 'ekskuls';
    protected $fillable = ['nama_ekskul'];

    public function ekskulUsers()
    {
        return $this->hasMany(EkskulUsers::class, 'id_ekskul');
    }

    public function pembina()
    {
        return $this->hasOneThrough(User::class, EkskulUsers::class, 'id_ekskul', 'id', 'id', 'id_user')
            ->where('users.role', 'pembina'); 
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'ekskul_users', 'id_ekskul', 'id_user');
    }
    }
