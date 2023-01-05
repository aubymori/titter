<?php

use Stillat\Numeral\Languages\Language_enUS;
use Stillat\Numeral\Languages\LanguageManager;
use Stillat\Numeral\Numeral;

class LanguageTest extends PHPUnit_Framework_TestCase
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

    public function testThatManagerCreatesEnglishLanguageByDefault()
    {
        $language = $this->languageManager->getCulture('en-US');
        $this->assertInstanceOf(Language_enUS::class, $language);
    }

    public function testThatLanguagesCanBeOverridden()
    {
        $this->languageManager->addCulture('en-US', new TestLanguage_enUS());
        $this->assertInstanceOf(TestLanguage_enUS::class, $this->languageManager->getCulture('en-US'));
    }

    public function testThatLanguagesCanBeAddedWithoutSpecifyingCodeEveryTime()
    {
        $this->languageManager->addCultureInstance(new TestLanguage_enUS());
        $value = $this->languageManager->getCulture(TestLanguage_enUS::$code);
        $this->assertInstanceOf(TestLanguage_enUS::class, $value);
    }

    public function testThatIncludedLanguagesCanBeAddedWithoutCreatingInstancesEveryTime()
    {
        $this->languageManager->setCulture('nl-BE');
        $this->assertInstanceOf(\Stillat\Numeral\Languages\Language_nlBE::class, $this->languageManager->currentCulture());
    }

    /**
     * @expectedException \Exception
     */
    public function testThatGetCultureThrowsExceptionIfCultureHasNotBeenInstantiated()
    {
        $this->languageManager->getCulture('Does Not Exist');
    }

    /**
     * @expectedException \Exception
     */
    public function testThatSetCultureThrowsExceptionIfCultureHasNotBeenInstantiated()
    {
        $this->languageManager->setCulture('Does Not Exist');
    }

    public function testThatDifferentLanguagesCanBeReturned()
    {
        $this->languageManager->addCulture('en-US-Super', new TestLanguage_enUS());
        $firstValue = $this->languageManager->getCulture('en-US');
        $secondValue = $this->languageManager->getCulture('en-US-Super');
        $this->assertNotSame($firstValue, $secondValue);
        $this->assertInstanceOf(Language_enUS::class, $firstValue);
        $this->assertInstanceOf(TestLanguage_enUS::class, $secondValue);
    }

    public function testThatCurrentCultureCanBeChanged()
    {
        $this->languageManager->addCulture('en-US-Super', new TestLanguage_enUS());
        $firstValue = $this->languageManager->currentCulture();
        $this->languageManager->setCulture('en-US-Super');
        $secondValue = $this->languageManager->currentCulture();
        $this->assertNotSame($firstValue, $secondValue);
        $this->assertInstanceOf(Language_enUS::class, $firstValue);
        $this->assertInstanceOf(TestLanguage_enUS::class, $secondValue);
    }


}

class TestLanguage_enUS extends Language_enUS
{
    public static $code = 'en-US-Super';
}