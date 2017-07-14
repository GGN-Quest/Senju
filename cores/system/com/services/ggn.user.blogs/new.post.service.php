<?php
/*
	Copyright GOBOU Y. Yannick
	
*/




/* 
	Class 'STYLIVOIR' // DEBUT ------------------
*/

\Gougnon::loadPlugins('PHP/stylIvoir.2.0');




/* 
	Class 'GGN\User\Blog' // DEBUT ------------------
*/

	new \GGN\Using('User\Blog');

/* 
	Class 'GGN\User\Blog' // FIN ------------------
*/






$this->Response(false);

/* 
	Class 'STYLIVOIR' // DEBUT ------------------
*/

	$STYLIVOIR = new \StylIvoir('Blogs.Now');

/* 
	Class 'STYLIVOIR' // FIN ------------------
*/







$bid = Register::_POST('bid', false);

$title = Register::_POST('title','');

$composer = Register::_POST('composer','');

$assocType = Register::_POST('assoc-type','');

$assocFiles = Register::_POST('assoc-files','');




/* 
	Noeud de reponse 
*/
$treat = $this->node('treat');






/* Traitement */

if((\Gougnon::isEmpty($composer) && \Gougnon::isEmpty($assocFiles)) || !is_string($bid) ){

	$treat->because = 'no.data';

}

else{

	$added = \GGN\User\Blog\Post::Add($bid, $title, $composer, $assocType, $assocFiles);


	if($added === TRUE){

		$this->Response(true);

	}


	else{

		$treat->because = 'add.failed';

	}


}






	
