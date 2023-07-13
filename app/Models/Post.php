<?php

namespace App\Models;

use App\Models\Type;
use App\Traits\Slugger;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use Slugger;
    use SoftDeletes;

    public function getRouteKey()
    {
        return $this->slug;
    }

    public function type()
    {
        // belongTo() si usa nel Model della tabella che contiene la key esterna
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        // belongToMany() si usa nel Model della tabella che contiene la key esterna in un rapporto molti a molti
        return $this->belongsToMany(Technology::class);
    }
}
