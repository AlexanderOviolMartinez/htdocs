<?php
namespace lib;

abstract class response
{
    public static function error($code)
    {
        include "./404/$code.html";
    }
}