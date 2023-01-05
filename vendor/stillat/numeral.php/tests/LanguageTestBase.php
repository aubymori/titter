<?php

use Stillat\Numeral\Languages\LanguageManager;
use Stillat\Numeral\Numeral;

abstract class LanguageTestBase extends PHPUnit_Framework_TestCase
{

    /**
     * The LanguageManager instance.
     *
     * @var \Stillat\Numeral\Languages\LanguageManager
     */
    protected $languageManager;

    /**
     * The Numeral instance.
     *
     * @var \Stillat\Numeral\Numeral
     */
    protected $numeral;

    protected $languageClass;

    protected $formatTests = [];

    protected $currencyTests = [];

    protected $percentageTests = [];

    protected $unformatTests = [];

    public function setUp()
    {
        $this->languageManager = new LanguageManager;
        $lang = $this->getLangInstance();
        $this->languageManager->addCultureInstance($lang);
        $this->languageManager->setCulture($lang::$code);
        $this->numeral = new Numeral;
        $this->numeral->setLanguageManager($this->languageManager);
    }

    abstract protected function getLangInstance();

    protected function assertActuallyEquals($expected, $value)
    {
        $this->assertEquals(strlen($expected), strlen($value), "Expected {$expected} got {$value}");
        $this->assertEquals($expected, $value);
    }

    protected function runTestsOnArray($array, $func)
    {
        foreach ($array as $test) {
            $value = $this->numeral->{$func}($test[0], $test[1]);
            $this->assertActuallyEquals($this->decode($test[2]), $value);
        }
    }


    public function testLanguageFormat()
    {
        $this->runTestsOnArray($this->formatTests, 'format');
    }

    public function testLanguagePercentage()
    {
        $this->runTestsOnArray($this->percentageTests, 'format');
        $this->runTestsOnArray($this->percentageTests, 'formatPercentage');
    }

    public function testLanguageCurrency()
    {
        $this->runTestsOnArray($this->currencyTests, 'format');
        $this->runTestsOnArray($this->currencyTests, 'formatCurrency');
    }

    public function testLanguageUnformat()
    {
        foreach ($this->unformatTests as $test) {
            $value = $this->numeral->unformat($test[0]);
            $this->assertEquals($test[1], $value);
        }
    }

    protected function decode($value)
    {
        if (is_array($value)) {
            return array_map(function($value) {
                return $this->decode($value);
            }, $value);
        }
        return json_decode('"'.$value.'"');
    }

}