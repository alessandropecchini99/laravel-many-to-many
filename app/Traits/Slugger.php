<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Slugger
{

    public static function slugger($string)
    {
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

        // ritorno lo slug
        return $slug;
    }
}
