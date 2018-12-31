<?php
/**
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 1.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$user         = learn_press_get_current_user();
$course       = learn_press_get_course();
$section_name = apply_filters( 'learn_press_curriculum_section_name', $section->section_name, $section );
$force        = isset( $force ) ? $force : false;

if ( $section_name === false ) {
	return;
}
?>
<?php //if ( !empty( $section_name ) ): ?>
	<h4 class="section-header">
		<span class="collapse"></span>
		<?php echo $section_name; ?>
	</h4>
<?php //endif; ?>
<?php if ( $section_description = apply_filters( 'learn_press_curriculum_section_description', $section->section_description, $section ) ) { ?>
	<p class="section-desc"><?php echo $section_description; ?></p>
<?php } ?>
