<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * ---------------------------------------------------
 *
 * numbro.js language configuration
 * language : Dutch
 * locale: Netherlands
 * author : Dave Clayton : https://github.com/davedx
 */

class Language_nlNL extends AbstractLanguage
{
    public static $code = 'nl-NL';

    protected $delimiters = [
        'thousands' => '.',
        'decimal' => ','
    ];

    protected $abbreviations = [
        'thousand' => 'k',
        'million' => 'mln',
        'billion' => 'mrd',
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