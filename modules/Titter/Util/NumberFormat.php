<?php
namespace Titter\Util;

use Stillat\Numeral\Languages\LanguageManager;
use Stillat\Numeral\Numeral;

class NumberFormat
{
    private static LanguageManager $langManager;
    private static Numeral $formatter;

    public static function __initStatic()
    {
        self::$langManager = new LanguageManager();
        self::$formatter = new Numeral();
        self::$formatter->setLanguageManager(self::$langManager);
    }

    public static function shorten(int $number)
    {
        if ($number < 10000)
        {
            return self::$formatter->format($number, "0,0");
        }

        switch (strlen((string) $number) % 3)
        {
            case 0:
                return strtoupper(self::$formatter->format($number, "0a"));
            case 1:
                return strtoupper(self::$formatter->format($number, "0a.00"));
            case 2:
                return strtoupper(self::$formatter->format($number, "0a.0"));
        }
    }
}