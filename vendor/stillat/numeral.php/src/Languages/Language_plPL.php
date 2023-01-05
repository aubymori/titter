<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * -----------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Polish
 * locale : Poland
 * author : Dominik Bulaj : https://github.com/dominikbulaj
 */

class Language_plPL extends AbstractLanguage
{
    public static $code = 'pl-PL';

    protected $delimiters = [
        'thousands' => ' ',
        'decimal' => ','
    ];

    protected $abbreviations = [
        'thousand' => 'tys.',
        'million' => 'mln',
        'billion' => 'mld',
        'trillion' => 'bln'
    ];

    protected $currency = [
        'symbol' => ' \u007a\u0142', // zł
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    public function ordinal($number)
    {
        return '.';
    }

}