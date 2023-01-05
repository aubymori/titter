<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * -----------------------------------------------------------------------------------------------------------------
 *
 * numbro.js language configuration
 * language : German
 * locale: Switzerland
 * author : Michael Piefel : https://github.com/piefel (based on work from Marco Krage : https://github.com/sinky)
 */

class Language_deCH extends AbstractLanguage
{
    public static $code = 'de-CH';

    protected $delimiters = [
        'thousands' => ' ',
        'decimal' => ','
    ];

    protected $currency = [
        'symbol' => 'CHF',
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