<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * --------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Portuguese
 * locale : Portugal
 * author : Diogo Resende : https://github.com/dresende
 */

class Language_ptPT extends AbstractLanguage
{
    public static $code = 'pt-PT';

    protected $delimiters = [
        'thousands' => ' ',
        'decimal' => ','
    ];

    protected $abbreviations = [
        'thousand' => 'k',
        'million' => 'm',
        'billion' => 'b',
        'trillion' => 't'
    ];

    protected $currency = [
        'symbol' => '\u20ac', // €
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    public function ordinal($number)
    {
        return 'º';
    }

}