<?php
/**
 * Setter & getter function which can be used across the site
 * no matter inside theme or plugin
 *
 * This is the same as "Vars" class.
 * We need semantic ways. So, Vars for variables & Objects for objects/classes
 *
 * Objects::set($key, $value);
 * @param   string/array  $key
 * @param   mix           $value
 *
 * Objects::get($key);
 * @param   string  $key
 * @return  mix     $value
 */
class Objects
{
    private static $_items = [];



    public static function get($name)
    {
        $value = isset(static::$_items[$name]) ? static::$_items[$name] : '';
        return $value;
    }



    public static function set($name, $value = '')
    {
        if (is_array($name)) {
            foreach ($name as $key => $value) {
                static::$_items[$key] = $value;
            }
        } else {
            static::$_items[$name] = $value;
        }
    }
}
