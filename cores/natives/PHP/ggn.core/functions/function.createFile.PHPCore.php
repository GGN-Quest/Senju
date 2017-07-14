<?php  
 	

	$i = $args;  $in = count($args);

	$omd = (isset($i[2])) ? $i[2] : 'w+';

	if(!file_exists($i[0])): self::createEmptyFile($i[0]); endif;
		
		if (is_writable($i[0])) {
				if (!$FileHandle = fopen($i[0], $omd)) {
					 exit("Erreur Fatal: Impossible de creer le fichier < ".$i[0]." >.");
					return false;
				}
				if (fwrite($FileHandle, $i[1]) === FALSE) {
					return false;
				}
				fclose($FileHandle);

			} else {
				return null;
			}


	return true;

?>