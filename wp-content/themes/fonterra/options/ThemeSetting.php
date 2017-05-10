<?php
namespace Theme;

defined('ABSPATH') or die('Can\'t access directly');



class ThemeSetting
{
    public function __construct()
    {
        // $this->hideAdminBar();
        // add_action('the_content', [$this, 'removePTagFromImage']);
        add_action( 'init', [$this, 'register_my_menu']);
        add_action('after_setup_theme', [$this, 'remove_admin_bar']);
        $this->registerThemeOptions();

        add_action( 'init', [$this, 'registerOptionPage']);
        add_filter('wp_nav_menu_items', [$this, 'addItem'], 100, 2);
    }

    function registerOptionPage(){
            acf_add_options_page(array(
    		'page_title' 	=> 'Theme General Settings',
    		'menu_title'	=> 'Option Setting',
    		'menu_slug' 	=> 'theme-general-settings',
    		'capability'	=> 'edit_posts',
    		'redirect'		=> false
    	));
    }
    public function addItem($items, $args)
    {
        $accountMenu    = '';
        $redirect       = BASE_URL. '/login/';
        $logoutUrl      = wp_logout_url($redirect);

        if (is_user_logged_in()) {
        $accountMenu = '
        <li class="menu-item-has-children">
        <a href="' . $logoutUrl . '">Logout</a>
        </li>
        ';
        }
        // var_dump($logoutUrl);

        return $items . $accountMenu;
    }

    function remove_admin_bar() {
        // if (!current_user_can('administrator') && !is_admin()) {
          show_admin_bar(false);
        // }
    }

    function register_my_menu() {
        add_theme_support('menus');
        register_nav_menu('header-menu',__( 'Header Menu' ));
    }




    public function registerThemeOptions()
    {
        add_filter('tr_theme_options_page', function() {
            return THEME_DIR . '/theme-options.php';
        });
    }



    /**
     * Force "medium & large" image sizes to use "crop" mode
     * Not necessary to call this every time.
     * Just call it once and you can disable/ comment it
     *
     * @return void
     */
    public function forceCrop()
    {
        if (get_option('large_crop') == 0) update_option('large_crop', '1');
        if (get_option('medium_crop') == 0) update_option('medium_crop', '1');
    }



}

use Theme\ThemeSetting;
new ThemeSetting();
