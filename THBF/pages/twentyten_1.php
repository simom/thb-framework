<p>Ciao ciao</p>

<?php 
global $wpdb;

$items = $wpdb->get_results("SELECT guid FROM {$wpdb->prefix}posts WHERE post_type='attachment'");

foreach($items as $i) {
	echo "<img src=\"$i->guid\" style=\"width: 50px; height: 50px;\" /><br>";
	
}