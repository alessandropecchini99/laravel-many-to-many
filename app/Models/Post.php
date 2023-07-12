<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function type()
    {
        // belongTo() si usa nel Model della tabella che contiene la key esterna
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        // belongTo() si usa nel Model della tabella che contiene la key esterna
        return $this->belongsToMany(Technology::class);
    }
}
