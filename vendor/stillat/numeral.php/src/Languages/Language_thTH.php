<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * --------------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Thai
 * locale : Thailand
 * author : Sathit Jittanupat : https://github.com/jojosati
 */

class Language_thTH extends AbstractLanguage
{
    public static $code = 'th-TH';

    protected $delimiters = [
        'thousands' => ',',
        'decimal' => '.'
    ];

    protected $currency = [
        'symbol' => '\u0e3f',
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    protected $abbreviations = [
        'thousand' => '\u0e1e\u0e31\u0e19',
        'million' => '\u0e25\u0e49\u0e32\u0e19',
        'billion' => '\u0e1e\u0e31\u0e19\u0e25\u0e49\u0e32\u0e19',
        'trillion' => '\u0e25\u0e49\u0e32\u0e19\u0e25\u0e49\u0e32\u0e19'
    ];

    public function ordinal($number)
    {
        return '.';
    }

}