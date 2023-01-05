<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * ------------------------------------------------------
 *
 * numbro.js language configuration
 * language : English
 * locale: South Africa
 * author : Stewart Scott https://github.com/stewart42
 */

class Language_enZA extends AbstractLanguage
{
    public static $code = 'en-ZA';

    protected $delimiters = [
        'thousands' => ',',
        'decimal' => '.'
    ];

    protected $currency = [
        'symbol' => 'R',
        'position' => 'prefix',
        'spaceSeparated' => true
    ];

    protected $abbreviations = [
        'thousand' => 'k',
        'million' => 'm',
        'billion' => 'b',
        'trillion' => 't'
    ];

    public function ordinal($number)
    {
        $b = intval($number % 10);

        if (intval($number % 100 / 10) === 1) {
            return 'th';
        } else {
            if ($b == 1) {
                return 'st';
            } elseif ($b == 2) {
                return 'nd';
            } elseif ($b == 3) {
                return 'rd';
            } else {
                return 'th';
            }
        }
    }

}