<?php
namespace Theme\Queue;

defined('ABSPATH') or die('Can\'t access file directly');



class CSS
{
    public function __construct()
    {
        add_action('wp', [$this, 'check']);
    }

    public function check()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueueGeneralStyles']);
        // if( is_front_page() ) add_action('wp_enqueue_scripts', [$this, 'enqueuHomeScripts']);

    }

    public function enqueueGeneralStyles() {
        $css = \xpress::css();

        $css
        ->register('google-font')
        ->setUrl('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,900')
        ->setVersion('1.0.0')
        ->enqueue();

        $css
        ->register('animate')
        ->setUrl(THEME_URL . '/assets/css/animate.css')
        ->setVersion('1.0.0')
        ->enqueue();

        $css
        ->register('style')
        ->setUrl(THEME_URL . '/style.css')
        ->setVersion('1.0.3')
        ->enqueue();

        $css
        ->register('responsive')
        ->setUrl(THEME_URL . '/assets/css/responsive.css')
        ->setVersion('1.0.2')
        ->enqueue();

        $css
        ->register('font-awesome')
        ->setUrl(THEME_URL . '/assets/css/font-awesome.min.css')
        ->setVersion('1.0.3')
        ->enqueue();

        $css
        ->register('magnific-popup')
        ->setUrl(THEME_URL . '/assets/css/magnific-popup.css')
        ->setVersion('1.0.3')
        ->enqueue();

    }

    public function enqueuHomeScripts()
    {
        $css = \xpress::css();


    }
}

use Theme\Queue\CSS;
new CSS();
