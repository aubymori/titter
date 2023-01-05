<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * -----------------------------------------------------
 *
 * numbro.js language configuration
 * language : Italian
 * locale: Italy
 * author : Giacomo Trombi : http://cinquepunti.it
 */

class Language_itIT extends AbstractLanguage
{
    public static $code = 'it-IT';

    protected $delimiters = [
        'thousands' => '.',
        'decimal' => ','
    ];

    protected $abbreviations = [
        'thousand' => 'mila',
        'million' => 'mil',
        'billion' => 'b',
        'trillion' => 't'
    ];

    protected $currency = [
        'symbol' => '\u20ac', // €
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    public function ordinal($number)
    {
        return $this->decode('\u00ba'); // º
    }

}