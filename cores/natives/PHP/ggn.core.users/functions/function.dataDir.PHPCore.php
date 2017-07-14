<?php
	
	$username = (isset($args[0]))? $args[0]: false;

	$ipth = (isset($args[1]))? $args[1]: false;


	if($username===false){return false;}



	$userDir = GUSERS::pathData($username);

	if($ipth === false){return $userDir;}


	$pth = str_replace('%', '', $ipth);

	$path = dirname(__FILE__) . '/~dataDir/.' . $pth . '.dir.php';

	$dirname = false;
	


	if(is_file($path)){
		include $path;
		$dir = false;

		if(is_string($dirname)){
			$dir = $userDir . $dirname . ((substr($dirname, -1)=='/')?'':'/');
			if(!is_dir($dir)){Gougnon::createFolders($dir);}
		}

		if(is_array($dirname)){
			foreach($dirname as $d){
				$dir = $userDir . $d . ((substr($d, -1)=='/')?'':'/');
				if(!is_dir($dir)){Gougnon::createFolders($dir);}
			}
		}

		return $dir;
	}
	else{
		return false;
	}




?>