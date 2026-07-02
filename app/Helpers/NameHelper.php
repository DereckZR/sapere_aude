<?php

namespace App\Helpers;

class NameHelper
{
    private const IGNORED_SURNAME_PARTICLES = [
        'de',
        'del',
        'la',
        'las',
        'el',
        'los',
        'van',
        'von',
        'da',
        'das',
        'do',
        'dos',
        'di',
        'du',
        'le',
        'mac',
        'mc',
    ];

    public static function getSurnameInitial(string $surname): string
    {
        $words = preg_split('/\s+/', trim($surname));

        foreach ($words as $word) {
            if (!in_array(strtolower($word), self::IGNORED_SURNAME_PARTICLES, true)) {
                return strtoupper(mb_substr($word, 0, 1));
            }
        }

        return '';
    }
}