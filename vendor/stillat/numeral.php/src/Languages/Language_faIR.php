<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * -----------------------------------------------
 *
 * numbro.js language configuration
 * language : Farsi
 * locale: Iran
 * author : neo13 : https://github.com/neo13
 */

class Language_faIR extends AbstractLanguage
{
    public static $code = 'fa-IR';

    protected $delimiters = [
        'thousands' => '،',
        'decimal' => '.'
    ];

    protected $currency = [
        'symbol' => '\ufdfc'
    ];

    protected $abbreviations = [
        'thousand' => '\u0647\u0632\u0627\u0631', // هزار
        'million' => '\u0645\u06cc\u0644\u06cc\u0648\u0646', // میلیون
        'billion' => '\u0645\u06cc\u0644\u06cc\u0627\u0631\u062f', // میلیارد
        'trillion' => '\u062a\u0631\u06cc\u0644\u06cc\u0648\u0646' // تریلیون
    ];

    public function ordinal($number)
    {
        return  $this->decode('\u0627\u0645'); // ام
    }

}