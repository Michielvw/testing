<?php
namespace Plugin\Login;

defined('ABSPATH') or die('Can\'t access directly');

class Setup
{
    private $_action      = 'ajaxlogin';
    private $_action2     = 'forgotpassword';

    private $_dir;
    private $_url;

    public function __construct()
    {
        $this->_dir = INTERNAL_PLUGIN_DIR . '/login';
        $this->_url = INTERNAL_PLUGIN_URL . '/login';

        \Vars::set('loginajax_action', $this->_action);
        $this->registerActions();

        \Vars::set('forgotpassword_action', $this->_action2);
        $this->registerActions();

        add_action('wp', [$this, 'checkPage']);
        //$this->checkPage();
    }


    public function registerActions()
    {
        $ajax = \xpress::ajax();

        $ajax
        ->register($this->_action)
        ->setController(new Ajax\Login());

        $ajax
        ->register($this->_action2)
        ->setController(new Ajax\ForgotPassword());

    }

    public function checkPage()
    {
        if (!is_page('login')) return;
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts']);

    }

    public function enqueueScripts()
    {
        $js = \xpress::js();

        $js
        ->register($this->_action)
        ->setUrl($this->_url . '/assets/js/' . $this->_action . '.js')
        ->setGlobalObject([
            'name' => 'ajaxLoginObject',
            'value' => [
                'url' => admin_url('admin-ajax.php'),
                'action' => $this->_action
            ]
        ])
        ->enqueue();

        $js
        ->register($this->_action2)
        ->setUrl($this->_url . '/assets/js/' . $this->_action2 . '.js')
        ->setGlobalObject([
            'name' => 'forgotPasswordObject',
            'value' => [
                'url' => admin_url('admin-ajax.php'),
                'action' => $this->_action2
            ]
        ])
        ->enqueue();

    }

}

use Plugin\Login\Setup;
new Setup();
