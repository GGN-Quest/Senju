<?php
	
	/* Chargement du Noyau */
	/* Paramètres */
	define('DEFAULT_STYLE', self::_REQUEST('style'));
	
	$this->UseCompactMode = (self::_REQUEST('compact', '1') == '1') ? TRUE : FALSE;
	
	
	
	/* Chargement du Noyau */
	$jsCore = _GGN::JSCore('ggn.core');
	$CSSCore = _GGN::CSSCore('ggn.core');
	
	// $alert = '';
	// $alert .= 'G_ALERT=function(m){var A=Gougnon||G||false,str=[];';
	// $alert .= 'for(var x in arguments){str.push(arguments[x]);}';
	// $alert .= 'if(A!==false){A.notice.open({html:str.join(""),delay:7*1000});}';
	// $alert .= 'else{alert(str);}';
	// $alert .= '};';
	
	// _GGN::write($alert);
	
	
	
	
	include $this->file;
	
	
?>