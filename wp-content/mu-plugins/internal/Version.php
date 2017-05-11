<?php
/**
 * Version - To automatically generate file versioning
 *
 * example:
 * Version::auto('css/style.css'); will generate something like 'css/style.23423423.css'
 * The random number is the last modified time
 *
 * What is this for?
 * Sometimes we need to cache static assets for faster load speed via .htaccess
 * The static assets like css, js will be cached
 * The problem is, when the .css or .js is edited or modified, it is still cached until user reload/refresh page
 * Nah, this method adds "last time modified" before the extension like functions.3124324234.js
 * It will not be an error, since we will put some script into htaccess
 *
 * So?
 * So the static assets will be cached but no need to worry when you edit/ modify the file
 * because it's auto detected now :)
 *
 * But?
 * We need to insert some codes to htaccess
 * And wpengine doesn't support those codes
 *
 */

class Version
{
    public static function auto($url)
    {
        $dir  = str_replace(BASE_URL . '/', '', $url);
        $path = $dir;

        $ver  = '.' . filemtime($dir);
        $path = pathinfo($path);
        $name = $path['basename'];
        $arr  = explode('.', $name);
        $end  = end($arr);
        $file = str_replace( '.' . $end, $ver . '.' . $end, $name );

        $output = $path['dirname'] . '/' . $file;
        $output = BASE_URL . '/' . $output; // optional

        clearstatcache();

        // this is for WPEngine
        $output = $url;

        return $output;
    }
}
