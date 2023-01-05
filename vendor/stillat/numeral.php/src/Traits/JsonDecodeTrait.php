<?php

namespace Stillat\Numeral\Traits;

trait JsonDecodeTrait {

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