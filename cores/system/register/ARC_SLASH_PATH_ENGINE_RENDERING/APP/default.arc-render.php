<?php

/* Copyright GOBOU Y. Yannick */


	$CurrentPath = implode('/', \Gougnon::arrayValues(explode('/', $this->gFile), 1, 2));

	$Dir = \GGN\Path\Protocol::Value('app://' .  $CurrentPath);

	$Page = implode('/', \Gougnon::arrayValues(explode('/', $this->gFile), 2));

	$Main = $Dir . 'main.php';



	if(is_file($Main)){

		include $Main;

	}

	else{

		\_GGN::wCnsl('<h1>GGN.APP</h1> "main" introuvable');

	}



?>
