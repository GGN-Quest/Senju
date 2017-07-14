<?php 
		$HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
		
		
        $browser = array();
		$browser['NAME'] = 'undefined';
		
		
        if(preg_match('/MSIE/i',$HTTP_USER_AGENT)){
            $browser['NAME'] = "Internet Explorer";
			}
        elseif(preg_match('/Firefox/i',$HTTP_USER_AGENT)){
            $browser['NAME'] = "Mozilla Firefox";
			}
        elseif(preg_match('/Chrome/i',$HTTP_USER_AGENT)){
            $browser['NAME'] = "Google Chrome";
			}
        elseif(preg_match('/Safari/i',$HTTP_USER_AGENT)){
            $browser['NAME'] = "Apple Safari";
			}
        elseif(preg_match('/Flock/i',$HTTP_USER_AGENT)){
           $browser['NAME'] = "Flock";
			}
        elseif(preg_match('/Opera/i',$HTTP_USER_AGENT)){
            $browser['NAME'] = "Opera";
			}
        elseif(preg_match('/Netscape/i',$HTTP_USER_AGENT)){
            $browser['NAME'] = "Netscape";
			} 
        elseif(preg_match('/Mozilla/i',$HTTP_USER_AGENT)){
            $browser['NAME'] = "Mozilla Gecko";
			} 
		
		
	return $browser;

?>