<?php
namespace Theme\Queue;

defined('ABSPATH') or die('Can\'t access file directly');

class JS
{
    public function __construct()
    {
        add_action('wp', [$this, 'check']);
    }

    public function check()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueGeneralScripts']);
        // add_action('wp_enqueue_scripts', [$this, 'enqueuHomeScripts']);
        //if( is_front_page() ) add_action('wp_enqueue_scripts', [$this, 'enqueuHomeScripts']);
    }

    public function enqueueGeneralScripts()
    {
        $js = \xpress::js();

        $js
        ->register('function')
        ->setUrl(THEME_URL . '/assets/js/function.js')
        ->setDependency(['jquery'])
        ->setVersion('0.0.1')
        ->enqueue();

        $js
        ->register('slicknav')
        ->setUrl(THEME_URL . '/assets/js/jquery.slicknav.min.js')
        ->setDependency(['jquery'])
        ->setVersion('0.0.1')
        ->enqueue();

        $js
        ->register('magnific-popup')
        ->setUrl(THEME_URL . '/assets/js/jquery.magnific-popup.min.js')
        ->setDependency(['jquery'])
        ->setVersion('0.0.1')
        ->enqueue();

        $js
        ->register('magnific')
        ->setUrl(THEME_URL . '/assets/js/jquery.magnific-popup.js')
        ->setDependency(['jquery'])
        ->setVersion('0.0.1')
        ->enqueue();

    }

    public function enqueuHomeScripts()
    {
        $js = \xpress::js();

        
    }
}

use Theme\Queue\JS;
new JS();
