<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS GVideoPlayer
	PAGE cores/_GGNs/PHP/Register.core.g/ARC_ENGINE_RENDING/VIDEOPLAYBACK/default.arc-render
======================================================
	
*/


global $_Gougnon, $GRegister;




if(!class_exists('GVideoPlayer')){
	
	/* Class GLogin */
	class GVideoPlayer{

		const NAME = 'GGN Video PlayBack';
		const VERSION = '0.1.150811.1943';


		var $Type = false;
		var $_Params = 'k autoplay';
		var $Param = [];
		var $Video = ['url'=>false, 'autoplay'=>false, 'key'=>false, 'title'=>false];
		

		public function __construct(){
			global $GLANG,$_Gougnon;
			$this->syslang = $GLANG;
			$this->arguments = func_get_args();
		}
		

		public function addParams($array){
			global $GLANG,$_Gougnon;
			
			$p = explode(' ', $this->_Params);
			foreach ($p as $name) {
				$this->Param[$name] = isset($array[$name])?$array[$name]:false;
			}

			
		}
		
		


	}
	
}
	
	
?>