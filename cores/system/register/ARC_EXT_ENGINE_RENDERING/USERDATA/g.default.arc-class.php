<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS USERDATA
	PAGE cores/_GGNs/PHP/Register.core.g/ARC_ENGINE_RENDING/USERDATA/g.default.arc-render
======================================================
	
*/

/*
	CLASS 'USERDATA'
*/

global $_Gougnon;

if(!class_exists('_GGN')){exit('Class Native introuvable');}
if(!class_exists('Gougnon')){_GGN::wCnsl('Class Gougnon introuvable');}


/* Class GUSERS */
if(!class_exists('GUSERS')){
	_GGN::PHPCore('ggn.core.users');
}

	/* Verification */
	if(!isset($_Gougnon)){
		_GGN::wCnsl('Erreur Données Manquantes: Variable Gougnon ');
	}

	if(!class_exists('GUSERS')){
		_GGN::wCnsl('Erreur Classe Manquantes: Gougnon Users ');
	}





if(!class_exists('GUSERDATA')){
	


	class GUSERDATA{



		
		public function __construct(){
			global $GLANG,$_Gougnon;
			$this->syslang = $GLANG;
			$this->arguments = func_get_args();
			$this->USERS_DIR = __USERS__;
			$this->USER = (isset($this->arguments[0]))?$this->arguments[0]:false;
			$this->modFactory = (isset($this->arguments[1]))?$this->arguments[1]:false;
			$this->modName = (isset($this->arguments[2]))?$this->arguments[2]:false;
		}
		
		

		public function factory(){
			if(!isset($this->modFactory)){return false;}
			if(!isset($this->modName)){return false;}

			return GSystem::requires( $this->modName . '/' .'users.data.factory.' . $this->modFactory, $this->USER);
		}
		
		
		


	}
	
}
	
	
?>