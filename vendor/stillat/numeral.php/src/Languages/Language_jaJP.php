<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * -------------------------------------------------
 *
 * numbro.js language configuration
 * language : Japanese
 * locale: Japan
 * author : teppeis : https://github.com/teppeis
 */

class Language_jaJP extends AbstractLanguage
{
    public static $code = 'ja-JP';

    protected $delimiters = [
        'thousands' => ',',
        'decimal' => '.'
    ];

    protected $currency = [
        'symbol' => '\u00a5',
        'position' => 'prefix',
        'spaceSeparated' => true
    ];

    protected $abbreviations = [
        'thousand' => '\u5343',
        'million' => '\u767e\u4e07',
        'billion' => '\u5341\u5104',
        'trillion' => '\u5146'
    ];

    public function ordinal($number)
    {
        return '.';
    }

}