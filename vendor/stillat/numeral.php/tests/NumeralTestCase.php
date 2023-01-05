<?php

use Stillat\Numeral\Languages\LanguageManager;
use Stillat\Numeral\Numeral;

abstract class NumeralTestCase extends PHPUnit_Framework_TestCase
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

    public function setUp()
    {
        $this->languageManager = new LanguageManager;
        $this->numeral = new Numeral;
        $this->numeral->setLanguageManager($this->languageManager);
    }

    /**
     * Runs common test on an array of values/conditions.
     *
     * @param        $array
     * @param string $func
     */
    protected function runTestsOnArray($array, $func = 'unformat')
    {
        foreach ($array as $input => $expectedOutput) {
            $this->assertEquals($expectedOutput, $this->numeral->{$func}($input));
        }
    }

}