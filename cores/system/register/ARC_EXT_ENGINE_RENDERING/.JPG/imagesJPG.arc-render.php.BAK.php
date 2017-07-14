<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS imagesPNG
	PAGE cores/_GGNs/PHP/Register.core.g/ARC_ENGINE_RENDING/.JPG/imagesPNG.arc-render.php
======================================================

	Moteur de rendu d'images JPG
	
*/

/*
	CLASS 'imagesJPG'
*/

	if(!class_exists('GImages')){
		Gougnon::loadPlugins('PHP/GImages.0.1');
	}





	$mode = (isset($_GET['mode']))?$_GET['mode']: '-default';





	/* Paramètres pour le cache */
	$dir = 'ggn.caches.images.jpg';
	$URL = Gougnon::currentURL();
	$Caches = new _GGNCaches('-passive', $URL, $dir, '.JPG');
	$path = $Caches->Path();
	$data = $Caches->Data();







	/* Affichage du cache */
	if(is_string($data)){_GGN::write($data);exit;}







	/* Création de l'image */
	if(!is_string($data)){

		/* Paramètres pour l'image */
		$resizer = (isset($_GET['resize']))?TRUE:FALSE;
		$width = (isset($_GET['width']))?$_GET['width']:FALSE;
		$height = (isset($_GET['height']))?$_GET['height']:FALSE;
		
		$resizeby = (isset($_GET['resizeby']))?$_GET['resizeby']:FALSE;
			$resizeby = ($resizeby=='0'||$resizeby=='-width')?false:true;

		$rogner = (isset($_GET['rogner']))?$_GET['rogner']:FALSE;
			$rogner = ($rogner=='0')?false:true;

		



		/* Déclaration */
		$this->Render = new GImages(
			$this->file
			, $width
			, $height
			, (isset($_GET['source']))?$_GET['source']: 'text.plain'
			, $mode
			, (isset($_GET['quality']))?$_GET['quality']: '-medium'
			, (isset($_GET['filter']))?$_GET['filter']:FALSE 
		);
		
		





		/* Génération de l'images dans le cache */
		if($resizer===false){
			$path = ($mode=='-default')?null:$path;
			$this->Render->open($path);
		}

		if($resizer===true){
			$this->Render->resize($path, $resizeby, $rogner);	
		}






		/* Redirection vers l'image */
		if(is_string($path)){
			header('location:' . $URL);
		}

	}


	

?>