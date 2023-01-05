<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * --------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Spanish
 * locale: Spain
 * author : Hernan Garcia : https://github.com/hgarcia
 */

class Language_esES extends Language_esAR
{
    public static $code = 'es-ES';

    protected $currency = [
        'symbol' => '\u20ac',
        'position' => 'postfix',
        'spaceSeparated' => true
    ];

}