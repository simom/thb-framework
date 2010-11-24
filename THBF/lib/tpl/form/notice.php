<?php if( $_GET['updated'] == 'true' ) :
	$themename = get_current_theme();
	echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
endif; ?>