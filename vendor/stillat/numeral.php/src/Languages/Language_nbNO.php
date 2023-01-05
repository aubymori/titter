<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * --------------------------------------
 *
 * numbro.js language configuration
 * language: Norwegian Bokmål
 * locale: Norway
 * author : Benjamin Van Ryseghem
 */

class Language_nbNO extends AbstractLanguage
{
    public static $code = 'nb-NO';

    protected $delimiters = [
        'thousands' => ' ',
        'decimal' => ','
    ];

    protected $currency = [
        'symbol' => 'kr',
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    protected $abbreviations = [
        'thousand' => 't',
        'million' => 'M',
        'billion' => 'md',
        'trillion' => 't'
    ];

}