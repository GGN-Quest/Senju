<?php
/*
	Copyright GOBOU Y. Yannick
*/

	
$_RETURN = TRUE;





/* Contenu ICI */
if($_RETURN===TRUE){

	$droot = $_SERVER['DOCUMENT_ROOT'];
	$root = substr(__MAIN__, strlen($droot) );
	$uri = substr($_SERVER['REQUEST_URI'], strlen($root));
		$uri = (substr($uri, 0,1)=='/')?substr($uri, 1): $uri;
	$name = strtoupper(_GGNCrypt::_sha256($uri,7));
	

	/* Creation */
	// var_dump(GStorages::create($name, self::getDataPath(GGN_REGISTER_MODE_FREE), self::getDataColumns(GGN_REGISTER_MODE_FREE) ) );


	/* Lectures */
	$d0 = GStorages::load($name, self::getDataPath(GGN_REGISTER_MODE_FREE));
	$row = count($d0['NAME']);


	if($row<=0){
		$this->eventOn('ERROR.FREE.MODE.NOT.FOUND');
	}
	else{
		
		$this->eventOn('SUCCESS.REQUEST.OK', self::MODE_FREE_REGISTER, 'content-type:text/html');
		
		$n = $d0['NAME'][0];
		$t = $d0['TYPE'][0];
		$d = $d0['DATA'][0];
		$l = $d0['LABEL'][0];
		$c = $d0['COMMENTS'][0];


		echo 'FREE.MODE:NOT.OPERANT';
		exit;

	}



}


?>