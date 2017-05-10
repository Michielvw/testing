<?php
namespace Plugin\Restrict;

class Setup
{
    public function __construct()
    {
        add_action('init', [$this, 'restrictLoginPage'], 1);
        add_filter('rest_authentication_errors', [$this, 'disable_REST_API']);
        add_action('template_redirect', [$this, 'restrict']);
        // add_action('wp_login', [$this, 'checkPending'], 1, 2);
        add_filter('login_redirect', [$this, 'changeDefaultRedirect'], 10, 3);
        add_action('admin_init', [$this, 'restrictDashboard'], 1);
        // add_action('init', [$this, 'loggedin_user_only_fn'], 1);
    }

    public function restrictLoginPage()
    {
        $page_now   = $GLOBALS['pagenow'];
        //$login      = wp_login_url();
        $action     = isset($_GET['action']) ? $_GET['action'] : '';
        if ($page_now == 'login' || $page_now== wp_login_url() && is_user_logged_in()) {
            if ($action !='logout') $this->redirect();
        }
        // if(is_page('wp_login_url')){
        //     // if ($action !='logout')
        //         wp_redirect( $login_url );
        //         exit;
        // }
    }

    /**
     * Disable WP REST API
     * Picked from http://www.binarytemplar.com/disable-json-api
     * @author Dave McHale (http://www.binarytemplar.com)
     */
    public function disable_REST_API($access)
    {
        return new \WP_Error( 'rest_cannot_access', __( 'REST API is disabled.', 'abn' ), array( 'status' => rest_authorization_required_code() ) );
    }

    /**
     * template_redirect hook doesn't affect login page
     * No need to check whether current page is login page or not
     */

    public function restrict()
    {
        if (!is_user_logged_in()) {
            $this->guestRestriction();
        }
    }

    public function loggedInRestriction()
    {
        require 'loggedin_restriction.php';
    }

    public function guestRestriction()
    {
        $login_url      = BASE_URL. '/login/';
        //$thankyou_page  = get_field('registration_thankyou_page', 'option');
        $redirect       = false;

        if (!is_page('register') && !is_page('login') && !is_page('activate')) $redirect = true;
        if ($redirect) $this->redirect($login_url);
    }

    // public function checkPending($user_login, $user)
    // {
    //     $user_id    = $user->ID;
    //     $is_pending = (bool) get_user_meta( $user_id, 'pending_user', true );
    //     if ($is_pending) {
    //         wp_logout();
    //         $to = BASE_URL. '/not-confirmed-user/';
    //
    //         wp_safe_redirect($to);
    //         exit;
    //     }
    // }

    public function changeDefaultRedirect($redirect_to, $requested_redirect_to, $user)
    {
        // $user->roles are empty array here, so we use $user->caps
        if (isset($user->caps)) {
            if (isset($user->caps['administrator']) && $user->caps['administrator']) {
                return BASE_URL . '/wp-admin/';
            } else {
                    return BASE_URL;
            }
        } else {
            return $redirect_to;
        }
    }

    public function restrictDashboard() {
        if (!defined('DOING_AJAX') || !DOING_AJAX) {
            $currentUser = wp_get_current_user();
            if (!in_array('administrator', $currentUser->roles)) $this->redirect();
        }
    }

    public function redirect($to = BASE_URL)
    {
        wp_safe_redirect($to);
        die();
    }
}

new Setup();
