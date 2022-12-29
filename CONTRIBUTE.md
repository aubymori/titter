# Contributing to Titter

## Code formatting


### Filenames
* **PHP files without classes** should be named in `snake_case`.
* **PHP files with classes** should be named in `PascalCase`.
* **Twig files** should be named in `snake_case`.

### PHP code

**Formatting**:
* Code should be indented by **four spaces**.
* PHP files with only PHP should **not** include a closing tag (`?>`).
* **Classes** should be named in `PascalCase`.
* **Functions/methods, their arguments, and variables** should be named in `camelCase`.
* Do **not** omit the `public` keyword in classes.
* **Strings** should be defined in double quotes, unless they contain double quotes.
* **Constant variables** should be named in `UPPER_SNAKE_CASE`.
* **Opening braces** to blocks of code should be on a separate line from the opening block.
* There should be **no spaces** between `->` path separators.
* There should be **spaces** between **assignment, arithmetic, and compariso operators**.
* **Inline if/for statements** should have their code split into a separate line that is indented.

DO ✅:
```php
<?php
class SomeClass
{
    public string $foo = "Hello, world!";
    public int $bar;

    public function __construct(?string $foo, int $bar)
    {
        if ($bar < 12)
        {
            throw new \ValueError("\$bar must be greater than 11.");
            return;
        }

        if (!is_null($foo))
            $this->foo = $foo;

        $this->bar = $bar;
    }

    public function __toString()
    {
        return "SomeClass(" . $this->foo . ", " . $this->bar . ")";
    } 
}
```

DON'T ❌:
```php
<?php
class some_Class{
    $FOO="Hello, world!";
    $BAR;

    function __construct($FOO, $BAR){
        if ($bar < 12){
            throw new \ValueError('$BAR must be greater than 11.');
            return;
        }

        if (!is_null($foo)) $this -> foo=$foo;
        $this -> bar=$bar;
    }

    function __toString(){
        return 'Someclass(' . $this -> foo . ', ' . $this -> bar . ')';
    }
}
?>
```