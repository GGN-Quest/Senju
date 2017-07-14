<?php 
	
	$ext = '.ini';

	$sc = Gougnon::scanFolder(__CORES_SYSTEM_SDGUI__ . 'tray.ini');
	$out=array();


	for($x=0; $x<count($sc);$x++){
		$f=$sc[$x];

		if(substr($f, -1*(strlen($ext)))==$ext){
			$bf=basename($f);
			array_push($out, _GGN::ReadINI($f));

		}

	}

	return $out;

?>