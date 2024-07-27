<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory, SoftDeletes;
    use InteractsWithMedia;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function getProductsUrlAttribute()
{
    // Mengambil URL gambar pertama dari koleksi 'images/projects'
    if ($this->hasMedia('images/projects')) {
        return $this->getFirstMediaUrl('images/projects');
    }
    
    // Mengembalikan URL gambar default jika tidak ada media
    return asset('no-image.jpg');
}
}
