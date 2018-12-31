<?php
if ( $instance['layout'] == 'layout-01' ) {
	?>
	<div class="courses-searching">
		<form role="search" method="get" action="<?php echo site_url( '/' ); ?>">
			<input type="text" value="" name="s" id="s" placeholder="<?php echo esc_attr( $instance['label'] ); ?>" class="form-control courses-search-input" autocomplete="off" />
			<input type="hidden" value="course" name="ref" />
			<button type="submit"><i class="fa fa-search"></i></button>
			<span class="widget-search-close"></span>
		</form>
		<ul class="courses-list-search list-unstyled"></ul>
	</div>
<?php } else { ?>
	<div class="search-link"><i class="fa fa-search"></i></div>
	<div class="courses-searching search-layout-02">
		<form role="search" method="get" action="<?php echo site_url( '/' ); ?>">
			<input type="text" value="" name="s" id="s" placeholder="<?php echo esc_attr( $instance['label'] ); ?>" class="form-control courses-search-input" autocomplete="off" />
			<input type="hidden" value="course" name="ref" />
			<span class="widget-search-close"><i class="fa fa-times"></i></span>
		</form>
		<ul class="courses-list-search list-unstyled"></ul>
	</div>
<?php } ?>