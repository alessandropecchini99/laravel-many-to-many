<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Technology extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function posts()
    {
        // belongTo() si usa nel Model della tabella che contiene la key esterna
        return $this->belongsToMany(Post::class);
    }
}
