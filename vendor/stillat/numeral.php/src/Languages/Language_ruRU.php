<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * ----------------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Russian
 * locale : Russsia
 * author : Anatoli Papirovski : https://github.com/apapirovski
 */

class Language_ruRU extends AbstractLanguage
{
    public static $code = 'ru-RU';

    protected $delimiters = [
        'thousands' => ' ',
        'decimal' => ','
    ];

    protected $currency = [
        'symbol' => '\u0440\u0443\u0431\u002e', //. руб.
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    protected $abbreviations = [
        'thousand' => '\u0442\u044b\u0441\u002e', // тыс.
        'million' => '\u043c\u043b\u043d', // млн
        'billion' => 'b',
        'trillion' => 't'
    ];

    public function ordinal($number)
    {
        // not ideal, but since in Russian it can taken on
        // different forms (masculine, feminine, neuter)
        // this is all we can do
        return '.';
    }

}