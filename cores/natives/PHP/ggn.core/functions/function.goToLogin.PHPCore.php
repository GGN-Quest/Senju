<?php  

	header('location:'
	
		. HTTP_HOST 
	
		. 'login?next=' 
	
		. urlencode(\Gougnon::currentURL()) 

		. (is_string(__HTTP_REFERER__) ? '&previous=' . urlencode(__HTTP_REFERER__) : '')

		. (isset($args[0]) && is_string($args[0]) ? '&app=' . $args[0] : '')

		. (isset($args[1]) && is_string($args[1]) ? '&' . $args[1] : '')
	
	);


	exit;


?>