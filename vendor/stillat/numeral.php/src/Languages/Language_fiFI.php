<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * -----------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Finnish
 * locale: Finland
 * author : Sami Saada : https://github.com/samitheberber
 */

class Language_fiFI extends AbstractLanguage
{
    public static $code = 'fi-FI';

    protected $delimiters = [
        'thousands' => ' ',
        'decimal' => ','
    ];

    protected $abbreviations = [
        'thousand' => 'k',
        'million' => 'M',
        'billion' => 'G',
        'trillion' => 'T'
    ];

    protected $currency = [
        'symbol' => '\u20ac',
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    public function ordinal($number)
    {
        return '.';
    }

}