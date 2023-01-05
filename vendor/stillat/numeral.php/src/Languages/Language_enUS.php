<?php

namespace Stillat\Numeral\Languages;

/*
 * This is the same as the "default culture" included in numbro js.
 * For the specific code definition see https://github.com/foretagsplatsen/numbro/blob/develop/numbro.js#L28-L59
 *
 * Original file copyright notice
 * ---------------------------------
 * numbro.js
 * version : 1.6.2
 * author : Företagsplatsen AB
 * license : MIT
 * http://www.foretagsplatsen.se
 */

class Language_enUS extends AbstractLanguage
{

    public static $code = 'en-US';

    protected $delimiters = [
        'thousands' => ',',
        'decimal' => '.'
    ];

    protected $currency = [
        'symbol' => '$'
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