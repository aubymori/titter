<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * -------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Hebrew
 * locale : IL
 * author : Eli Zehavi : https://github.com/eli-zehavi
 */

class Language_heIL extends AbstractLanguage
{
    public static $code = 'he-IL';

    protected $delimiters = [
        'thousands' => ',',
        'decimal' => '.'
    ];

    protected $currency = [
        'symbol' => '\u20aa',
        'position' => 'prefix',
        'spaceSeparated' => true
    ];

    protected $abbreviations = [
        'thousand' => '\u05d0\u05dc\u05e3',
        'million' => '\u05de\u05dc\u05d9\u05d5\u05df',
        'billion' => '\u05d1\u05dc\u05d9\u05d5\u05df',
        'trillion' => '\u05d8\u05e8\u05d9\u05dc\u05d9\u05d5\u05df'
    ];

}