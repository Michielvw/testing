<?php
namespace Plugin\ScoreMessage;

defined('ABSPATH') or die('Can\'t access directly');

class Setup
{
    private $_dir;
    private $_url;

    public function __construct()
    {
        $this->_dir = INTERNAL_PLUGIN_DIR . '/scoremessage';
        $this->_url = INTERNAL_PLUGIN_URL . '/scoremessage';
        $this->registerPostTypes();
        add_action('wp', [$this, 'enqueue']);
    }

    public function registerPostTypes()
    {
        $scoremessage = tr_post_type('scoremessage')
        ->setSlug('scroremessage')
        ->setId('scroremessage')
        ->setArgument('supports', ['title','editor','comments','thumbnail'])
        ->setIcon('wrench');
    }

    public function enqueue()
    {
        if (is_page('scroremessage'))
            add_action('wp_enqueue_scripts', [$this, 'scoremessageStyling'], 11);
    }

    public function scoremessageStyling() {
        $js     = \xpress::js();
        $css    = \xpress::css();

        $css
        ->register('toolkit-style')
        ->setUrl($this->_url . '/assets/css/scoremessage.css')
        ->enqueue();

        $js
        ->register('toolkit-scripts')
        ->setUrl($this->_url . '/assets/js/scoremessage.js')
        ->setDependency(['jquery', 'functions'])
        ->enqueue();
    }

} //end class

new Setup();
