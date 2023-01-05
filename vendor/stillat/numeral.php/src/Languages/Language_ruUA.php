<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * --------------------------------------------------------------
 *
 * numbro.js language configuration
 * language : Russian
 * locale : Ukraine
 * author : Anatoli Papirovski : https://github.com/apapirovski
 */

class Language_ruUA extends Language_ruRU
{
    public static $code = 'ru-UA';

    protected $currency = [
        'symbol' => '\u20B4', // ₴
        'position' => 'postfix'
    ];

}