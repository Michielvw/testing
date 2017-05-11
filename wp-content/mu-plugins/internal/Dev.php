<?php
defined('ABSPATH') or die('Can\'t access directly');

class Dev
{
    public static function printVar($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }



    public static function printVarAsJSON($var)
    {
        $var = json_encode($var, JSON_PRETTY_PRINT);
        static::printVar($var);
    }



    public static function logVar($file, $var)
    {
        $message = var_export($var, true);
        file_put_contents($file, $message);
    }
}
