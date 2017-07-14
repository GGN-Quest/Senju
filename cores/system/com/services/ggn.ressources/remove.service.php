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



	/* Paramètres */
	$ukey = Register::_REQUEST('ukey');

	$user = Register::_REQUEST('user');

		$user = ($user == 'true') ? true : false;

	$file = Register::_REQUEST('file');

	$type = Register::_REQUEST('type');





	/* Retrouver la ressource */

	$rsrc = $this->node('rsrc');

	$dir = $_RSRC->_Dir($user, $type);
	// $dir = $_RSRC->_Dir($user, $type) . $dirname;


	$filename = $dir . $file;


	if(is_file($filename)){

		\GGN\File\Remove($filename);

		if(is_file($filename . RegisterMeta::EXT)){

			\GGN\File\Remove($filename . RegisterMeta::EXT);

		}

		$rsrc->unlink = true;

	}

	else{

		$rsrc->unlink = false;

	}





}


/* Besoin de connexion */
else{

	$this->Response('require.login');

}

