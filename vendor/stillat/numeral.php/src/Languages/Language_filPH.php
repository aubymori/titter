<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * -------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Filipino (Pilipino)
 * locale: Philippines
 * author : Michael Abadilla : https://github.com/mjmaix
 */

class Language_filPH extends AbstractLanguage
{
    public static $code = 'fil-PH';

    protected $delimiters = [
        'thousands' => ',',
        'decimal' => '.'
    ];

    protected $abbreviations = [
        'thousand' => 'k',
        'million' => 'm',
        'billion' => 'b',
        'trillion' => 't'
    ];

    protected $currency = [
      'symbol' => '\u20b1'
    ];

    public function ordinal($number)
    {
        $b = intval($number % 10);

        if (intval($number % 100 / 10) === 1) {
            return 'th';
        } else {
            if ($b == 1) {
                return 'st';
            } elseif ($b == 2) {
                return 'nd';
            } elseif ($b == 3) {
                return 'rd';
            } else {
                return 'th';
            }
        }
    }

}