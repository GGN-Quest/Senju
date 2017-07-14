/* Fichier : Gougnon.CSS.Gabarit.Nav.Tab.cssg, Nom : Gougnon CSS Gabarit.Nav.Tab, version 0.0.1.150303.1434, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');





/* 
	// DEBUT ======================================
*/


	/* Title / DEBUT */

		$Core->selector('.gui.gabarit.nav-tab'
			
			, [
			
				'min-width' => '128px'

				// , 'border' => '1px solid rgba(' . $Core->styleProperty('font-color-rgb') . ',.1)'

				, 'min-height' => '128px'
			
			]

		);

		$Core->selector('.gui.gabarit.nav-tab .items-title'
			
			, [
			
				'width' => '100%'
			
			]

		);

		$Core->selector('.gui.gabarit.nav-tab .items-title'
			
			, [
			
				'overflow-x && overflow-y' => 'hidden'
			
			]

		);

		$Core->selector('.gui.gabarit.nav-tab .items-title > .item'
			
			, [
			
				'padding' => '12px 16px'

				, 'cursor' => 'pointer'

				// , 'color' => 'rgba(' . $Core->styleProperty('palette-light-color-rgb') . ',.48)'

				// , 'border-bottom' => '3px solid transparent'
			
			]

		);

		$Core->selector('.gui.gabarit.nav-tab .items-title > .item.actived'
			
			, [
			
				'background-color' => 'rgba(' . $Core->styleProperty('palette-primary-color-rgb') . ',.64)'

				, 'color' => '' . $Core->styleProperty('palette-light-color') . ''

				// , 'border-bottom-color' => '' . $Core->styleProperty('palette-primary-color') . ''
			
			]

		);


	/* Title / FIN */


	/* Conteneur / DEBUT */

		$Core->selector('.gui.gabarit.nav-tab .items-container'
			
			, [
			
				'background-color' => 'rgba(' . $Core->styleProperty('background-color-rgb:hover') . ',.48)'

				, 'position' => 'relative'

				, 'width' => '100%'

				, 'border-top' => '3px solid ' . 'rgba(' . $Core->styleProperty('palette-primary-color-rgb') . ',.64)' . ''
			
			]

		);

		$Core->selector('.gui.gabarit.nav-tab .items-container > .item'
			
			, [
			
				'overflow-x' => 'auto'

				, 'position' => 'absolute'

				, 'z-index' => '0'

				, 'overflow-y' => 'hidden'

				, 'padding' => '12px 16px'

				, 'opacity' => '0'
			
			]

		);

		$Core->selector('.gui.gabarit.nav-tab .items-container > .item.actived'
			
			, [
			
				'opacity' => '1'

				,'flex' => '1'

				, 'z-index' => '2'
			
			]

		);

	/* Conteneur / FIN */


/* 
	// FIN ======================================
*/

