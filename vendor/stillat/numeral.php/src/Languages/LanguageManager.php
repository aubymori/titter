<?php

namespace Stillat\Numeral\Languages;

use Exception;

class LanguageManager
{

    /**
     * Holds the instantiated language instances.
     *
     * @var array
     */
    protected $languages = [];

    /**
     * Indicates the current language.
     *
     * @var string
     */
    protected $currentCulture = 'en-US';

    /**
     *
     * The current AbstractLanguage instance.
     *
     * @var null|AbstractLanguage
     */
    protected $currentCultureInstance = null;

    public function __construct()
    {
        // This makes sure that the English language is always available.
        $this->addCulture('en-US', new Language_enUS);
    }

    /**
     * Adds a new language to the registered languages.
     *
     * @param                                             $code
     * @param \Stillat\Numeral\Languages\AbstractLanguage $languageData
     */
    public function addCulture($code, AbstractLanguage $languageData)
    {
        $this->languages[$code] = $languageData;
    }

    /**
     * Adds a new language and sets the code to the languages static code.
     *
     * @param \Stillat\Numeral\Languages\AbstractLanguage $languageData
     */
    public function addCultureInstance(AbstractLanguage $languageData)
    {
        $this->languages[$languageData::$code] = $languageData;
    }

    public function defaultAbbreviations()
    {
        return [
            'thousand' => 'k',
            'million' => 'm',
            'billion' => 'b',
            'trillion' => 't'
        ];
    }

    /**
     * Sets the current culture information.
     *
     * @param $code
     *
     * @throws \Exception
     */
    public function setCulture($code)
    {
        $this->currentCultureInstance = $this->getCulture($code);
        $this->currentCulture = $code;
    }

    /**
     * Gets the currently loaded culture.
     *
     * @return \Stillat\Numeral\Languages\AbstractLanguage
     * @throws \Exception
     */
    public function currentCulture()
    {
        return $this->getCulture($this->currentCulture);
    }

    /**
     * Returns the current culture code.
     *
     * @return string
     */
    public function currentCultureCode()
    {
        return $this->currentCulture;
    }

    /**
     * Gets a culture based on the culture code.
     *
     * @param $code
     *
     * @return \Stillat\Numeral\Languages\AbstractLanguage
     * @throws \Exception
     */
    public function getCulture($code)
    {
        if (array_key_exists($code, $this->languages)) {
            return $this->languages[$code];
        } else {
            $languageClassName = 'Stillat\\Numeral\\Languages\\Language_'.trim(strtr($code,['-' => '']));

            if (class_exists($languageClassName)) {
                $instance = new $languageClassName;
                $this->languages[$instance::$code] = $instance;
                return $instance;
            }
        }

        throw new Exception("Language '{$code}' not instantiated.");
    }

}