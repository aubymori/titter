<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * ---------------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Turkish
 * locale : Turkey
 * author : Ecmel Ercan : https://github.com/ecmel,
 *          Erhan Gundogan : https://github.com/erhangundogan,
 *          Burak Yiğit Kaya: https://github.com/BYK
 */

class Language_trTR extends AbstractLanguage
{
    public static $code = 'tr-TR';

    protected $suffixes = [
        1 => '\'inci',
        5 => '\'inci',
        8 => '\'inci',
        70 => '\'inci',
        80 => '\'inci',

        2 => '\'nci',
        7 => '\'nci',
        20 => '\'nci',
        50 => '\'nci',

        3 => '\'üncü',
        4 => '\'üncü',
        100 => '\'üncü',

        6 => '\'ncı',

        9 => '\'uncu',
        10 => '\'uncu',
        30 => '\'uncu',

        60 => '\'ıncı',
        90 => '\'ıncı'
    ];

    protected $currency = [
        'symbol' => '\u20BA',
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

    protected $delimiters = [
        'thousands' => '.',
        'decimal' => ','
    ];

    protected $abbreviations = [
        'thousand' => 'bin',
        'million' => 'milyon',
        'billion' => 'milyar',
        'trillion' => 'trilyon'
    ];

    public function ordinal($number)
    {
        if ($number === 0) {
            return '\'ıncı';
        }
        $a = $number % 10;
        $b = $number % 100 - $a;
        $c = ($number >= 100) ? 100 : null;

        if (isset($this->suffixes[$a])) {
            return $this->suffixes[$a];
        }

        if (isset($this->suffixes[$b])) {
            return $this->suffixes[$b];
        }

        return $this->suffixes[$c];
    }

}