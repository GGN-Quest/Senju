<?php
/*
	Copyright GOBOU Y. Yannick
	
*/

if(isset($this->Register->USER) && is_array($this->Register->USER)){


	/*
		Classe utile pour les ressources 
		du système et des utilisateurs 
	*/

	GSystem::requires('util.rsrc');

	$_RSRC = new GGN_UTIL_RSRC($this->Register);






	ini_set('max_input_time', 300);

	ini_set('max_execution_time', 300);

	ini_set("memory_limit", \_GGN::varn('MEMORY_LIMIT') );

	


	/*
		
		Plugin d'upload Ajax (base64)

	*/
	if(!class_exists('AjaxUpload')){

		\Gougnon::loadPlugins('PHP/ajax.upload.0.1');

	}



	/* Noeud du Resultat */

	$imported = $this->node('imported');



	/* 
		Ressource dedié à l'utilisateur courant si 'true' 
		et au systeme si 'false' avec accès administrateur 
		sauf changement depuis la config
	*/
	$user = Register::_GET('user', false);

		$user = ($user == 'true') ? true : false;




	/* 
		Confidentialité de la ressource uploadée
	*/

	$confidentiality = Register::_GET('confidentiality', false);




	/* 
		Type de ressource
	*/
	$type = Register::_GET('type', 'other-files');




	/* 
		Nom du Dossier dans le dossier des ressources
	*/
	$dirname = Register::_GET('dirname', '');

		$slshdn = substr($dirname, -1);

		$dirname .= ($slshdn!='/' && is_string($slshdn)) ? '/' : '';




	/* Requete Fichier envoyé */
	$filename = Register::_REQUEST('filename', '');

	$size = Register::_REQUEST('size', false);

	$file = Register::_POST('file', false);






	/* Dossier */
	$dir = $_RSRC->_Dir($user, $type) . $dirname;






	/* Requete de fichier valide */
	if(is_string($file) && is_string($dir)){


		/* Ajax Upload */
		$upload = new AjaxUpload(

			[

				'data' => $file

				,'filename' => $filename

				,'size' => $size

			]

			, AJAXUPLOAD_BASE64

		);




		/* Validation */
		if(!$upload->isValid()){

			$imported->response = 'data.not.available';

		}




		/* Conversion du fichier */
		$convert = $upload->convertTo(AJAXUPLOAD_IMAGE_ORIGIN);



		/* Deplacement du fichier vers '$dir' */
		$move = $upload->moveTo($dir);


		// print_r($move); exit;




		/* Etat de la conversion */
		if($convert==false){
		
			$imported->response = 'convert.failed';
		
		}
		
		if(is_string($convert)){
		
			$imported->convert = $convert;
		
		}
		


		/* Etat du déplacement */
		if($move==false){
		
			$imported->response = 'move.failed';
		
		}


		// print_r($move);exit;


		/* Deplacement vers '$dir' terminé */
		if(is_string($move)){


			$fnx = explode('.', $filename);

			$fn = implode('.',\Gougnon::arrayValues($fnx, 0, count($fnx) - 1 ));

			/* Meta */
			$meta = new RegisterMeta($move);

				$meta->Update('title', $fn );

				$meta->Update('ext', array_reverse($fnx)[0] );

				$meta->Update('info', @getimagesize($move) );

				$meta->Update('confidentiality', $confidentiality );

			$meta->Save();
			

			/* Reponse du serveur */
			$imported->response = 'import.success';

		}




		/* Reponse du serveur */
		$this->Response(true);



	}



	/* Requete invalide */
	else{

		/* Reponse du serveur */
		$this->Response('failed');


	}


}


/* Besoin de connexion */
else{

	$this->Response('require.login');

}
