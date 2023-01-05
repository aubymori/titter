<?php

namespace Stillat\Numeral\Languages;

/*
 * Original notice
 * --------------------------------------------------
 *
 * numbro.js language configuration
 * language : simplified chinese
 * locale : China
 * author : badplum : https://github.com/badplum
 */

class Language_zhCN extends AbstractLanguage
{
    public static $code = 'zh-CN';

    protected $delimiters = [
        'thousands' => ',',
        'decimal' => '.'
    ];

    protected $currency = [
        'position' => 'prefix',
        'symbol' => '\u00a5', // ¥
        'spaceSeparated' => true
    ];

    protected $abbreviations = [
        'thousand' => '\u5343', // 千
        'million' => '\u767e\u4e07', // 百万
        'billion' => '\u5341\u4ebf', // 十亿
        'trillion' => '\u5146'// 兆
    ];
    
    public function ordinal($number)
    {
        return '.';
    }

}