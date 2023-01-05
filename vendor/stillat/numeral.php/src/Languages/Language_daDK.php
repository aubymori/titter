<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * ------------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Danish
 * locale: Denmark
 * author : Michael Storgaard : https://github.com/mstorgaard
 */

class Language_daDK extends AbstractLanguage
{
    public static $code = 'da-DK';

    protected $delimiters = [
        'thousands' => '.',
        'decimal' => ','
    ];

    protected $currency = [
        'symbol' => 'kr',
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    protected $abbreviations = [
        'thousand' => 'k',
        'million' => 'mio',
        'billion' => 'mia',
        'trillion' => 'b'
    ];

    public function ordinal($number)
    {
        return '.';
    }

}