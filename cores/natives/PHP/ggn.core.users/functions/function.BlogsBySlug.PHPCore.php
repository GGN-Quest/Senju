<?php

	global $database;

	
	$slug = (isset($args[0]))? $args[0]: false;

	$available = (isset($args[1]))? $args[1]: '1';

	if(is_string($slug)){

		return $database->SelectFromTable('NATIVE_USERS_BLOGS', "WHERE SLUG='" . $slug . "' AND AVAILABLE='" . $available . "'");

	}

	return false;


?>