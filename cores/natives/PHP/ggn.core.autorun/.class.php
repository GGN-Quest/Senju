<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS Autorun
	PAGE cores/_GGNs/PHP/autorun.core.g/.class.php
======================================================

*/
_GGN::JSCore('ggn.core');
_GGN::CSSCore('ggn.core');

if(!class_exists('_GGN')){exit('Class native introuvable');}
if(!class_exists('Gougnon')){exit('Gougnon PHP Framework introuvable');}
if(!class_exists('GougnonJS')){exit('Gougnon JS Framework introuvable');}
if(!class_exists('GougnonCSS')){exit('Gougnon CSS Framework introuvable');}


	
class AutoRun
{

	/* INFOS */
	CONST NAME = 'Auto Run Core';
	CONST VERSION = '0.1';
	CONST REEL_VERSION = '0.1.140504.1536';
	CONST TYPE = 'PHP.CORE';
	
	
	public $bootOn = false;
	public $preview = false;
	
	
	
	
	
	
	/* CONSTRUCTEUR */
	public function __construct(){
		$this->arguments = func_get_args();
		$this->preview = '';
		$this->preview .= '<h3>' . _GGN::SYSTEM_NAME . '</h3><h4> version ' . _GGN::SYSTEM_VERSION . ' ( ' . _GGN::SYSTEM_UPADTE_VERSION . ' )</h4>';
		$this->preview .= '<br><h3>' . _GGN::NAME . '</h3><h4> version ' . _GGN::VERSION . ' ( ' . _GGN::FAMILY_VERSION . ' )</h4>';
		$this->preview .= '<br><h3>' . Gougnon::NAME . '</h3><h4> version ' . Gougnon::VERSION . ' ( ' . Gougnon::REEL_VERSION . ' )</h4>';
		$this->preview .= '<br><h3>' . GougnonJS::NAME . '</h3><h4> version ' . GougnonJS::VERSION . ' ( ' . GougnonJS::REEL_VERSION . ' )</h4>';
		$this->preview .= '<br><h3>' . GougnonCSS::NAME . '</h3><h4> version ' . GougnonCSS::VERSION . ' ( ' . GougnonCSS::REEL_VERSION . ' )</h4>';
		$this->preview .= '<br><h3>' . self::NAME . '</h3><h4> version ' . self::VERSION . ' ( ' . self::REEL_VERSION . ' )</h4>';
		}
		
	
	
	
	
	
	/* Démarrage */
	public function start(){/* +1 Overlad */
		$a = func_get_args();
		
		if($this->bootOn!==false && $this->bootOn!==true){
			header('location: ' . _GGN::setvar($this->bootOn));
			}
			
		else{
			_GGN::wCnsl((isset($a[0]))?$a[0]: $this->preview);
			}
			
		}
		
		
		
	
}
	
	
 
 
 
?>