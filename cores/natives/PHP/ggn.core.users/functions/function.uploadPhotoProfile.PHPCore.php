<?php
	
	$arguments = (isset($args[0]))? $args[0]: false;
	$user = (isset($arguments['user']))? $arguments['user']: false;
	$file = (isset($arguments['file']))? $arguments['file']: false;


	if(!is_array($arguments)){return false;}
	if(!is_array($file)){return false;}

	// print_r($file);exit;


	if(!class_exists('AjaxUpload')){
		Gougnon::loadPlugins('PHP/ajax.upload.0.1');
	}

	
	$dir = GUSERS::dataDir($user['USERNAME'][0], '%PHOTO.PROFILE%');




	/* Ajax Upload */
	$upload = new AjaxUpload($file, AJAXUPLOAD_BASE64);



	/* Validation */
	if(!$upload->isValid()){return 'data.not.available';}



	$convert = $upload->convertTo(AJAXUPLOAD_IMAGE_JPG);



	/* Deplacement du fichier vers '$dir' */
	$filename = $upload->moveTo($dir);




	/* Resultats */
	if($convert==false){return 'convert.failed';}
	if(is_string($convert)){return $convert;}
	if($filename==false){return 'move.failed';}





	/* Deplacement vers '$dir' terminé */
	if(is_string($filename)){


		/* Meta */
		@$info = getimagesize($filename);
		
		// $meta = Register::newMeta($filename);
		// 	$meta->addChild('size', filesize($filename));
		// 	$meta->addChild('width', $info[0]);
		// 	$meta->addChild('height', $info[1]);
		// 	$meta->addChild('bits', $info['bits']);
		// 	$meta->addChild('mime', $info['mime']);
		// $meta = Register::createMeta($meta);


		// exit('filename : ' . $filename);
		return '{response:"upload.success", filename:"' . basename($filename) . '", width:'.$info[0].', height:'.$info[1].', bits:"'.$info['bits'].'", mime:"'.$info['mime'].'" }';
	}


	return 'no.responses';

?>