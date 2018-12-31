<?php
$data = get_post_meta( $pid, 'pricing_table_opt', true );
$featured = get_post_meta( $pid, 'pricing_table_opt_feature', true );
wp_enqueue_style('table-plus-minimal',plugins_url('/pricing-table-plus/tpls/css/minimal.css'), array());

?>

<div id="shaon-pricing-table-plus" class="gray">
	<div class="minimal">
		<?php
			$i = 0;
			foreach ( $data as $key2 => $value2 ) {
			$i++;
			if($i==1){
			?>
			<div class="highlight plan p1 list-interval">
				<div class="detail">
					<h3>
						<span class="icon"><i class="fa <?php echo $value2['Icon']; ?>"></i></span>
						<span class="title"><?php echo $key2; ?></span>
						<span class="interval"><?php echo $value2['Detail']; ?></span>
					</h3>
					<h4>
						<span class="amount"><?php echo $currency; ?><?php echo $value2['Price']; ?></span>
					</h4>
				</div>
				<div class="features">
					<ul>
						<?php
						foreach ( $value2 as $key3 => $value3 ) {
							if (($key3 != "Detail") && ( $key3 != "Button URL") && ($key3 != "Button Text") && ($key3 != "Price") && ($key3 != "Icon") ) {
								echo "<li>$key3</li>";
							}
						}
						?>
					</ul>
				</div>
				<div class="select">
					<div>
						<a class="pt-button" href="<?php echo $value2['Button URL'] ?>"><span><?php echo $value2['Button Text'] ?></span></a>
					</div>
				</div>
			</div>
		<?php
				} else {
					echo "";
				}
			}
		?>
		<?php
		foreach ( $data as $key => $value ) {
			?>
			<div class="highlight plan p1<?php if ( $featured == $key ) { echo " featured"; } ?>">
				<div class="detail">
					<h3>
						<span class="icon"><i class="fa <?php echo $value['Icon']; ?>"></i></span>
						<span class="title"><?php echo $key; ?></span>
						<span class="interval"><?php echo $value['Detail']; ?></span>
					</h3>
					<h4>
						<span class="amount"><?php echo $currency; ?><?php echo $value['Price']; ?></span>
					</h4>
				</div>
				<div class="features">
					<ul>
						<?php foreach ( $value as $key1 => $value1 ) {
							if ( strtolower( $key1 ) == 'detail' ) {
								echo "";
							} else {
								if ( strtolower( $key1 ) != "button url" && strtolower( $key1 ) != "button text" && strtolower( $key1 ) != "price" && strtolower( $key1 ) != "icon" ) {
									$value1 = explode( "|", $value1 );
									if (count( $value1 ) > 1 && $value1[1] != '' ) {
										echo "<li><b title='{$value1[1]}'>" . $value1[0] . "</b></li>";
									} else {
										if($value1[0] == 'v') {
											$value1[0] = '<i class="fa fa-check" aria-hidden="true"></i>';
										}
										if($value1[0] == 'x') {
											$value1[0] = '<i class="fa fa-close" aria-hidden="true"></i>';
										}
										echo "<li>" . $value1[0] . "</li>";
									}
								}
							}
						}
						?>
					</ul>
					<div class="select">
						<div>
							<a class="pt-button" href="<?php echo $value['Button URL'] ?>"><span><?php echo $value['Button Text'] ?></span></a>
						</div>
					</div>

				</div>
			</div>
		<?php } ?>

	</div>
</div>
<div style="clear:both"></div>
 