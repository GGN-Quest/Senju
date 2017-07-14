<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CSS Framework Render
======================================================

	update(160205.0926)

*/


	$this->UseCompactMode = (self::_REQUEST('compact', '1') == '1') ? TRUE : FALSE;


	
	/* 
		Chargement du Noyau 
	*/
	
		$Core = _GGN::CSSCore('ggn.core');




	/* 
		Style du Framework
	*/

		$style = self::_REQUEST('style', $Core::TONE . ':' . $Core::STYLE);




	/* 
		Version du Framework
	*/

		$version = self::_REQUEST('version', $Core::DEFEULT_FRAMEWORK);
	




	/* 
		API a charger
	*/

		$api = self::_REQUEST('api', '');

		
		/* API demandé */
		$APIs = explode(',', $api);

	


	/* 
		Instruction pour activation desactivation de la responsivité
	*/

		$responsivity = self::_REQUEST('responsivity');




	/* 
		Palette definie par le client
	*/

		$palette = self::_REQUEST('palette', false);




	/*
		Definition de la palette de couleur si demandé
	*/
		// var_dump($palette);exit;
		$Core->ToPalette($palette);



	/* 
		Construction -----------------------------------
	*/


	/* 
		Chargement du Style
	*/

		
		$Core->Style($style);
		

		

	

	/* 
		Chargement de la version du framework
	*/
	if($version!==FALSE){

		if($Core->framework($version)===FALSE){

			header(_GGN::HTTP_HEADER_404);

			_GGN::write('/* GGN.CSS Framework : version introuvable */');

			exit;

		}

	}
	



	/* 
		Chargement du framework par defaut
	*/
	if($version===FALSE){$Core->loadDefaultFramework();}



		

	/* 
		Chargement des APIs
	*/
	if(is_array($APIs)){
		

		/* 
			Appel des API
		*/

		foreach ($APIs as $key => $data) {

			$Core->loadPackages($data, ['responsivity'=>$responsivity]);

		}
		

	}
		
	
	


	

	/* Construction du code */
	$Core->Build();






?>