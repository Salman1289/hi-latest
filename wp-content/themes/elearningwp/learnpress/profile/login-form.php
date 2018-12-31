<?php
/**
 * Template for displaying template of login form
 *
 * @author  ThimPress
 * @package Templates
 * @version 2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Overwrite template in your theme at [YOUR_THEME]/learnpress/profile/login-form.php.
 * By default, it load default login form of WP core.
 */
if ( ! isset( $redirect ) ) {
	$redirect = false;
}
$login_args = array(
	'echo'    => false,
	'form_id' => 'learn-press-form-login',
	'context' => 'learn-press-login'
);

if ( $redirect ) {
	$login_args['redirect'] = $redirect;
}
$form_login = wp_login_form( $login_args );


//add the placeholders
$form_login = str_replace( 'name="log"', 'name="log" placeholder="Username"', $form_login );
$form_login = str_replace( 'name="pwd"', 'name="pwd" placeholder="Password"', $form_login );
echo( $form_login );