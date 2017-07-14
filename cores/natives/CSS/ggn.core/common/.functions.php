<?php

	global $_DPO_DEVICE, $_Gougnon;



/* 
	Fonctions // DEBUT ----------------------------------------
*/

	if(isset($GUI) && is_array($GUI)){


		/*
			Affichage par taille d'ecran // DEBUT ----------------------------------
		*/ 



			$GUI['Screen.By.Size'] = function($callback = false, $sizes = false) use($Core){


				if($callback){

					$Array = [];

					$ISS = is_string($sizes);

					if($ISS){

						foreach (explode(',', $sizes) as $k) {

							if(isset($Core->ScreenPrefix[$k])){

								$Array[$k] = $Core->ScreenPrefix[$k];

							}

							
						}

					}

					if(!$ISS){

						$Array = $Core->ScreenPrefix;

					}

					foreach ($Array as $key => $size) {

						$min = (isset($size[0]) && is_string($size[0]) ) ? $size[0] : false;

						$max = (isset($size[1]) && is_string($size[1]) ) ? $size[1] : false;

						$Core->openMedia('' 

							. (is_string($min) ? '(min-width: ' . $min . ') ' : '') . '' 

							. ( ($min != false && $max != false) ? ' and ' : '') . '' 

							. (is_string($max) ? '(max-width: ' . $max . ') ' : '') . '');


							$callback($key, $min, $max);


						$Core->closeMedia();
						
					}		


				}

			};

		/*
			Affichage par taille d'ecran // FIN ----------------------------------
		*/
			






		/*
			Propriété : Display // DEBUT ----------------------------------
		*/

			$GUI['Property.Display.ForEach'] = function($prefix, $subfix = '', $important = true) use($Core){

				foreach (explode(' ', 'block flex inline inline-block inline-flex inline-table list-item run-in table table-caption table-column-group table-header-group table-footer-group table-row-group table-cell table-column table-row initial inherit') as $disp) {

					$Core->selector($prefix . $disp . $subfix, ['display'=> $disp . ' ' . ($important===true ? ' !important': '')] );

				}

			};

		/*
			Propriété : Display // FIN ----------------------------------
		*/
			





		/*
			Prédéfinie : Display // DEBUT ----------------------------------
		*/

			// $GUI['Preset.Notice.Error'] = [];

		/*
			Prédéfinie : Display // FIN ----------------------------------
		*/
			




	}


/* 
	Fonctions // FIN ----------------------------------------
*/





?>