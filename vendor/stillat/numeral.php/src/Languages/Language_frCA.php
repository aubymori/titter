<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * ------------------------------------------------------------
 *
 * numbro.js language configuration
 * language : French
 * locale: Canada
 * author : Léo Renaud-Allaire : https://github.com/renaudleo
 */

class Language_frCA extends AbstractLanguage
{

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
        'symbol' => '$',
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    public function ordinal($number)
    {
        return ($number === 1) ? 'er' : 'ème';
    }

}