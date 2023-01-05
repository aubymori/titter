<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * -------------------------------------------------------
 * s
 * numbro.js language configuration
 * language : Slovak
 * locale : Slovakia
 * author : Ahmed Al Hafoudh : http://www.freevision.sk
 */

class Language_skSK extends AbstractLanguage
{
    public static $code = 'sk-SK';

    protected $delimiters = [
        'thousands' => ' ',
        'decimal' => ','
    ];

    protected $abbreviations = [
        'thousand' => 'tis.',
        'million' => 'mil.',
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
        return '.';
    }

}