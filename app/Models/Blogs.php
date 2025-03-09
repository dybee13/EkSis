<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model {
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'slug',
        'body',
        'keterangan',
        'id_ekskul'
    ];

    public function blogImages() {
        return $this->hasMany(BlogImages::class, 'blog_id', 'id');
    }

    public function ekskul() {
        return $this->belongsTo(Ekskuls::class, 'id_ekskul');
    }
}
