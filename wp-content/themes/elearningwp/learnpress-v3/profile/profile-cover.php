<?php
/**
 * Template for displaying user profile cover image.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/profile/profile-cover.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$profile = LP_Profile::instance();

$user = $profile->get_user();

$avatar_size_settings = LP()->settings->get( 'profile_picture_thumbnail_size' );

$avatar_size_default = array(
	'width'  => 300,
	'height' => 300,
	'crop'   => 'no'
);

$avatar_size_settings = wp_parse_args( $avatar_size_settings, $avatar_size_default );
?>

<div class="user-info clearfix">
	<div class="author-avatar">
		<div class="inner-avatar">
			<?php echo $user->get_profile_picture( null, $avatar_size_settings['height'] ); ?>

			<h3 class="author-name"><?php echo learn_press_get_profile_display_name( $user ); ?></h3>

			<?php
			$lp_info = get_the_author_meta( 'lp_info', $user->get_id() );
			?>
			<?php if ( isset( $lp_info['major'] ) && $lp_info['major'] ) : ?>
				<span class="major"><?php echo $lp_info['major']; ?></span>
			<?php endif; ?>
			<ul class="thim-author-social">
				<?php if ( isset( $lp_info['facebook'] ) && $lp_info['facebook'] ) : ?>
					<li>
						<a href="<?php echo esc_url( $lp_info['facebook'] ); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
					</li>
				<?php endif; ?>

				<?php if ( isset( $lp_info['twitter'] ) && $lp_info['twitter'] ) : ?>
					<li>
						<a href="<?php echo esc_url( $lp_info['twitter'] ); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
					</li>
				<?php endif; ?>

				<?php if ( isset( $lp_info['google'] ) && $lp_info['google'] ) : ?>
					<li>
						<a href="<?php echo esc_url( $lp_info['google'] ); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
					</li>
				<?php endif; ?>

				<?php if ( isset( $lp_info['linkedin'] ) && $lp_info['linkedin'] ) : ?>
					<li>
						<a href="<?php echo esc_url( $lp_info['linkedin'] ); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a>
					</li>
				<?php endif; ?>

				<?php if ( isset( $lp_info['youtube'] ) && $lp_info['youtube'] ) : ?>
					<li>
						<a href="<?php echo esc_url( $lp_info['youtube'] ); ?>" class="youtube"><i class="fa fa-youtube"></i></a>
					</li>
				<?php endif; ?>
			</ul>
		</div>
		<?php do_action( 'learn_press_profile_get_count_courses', $user ); ?>
	</div>

	<div class="user-information">
		<h3><?php echo esc_html__( 'About me', 'elearningwp' ); ?></h3>
		<p><?php echo get_user_meta( $user->get_id(), 'description', true ); ?></p>
		<ul>
			<li>
				<i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo $user->get_email(); ?>
			</li>
			<?php if ( isset( $lp_info['phone'] ) && $lp_info['phone'] ) : ?>
				<li>
					<i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( $lp_info['phone'] ); ?>
				</li>
			<?php endif; ?>
			<?php if ( isset( $lp_info['location'] ) && $lp_info['location'] ) : ?>
				<li>
					<i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_html( $lp_info['location'] ); ?>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</div>

<?php do_action( 'learn_press_profile_get_courses_intructor', $user ); ?>

