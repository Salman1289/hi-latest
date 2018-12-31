<!-- <div class="main-menu"> -->
<div class="container">
	<div class="row">
		<div class="navigation col-sm-12">
			<div class="tm-table">
				<a class="menu-mobile-effect navbar-toggle" data-effect="mobile-effect">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<nav class="width-navigation-left table-cell table-left" role="navigation">
					<?php get_template_part( 'templates/header/menu-left-header-v2' ); ?>
				</nav>
				<div class="width-logo table-cell sm-logo">
					<?php
					do_action( 'thim_logo' );
					do_action( 'thim_sticky_logo' );
					?>
				</div>
				<nav class="width-navigation-right table-cell table-right" role="navigation">
					<?php get_template_part( 'templates/header/menu-right-header-v2' ); ?>
				</nav>
			</div>
			<!--end .row-->
		</div>
	</div>
</div>