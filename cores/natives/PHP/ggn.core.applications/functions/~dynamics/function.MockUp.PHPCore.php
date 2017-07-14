<?php

	$return = false;
	


if(is_object($context) && is_string($context->MockUpPath) && isset($args[0]) && is_string($args[0]) ){


	/* Partie a charger */
	$part = $args[0];


	/* Chemin d'une partie de la Maquette */
	$return = $context->MockUpPath . $part . '.mockup.php';


}



