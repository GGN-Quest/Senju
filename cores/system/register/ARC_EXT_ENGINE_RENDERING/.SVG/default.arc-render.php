<?php
	
	/* Chargement du Noyau */



	/* Paramètres */
	define('DEFAULT_STYLE', self::_REQUEST('style'));

	// $GetColors = $this::_REQUEST('color', false);

	$Size = explode('x', $this::_REQUEST('size', '64x64'));
		$Width = isset($Size[0]) && is_numeric($Size[0]) ? $Size[0]: 64;
		$Height = isset($Size[1]) && is_numeric($Size[1]) ? $Size[1]: $Width;
	
	
	
	
	/* Chargement des Noyaux */

	$Style = [];

	$JSCore = _GGN::JSCore('ggn.core');

	$CSSCore = _GGN::CSSCore('ggn.core');

		$CSSCore->Style(DEFAULT_STYLE);
	

	include $this->file;
	
	
?>