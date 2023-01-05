<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * -----------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Spanish
 * locale: Argentina
 * author : Hernan Garcia : https://github.com/hgarcia
 */

class Language_esAR extends AbstractLanguage
{
    public static $code = 'es-AR';

    protected $delimiters = [
        'thousands' => '.',
        'decimal' => ','
    ];

    protected $currency = [
        'symbol' => '$',
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    protected $abbreviations = [
        'thousand' => 'k',
        'million' => 'mm',
        'billion' => 'b',
        'trillion' => 't'
    ];

    public function ordinal($number)
    {
        $b = intval($number % 10);

        switch ($b) {
            case 1:
            case 3:
                return 'er';
            case 2:
                return 'do';
            case 7:
            case 0:
                return 'mo';
            case 8:
                return 'vo';
            case 9:
                return 'no';
            default:
                return 'to';
        }
    }

}