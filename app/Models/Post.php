<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Technology;
use Illuminate\Support\Str;
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
        // belongToMany() si usa nel Model della tabella che contiene la key esterna in un rapporto molti a molti
        return $this->belongsToMany(Technology::class);
    }

    public static function slugger($string)
    {
        //Post::slugger($string)

        // genero le var di base e lo slug base
        $baseSlug = Str::slug($string);
        $i = 1;
        $slug = $baseSlug;

        // verifico se lo slug base è già presente nel db
        // se presente incrementare un contatore e concatenare il numero allo slug
        // ripetere finché non arriva uno slug non presente
        while (self::where('slug', $slug)->first()) {
            // genero il nuovo slug
            $slug = $baseSlug . '-' . $i;

            //incremento il contatore
            $i++;
        }

        return $slug;
    }
}
