<?php
$rand = time() . '-' . rand( 0, 100 );
?>
<div class="accordion-group" id="accordion-<?php echo esc_attr( $rand ); ?>" role="tablist" aria-multiselectable="true">
	<?php
	$j = 1;
	if ( $instance['collapse'] ) {
		foreach ( $instance['collapse'] as $i => $collapse ) {
			$content_active = ( $j == 1 ) ? ' in' : '';
			$expanded       = ( $j == 1 ) ? 'data-toggle="collapse" aria-expanded="true"' : 'class="collapsed" data-toggle="collapse" aria-expanded="false"';
			?>
			<div class="accordion-section panel">
				<div class="collapse-heading" role="tab" id="heading-<?php echo esc_attr( $j ) . '-' . $rand; ?>">
					<h4 class="panel-title">
						<a <?php echo ent2ncr( $expanded ); ?> data-parent="#accordion-<?php echo esc_attr( $rand ); ?>" href="#collapse-<?php echo esc_attr( $j ) . '-' . $rand; ?>" aria-controls="collapse-<?php echo esc_attr( $j ) . '-' . $rand; ?>"><?php echo ent2ncr( $collapse['title'] ); ?></a>
					</h4>
				</div>
				<div id="collapse-<?php echo esc_attr( $j ) . '-' . $rand; ?>" class="panel-collapse collapse<?php echo ent2ncr( $content_active ); ?>" role="tabpanel" aria-labelledby="heading-<?php echo esc_attr( $j ) . '-' . $rand; ?>">
					<div class="collapse-body"><?php echo ent2ncr( $collapse['content'] ) ?></div>
				</div>
			</div>
			<?php
			$j ++;
		}
	}
	?>
</div>
