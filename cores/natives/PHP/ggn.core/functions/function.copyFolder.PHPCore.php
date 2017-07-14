<?php  
	$Param = $args;  $numParam = count($args);
	$Folder = $Param[0]; 
	$Dir = opendir($Folder);
	
	if(is_dir($Param[1])):
		while ($rF = readdir($Dir)): 
				if(!is_dir($Folder.$rF)): 
					$Element = $Folder.'/'.$rF;
					
				 
					if(!is_file($Element)):
						$OxCore->creatFolders($Param[1].'/'.basename($Element));
						$OxCore->copyFolder($Element, $Param[1].'/'.basename($Element));
					endif;
				
					if(is_file($Element)):
						copy($Element, $Param[1].'/'.basename($Element));
					endif;
					
				endif; 
				 
				
				 
			endwhile;
		endif;
?>