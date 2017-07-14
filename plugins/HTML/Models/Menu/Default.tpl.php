<?php 
/*
	
	Copyright GOBOU Yannick

	version : 0.1
	update : 160314.1149

*/


	


	/* URI de base du Menu */
	$uri = isset($uriBase) && is_string($uriBase) ? $uriBase: '';


	/* Page Hote du menu : Page courante */
	$host = isset($host) && is_string($host) ? $host: '';


	/* ID du box du Menu */
	$id = isset($id) && is_string($id) ? $id: \_GGNCrypt::RKCRandm(\_GGNCrypt::PALETTE_ALPHA . ' ' . \_GGNCrypt::PALETTE_NUMERIC . ' ' . \_GGNCrypt::PALETTE_iALPHA);


	/* Classe du box du Menu */
	$class = isset($class) && is_string($class) ? $class: '';


	/* Responsive : Minimiser Icon */
	$minIcon = isset($minIcon) && is_string($minIcon) ? $minIcon: 'menu';


	/* Responsive : Icon de Retour */
	$minBack = isset($minBack) && is_string($minBack) ? $minBack: 'arrow_back';


	/* Flexibilité du Menu */
	$flex = isset($flex) && is_string($flex) ? $flex: 'row';
	

	/* List des Attributes */
	$gattrib = [];

	$gattri = isset($attributes) && is_array($attributes) ? $attributes: [];


	/* List des Items */
	$items = isset($items) && is_array($items) ? $items: [];


	/* List des Sous menu */
	$subItems = isset($subItems) && is_array($subItems) ? $subItems: false;


	/* Balise HTML Cible */
	$target = isset($target) && is_array($target) ? $target: false;



	
	


	/*
		Attributs du box principal
	*/

	if($gattri){
		
		foreach ($gattri as $name => $value) {
		
			$nname=strtolower($name); 
		
			if($nname=='id'||$nname=='class'){continue;return false;} 
		
			$gattrib[count($gattrib)] = ' ' . $name . '="'.addslashes($value).'"'; 
		
		}

	}




	/*
		Fonctionnalités
	*/

	/* Vers une liste d'attributs */
	$toAttrib = function($attrib = false){

		if(!is_array($attrib)){return [];}

		else{

			$_attrib = [];

			foreach ($attrib as $n => $value) {

				if(is_string($value)){
				
					$nn=strtolower($n); 
			
					if($nn=='id'||$nn=='class'||$nn=='title'){continue;return false;} 
			
					$_attrib[count($_attrib)] = ' ' . $n . '="'.addslashes($value).'"';
		
				}

			}

			return $_attrib;

		}
	
	};



	/* Rendu d'un item */
	$rendering = function($item, $r, $k) use ($html, $js, $uri, $host, $subItems, $toAttrib, $target){

		if(!is_array($item)){continue;}

			extract($item);


		/* Données de l'item */
		
		
		$hattrib = isset($hattrib) && is_array($hattrib) ? $hattrib : [];

		$attrib = isset($attrib) && is_array($attrib) ? $attrib : [];
		
		$link = isset($link) && is_string($link) ? \_GGN::setvar($link) : 'javascript://void(0);';
		
		$title = isset($title) && is_string($title) ? $title : '';

		$label = isset($label) && is_string($label) ? $label : '';

		$click = isset($click) && is_string($click) ? $click : '';
		
		$id = isset($id) && is_string($id) ? $id : '';
		// $id = isset($id) && is_string($id) ? $id : \_GGNCrypt::RKCRandm(\_GGNCrypt::PALETTE_ALPHA . ' ' . \_GGNCrypt::PALETTE_iALPHA . ' ' . \_GGNCrypt::PALETTE_NUMERIC);
		
		$flex = isset($flex) && is_string($flex) ? $flex : 'column center';
		
		$class = isset($class) && is_string($class) ? $class : '';

		$p = preg_match(\_GGN::PATTERN_URL, $link);
		
		$u = (($p==true) ? '': $uri) . $link;


		$actived = (basename($host)==basename($link)) ? 'active ggn-gabarit-item-acived':'';


		/* Attributs */
		$hattrib = (isset($hattrib['target']) ? $hattrib['target'] : false);

		$_hattrib = $toAttrib($hattrib);

		$_attrib = $toAttrib($attrib);
		


		/* Sous menu exist */
		$hasNotSI = is_array($subItems);


		/* 
			Item : Code HTML
		*/
		if(!$hasNotSI){

			$html('<a '. (implode(' ', $_hattrib)) .' href="'.($u).'" class="item gui pos-relative flex '.$flex.' '.$actived.' '.$class.'" title="'.$title.'" onclick="'.$click.'" ggn-gabarit-item="'.$k.'" id="' . $id . '">');

		}

		if($hasNotSI){

			$html('<div class="item gui flex with-sub-item '.$actived.' cursor-default '.$class.'" title="'.$title.'" onclick="'.$click.'" ggn-gabarit-item="'.$k.'" id="' . $id . '">');

		}





			$html('<div '. (implode(' ', $_attrib)) .' class="label isolation '.$class.'" title="'.$title.'">');

				$html( ($label) );

			$html('</div>');



			if($hasNotSI){

				$html('<div class="sub-item">');

					foreach ($subItems as $sk => $subItem) {
					
						$html($r($subItem, $r));

					}

				$html('</div>');

			}




		if($hasNotSI){

			
			$html('</div>');

		}


		if(!$hasNotSI){
			
				$html('<div class="item-decoration"></div>');

			$html('</a>');

		}


	};










	/*
		Box principal
	*/
		
	$html('<div class="gui gabarit menu-minimizing flex center cursor-pointer disable mi-enable-flex li-enable-flex s-enable-flex" id="'.$id.'-minimizer" handler-click="Gabarit.Toggle" gabarit-toggle="#'.$id.'"> <span class="gui iconx min-action" handler-click="Gabarit.Toggle" gabarit-toggle="#'.$id.'" >'.$minIcon.'</span> </div>');

	$html('<div '. (implode(' ', $gattrib)) .' class="gui layout gabarit menu mi-disable li-disable s-disable gui-fx '.$class.'" id="'.$id.'">');

		$html('<div class="gui gabarit menu-minimize-back flex left cursor-pointer disable mi-enable-flex li-enable-flex s-enable-flex" id="'.$id.'-minimizer-back"> <span class="gui iconx min-action" handler-click="Gabarit.Toggle" gabarit-toggle="#'.$id.'" >'.$minBack.'</span> </div>');

		$html('<div class="gui flex '.$flex.' items" >');


			/*
				Items
			*/
				
			foreach ($items as $k => $item) {

				$rendering($item, $rendering, $k);

			}




		$html('</div>');
		

	$html('</div>');







?>