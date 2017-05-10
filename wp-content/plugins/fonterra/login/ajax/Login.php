<?php
namespace Plugin\Login\Ajax;

defined('ABSPATH') or die('Can\'t access directly');

class Login
{
    public function ajax()
   {
       $this->response();
       wp_die();
   }

   public function response()
   {
       // First check the nonce, if it fails the function will break
      //$security = $_POST['wpnonce'];
       //check_ajax_referer( 'ajax-login-nonce', $security );

       // Nonce is checked, get the POST data and sign user on
       $info = array();
       $info['user_login']    = $_POST['username'];
       $info['user_password'] = $_POST['password'];
       $info['remember']      = true;

       $user_signon = wp_signon( $info, false );
       if ( is_wp_error($user_signon) ){
            $loggedin = false;
            $status   = 'error';
            $type     = 'error';
            $message  = 'Wrong password or username!';
       } else {
            $loggedin = true;
            $status   = 'true';
            $type     = 'success';
            $message  = 'Login successful, redirecting...';
       }

		echo json_encode([
            'loggedin'    => $loggedin,
            'message'     => $message,
            'status'      => $status,
            'type'        => $type,
            'redirecturl' => home_url()
		]);
   }
}
