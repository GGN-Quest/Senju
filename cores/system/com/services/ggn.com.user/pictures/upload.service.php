<?php
	
if(is_array($this->Register->USER)){

	global $database;


	/* Utilisateur */
	$User = $this->Register->USER;



	/* Ajax Upload */
	if(!class_exists('AjaxUpload')){
		Gougnon::loadPlugins('PHP/ajax.upload.0.1');
	}


	/* Paramètres */
	$parent = $this->Register->_REQUEST('parent');
		$parent = (is_string($parent))? $parent: '0';
	$context = $this->Register->_REQUEST('context');
		$context = (is_string($context))? $context: '';
	$akey = $this->Register->_REQUEST('akey');
		$akey = (is_string($akey))? $akey: '0';
	// $tunnel = $this->Register->_REQUEST('tunnel');

	$image = $this->Register->_REQUEST('image');
		$filename = $this->Register->_REQUEST('filename');
		$size = $this->Register->_REQUEST('size');
	$path = $this->Register->_REQUEST('path');
		$path = (is_string($path))? $path: '';
		$path .=  ((substr($path,-1)=='/')?'':'/');
	$type = $this->Register->_REQUEST('type');
	$dir = GUSERS::dataDir($User['USERNAME'][0], '%PICTURES%');


	/* Traitement */
	if(is_string($image)&&is_string($path)){

		$time = time();
		$dir .= $path;

		$file=[
			'filename'=>$filename
			,'data'=>$image
			,'size'=>$size
		];



		/* Ajax Upload */
		$upload = new AjaxUpload($file, AJAXUPLOAD_BASE64);



		/* Validation */
		if(!$upload->isValid()){$this->Response('data.not.available');}


		/* Conversion en 'JPG' */
		$convert = $upload->convertTo(AJAXUPLOAD_IMAGE_JPG);



		/* Deplacement du fichier vers '$dir' */
		$filename = $upload->moveTo($dir);




		/* Trigger */
		if($convert==false){$this->Response('convert.failed');}
		if(is_string($convert)){$this->Response($convert);}
		if($filename==false){$this->Response('move.failed');}


		if(is_string($filename)){
			$dataKey = 'UU' . _GGNCrypt::RKCRandm(_GGNCrypt::PALETTE_NUMERIC, 232) . date('YmdHis');

			/* Reponse de l'upload */
			$this->Response('upload.success');
			$file = $this->Node('file');
			$file->name = basename($filename);
			$file->info = @getimagesize($filename);



			/* Ajout à la base de donnée */
			$query = $this->Node('query');

			$Response = $database->InsertIntoTable('NATIVE_USERS_DATA_IMAGES'
				, " VALUES(NULL, '" . $User['UKEY'][0] . "', '" . $context . "', '" . $parent . "', '" . $dataKey . "', '" . $akey . "', '', '" . $file->name . "', '" . $file->info['mime'] . "', '" . $file->info['bits'] . "', '" . $file->info[0] . "', '" . $file->info[1] . "', '" . (isset($file->info['channels'])?$file->info['channels']:'NaN') . "', '" . $size . "', '" . $path . "', '" . $time . "', '" . $time . "', '1' ) "
			); 

			if($Response){
				$query->response = 'query.success';
			}

			if(!$Response){
				$query->response = 'query.fail';
			}



			/* Chargement du tunnel */
			// $tnl = $this->Node('tunnel');

			// if(is_string($tunnel)){
			// 	if($this->Tunnel($tunnel, '-image.upload', ['dataKey'=>$dataKey,'assocKey'=>$akey,'filename'=>$filename])===false){
			// 		$tnl->response = 'tunnel.fail';
			// 	}
			// 	else{
			// 		$tnl->response = 'tunnel.success';
			// 	}
			// }



		}
		
		if(!is_string($filename)){
			$this->Response('upload.fail');
		}




	}
	else{
		$this->Response('data.not.found');
	}

}

else{
	$this->Response('user.not.found');
}


?>