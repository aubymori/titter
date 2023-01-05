<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * -------------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Swedish
 * locale : Sweden
 * author : Benjamin Van Ryseghem (benjamin.vanryseghem.com)
 */

class Language_svSE extends AbstractLanguage
{
    public static $code = 'sv-SE';

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
        'trillion' => 'tmd'
    ];

}