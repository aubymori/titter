<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * -------------------------------------------------
 *
 * numbro.js language configuration
 * language : simplified chinese
 * locale : China
 * author : badplum : https://github.com/badplum
 */

class Language_zhTW extends AbstractLanguage
{
    public static $code = 'zh-TW';

    protected $delimiters = [
        'thousands' => ',',
        'decimal' => '.'
    ];

    protected $currency = [
        'symbol' => 'NT$'
    ];

    protected $abbreviations = [
        'thousand' => '千',
        'million' => '百萬',
        'billion' => '十億',
        'trillion' => '兆'
    ];

    public function ordinal($number)
    {
        return '第';
    }

}