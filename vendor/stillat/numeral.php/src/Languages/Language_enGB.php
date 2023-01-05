<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * -----------------------------------------------------------------
 *
 * numbro.js language configuration
 * language : English
 * locale: United Kingdom of Great Britain and Northern Ireland
 * author : Dan Ristic : https://github.com/dristic
 */
class Language_enGB extends AbstractLanguage
{
    public static $code = 'en-GB';

    protected $delimiters = [
        'thousands' => ',',
        'decimal' => '.'
    ];

    protected $currency = [
        'symbol' => '\u00a3',
        'position' => 'prefix',
        'spaceSeparated' => true
    ];

    protected $abbreviations = [
        'thousand' => 'k',
        'million' => 'm',
        'billion' => 'b',
        'trillion' => 't'
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