<?php
namespace Titter\Model\Common;

class EdgeButton
{
    public function __construct(
        public string $style,
        public string $size,
        public string $label,
        public ?string $url = null,
        public bool $asInput = false,
        public array $class = [],
        public array $attributes = []
    )
    {}
}