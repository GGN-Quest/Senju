<?php

	global $GLANG;





	/* Taritement */
	$_REG = $this;

	$_REG_MODE = (isset($args[1]))?$args[1]:false;

	$_REG_MIME = (isset($args[2]))?trim($args[2]):false;

	$_REG_TYPE = (isset($args[3]))?$args[3]:false;








	/* Cache HTML / DEBUT */

		if($_REG_MIME == 'content-type:text/html'){

			$Memorize = \RegisterCaches::Memorize(RegisterCaches::_PATH_HTML, $_REG->UseDynamicCaches, $_REG->UseUpdateCaches, $_REG->UseTypeCaches);

			if(is_string($Memorize)){ 

				header($_REG_MIME .';charset='.$GLANG['INFO']['CHARSET'].''); 

				echo ($Memorize); 

				$this->close(true); 

			}

			ob_start(function($Buffer) use ($_REG){

				return ($_REG->UseCaches == false) 

					? $Buffer 

					: \RegisterCaches::HTML($Buffer, $_REG->UseDynamicCaches, $_REG->UseUpdateCaches, $_REG->UseTypeCaches, $_REG->UseCompactMode, $_REG->__FilesToCaches)

				;

			});

		}

	/* Cache HTML / FIN */






	/* Cache CSS / DEBUT */

		if($_REG_MIME == 'content-type:text/css'){

			$Memorize = \RegisterCaches::Memorize(RegisterCaches::_PATH_CSS, $_REG->UseDynamicCaches, $_REG->UseUpdateCaches, $_REG->UseTypeCaches);

			if(is_string($Memorize)){ 

				header($_REG_MIME .';charset='.$GLANG['INFO']['CHARSET'].''); 

				echo $Memorize; 

				$this->close(true); 

			}

			ob_start(function($Buffer) use ($_REG){

				return ($_REG->UseCaches == false) 

					? $Buffer 

					: \RegisterCaches::CSS($Buffer, $_REG->UseDynamicCaches, $_REG->UseUpdateCaches, $_REG->UseTypeCaches, $_REG->UseCompactMode, $_REG->__FilesToCaches)

				;

			});

		}

	/* Cache CSS / FIN */







	/* Cache JS / DEBUT */

		if($_REG_MIME == 'content-type:text/javascript'){

			$Memorize = \RegisterCaches::Memorize(RegisterCaches::_PATH_JS, $_REG->UseDynamicCaches, $_REG->UseUpdateCaches, $_REG->UseTypeCaches);

			if(is_string($Memorize)){ 

				header($_REG_MIME .';charset='.$GLANG['INFO']['CHARSET'].''); 

				echo $Memorize; 

				$this->close(true); 

			}			

			ob_start(function($Buffer) use ($_REG){

				return ($_REG->UseCaches == false) 

					? $Buffer 

					: \RegisterCaches::JS($Buffer, $_REG->UseDynamicCaches, $_REG->UseUpdateCaches, $_REG->UseTypeCaches, $_REG->UseCompactMode, $_REG->__FilesToCaches)

				;

			});

		}

	/* Cache JS / FIN */




?>