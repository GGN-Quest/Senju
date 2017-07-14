<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS IHTML
	PAGE cores/_GGNs/PHP/Register.core.g/ARC_ENGINE_RENDING/.HTML/PHP.HTML.arc-render
======================================================
	
*/

/*
	CLASS 'IHTML'
*/

class IHTML{
	
	public function __construct(){
		global $GLANG;
		$this->syslang = $GLANG;
		$this->arguments = func_get_args();
		$this->file = $this->arguments[0];
		$this->path = dirname($this->file) . '/';
		
		}
	
	
	public function engine(){
		global $database;
		include $this->file;
	}
	
	
	}
	
	
	
?>