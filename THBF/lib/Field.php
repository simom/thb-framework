<?php

class Field {

	public $id;
	public $label;
	private $attributes;
	private $forbidden_attributes = array("values");
	private $type;
	private $value;
		
	/*
		Inserts a field in the page.
	*/
	public function insert($i, $l, $t, $a = array())
	{
		$this->id = $i;
		$this->label = $l;
		$this->type = $t;
		$this->attributes = $a;
		$this->value = get_option($i);
		
		switch($t) {
		
			case 'select':
				$this->insert_select_field();
				break;
		
			case 'checkbox':
				$this->insert_checkbox_field();
				break;
				
			case 'textarea':
				$this->insert_text_field(true);
				break;
		
			case 'text':
			default:
				$this->insert_text_field();
				break;
		
		}
	}
	
	/*
		Inserts a text field in the page.
	*/
	private function insert_text_field($large = false)
	{
		$incl = ($large) ? "textarea" : "text";
	
		$tpl = new Template(dirname(__FILE__)."/tpl/form/fields/$incl.tpl");
		$tpl->render(
			array(
				'id'		=> $this->id,
				'label'		=> $this->label,
				'value'		=> $this->value,
				'attributes'=> $this->add_attributes()
			)
		);
	}
	
	/*
		Inserts a checkbox field in the page.
	*/
	private function insert_checkbox_field()
	{
		$tpl = new Template(dirname(__FILE__)."/tpl/form/fields/checkbox.tpl");
		$tpl->render(
			array(
				'id'		=> $this->id,
				'label'		=> $this->label,
				'checked'	=> ($this->value == '1') ? 'checked="checked"' : '',
				'attributes'=> $this->add_attributes()
			)
		);
	}
	
	/*
		Inserts a select field in the page.
	*/
	private function insert_select_field()
	{
		$tpl = new Template(dirname(__FILE__)."/tpl/form/fields/select.tpl");
		
		$tpl->render(
			array(
				'id'		=> $this->id,
				'label'		=> $this->label,
				'options'	=> $this->insert_select_option(),
				'attributes'=> $this->add_attributes()
			)
		);
	}
	
	/*
		Populates the select's options.
	*/
	protected function insert_select_option()
	{		
		$opts = "";
		if($this->attributes['values']) {
			foreach($this->attributes['values'] as $k => $v) {
				$options = new Template(dirname(__FILE__)."/tpl/form/fields/option.tpl");
				$opts .= $options->replace_bookmarks(
					array(
						'value'		=> $k,
						'text'		=> $v,
						'selected'	=> ($this->value == $k) ? 'selected="selected"' : ''
					)
				);
			}
		}
		
		return $opts;
	}
	
	/*
		Adds attributes to the input element
	*/
	protected function add_attributes()
	{
		$attr = "";
		if($this->attributes) {
			foreach($this->attributes as $k => $v) {
				if( !in_array($k, $this->forbidden_attributes) ) {
					$attr .= " ".$k . "=\"$v\"";
				}
			}
		}
		
		return $attr;
	}

}

$field = new Field();