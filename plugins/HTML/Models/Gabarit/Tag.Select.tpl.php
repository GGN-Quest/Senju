<?php 
/*
	
	Copyright GOBOU Yannick

	version : 0.1
	update : 160314.1149

*/


	


	/* Le 'Name' du champs */
	$name = isset($name) && is_string($name) ? $name: '';


	/* La 'Valeur' du champs */
	$value = isset($defaultValue) && is_string($defaultValue) ? $defaultValue: '';


	/* La 'Valeur' du champs */
	$label = isset($label) && is_string($label) ? $label: '';


	/* Les options */
	$options = isset($options) && is_array($options) ? $options: [];


	/* Extrapolation du box principal */
	$extrapole = (isset($extrapole) && ($extrapole == true)) ? '' : 'pos-relative enable-inline-block';


	/* Class CSS */
	$classname = (isset($classname) && is_string($classname)) ? $classname : '';



	
	







	/* Box principal */

	$html('<div class="gui gabarit tag-select cursor-default ' . $classname . ' ' . $extrapole . '" >');

		$html('<input tag-select type="hidden" name="' . $name . '" value="' . $value . '" >');

		$html('<div tabindex="0" class="label gui flex row center" ggn-handler-focus="Gabarit.Tag.Select" >');

			$html('<div class="text col-0 text-ellipsis">' . $label . '</div>');

			$html('<div class="indexer gui iconx text-x24 align-right">keyboard_arrow_down</div>');

		$html('</div>');

		$html('<div class="options gui-fx gui pos-absolute">');

			foreach ($options as $option) {

				$type = (isset($option['type']) && is_string($option['type'])) ? strtolower($option['type']) : false;

				$val = (isset($option['value']) && is_string($option['value'])) ? ($option['value']) : '';

				$lab = (isset($option['label']) && is_string($option['label'])) ? ($option['label']) : '';


				$cn = 'option';

				if($type == 'title'){

					$cn = 'option-group-title';

				}


				$html('<div class="' . $cn . '" data-value="' . $val . '">' . $lab . '</div>');
				
			}

			// $html('<div class="">Choisissez une option</div>')

			// $html('<div class="option" data-value="1">Option 1</div>')

			// $html('<div class="option" data-value="2">Option 2</div>')

			// $html('<div class="option" data-value="3">Option 3</div>')

			// $html('<div class="option" data-value="4">Option 4</div>')

			// $html('<div class="option" data-value="5">Option 5</div>')


		$html('</div>');


	$html('</div>');






	/* 
		CSS // DEBUT -------------------------------------------
	*/

		// $css(''
		
		// 	, [
		
		// 		''=> $CSSCore->styleProperty('palette-light-color')
		
		// 	]
		
		// );

	/* 
		CSS // FIN -------------------------------------------
	*/






?>