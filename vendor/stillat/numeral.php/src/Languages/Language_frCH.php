<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * ---------------------------------------------------------
 *
 * numbro.js language configuration
 * language : French
 * locale: Switzerland
 * author : Adam Draper : https://github.com/adamwdraper
 */

class Language_frCH extends AbstractLanguage
{

    protected $delimiters = [
        'thousands' => '\'',
        'decimal' => '.'
    ];

    protected $currency = [
        'symbol' => 'CHF',
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    public function ordinal($number)
    {
        return ($number === 1) ? 'er' : 'ème';
    }

}