<?php

class Template {
	
	private $path;
	private $content = "";
	
	function Template($p)
	{
		$this->path = $p;
		$this->load();
	}
	
	/*
		Loads the template from the path
	*/
	public function load()
	{
		$fh = fopen($this->path, 'r');
		$data = fread($fh, filesize($this->path));
		fclose($fh);
		
		$this->content = $data;
	}
	
	/*
		Renders the template
	*/
	public function render($replacements = array())
	{
		$this->replace_bookmarks($replacements);
		echo $this->content;
	}
	
	/*
		Replaces the bookmarks in the template
	*/
	public function replace_bookmarks($replacements)
	{
		foreach($replacements as $k => $v) {
			$this->content = str_replace("%".$k."%", $v, $this->content);
		}
		
		return $this->content;
	}
	
}