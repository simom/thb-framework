<?php

include 'Field.php';

class Form {

	public $fields = array();
	
	/*
		Renders the form header.
	*/
	public function header()
	{
		include dirname(__FILE__)."/tpl/form/header.php";
	}
	
	/*
		Renders the form footer.
	*/
	public function footer()
	{
		$tpl = new Template(dirname(__FILE__)."/tpl/form/footer.php");
		$tpl->render(
			array(
				'fields'	=> implode(",", $this->fields),
				'submit'	=> __('Save Changes')
			)
		);
	}
	
	/*
		Adds a field to the form.
	*/
	public function add($i, $l, $t, $a = array())
	{
		$this->fields[count($this->fields)] = $i;
	
		$f = new Field();
		$f->insert($i, $l, $t, $a);
	}
	
	/*
		Displays the notice message.
	*/
	public function display_notice()
	{
		include dirname(__FILE__)."/tpl/form/notice.php";
	}

}