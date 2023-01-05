<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * ----------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Dutch
 * locale: Belgium
 * author : Dieter Luypaert : https://github.com/moeriki
 */

class Language_nlBE extends AbstractLanguage
{
    public static $code = 'nl-BE';

    protected $delimiters = [
        'thousands' => ' ',
        'decimal' => ','
    ];

    protected $abbreviations = [
        'thousand' => 'k',
        'million' => 'mln',
        'billion' => 'mld',
        'trillion' => 'bln'
    ];

    protected $currency = [
        'symbol' => '\u20ac', // €
        'position' => 'postfix',
        'spaceSeparated' => true
];

    public function ordinal($number)
    {
        $remainder = $number % 100;
        return ($number !== 0 && $remainder <= 1 || $remainder === 8 || $remainder >= 20) ? 'ste' : 'de';
    }


}