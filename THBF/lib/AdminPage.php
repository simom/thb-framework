<?php

include 'Utils.php';

class AdminPage {
	
	public $title;
	public $slug;
	protected $capability = "install_themes";
	
	function AdminPage($page, $add_menu = true)
	{
		global $utils;
		
		$this->title 		= $page[0];
		$this->slug 		= $utils->make_slug($this->title);

		add_menu_page(
			$this->title,
			$this->title,
			$this->capability,
			$this->slug,
			$this->slug
		);
		
		eval("function ".$this->slug."() { global \$theme; \$theme->admin(); }");
				
		if( isset($page[1]) ) {	
			$i=1;
			foreach($page[1] as $pag) {
				$p = new AdminSubPage($pag, $this->slug, $this->slug."_".$i);
				eval("function ".$this->slug."_".$i."() { global \$theme; \$theme->admin(); }");
				unset($p);
				$i++;
			}
		}
	}
	
}

class AdminSubPage extends AdminPage {
	
	function AdminSubPage($page, $parent_slug, $sl) {		
		$this->title 		= $page;
		$this->slug 		= $sl;
		
		add_submenu_page(
			$parent_slug,
			$this->title, 
			$this->title,
			$this->capability,
			$this->slug,
			$this->slug
		);
	}
	
}