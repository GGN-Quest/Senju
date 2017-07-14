<?php 
	
	$apis = $args;
	$arguments = (isset($args[1]))?$args[1]:[];
	$capis = count($apis);
	$pre = 'require.';
	$ext = '.gsys.php';
	$dir = __CORES_SYSTEM__;
	$x=0;


	// for($x=0;$x<$capis;$x++){
		$api = $apis[$x];
		$_api = explode('/',$api);
		$fapi = $_api[0];
		$folder = ((isset($_api[1]))?$_api[1]:'') . '/';
		$file = $dir . $folder . $pre . $fapi . $ext;

		if(is_file($file)){
			return include $file;
		}
		else{_GGN::wCnsl('Donnée require introuvable : ' . $api );}
	// }

	return false;

?>