<?php
	
	namespace GGN\DPO;
	

	$return = [

		 'template' => function($Logo = false, $Menu = false, $Module = false, $Options = false){


		 	$SiteName = \_GGN::varn('SITENAME');


			$brick = new Theme\Tag([

				'id'=>'header-nav'

				,'tag'=>'header'

				,'class'=>'gui flex start row wrap'

			]);


			/* Logo / DEBUT */

				if(is_array($Logo) || is_string($Logo)){

					$brick->node->Logo = (new Theme\Tag([
					
						'class' => 'header-logo gui flex'

					]));



					/* Texte simple / DEBUT */

						if(is_string($Logo)){

							$isUrl = preg_match(\_GGN::PATTERN_URL, $Logo);

							if($isUrl){

								$brick->node->Logo->text('<a href="' . HTTP_HOST . '" title="' . $SiteName . '"><img class="logo" src="' . $Logo . '"></a>');
								
							}

							else{

								$brick->node->Logo->text($Logo);

							}


						}

					/* Texte simple / FIN */



					/* Addictif / DEBUT */

						if(is_array($Logo)){


							foreach ($Logo as $Key => $Dat) {

								if($Key == 'html' && is_string($Dat) ){

								 	$brick->node->Logo->text($Dat);

								}
								
								if($Key == 'source'){

									$LogoGoUrl = (isset($Logo['url'])) ? $Logo['url'] : HTTP_HOST;

									if(is_string($Dat)){

										$brick->node->Logo->text('<a href="' . $LogoGoUrl . '" title="' . $SiteName . '"><img class="logo" src="' . $Dat . '"></a>');

									}

									if(is_array($Dat)){

										foreach ($Dat as $ClassName => $Url) {

											$brick->node->Logo->text('<a href="' . $LogoGoUrl . '" class="' . $ClassName . '" title="' . $SiteName . '"><img class="logo" src="' . $Url . '"></a>');

										}

									}

								}


							}


						}

					/* Addictif / FIN */




				}

			/* Logo / FIN */






			/* Menu / DEBUT */

				if(is_string($Menu)){

					$brick->node->Menu = (new Theme\Tag([
					
						'class' => 'header-menu gui flex'

					]));

					$brick->node->Menu->node->Content = (new Theme\Content($Menu));

				}

			/* Menu / FIN */






			/* Module / DEBUT */

				if(is_string($Module)){

					$brick->node->Module = (new Theme\Tag([
					
						'class' => 'header-module gui flex col-0'

					]));

					$brick->node->Module->node->Content = (new Theme\Content($Module));

				}

			/* Module / FIN */






			/* Options / DEBUT */

				if(is_string($Options)){

					$brick->node->Options = (new Theme\Tag([
					
						'class' => 'header-options align-right'

					]));

					$brick->node->Options->node->Content = (new Theme\Content($Options));

				}

			/* Options / FIN */




			return $brick;

		}

	];



?>