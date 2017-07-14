<?php
/*
	Copyright GOBOU Y. Yannick
	
*/




/* 
	Class 'STYLIVOIR' // DEBUT ------------------
*/

\Gougnon::loadPlugins('PHP/stylIvoir.2.0');


	$STYLIVOIR = new \StylIvoir('Blogs.Now');


/* 
	Class 'STYLIVOIR' // FIN ------------------
*/







$slug = Register::_POST('slug');




if(!preg_match(\_GGN::PATTERN_USERNAME, $slug)){

	$this->Response('failed');

	return false;

}


else if(\Gougnon::isEmpty($slug)){

	$this->Response('empty');

	return false;

}


else if(strlen($slug) < 8){

	$this->Response('char.not.enough');

	return false;

}


else if(strlen($slug) > 32){

	$this->Response('char.too.much');

	return false;

}


else if(\Register::isARC($slug)){

	$this->Response('system.register.arc');

	return false;

}



else{

	$Is = $STYLIVOIR->UserBlogBySlug($slug);

	$this->Response( (is_object($Is) && $Is->row > 0 ) ? 'exist' : 'not.found' );

}




	
