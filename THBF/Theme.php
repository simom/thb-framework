<?php

include 'lib/Template.php';
include 'lib/AdminPage.php';

class Theme {
	
	private $dir;
	public $theme_menu = array();
	
	function Theme()
	{
		$this->dir = dirname(__FILE__);
	}
	
	// ADMINISTRATION-RELATED FUNCTIONS ===========================================================
	
	/*
		Runs the WPFramework
	*/
	public function run()
	{
		if( !empty($this->theme_menu) ) {
			add_action('admin_menu', 'create_theme_menu');		
			eval("function create_theme_menu() { global \$theme; \$theme->add_menu(\$theme->theme_menu); }");
		}
		
		add_action('admin_head', 'theme_css');
		eval("function theme_css() {
			\$url = get_bloginfo('template_url') .'/THBFramework/admin.css';
			echo '<link rel=\"stylesheet\" type=\"text/css\" href=\"' . \$url . '\" />';
		}");
	}
	
	/*
		Creates the menu structure.
	*/
	public function add_menu($structure)
	{
		$main = new AdminPage($structure);
	}
	
	/*
		Renders an administration page.
	*/
	public function admin()
	{
		$caller = debug_backtrace();
			
		$top = new Template($this->dir."/lib/tpl/admin_top.tpl");
		echo $top->render(
			array(
				'title'		=> get_admin_page_title()
			)
		);
		
		if(file_exists($this->dir."/pages/".$caller[1]['function'].".php"))
			include $this->dir."/pages/".$caller[1]['function'].".php";
			
		$bottom = new Template($this->dir."/lib/tpl/admin_bottom.tpl");
		$bottom->render();
	}
	
	// PRESENTATION-RELATED FUNCTIONS =============================================================
	
	/*
		Checks wether a given block is activated or not.
	*/
	public function block($name)
	{
		return get_option('show_'.$name.'_block') == 1;
	}
	
	/*
		Displays the content of an option
	*/
	public function option($name)
	{
		return get_option($name);
	}
	
}

// Creating the instance of WPF
$theme = new Theme();