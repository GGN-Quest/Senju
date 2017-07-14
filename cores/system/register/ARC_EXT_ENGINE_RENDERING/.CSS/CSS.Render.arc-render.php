<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CSS Render
======================================================

*/
		
	
	$this->UseCompactMode = (self::_REQUEST('compact', '1') == '1') ? TRUE : FALSE;

	
	/* Chargement du Noyau */

		$Core = _GGN::CSSCore('ggn.core');



	/* 
		Palette definie par le client
	*/

		$palette = self::_REQUEST('palette', false);
	


	/* 
		Style du Fichier
	*/

		$style = self::_REQUEST('style', $Core::TONE . ':' . $Core::STYLE);



	/*
		Definition de la palette de couleur si demandé
	*/

		$Core->ToPalette($palette);



	/* Chargement du Style */

		$Core->Style($style);




	/* Registre GGN */

		$Core->Register = $this;

	
	
	/* Chargement du fichier */

		include $this->file;

	

	/* Construction du code */

		$Data = $Core->Build();


