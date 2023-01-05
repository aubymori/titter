<?php

class ZeroFormatTest extends NumeralTestCase
{

    public function testYouCanSetAZeroFormat()
    {
        $this->numeral->setZeroFormat('A format');
        $this->assertEquals('A format', $this->numeral->getZeroFormat());
    }

    public function testZeroFormatIsReturnedOnZero()
    {
        $this->numeral->setZeroFormat('TestFormat');
        $value = $this->numeral->format(0, '');
        $this->assertEquals('TestFormat', $value);
    }

    public function testZeroFormatCanBeReset()
    {
        $this->numeral->setZeroFormat('TestFormat');
        $value = $this->numeral->format(0, '');
        $this->assertEquals('TestFormat', $value);
        $this->numeral->setZeroFormat(null);
        $value = $this->numeral->format(0, '');
        $this->assertEquals(0, $value);
    }

}