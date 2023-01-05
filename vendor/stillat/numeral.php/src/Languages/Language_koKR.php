<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * --------------------------------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Korean
 * author (numbro.js Version): Randy Wilander : https://github.com/rocketedaway
 * author (numeral.js Version) : Rich Daley : https://github.com/pedantic-git
 */

class Language_koKR extends AbstractLanguage
{
    public static $code = 'ko-KR';

    protected $delimiters = [
        'thousands' => ',',
        'decimal' => '.'
    ];

    protected $abbreviations = [
        'thousand' => '\ucc9c',
        'million' => '\ubc31\ub9cc',
        'billion' => '\uc2ed\uc5b5',
        'trillion' => '\uc77c\uc870'
    ];

    protected $currency = [
        'symbol' => '\u20a9'
    ];

    public function ordinal($number)
    {
        return '.';
    }

}