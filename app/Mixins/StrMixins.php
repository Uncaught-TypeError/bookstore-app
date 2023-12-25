<?php

namespace App\Mixins;

class StrMixins
{
    public function isLength()
    {
        return function ($str, $length) {
            return static::length($str) == $length;
        };
    }

    public function appendTo()
    {
        return function ($str, $char) {
            return $str . $char;
        };
    }
}
