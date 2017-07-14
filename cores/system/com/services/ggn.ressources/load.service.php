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





	/* 
		Ressource dedié à l'utilisateur courant si 'true' 
		et au systeme si 'false' avec accès administrateur 
	*/

	$user = Register::_REQUEST('user', false);

		$user = ($user == 'true') ? true : false;




	/* 
		Paramètres
	*/
	$type = Register::_REQUEST('type', 'other-files');


	$order = Register::_REQUEST('order', 'desc');

	$start = Register::_REQUEST('start', 0);

	$limit = Register::_REQUEST('limit', 10);

		// $limit += $start;
	




	/* 
		Nom du Dossier dans le dossier des ressources
	*/
	$dirname = Register::_REQUEST('dirname', '');

		$slshdn = substr($dirname, -1);

		$dirname .= ($slshdn!='/' && is_string($slshdn)) ? '/' : '';







	/* Dossier */
	$dir = $_RSRC->_Dir($user, $type) . $dirname;




	/* Noeud du Resultat */

	$rsrc = $this->node('rsrc');



	$rsrc->start = $start;
	
	$rsrc->limit = $limit;

	$rsrc->order = $order;
	
	$rsrc->type = $type;

	$rsrc->isMy = false;




	/*
		
		Chargement de tous les meta du dossier
		
	*/

	$rsrc->username = $_RSRC->_UDNm($user);

		$QU = \GUSERS::get(" WHERE USERNAME='" . addslashes($rsrc->username) . "' ", true);

		if(is_object($QU)){

			if($QU->row > 0){

				/* Destinataire de la mention */
				$UDat = $QU->data[0];

				$rsrc->ukey = $UDat['UKEY'];

				$rsrc->isMy = $rsrc->ukey === $this->Register->USER['UKEY'];


			}

		}





	$rsrc->files = [];

	$scan = \Gougnon::iScanFolder($dir);

		/* Order croissant // DEBUT */

			$scanlwr = array_map('strtolower', $scan);

			array_multisort( $scanlwr, SORT_ASC, SORT_STRING, $scan );

		/* Order croissant // FIN */

	$cscan = count($scan);


	if($cscan > 0){



		/* Order */

		if(strtolower($order) == 'desc'){

			$scan = array_reverse($scan);

		}




		/*
			Tri
		*/

		$toStart = 0;

		$toLimit = 0;

		foreach ($scan as $meta) {

			$ext = substr($meta, -1 * strlen(RegisterMeta::EXT));

			$c = count($rsrc->files);


			if($ext == RegisterMeta::EXT){

				$f = substr($meta, 0, -1 * strlen(RegisterMeta::EXT) );

				if(is_file($f)){

					if($toLimit >= $limit){break;}

					if($toStart >= $start){

						$fl = substr($f, strlen($dir));

						array_push($rsrc->files,  [

							'src'=>$fl

							,'meta'=> (new RegisterMeta($f))->Loaded

						]);

						$toLimit++;

					}


					$toStart++;

				}


			}



			
		}





	}



}


/* Besoin de connexion */
else{

	$this->Response('require.login');

}


