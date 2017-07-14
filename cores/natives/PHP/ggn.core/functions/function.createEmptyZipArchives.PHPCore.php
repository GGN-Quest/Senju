<?php 
 
	$i = $args;  $in = count($args); 
	if(@!copy($OiDevice['RESSOURCES_EMPTY_ZIP'], $i[0])):
		die(OiDevice::ErrorWritter('le Fichier esclave est introuvable.'));
	endif;

?>