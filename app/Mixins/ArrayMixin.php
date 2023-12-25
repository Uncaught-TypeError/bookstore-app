<?php

namespace App\Mixins;

class ArrayMixin
{
    public function duplicateCheck()
    {
        return function ($value) {
            return $this->filter(function ($item) use ($value) {
                return $item === $value;
            })->count() === 1;
        };
    }
}
