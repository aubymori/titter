<?php
namespace Titter;

/**
 * Implements a basic localization system for strings,
 * which loads from JSON files
 * 
 * Basic file layout:
 *   i18n/
 *   ├─ namespace/
 *   │  ├─ en.json
 *   │  ├─ ja.json
 *   ├─ other_namespace/
 *   │  ├─ en.json
 *   │  ├─ ja.json
 * 
 * Basic usage:
 * $i18n = new i18n("namespace");
 * echo $i18n->normalString;
 * echo $i18n->formattedString("argument");
 * 
 * To change the global language, use the 
 * i18n::setGlobalLang function. This should 
 * be run before any namespaces are
 * initialized.
 * 
 * i18n::setGlobalLang("ja");
 * 
 * Formatted strings use the sprintf function,
 * so use that same format.
 * 
 * @author Aubrey Pankow <aubyomori@gmail.com>
 */
class i18n
{
    /**
     * Used as a default and a fallback.
     * 
     * @var string
     */
    private const DEFAULT_LANG = "en";

    /**
     * Folder to include JSON files from.
     * 
     * @var string
     */
    private const I18N_ROOT = "i18n";

    /**
     * Global language used by default when initiating
     * a new instance of i18n. Can be changed via
     * the setGlobalLang function
     */
    public static string $globalLang = "en";

    /**
     * Language used by the current instance.
     */
    private string $lang;

    /**
     * Strings from current instance.
     * Do not access directly.
     * Instead, use the magic
     * __get and __call functions.
     */
    private object $strings;

    /**
     * The namespace of the current instance.
     */
    private string $namespace;

    /**
     * Get the folder name of an instance.
     */
    public function getFolderName(): string
    {
        return self::I18N_ROOT . "/" . $this->namespace;
    }

    public function __construct(string $namespace)
    {
        if (!is_dir(self::I18N_ROOT . "/" . $namespace))
        {
            throw new \Exception("[i18n] The specified namespace does not exist.");
            return;
        }

        $this->lang = self::DEFAULT_LANG;
        $this->namespace = $namespace;
        $this->loadStrings();
    }

    /**
     * Set the global language.
     */
    public static function setGlobalLang(string $lang): void
    {
        self::$globalLang = $lang;
    }

    /**
     * Set the language of the current instance.
     */
    public function setLanguage(string $lang): void
    {
        $this->lang = $lang;
    }

    /**
     * Get a string.
     */
    private function getString(string $string, string ...$args): ?string
    {
        $lang = $this->lang;
        
        if ($text = @$this->strings->{$lang}->{$string})
        {
            if (count($args) > 0)
            {
                return sprintf($text, ...$args);
            }
            else
            {
                return $text;
            }
        }

        return null;
    }

    public function __get($id)
    {
        return $this->getString($id);
    }

    public function __call($id, $args)
    {
        return $this->getString($id, ...$args);
    }

    /**
     * Load the strings of the current namespace.
     */
    private function loadStrings(): void
    {        
        $this->strings = (object) [];
        foreach (glob($this->getFolderName() . "/*.json") as $filename)
        {
            $file = file_get_contents($filename);
            $json = json_decode($file);
            if ($json === null)
            {
                throw new \Exception("[i18n] Could not decode JSON from file \"$filename\".");
                continue;
            }

            $name = explode("/", $filename);
            $name = $name[count($name) - 1];
            $name = str_replace(".json", "", $name);

            $this->strings->{$name} = $json;
        }
    }
}