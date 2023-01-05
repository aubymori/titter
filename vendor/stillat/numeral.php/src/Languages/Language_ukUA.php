<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * ----------------------------------------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Ukrainian
 * locale : Ukraine
 * author : Michael Piefel : https://github.com/piefel (with help from Tetyana Kuzmenko)
 */

class Language_ukUA extends AbstractLanguage
{
    public static $code = 'uk-UA';

    protected $delimiters = [
        'thousands' => ' ',
        'decimal' => ','
    ];

    protected $currency = [
        'symbol' => '\u20B4',
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    protected $abbreviations = [
        'thousand' => '\u0442\u044b\u0441\u002e', // тыс.
        'million' => '\u043c\u043b\u043d', // млн
        'billion' => '\u043c\u043b\u0440\u0434', // млрд
        'trillion' => '\u0431\u043b\u043d' //блн

    ];

    public function ordinal($number)
    {
        // not ideal, but since in Russian it can taken on
        // different forms (masculine, feminine, neuter)
        // this is all we can do
        return '';
    }

}