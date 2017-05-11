<?php
add_filter( 'retrieve_password_message', 'retrieve_password_ases', 10, 2 );

function retrieve_password_ases() {
    // $region_endpoint = AMAZONE_SES_ENDPOINT;
    // $ses             = new \SimpleEmailService(AMAZONE_SES_ACCESS_KEY, AMAZONE_SES_SECRET_KEY, $region_endpoint);
    // $m               = new \SimpleEmailServiceMessage();

    $ses     = \Vars::get('aws_ses');
    $msg     = \Vars::get('aws_msg');
    $sender  = \Vars::get('aws_sender');

    global $wpdb, $wp_hasher;

    $errors = new WP_Error();

    if ( empty( $_POST['user_login'] ) ) {
        $errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or email address.'));
    } elseif ( strpos( $_POST['user_login'], '@' ) ) {
        $user_data = get_user_by( 'email', trim( wp_unslash( $_POST['user_login'] ) ) );
        if ( empty( $user_data ) )
            $errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.'));
    } else {
        $login = trim($_POST['user_login']);
        $user_data = get_user_by('login', $login);
    }

    /**
     * Fires before errors are returned from a password reset request.
     *
     * @since 2.1.0
     * @since 4.4.0 Added the `$errors` parameter.
     *
     * @param WP_Error $errors A WP_Error object containing any errors generated
     *                         by using invalid credentials.
     */
    do_action( 'lostpassword_post', $errors );

    if ( $errors->get_error_code() )
        return $errors;

    if ( !$user_data ) {
        $errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or email.'));
        return $errors;
    }

    // Redefining user_login ensures we return the right case in the email.
    $userLogin = $user_data->user_login;
    $receiver  = $user_data->user_email;
    //$key = get_password_reset_key( $user_data );
    $key = wp_generate_password(20, false);

    if ( empty( $wp_hasher ) ) {
        require_once( ABSPATH . WPINC . '/class-phpass.php' );
        $wp_hasher = new PasswordHash( 8, true );
    }

    $hashed = time() . ':' . $wp_hasher->HashPassword( $key );
    $wpdb->update($wpdb->users, array('user_activation_key' => $hashed), array('user_login' => $userLogin));

    if ( is_wp_error( $key ) ) {
        return $key;
    }

    $siteUrl     = network_home_url( '/' );
    $urlReset    = network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($userLogin), 'login');

    $textSubject = get_field('reset_password_subject_message', 'option');
    $textMessage = get_field('reset_password_body_message', 'option');

    $dataReplace = [
        '{user_login}'  => $userLogin,
        '{first_name}'  => $user_data->first_name,
        '{site_url}'    => $siteUrl,
        '{url_reset}'   => $urlReset
    ];

    $placeholder = new \Plugin\Email\Placeholder();
    $subject     = $placeholder->setContent($textSubject)->convert($dataReplace);
    $body        = $placeholder->setContent($textMessage)->convert($dataReplace);

    // custom layout
    $site_name      = \xpress::siteName();
    $site_logo_id   = tr_options_field('tr_theme_options.logo');
    $site_logo_src  = wp_get_attachment_image_src($site_logo_id, 'full');
    $site_logo_url  = $site_logo_src[0];

    // custom layout
    $tags = [
        '{site_name}'       => $site_name,
        '{subject}'         => $subject,
        '{body}'            => $body,
        '{site_url}'        => BASE_URL,
        '{site_logo_url}'   => $site_logo_url,
        '{featured_image}'  => '',
        '{copyright}'       => 'Copyright &copy; ABN AMRO ' . date('Y')
    ];

    $mailTemplate = file_get_contents(INTERNAL_PLUGIN_DIR . '/email/templates/email.html');
    $body = $placeholder->setContent($mailTemplate)->convert($tags);
    // /custom layout

    $msg->clearTo();
    $msg->addTo($receiver);
    $msg->setFrom($sender);
    $msg->setSubject($subject);
    $msg->setMessageFromString('', $body);
    $ses->sendEmail($msg);

    return false;
}

// Email notification has change password

if ( !function_exists('wp_password_change_notification') ) :

    function wp_password_change_notification( $user ) {

        return false;

        // $region_endpoint = AMAZONE_SES_ENDPOINT;
        // $ses             = new \SimpleEmailService(AMAZONE_SES_ACCESS_KEY, AMAZONE_SES_SECRET_KEY, $region_endpoint);
        // $m               = new \SimpleEmailServiceMessage();
        //
        // $siteUrl         = get_site_url();
        // $loginUrl        = wp_login_url();
        // $userLogin       = $user->user_login;
        //
        // $sender          = get_field('email_sender', 'option');
        // $receiver        = $user->user_email;
        //
        // $textSubject     = get_field('subject_notification_reset_password', 'option');
        // $textMessage     = get_field('message_notofication_reset_password', 'option');
        //
        // $dataReplace = [
        //     '{user_login}'  => $userLogin,
        //     '{first_name}'  => $user->first_name,
        //     '{login_url}'   => $loginUrl,
        //     '{site_url}'    => $siteUrl
        // ];
        //
        // $placeholder = new \Placeholder();
        // $subject     = $placeholder->setContent($textSubject)->convert($dataReplace);
        // $body        = $placeholder->setContent($textMessage)->convert($dataReplace);
        // // custom layout
        // $siteLogo   = tr_options_field('tr_theme_options.logo');
        // $siteLogo   = wp_get_attachment_image_src($siteLogo, 'full');
        // $siteLogo   = $siteLogo[0];
        // $ctaButton  = '<a href="" style="font-weight:bold;font-size:17px;padding:15px 40px;background-color:#b73631;color:white;text-decoration:none;">CTA TEXT</a>';
        //
        // $templateTags = [
        //     '{mail_title}'      => $subject,
        //     '{mail_description}' => '',
        //     '{mail_content}'    => $body,
        //     '{site_url}'        => BASE_URL,
        //     '{site_logo}'       => $siteLogo,
        //     '{cta_button}'      => '',
        //     '{copyright}'       => 'Copyright ARCADIS ' . date('Y')
        // ];
        //
        // $mailTemplate = file_get_contents(SPECIFIC_PLUGIN_DIR . '/email/templates/email.php');
        // $body = $placeholder->setContent($mailTemplate)->convert($templateTags);
        // // /custom layout
        //
        // $m->clearTo();
        // $m->addTo($receiver);
        // $m->setFrom($sender);
        // $m->setSubject($subject);
        // $m->setMessageFromString('', $body);
        // $ses->sendEmail($m);
    }

endif;
?>
