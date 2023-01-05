<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * ------------------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Latvian
 * locale: Latvia
 * author : Lauris Bukšis-Haberkorns : https://github.com/Lafriks
 */

class Language_lvLV extends AbstractLanguage
{
    public static $code = 'lv-LV';

    protected $delimiters = [
        'thousands' => ' ',
        'decimal' => ','
    ];

    protected $currency = [
        'symbol' => '\u20ac', // €
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    protected $abbreviations = [
        'thousand' => ' \u0074\u016b\u006b\u0073\u0074\u002e', // tūkst.
        'million' => ' \u006d\u0069\u006c\u006a\u002e', //  milj.
        'billion' => ' \u006d\u006c\u006a\u0072\u0064\u002e', //  mljrd.
        'trillion' => ' \u0074\u0072\u0069\u006c\u006a\u002e' //  trilj.
    ];

    public function ordinal($number)
    {
        return '.';
    }

}