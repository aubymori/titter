<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * -------------------------------------------------------------
 * numbro.js language configuration
 * language : Czech
 * locale: Czech Republic
 * author : Anatoli Papirovski : https://github.com/apapirovski
 */

class Language_csCZ extends AbstractLanguage
{
    public static $code = 'cs-CZ';

    protected $delimiters = [
        'thousands' => ' ',
        'decimal' => ','
    ];

    protected $currency = [
        'symbol' => '\u004b\u010d',
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    protected $abbreviations = [
        'thousand' => 'tis.',
        'million' => 'mil.',
        'billion' => 'b',
        'trillion' => 't'
    ];

    public function ordinal($number)
    {
        return '.';
    }

}