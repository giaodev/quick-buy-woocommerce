<form method="post" action="options.php">
	<?php  
	settings_fields( 'quick_buy_group' );
	do_settings_sections( 'setting_giaovn' );
	submit_button( $text = null, $type = 'primary', $name = 'submit', $wrap = true, $other_attributes = null )
	?>
</form>