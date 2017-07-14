<?php
	global $GLANG;
	
	$lang = $GLANG;
	$mode = trim(strtolower($args[0]));
	$access = (is_array($args[1]))?$args[1]: array();
	$excludes = (is_array($args[2]))?$args[2]: array();
	$Event = (is_object($args[3]))?$args[3]: false;


	$Return = function($code) use ($Event) {
		if(is_object($Event)){
			return $Event($code, _GGN::HTTP_HEADER_403);
		}
		else{
			_GGN::clientRefererControlAccessFailed($code, _GGN::HTTP_HEADER_403);
		}
	};


	$url = __HTTP_REFERER__;
	$uhost = strtolower(urldecode($_SERVER['HTTP_HOST']));
	$shost = HOST;

	preg_match("/(\w+):\/\/([\w.:-]+)\/(\S*)/", $url.'/', $URLPattern);
	
	// if(!isset($_SERVER['HTTP_CONNECTION'])){
	// 	// _GGN::clientRefererControlAccessFailed('e1xKA0011', _GGN::HTTP_HEADER_403);
	// 	return $Return('e1xKA0011');
	// }
	
	if(count($URLPattern)<=0){preg_match("/(\w+):\/\/([\w.:-]+)\/(\S*)/", 'http://'.$url.'/', $URLPattern);}
	if(isset($URLPattern[2])){$domaineName = strtolower(urldecode($URLPattern[2]));}
	 
	$allHeaders = (function_exists('getallheaders'))?getallheaders():false;

	if($mode=='-deny'){
		$excludesAvailable = FALSE;
		if(isset($domaineName)){
			for($y=0; $y<count($excludes); $y++){
				$excl = trim(strtolower($excludes[$y]));
				if($excl=='domaine'){
					$gexcnin = substr($domaineName, -1*(strlen(trim($uhost))));
					$gexnin = str_replace($gexcnin, '', $domaineName);
					if($gexcnin==$uhost && (Gougnon::isEmpty($gexnin))){$excludesAvailable=TRUE;break;} 
					if($gexcnin==$uhost && (!Gougnon::isEmpty($gexnin))){$excludesAvailable=TRUE;break;} 
					break;}
				if($excl=='subdomaine'){
					$gexcnin = substr($domaineName, -1*(strlen(trim($uhost))));
					$gexnin = str_replace($gexcnin, '', $domaineName);
					if($gexcnin==$uhost && (!Gougnon::isEmpty($gexnin)) && $gexnin!='www.'){$excludesAvailable=TRUE;break;} 
					break;}
				else{
					$gexcnin = substr($domaineName, -1*(strlen(trim($excludes[$y]))));
					$gexnin = str_replace($gexcnin, '', $domaineName);
					if($gexcnin==trim($excludes[$y]) && (Gougnon::isEmpty($gexnin))){$excludesAvailable=TRUE;break;}
					}
				}
			}

		if($excludesAvailable===FALSE){
			for($x=0; $x<count($access); $x++){
			
				if(trim($access[$x])=='all' || trim($access[$x])=='*'){
					// _GGN::clientRefererControlAccessFailed('e1xD001', _GGN::HTTP_HEADER_403);
					return $Return('e1xD001');
					break;
				}
				
				else{
					if(isset($URLPattern[2])){
						$gdomnin = substr($domaineName, -1*(strlen($uhost)));
						$gdonin = str_replace($gdomnin, '', $domaineName);
							
						if(trim($access[$x])=='domaine'){
							if($uhost==$domaineName){
								// _GGN::clientRefererControlAccessFailed('e1xD003', _GGN::HTTP_HEADER_403);
								return $Return('e1xD003');
								break;
							}
							else{
								if($gdomnin==$uhost && (!Gougnon::isEmpty($gdonin))){
									// _GGN::clientRefererControlAccessFailed('e1xD0033', _GGN::HTTP_HEADER_403);
									return $Return('e1xD0033');
									break;
								} 
								else{break;} 
								}
							break;}
							
						if(trim($access[$x])=='subdomaine'){ 
							if($gdomnin==$uhost && (!Gougnon::isEmpty($gdonin)) && $gdonin!='www.'){
								// _GGN::clientRefererControlAccessFailed('e1xD004', _GGN::HTTP_HEADER_403);
								return $Return('e1xD0033');
								break;
							}
							break;}
							
						else{
							if(trim($access[$x])==$domaineName){
								// _GGN::clientRefererControlAccessFailed('e1xD005', _GGN::HTTP_HEADER_403);
								return $Return('e1xD005');
								break;
							}
							$gdomnin = substr($domaineName, -1*(strlen(trim($access[$x]))));
							$gdonin = str_replace($gdomnin, '', $domaineName);
							if($gdomnin==trim($access[$x]) && (!Gougnon::isEmpty($gdonin))){
								// _GGN::clientRefererControlAccessFailed('e1xD006', _GGN::HTTP_HEADER_403);
								return $Return('e1xD006');
								break;
							}
							}
						}
					}
					

				}
			}
		}
	
	
	
	
	
	
	if($mode=='-allow'){
		$excludesAvailable = FALSE;
		if(isset($domaineName)){
			for($y=0; $y<count($excludes); $y++){
				$excl = trim(strtolower($excludes[$y]));
				if($excl=='domaine'){
					$gexcnin = substr($domaineName, -1*(strlen(trim($uhost))));
					$gexnin = str_replace($gexcnin, '', $domaineName);
					if($gexcnin==$uhost && (Gougnon::isEmpty($gexnin))){
						// _GGN::clientRefererControlAccessFailed('e1xA001111', _GGN::HTTP_HEADER_403);
						return $Return('e1xA001111');
						break;
					} 
					if($gexcnin==$uhost && (!Gougnon::isEmpty($gexnin))){
						// _GGN::clientRefererControlAccessFailed('e1xA00111', _GGN::HTTP_HEADER_403);
						return $Return('e1xA00111');
						break;
					} 
					break;}
				if($excl=='subdomaine'){
					$gexcnin = substr($domaineName, -1*(strlen(trim($uhost))));
					$gexnin = strtolower(str_replace($gexcnin, '', $domaineName));
					if($gexcnin==$uhost && (!Gougnon::isEmpty($gexnin)) && $gexnin!='www.'){
						// _GGN::clientRefererControlAccessFailed('e1xA0011', _GGN::HTTP_HEADER_403);
						return $Return('e1xA0011');
						break;
					} 
					break;}
				else{
					$gexcnin = substr($domaineName, -1*(strlen(trim($excludes[$y]))));
					$gexnin = str_replace($gexcnin, '', $domaineName);
					if($gexcnin==trim($excludes[$y]) && (Gougnon::isEmpty($gexnin))){
						// _GGN::clientRefererControlAccessFailed('e1xA001', _GGN::HTTP_HEADER_403);
						return $Return('e1xA001');
						break;
					} 
					}
				}
			}
			
		if($excludesAvailable===FALSE){
			for($x=0; $x<count($access); $x++){
			
				if(trim($access[$x])=='all' || trim($access[$x])=='*'){break;}
				
				else{
					if($url===FALSE){
						// _GGN::clientRefererControlAccessFailed('e1xA000', _GGN::HTTP_HEADER_403);
						return $Return('e1xA000');
						break;
					}
					if(!isset($URLPattern[2])){
						// _GGN::clientRefererControlAccessFailed('e1xA002', _GGN::HTTP_HEADER_403);
						return $Return('e1xA002');
						break;
					}
					
					$clientBrowser = self::getClientBrowser();
					if($clientBrowser['NAME'] == 'Mozilla Firefox'){
						
						if(is_array($allHeaders)){
							if($allHeaders['Accept']=='*/*'){
								// _GGN::clientRefererControlAccessFailed('e1xA0022', _GGN::HTTP_HEADER_403);
								return $Return('e1xA0022');
								break;
							}
							if(!isset($allHeaders['Connection'])){
								// _GGN::clientRefererControlAccessFailed('e1xA0022', _GGN::HTTP_HEADER_403);
								return $Return('e1xA0022');
								break;
							}
						}
					}
					
					if(isset($URLPattern[2])){
						$gdomnin = substr($domaineName, -1*(strlen($uhost)));
						$gdonin = strtolower(str_replace($gdomnin, '', $domaineName));
						
						if(trim($access[$x])=='domaine'){
							if($uhost==$domaineName){break;}
							else{
								if($gdomnin==$uhost && (!Gougnon::isEmpty($gdonin))){break;} 
								else{
									// _GGN::clientRefererControlAccessFailed('e1xA0033', _GGN::HTTP_HEADER_403);
									return $Return('e1xA0033');
									break;
								} 
							}
						}
							
						if(trim($access[$x])=='subdomaine'){ 
							if($gdomnin!=$uhost){
								// _GGN::clientRefererControlAccessFailed('e1xA004', _GGN::HTTP_HEADER_403);
								return $Return('e1xA004');
							} 
							if($gdomnin==$uhost && (Gougnon::isEmpty($gdonin))){
								// _GGN::clientRefererControlAccessFailed('e1xA0044', _GGN::HTTP_HEADER_403);
								return $Return('e1xA0044');
								break;
							} 
							break;}
							
						else{
							if(trim($access[$x])==$domaineName){
								// _GGN::clientRefererControlAccessFailed('e1xA005', _GGN::HTTP_HEADER_403);
								return $Return('e1xA005');
								break;
							}
							$gdomnin = substr($domaineName, -1*(strlen(trim($access[$x]))));
							$gdonin = str_replace($gdomnin, '', $domaineName);
							if($gdomnin==trim($access[$x]) && (!Gougnon::isEmpty($gdonin)) && $gdonin!='www.'){
								// _GGN::clientRefererControlAccessFailed('e1xA006', _GGN::HTTP_HEADER_403);
								return $Return('e1xA006');
								break;
							} 
						}
					}
						
						
					}
					

				}
			}
		}
	
		
