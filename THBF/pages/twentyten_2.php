<?php
	
	// Create the form
	$form = new Form();
	
	// Informs the user about the saving action
	$form->display_notice();
	
	$form->header(); 
	
	// Add fields to the form
	$form->add('ciao', 'Ciao', 'text', array('class' => 'big'));
	$form->add('bazinga', 'Bazinga', 'textarea');
	
	echo "<tr><td colspan='2'><hr></td></tr>";
	
	$form->add('new_option_name', 'New Option Name', 'text');
	$form->add('show_custom_block', 'Show custom block', 'checkbox');
	
	
	$form->add('prova_select', 'Prova select', 'select', array(
		'values' => array(
			'1' => 'Ciao',
			'2' => 'Prova',
			'3' => 'Parapilli'
		),
		'class' => 'ciao')
	);
	
	$form->add('show_sidebar_block', 'Show sidebar?', 'checkbox');
	
	$form->footer();
	
?>