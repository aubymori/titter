<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * ----------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Estonian
 * locale: Estonia
 * author : Illimar Tambek : https://github.com/ragulka
 *
 * Note: in Estonian, abbreviations are always separated
 * from numbers with a space
 */

class Language_etEE extends AbstractLanguage
{
    public static $code = 'et-EE';

    protected $delimiters = [
        'thousands' => ' ',
        'decimal' => ','
    ];

    protected $abbreviations = [
        'thousand' => 'tuh',
        'million' => 'mln',
        'billion' => 'mld',
        'trillion' => 'trl'
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