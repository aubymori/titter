<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * --------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Hungarian
 * locale: Hungary
 * author : Peter Bakondy : https://github.com/pbakondy
 */

class Language_huHU extends AbstractLanguage
{
    public static $code = 'hu-HU';

    protected $delimiters = [
        'thousands' => ' ',
        'decimal' => ','
    ];

    protected $currency = [
        'symbol' => ' Ft',
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    protected $abbreviations = [
        'thousand' => 'E',  // ezer
        'million' => 'M',   // millió
        'billion' => 'Mrd', // milliárd
        'trillion' => 'T'   // trillió
    ];

    public function ordinal($number)
    {
        return '.';
    }

}