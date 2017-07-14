<?php
	
	$arguments = (isset($args[0]))? $args[0]: [];
	$user = (isset($arguments['user']))? $arguments['user']: false;
	$module = (isset($arguments['module']))? $arguments['module']: false;
	


	if($module == GUSERS_MOD_UPLOAD_PHOTO_PROFILE && is_array($user)){
		return self::uploadPhotoProfile([
			'user' => (isset($arguments['user']))? $arguments['user']: false
			, 'file' => (isset($arguments['file']))? $arguments['file']: false
		]);
	}



	return 'no.responses';

?>