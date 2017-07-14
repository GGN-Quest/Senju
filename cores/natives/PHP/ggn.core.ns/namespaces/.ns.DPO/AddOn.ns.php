<?php

	/**
	 * GGN DPO AddOn
	 *
	 * @version 1.2
	 * @update 150910.0900
	 * @Require Gougnon Framework
	*/




/*
	Nom de l'espace
*/
namespace GGN\DPO;
	


	if(!class_exists('\GGN\DPO\AddOn')){
			
		Class AddOn extends Invoke{
				
			const NAME = 'Gougnon DPO Theme';
			
			const VERSION = '2.2';
			
			const UPDATE = '150910.0900';




			var $Menus=array();
			var $MenuName=false;

			var $Sliders=array();
			var $SliderName=false;


			public function __construct(){
				$this->arguments = func_get_args();
			}



			/* Addon Slider */
			public function Slider(){
				if(isset($this->arguments[0])){
					if(is_string($this->arguments[0])){
						$this->Name = $this->arguments[0];
						$this->Sliders[$this->Name] = func_get_args();
					}
				}
				return $this;
			}




			/* Addon Menu */
			public function Menu(){
				if(isset($this->arguments[0])){
					if(is_string($this->arguments[0])){
						$this->Name = $this->arguments[0];
						$this->Menus[$this->Name] = array();
						$this->Menus[$this->Name]['PARENT'] = func_get_args();
						$this->Menus[$this->Name]['CHILDREN'] = array();
					}
				}
				return $this;
			}

			public function addMenuItem(){
				$this->Menus[$this->Name]['CHILDREN'][] = func_get_args();
			}






		} // Class 'AddOn'


	} // If class exists 'AddOn'




?>