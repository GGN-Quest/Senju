<?php 
/*
	
	Copyright GOBOU Yannick

	version : 0.1
	update : 170223.0848

*/


	


	/* URI de base du Menu */
	$uri = isset($uriBase) && is_string($uriBase) ? $uriBase: '';


	/* Page Hote du menu : Page courante */
	$host = isset($host) && is_string($host) ? $host: '';


	/* ID du box du Menu */
	$id = isset($id) && is_string($id) ? $id: 'GgN' . \_GGNCrypt::RKCRandm(\_GGNCrypt::PALETTE_ALPHA . ' ' . \_GGNCrypt::PALETTE_NUMERIC . ' ' . \_GGNCrypt::PALETTE_iALPHA);


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
		
			$gattrib[count($gattrib)] = ' ' . $name . '="' . addslashes($value) . '"'; 
		
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

			$html('<a '. (implode(' ', $_hattrib)) .' href="'.($u).'"  title="'.$title.'" onclick="'.$click.'" ggn-gabarit-item="'.$k.'" id="' . $id . '">');


				$html('<div '. (implode(' ', $_attrib)) .' class="ui-menu-item gui-fx ' . $class . ' ' . $actived . ' " title="'.$title.'">' . $label . '</div>');


			$html('</a>');



	};










	/*
		Box principal
	*/
	
	$html('<div '. (implode(' ', $gattrib)) .' class="ui-menu ' . $flex . ' ux-close" id="' . $id . '">');


		$html('<div class="ui-menu-pad disable ss-enable" id="ui-menu-pad"><div class="gui flex center x48"><div class="iconx text-x20 cursor-pointer" handler-click="Gabarit.Toggle" gabarit-toggle="#'.$id.'" toggle-from="ux-close" toggle-to="ux-open">' . $minIcon . '</div> </div> </div>');


		$html('<div class="ui-menu-outer disable ss-enable" handler-click="Gabarit.Toggle" gabarit-toggle="#'.$id.'" toggle-from="ux-close" toggle-to="ux-open" >&nbsp;</div>');


		$html('<div class="ui-menu-items" >');


			$html('<div class="ui-menu-head gui flex row center">');

				$html('<div class="closer gui iconx text-x32 padding-lr-x8 cursor-pointer" handler-click="Gabarit.Toggle" gabarit-toggle="#'.$id.'" toggle-from="ux-close" toggle-to="ux-open" >close</div> <div class="title col-0 text-x32 padding-x16 text-ellipsis">Menu</div>');

			$html('</div>');


			$html('<div class="ui-menu-body">');


				/* Items / DEBUT */
						
					foreach ($items as $k => $item) {

						$rendering($item, $rendering, $k);

					}

				/* Items / FIN */


			$html('</div>');


		$html('</div>');


	$html('</div>');






?>