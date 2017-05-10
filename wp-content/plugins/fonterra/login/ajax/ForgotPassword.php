<?php
namespace Plugin\Login\Ajax;

defined('ABSPATH') or die('Can\'t access directly');

class ForgotPassword
{
    public function ajax()
   {
       $this->response();
       wp_die();
   }

   public function response()
   {
      $email    = $_POST['email'];

   	global $wpdb;

         if( ! is_email( $email )) {
   			$message = 'Invalid username or e-mail address.';
   		} else if( ! email_exists($email) ) {
   			$message = 'There is no user registered with that email address.';
   		} else {

   			//lets generate our new password
   			$random_password = wp_generate_password( 12, false );

   			//Get user data by field and data, other field are ID, slug, slug and login
   			$user = get_user_by( 'email', $email );

   			$update_user = wp_update_user( array (
   					'ID' => $user->ID,
   					'user_pass' => $random_password
   				)
   			);

   			// if  update user return true then lets send user an email containing the new password
   			if( $update_user ) {
   				$to = $email;
   				$subject = 'Your new password';
   				$sender = 'admin';

   				$message = 'Your new password is: '.$random_password;

   				$headers[] = 'MIME-Version: 1.0' . "\r\n";
   				$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   				$headers[] = "X-Mailer: PHP \r\n";
   				$headers[] = 'From: '.$sender.' < '.$email.'>' . "\r\n";

   				$mail = wp_mail( $to, $subject, $message, $headers );
   				if( $mail )
   					$message = 'Check your email address for you new password.';

   			} else {
   				$message = 'Oops something went wrong updaing your account.';
   			}

   	}

		echo json_encode([
         'message'     => $message
		]);
   }
}
