<?php 
	


	/* ID du box du slider */
	$uri = isset($URIBase) && is_string($URIBase) ? $URIBase: '';


	/* ID du box du slider */
	$id = isset($id) && is_string($id) ? $id: 'ggn-slidershow-' . \_GGNCrypt::RKCRandm(_GGNCrypt::PALETTE_NUMERIC, 32);
	

	/* List des Images */
	$images = isset($images) && is_array($images) ? $images: [];
	

	/* Nombre des Images du diaporama */
	$row = is_array($images) ? count($images): 0;


	/* Dimension des ITEMS identiquent à la taille du SliderShow */
	// $inheritSize = (isset($inheritSize) && is_bool($inheritSize)) ? $inheritSize: 'true';


	/* Lecture automatique du diaporama */
	$autoplay = isset($autoplay) && is_bool($autoplay) && $autoplay===true ? 'true': 'false';


	/* Lecture automatique du diaporama */
	$loop = isset($loop) && is_bool($loop) && $loop===true ? 'true': 'false';


	/* Lecture automatique du diaporama */
	$timer = isset($timer) && is_numeric($timer) ? $timer: 'false';
	


	/* Cacher le 'Progress.Bar' */
	$hideProgressBar = isset($hideProgressBar) && is_bool($hideProgressBar) && $hideProgressBar===true ? 'true': 'false';
	


	/* Ne pas utiliser l'animation de transition par defaut */
	$notUseDefaultTransition = isset($notUseDefaultTransition) && is_bool($notUseDefaultTransition) && $notUseDefaultTransition===true ? 'true': 'false';
	







	$html('<div class="ggn-slidershow disable-scrollbar" id="'.$id.'">');

		$html('<div class="content disable-scrollbar">');

			
			if($row<=0){ 
	
				$html('<div class="notice ">');

					$html('<div class="message gui flex full center column">');

						$html('<span class="gui iconx">close</span><br>Aucune image');

					$html('</div>');

				$html('</div>');
			
			}


			if($row>0){ 

				$html('<div class="panel gui flex column align-left _h10">');

					foreach ($images as $key => $image) {

						$isImg = is_string($image);


						if($isImg){

							$p = preg_match(\_GGN::PATTERN_URL, $image);

							$u = ($p==true) ? '': $uri;

							$src = $u . $image;

					 		$html('<div style="background-image:url(' . (is_string($src)?$src:'') . ');" class="item background-abs-center" ggn-data-src="' . (is_string($src)?$src:'') . '"></div>');

						}

						if(!$isImg){

							if(is_array($image)){

								$t = isset($image['title']) ? $image['title']: false;
								
								$a = isset($image['about']) ? $image['about']: false;
								
								$src = isset($image['source']) ? $image['source']: false;

								$c = isset($image['content']) ? $image['content']: false;
								
								$attrib = isset($image['attributes']) ? $image['attributes']: [];


								$p = (is_string($src)) ? preg_match(\_GGN::PATTERN_URL, $src) : true;

								$u = ($p==true) ? '': $uri;



								$att = [];
								
								$sty = [];
								
								$clas = [];


								foreach ($attrib as $prop => $value) {

									$svalue = @strtolower($value);


									
									/* Propriété Autorisé : Debut */
										if(is_string($value) && $svalue!='style' && $svalue!='class'){

											$att[count($att)] = ' ' . $prop . '="' . addslashes($value) . '"';

										}

									/* Propriété Autorisé : Fin */


									/* Autres Propriétés : Debut */

										else{

											/* Style : Debut */
											if($svalue=='style'){

												if(is_array($value)){

													$sty[count($sty)] = \GougnonCSS::selector(false, $value, '-Value.Only');
													
												}

												if(is_string($value)){

													$sty[count($sty)] = $value; 
 
												}
												
											}
											/* Style : Fin */


											/* Class : Debut */
											if($svalue=='class'){

												if(is_string($value)){

													$clas[count($clas)] = $value;

												}
												
											}
											/* Class : Fin */


										}

									/* Autres Propriétés : Fin */


								}


								$source = (is_string($src)) ? 'background-image:url(' . $u . $src . ');': '';

								$activeC = is_string($c);


								$html('<div ' . implode(' ', $att) . ' style="' . implode(' ', $sty) . ' ' . $source . '" class="' . implode(' ', $clas)
									 . ' item background-abs-center" ggn-data-src="'
									 . (is_string($src)?$u.$src:'')
									 . '">')
								;

									if(!$activeC){

										$html('<div class="info">');

											/* titre */
											if(is_string($t)){$html('<div class="title">' . $t . '</div>'); }

											/* Description */
											if(is_string($a)){$html('<div class="about">' . $a . '</div>'); }

										$html('</div>');

									}

									if($activeC){

										$html($c);

									}

								$html('</div>');



							}

						}

					}

				$html('</div>');

			} 


			$html('<div class="browser left cursor-pointer"><div class="gui iconx static-light max-size flex full center">navigate_before</div></div>');
			
			$html('<div class="browser right cursor-pointer"><div class="gui iconx static-light max-size flex full center">navigate_next</div></div>');
			
			$html('<div class="progress"><div class="track"></div></div>');
			
			$html('<div class="status gui iconx static-light text-x24 ">pause</div>');



		$html('</div>');

	$html('</div>');





	$js('(function(W,D){');
 	
 		$js('var sld=G("#'.$id.'");');




 		$js('if(isObject(sld)){');

 			$js('var slider=G.SliderShow(sld).Init({');

				$js('panel:G("#'.$id.' > .content > .panel")');

				$js(',items:G("#'.$id.' > .content > .panel > .item")');

				$js(',progress:G("#'.$id.' > .content > .progress > .track")');

				$js(',lstatus:G("#'.$id.' > .content > .status")');

 				$js(',browser:{');

 					$js('next:G("#'.$id.' > .content > .browser.right")');

 					$js(',previous:G("#'.$id.' > .content > .browser.left")');

 				$js('}');

 				$js(',timer:' . $timer);

 				// $js(',inheritSize:' . $inheritSize);

 				$js(',loop:' . $loop);

 				$js(',autoplay:' . $autoplay);

 				$js(',hideProgressBar:' . $hideProgressBar);

 				$js(',notUseDefaultTransition:' . $notUseDefaultTransition);

 			$js('});');

 		$js('}');

	$js('})(window, document);');





?>