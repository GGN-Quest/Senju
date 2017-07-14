 <?php
/*
	Copyright GOBOU Y. Yannick
	
*/


	global $database;


if(isset($this->Register->USER) && is_array($this->Register->USER)){


	/*
		Classe utile pour les ressources 
		du système et des utilisateurs 
	*/

	GSystem::requires('util.rsrc');

	$_RSRC = new GGN_UTIL_RSRC($this->Register);



	$this->Response(true);



	$treat = $this->node('treat');


	$treat->set = false;





	/* Entité */
	$Entity = Register::_POST('entity', false);


	/* Entité */
	$Legend = Register::_POST('data', false);
  

	/* Utilisateur */
	$UKey = Register::_POST('ukey', __IP__);





	/* Entité existe */
	if(is_string($Entity)){

		$xent = explode('://', $Entity);

		$type = strtolower($xent[0]);


		$file = $Entity;


		if($type=='rsrc' && isset($xent[1])){

			$xen = explode('/', $xent[1]);

			if(count($xen) >= 3){

				$file = $_RSRC->_Dir($this->Register->USER['UKEY'], $xen[1]);

				$file .= implode('/',\Gougnon::arrayValues($xen,2));

				$file = str_replace('?ext=', '.', $file);

			}

		}



		if(is_file($file)){

			/* Meta */
			$meta = new RegisterMeta($file);

				$meta->Update('legend', $Legend );

			$meta->Save();

			$treat->set = true;
			
		}



	}




}


/* Besoin de connexion */
else{

	$this->Response('require.login');

}


