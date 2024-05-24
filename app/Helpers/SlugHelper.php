<?php

namespace App\Helpers;

use Transliterator;

class SlugHelper
{
    // doesnt need now
    public static function slugifyToEnglish(string $text)
    {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        if (function_exists('transliterator_transliterate'))
            $text = transliterator_transliterate('Any-Latin; Latin-ASCII', $text);
        $text = iconv('utf-8', 'ASCII//TRANSLIT//IGNORE', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', '', $text);

        return $text;
    }
}