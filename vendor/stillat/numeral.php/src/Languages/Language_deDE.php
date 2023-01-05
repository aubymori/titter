<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * --------------------------------------------------------------
 *
 * numbro.js language configuration
 * language : German
 * locale: Germany
 * author : Marco Krage : https://github.com/sinky
 *
 * Generally useful in Germany, Austria, Luxembourg, Belgium
 */
class Language_deDE extends AbstractLanguage
{
    public static $code = 'de-DE';

    protected $delimiters = [
        'thousands' => '.',
        'decimal' => ','
    ];

    protected $currency = [
        'symbol' => '\u20ac',
        'position' => 'postfix',
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
        return '.';
    }

}