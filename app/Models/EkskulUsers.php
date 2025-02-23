<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EkskulUsers extends Model
{
    use HasFactory;
    protected $table = 'ekskul_users';
    protected $fillable = ['id_user', 'id_ekskul',];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function ekskul()
    {
        return $this->belongsTo(Ekskuls::class, 'id_ekskul');
    }
}
