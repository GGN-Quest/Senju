<?php 
/*
	
	Copyright GOBOU Yannick

	version : 0.1
	update : 160314.1149

*/


	


	/* Page de traitement des resultats */
	$results = isset($results) && is_string($results) ? $results: '';


	/* Ientifiant de la balise 'Form' */
	$id = isset($id) && is_string($id) ? $id: '';


	/* Ientifiant de la balise 'Form' */
	$fname = isset($fname) && is_string($fname) ? $fname: 'ggnSearchBar';


	/* Methode la balise 'Form' */
	$method = isset($method) && is_string($method) ? $method: 'GET';


	/* Paramètre du champs du moteur de recherche */
	$name = isset($name) && is_string($name) ? $name: 'q';


	/* Le label (placeholder) */
	$label = isset($label) && is_string($label) ? $label: 'Recherche';


	/* La valeur */
	$value = isset($value) && is_string($value) ? $value: '';


	/* Le label (placeholder) */
	$inputs = isset($inputs) && is_array($inputs) ? $inputs: false;


	/* Definir une liste d'options additionnelle */
	$selectOption = isset($selectOption) && is_array($selectOption) ? $selectOption: false;



	
	







	/* Box principal */

	$html('<div class="ggn-search-bar-box col-0 gui flex _h10" >');


		$html('<div class="ss-enable-flex disable gui flex center cursor-pointer padding-lr-x12 x32-h-min" >');

			$html('<div class="gui iconx text-x20" ggn-handler-click="Gabarit.Toggle" gabarit-toggle=".ggn-search-bar" >search</div>');

		$html('</div>');


		$html('<div class="ggn-search-bar gui flex row mi-col-16 li-col-16 s-col-16 col-0 ss-disable sx-disable ">');

			$html('<form action="#" method="' . $method . '" onsubmit="GToast({title : \'Le moteur de recherche est cours de chargement...\', text : \'Si ce message persiste, veuillez actualiser votre page!\', delay:5000}).warning();return false;" class="gui flex column wrap _w10 col-16 pos-relative ggn-search-bar-form" id="' . $id . '" id="' . $fname . '">');

				// $html('<div class="gui flex row wrap _w10 col-16 pos-relative">');


					$html('<div class="ggn-search-bar-input gui field-input gui-fx flex center row col-0 " >');

						$html('<span class="gui icon iconx text-x18 mi-disable">search</span>');


						if(is_array($selectOption)){

							$selectOption['extrapole'] = true;

							$_SelectOption = new \GGN\Plugin\HTML\Model\Brick('Gabarit/Tag.Select', $selectOption);

							$html('<div class="col-4 h-inherit mi-col-16">' . $_SelectOption->html . '</div>');

						}
						

						$html('<input type="search" class="query gui col-0 mi-col-16" placeholder="' . $label . '" value="' . $value . '" name="' . $name . '" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus=".ggn-search-bar,.ggn-search-bar-suggest" autocomplete="off">');

						if(is_array($inputs)){

							foreach ($inputs as $input) {

								if(is_array($input)){

									$input['type'] = isset($input['type']) ? $input['type'] : 'hidden'; 

									$attrib = '';

									foreach ($input as $key => $val) {

									
										$attrib .= $key . '="' . addslashes($val) . '" ';
										
									}

									$html('<input  ' . $attrib . '>');

								}
								
							}

						}

						$html('<span class="f-btn gui icon iconx text-x18 cursor-pointer" onclick="this.parentNode.parentNode.onsubmit();">arrow_forward</span>');

						$html('<span class="h-btn gui icon iconx text-x18 cursor-pointer disable" ggn-handler-click="Gabarit.Toggle" gabarit-toggle=".ggn-search-bar">close</span>');

					$html('</div>');



					$html('<div class="ggn-search-bar-suggest col-16 gui pos-absolute close gui-fx">');

						$html('<center><h1>...</h1></center>');

					$html('</div>');


				// $html('</div>');

			$html('</form>');

		$html('</div>');



	$html('</div>');








	/* 
		CSS // DEBUT -------------------------------------------
	*/

		$css('.ggn-search-bar-suggest'
		
			, [
		
				'background-color'=>$CSSCore->styleProperty('dark-background-color')
		
				,'height'=> '0px'

				,'overflow-x'=> 'hidden'

				,'overflow-y'=> 'hidden'

				,'color'=> $CSSCore->styleProperty('font-color')
		
			]
		
		);
		
		$css('.ggn-search-bar-suggest.focus'
		
			, [
		
				'padding-top && padding-bottom'=>'16px'

				,'overflow-y'=> 'auto'

				// ,'min-height'=> '288px'

				,'height'=> '80vh'

				,'top'=> '100%'
		
			]
		
		);



		$css('.ggn-search-bar'
		
			, [
		
				// 'color'=>$CSSCore->styleProperty('palette-light-color')
		
				'transition'=>'background-color 0.3s ease-in'
		
			]
		
		);




		$css('.ggn-search-bar .gui.gabarit.tag-select'
		
			, [

				// 'color'=>$CSSCore->styleProperty('palette-light-color')
				
				'background-color && border-color'=>'transparent'

				,'font-size'=>'14px'

				,'padding-top'=>'10px'
		
			]
		
		);

		$css('.ggn-search-bar .gui.gabarit.tag-select > .options'
		
			, [
		
				'margin-top'=>'14px'
		
			]
		
		);




		$css('.ggn-search-bar .field-input > .icon'

			, [

				'padding-left && padding-right'=>'20px'

			]

		);


		$css('.ggn-search-bar .field-input > input'

			, [

				'padding-left'=>'4px '

				, 'padding-top'=>'4px '

				// ,'color'=>$CSSCore->styleProperty('palette-light-color')

				,'font-size'=>'14px'

			]

		);


		// $css('.ggn-search-bar .field-input > input:focus'

		// 	, [

		// 		'background-color'=>'rgba(0,0,0,.2)'

		// 	]

		// );


		$css('#ggn-search-bar .field-input > .f-btn'

			, [

				'padding-right && padding-left'=>'10px'

				,'display'=>'none'

			]

		);


		$css('#ggn-search-bar .field-input > .h-btn'
	
			, [
	
				'padding-right'=>'15px'
	
				,'padding-left'=>'10px'
	
			]
	
		);


		$css('.ggn-search-bar.focus .field-input'
	
			, [
	
				'background-color'=> $CSSCore->styleProperty('dark-background-color')
	
			]
	
		);



		$css('#ggn-search-bar.focus .field-input > .f-btn'

			, [

				'display'=>'block'

			]

		);



		/* Responsivité / DEBUT */



			$css(':::code:ScreenSBegin', $CSSCore->openMedia(' (min-width: '.$CSSCore::SCREEN_Mi_MAX.') ', true) );

				$css('.ggn-search-bar.open'

					, [

						'position'=>'absolute'

						,'display'=>'flex !important'

						,'top && left'=>'0px'

						,'z-index'=>'100'

						,'width'=>'100vw'

						,'height'=>'100%'

						// ,'margin'=>'0'

						// ,'border-radius'=>'4px'

						,'background-color'=>'' . $CSSCore->LDColor($CSSCore->styleProperty('palette-primary-color'), -20) . ''

						,'color'=>$CSSCore->styleProperty('palette-light-color')

					]

				);


				$css('.ggn-search-bar.open.focus'

					, [

						'background-color'=>'' . $CSSCore->LDColor($CSSCore->styleProperty('palette-primary-color'), -40) . ''

						,'color'=>$CSSCore->styleProperty('font-color')

						// 'background-color'=>'rgba(' . $CSSCore->styleProperty('palette-light-color-rgb') . ',.85)'

					]

				);


				$css('.ggn-search-bar.open .field-input > .h-btn'

					, [

						'display'=>'block !important'

					] 

				);


				$css('.ggn-search-bar.open .field-input input'
			
					, [
			
						'color'=>$CSSCore->styleProperty('palette-light-color')
			
					]
			
				);


				$css('.ggn-search-bar.open.focus .field-input input'
			
					, [
			
						'color'=>$CSSCore->styleProperty('font-color')
			
					]
			
				);


			$css(':::code:ScreenSEnd', $CSSCore->closeMedia(true) );






			$css(':::code:ScreenMiBegin', $CSSCore->openMedia(' (max-width: '.$CSSCore::SCREEN_Mi_MAX.') ', true) );

				$css('.ggn-search-bar.open .field-input'

					, [

						'flex-wrap'=>'wrap'

					]

				);

				$css('.ggn-search-bar .field-input'

					, [

						'padding-bottom'=>'16px'

					]

				);


			$css(':::code:ScreenMiEnd', $CSSCore->closeMedia(true) );

		/* Responsivité / DEBUT */




	/* 
		CSS // FIN -------------------------------------------
	*/






?>