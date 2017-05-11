<?php
/**
 * Setter & getter function which can be used across the site
 * no matter inside theme or plugin
 *
 * Vars::set($key, $value);
 * @param   string/array  $key
 * @param   mix           $value
 *
 * Vars::get($key);
 * @param   string  $key
 * @return  mix     $value
 */
class Vars
{
    private static $vars = [];



    public static function get($name)
    {
        $value = isset(static::$vars[$name]) ? static::$vars[$name] : '';
        return $value;
    }



    public static function set($name, $value = '')
    {
        if (is_array($name)) {
            foreach ($name as $key => $value) {
                static::$vars[$key] = $value;
            }
        } else {
            static::$vars[$name] = $value;
        }
    }
}
