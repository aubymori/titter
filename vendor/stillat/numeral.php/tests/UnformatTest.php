<?php

class UnformatTest extends NumeralTestCase
{

    protected $timeTests = [
        '2:23:57' => 8637,
        '23:57' => 1437
    ];

    protected $percentageTests = [
        '-76%' => -0.76
    ];

    protected $currencyTests = [
        '($1.23m)' => -1230000,
        '$ 10,000.00' => 10000,
        '$10,000.00' => 10000
    ];

    protected $bytesTest = [
        '100B' => 100,
        '3.154 TB' => 3154000000000,
        '3.154 TiB' => 3467859674006
    ];

    protected $numbersTest = [
        '10,000.123' => 10000.123,
        '(0.12345)' => -0.12345,
        '((--0.12345))' => 0.12345,
        '23rd' => '23',
        '31st' => '31',
        '10k' => 10000,
        '1.23t' => 1230000000000,
        'N/A' => 0,
        '' => 0,
        null => 0
    ];

    public function testUnformat()
    {
        $this->runTestsOnArray($this->numbersTest);
    }

    public function testUnformatTime()
    {
        $this->runTestsOnArray($this->timeTests, 'unformatTime');
    }

    public function testUnformatPercentages()
    {
        $this->runTestsOnArray($this->percentageTests);
    }

    public function testUnformatBytes()
    {
        $this->runTestsOnArray($this->bytesTest);
    }

    public function testUnformatCurrency()
    {
        $this->runTestsOnArray($this->currencyTests);
    }

}