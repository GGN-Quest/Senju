<?php

	/**
	 * GGN DPO Transcriber
	 *
	 * @version 1.2
	 * @update 150910.0900
	 * @Require Gougnon Framework
	*/




/*
	Nom de l'espace
*/
namespace GGN\DPO;
	


	if(!class_exists('\GGN\DPO\Transcriber')){

			
		Class Transcriber extends Invoke{
			

			/* Mode : Evaluation du code */
			const MODE_EVAL_ = 'mode;action;evaluate;';


			/* Mode : Code unique */
			const MODE_ONLY_ = 'mode;action;only.c;';




			/* Code : Rendu pour mise en cache */

			/* Code : Code de sortie */
			static public function CaOutCode($d){return '<?= ' . $d . '; ?>';}

			static public function eCaOutCode($d){return '" . ' . stripslashes($d) . ' . "';}

			/* Code : Substitution */
			static public function CaRepCode($d,$v,$in){return str_replace('{{'.$d.'}}', $v,$in);}

			/* Code : Controlleur */
			static public function CaCode($d, $mode = false){
				global $_Gougnon;

				$args = func_get_args();
				$output=$d;

				if($mode == self::MODE_EVAL_){
					$output = addslashes($d);
				}

				preg_match_all("/{{(.*)}}/U", $output, $out, PREG_PATTERN_ORDER);


				$r0 = count($out[0]);
				$r = $r0/2;


				if($r0>0){
					for($x=0; $x<$r0; $x++) {
						if(!isset($out[1])){continue;}
						if(!isset($out[1][$x])){continue;}

						$vara = ($out[1][$x])?$out[1][$x]:false;

						switch ($mode) {

							case self::MODE_ONLY_:
								$output = self::CaRepCode($vara, $vara, $output);
							break;
							
							case self::MODE_EVAL_:
								$output = self::CaRepCode($vara, self::eCaOutCode($vara), $output);
							break;
							
							default:
								$output = self::CaRepCode($vara, self::CaOutCode($vara), $output);
							break;

						}

					}

				}


				return $output;
			}




		} // Class 'Transcriber'


	} // If class exists 'Transcriber'














?>