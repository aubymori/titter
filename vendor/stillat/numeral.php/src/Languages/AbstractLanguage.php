<?php

namespace Stillat\Numeral\Languages;

use Stillat\Numeral\Traits\JsonDecodeTrait;

abstract class AbstractLanguage
{

    use JsonDecodeTrait;

    public static $code = '';

    protected $delimiters = [
        'thousands' => '',
        'decimal' => ''
    ];

    protected $abbreviations = [
        'thousand' => 'k',
        'million' => 'm',
        'billion' => 'b',
        'trillion' => 't'
    ];

    protected $currency = [
        'symbol' => '',
        'position' => 'prefix',
        'spaceSeparated' => false
    ];

    protected $cachedAbbreviations = null;
    protected $cachedCurrency = null;
    protected $cachedDelimiters = null;

    public function ordinal($number)
    {
        return null;
    }

    public function getDelimiters()
    {
        if ($this->cachedDelimiters === null) {
            $this->cachedDelimiters = $this->decode($this->delimiters);
        }

        return $this->cachedDelimiters;
    }

    public function getAbbreviations()
    {
        if ($this->cachedAbbreviations === null) {
            $this->cachedAbbreviations = $this->decode($this->abbreviations);
        }

        return $this->cachedAbbreviations;
    }

    public function getCurrency()
    {
        if ($this->cachedCurrency === null) {
            $this->cachedCurrency = $this->decode(array_merge([
                'symbol' => '$',
                'position' => 'prefix',
                'spaceSeparated' => false
            ], $this->currency));
        }

        return $this->cachedCurrency;
    }



}