/* Fichier : Gougnon.CSS.Styler.cssg, Nom : Gougnon CSS Styler, version 0.0.1.150303.1434, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');





/* 
	De Base / DEBUT /////////////////////////////////////////////
*/

$Core->selector('body'
	
	, [
	
		'background-color'=> $Core->styleProperty('background-color:hover')
	
	]

);

$Core->selector('a:focus'
	
	, [
	
		// 'outline'=> '0px solid rgba(' . $Core->styleProperty('palette-tertiary-color-rgb') . ',.55)'
	
	]

);

/* 
	De Base / FIN /////////////////////////////////////////////
*/





/* 
	Bouton Checker / DEBUT //////////////////////////////////////
*/

$Core->selector('.ui-button-checker'

	, [

		// 'color'=> $Core->styleProperty('palette-dark-color')

	]

);

$Core->selector('.ui-button-checker[checked]'

	, [

		'color'=> $Core->styleProperty('palette-light-color') . ' !important'

		, 'background-color'=> $Core->styleProperty('palette-primary-color') . ' !important'

	]

);

/* 
	Bouton Checker / FIN //////////////////////////////////////
*/





/* 
	Paragraphe / DEBUT //////////////////////////////////////
*/

$Core->selector('p'

	, [

		'padding'=> '10px 15px'

	]

);

/* 
	Paragraphe / FIN //////////////////////////////////////
*/









/* 
	Barre de Navigation / DEBUT //////////////////////////////////////////
*/

$Core->selector(

		'.ui-navbar'

		. ',.ui-header-onlybar'

	, [

		'z-index'=> '100'

		, 'top && left'=> '0px'

		// , 'color'=> ( $Core->GetColorIntensity( $Core->styleProperty('palette-primary-color') )->is == false ) 

		// 	? $Core->styleProperty('palette-light-color') 

		// 	: $Core->styleProperty('palette-dark-color')

		// , 'background-color'=> $Core->styleProperty('palette-primary-color')

		, 'background-color'=> $Core->LDColor($Core->styleProperty('palette-primary-color'), -20)

		, 'color'=> $Core->styleProperty('palette-light-color')

	]

);



/* NavBar / DEBUT */

	$Core->selector('.ui-navbar'

		, [

			'box-shadow'=> 'none'

		]

	);

/* NavBar / FIN */



/* NavBar : Ligne / DEBUT */

	$Core->selector('.ui-navbar.row'

		, [

			'flex-direction'=> 'row'

			, 'min-height'=> '48px'

		]

	);

	$Core->selector(

			'.ui-navbar.row'

			. ',.ui-navbar.row .ui-navbar-loader'

			. ',.ui-navbar.row .ui-navbar-content'

			. ',.ui-navbar.row .ui-navbar-overlay'

			. ',.ui-navbar.row .ui-menu'

			. ',.ui-navbar.row .ui-menu .ui-menu-items'

		, [

			'flex-direction'=> 'row'

		]

	);


	$Core->selector(

			'.ui-navbar.row'

			. ',.ui-navbar.row .ui-navbar-loader'

			. ',.ui-navbar.row .ui-navbar-content'

			. ',.ui-navbar.row .ui-navbar-overlay'

		, [

			'width'=> '100vw'

		]

	);


	$Core->selector(

			'.ui-navbar.row .ui-navbar-loader'

			. ',.ui-navbar.row .ui-navbar-content'

			. ',.ui-navbar.row .ui-navbar-overlay'

		, [

			'height'=> '100%'

		]

	);

/* NavBar : Ligne / DEBUT */







/* NavBar : Colonne / DEBUT */


	$Core->selector('.ui-navbar.column'

		, [

			'flex-direction'=> 'column'

			, 'width'=> '48px'

		]

	);

	$Core->selector(

			'.ui-navbar.column'

			. ',.ui-navbar.column .ui-navbar-loader'

			. ',.ui-navbar.column .ui-navbar-content'

			. ',.ui-navbar.column .ui-navbar-overlay'

			. ',.ui-navbar.column .ui-menu'

			. ',.ui-navbar.column .ui-menu .ui-menu-items'

			. ',.ui-menu.column'

			. ',.ui-menu.column .ui-menu-items'

		, [

			'flex-direction'=> 'column'

		]

	);

	$Core->selector(

			'.ui-navbar.column'

			. ',.ui-navbar.column .ui-navbar-loader'

			. ',.ui-navbar.column .ui-navbar-content'

			. ',.ui-navbar.column .ui-navbar-overlay'

		, [

			'height'=> '100vh'

		]

	);

	$Core->selector(

			'.ui-navbar.column .ui-navbar-loader'

			. ',.ui-navbar.column .ui-navbar-content'

			. ',.ui-navbar.column .ui-navbar-overlay'

		, [

			'width'=> '100%'

		]

	);


/* NavBar : Colonne / FIN */






/* NavBar : Bi Directionnel / DEBUT */

	$Core->selector(

			'.ui-navbar-loader'

			. ',.ui-navbar-content'

			. ',.ui-navbar-overlay'

		, [

			'top && left'=> '0px'

			, 'position'=> 'absolute'

			, 'display'=> ['-webkit-flex', 'flex']


		]

	);


	$Core->selector('.ui-navbar-loader'

		, [

			'z-index'=> '1'

		]

	);


	$Core->selector('.ui-navbar-loader .navbar-loader-track'

		, [

			'background-color'=> $Core::LDColor($Core->styleProperty('palette-primary-color'), 70)

		]

	);


	$Core->selector(

			'.ui-navbar .ui-navbar-loader .navbar-loader-track.full'

			. ',.ui-navbar.row .ui-navbar-loader .navbar-loader-track.full'

		, [

			'width'=> '100vw'

		]

	);


	$Core->selector('.ui-navbar.column .ui-navbar-loader .navbar-loader-track.full'

		, [

			'height'=> '100vh'

		]

	);




	/* Contenu / DEBUT */

		$Core->selector('.ui-navbar .ui-navbar-content'

			, [

				'z-index'=> '2'

			]

		);

	/* Contenu / FIN */




	/* Over / DEBUT */

		$Core->selector('.ui-navbar .ui-navbar-overlay'

			, [

				'z-index'=> '3'

				, 'transform'=> 'translateY(0%)'

				, 'opacity'=> '1'

				, 'background-color'=> 'transparent'

				, 'align-items'=>'center'

				, 'justify-content'=>'center'

				// , 'color'=> ( $Core->GetColorIntensity( $Core->styleProperty('palette-primary-color') )->is == false ) 

				// 	? $Core->styleProperty('palette-light-color') 

				// 	: $Core->styleProperty('palette-dark-color')

				// , 'background-color'=> $Core->styleProperty('palette-primary-color')

				, 'background-color'=> $Core->styleProperty('background-color')

			]

		);

		$Core->selector(

				'.ui-navbar:hover .ui-navbar-overlay'

				. ',body.ux-on-mobile .ui-navbar .ui-navbar-overlay'

			, [

				'transform'=> 'translateY(-100%)'

				, 'opacity'=> '0.001'

			]

		);

	/* Over / FIN */





	$Core->selector('.ui-navbar-content .ui-navbar-logo'

		, [

			'min-width && min-height'=> '48px'

			, 'padding-left && padding-right'=> '16px'

			// , 'background-color'=> $Core->styleProperty('palette-primary-color')

		]

	);




/* NavBar : Bi Directionnel / FIN */




/* Menu :  / DEBUT */

	$Core->selector(

			'.ui-menu'

			. ',.ui-menu .ui-menu-items'

		, [

			'display'=> ['-webkit-flex', 'flex']

		]

	);

	$Core->selector(

			'.ui-menu .ui-menu-items a'

		, [

			'text-decoration'=> 'none'

			, 'color'=> 'inherit'

		]

	);

	$Core->selector(

			'.ui-menu .ui-menu-items .ui-menu-item'

		, [

			'font-size'=> '15px'

			, 'padding'=> '13.5px 16px'

			// , 'color'=> $Core->styleProperty('font-color')

			, 'color'=> 'inherit'

		]

	);

	$Core->selector(

			'.ui-menu .ui-menu-items .ui-menu-item .text-label'

		, [

			'padding-left && padding-right'=> '8px'

			, 'color'=> 'inherit'

		]

	);

	$Core->selector(

			'.ui-menu .ui-menu-items .ui-menu-item.active'

			. ',.ui-menu .ui-menu-items .ui-menu-item:hover'

		, [

			'color'=> $Core->styleProperty('palette-light-color')

			// 'color'=> ( $Core->GetColorIntensity( $Core->styleProperty('palette-primary-color') )->is == false ) 

			// 	? $Core->styleProperty('palette-light-color') 

			// 	: $Core->styleProperty('palette-dark-color')

			, 'background-color'=> $Core->styleProperty('palette-primary-color')

		]

	);



	$Core->selector('.ui-menu .ui-menu-head', ['display'=> 'none'] );

	$Core->selector('.ui-menu .ui-menu-body'

		, [

			'display'=> ['-webkit-flex', 'flex']

			, 'flex-direction'=> 'inherit'

			// , 'flex-wrap'=> 'wrap'

			, 'flex'=> '1'

		]

	);






	$Core->openMedia('(max-width: ' . $Core::SCREEN_M_MIN . ')');

		$Core->selector('.ui-navbar-overlay'

			, [

				'display'=> 'none'

			]

		);

		$Core->selector('.ui-menu .ui-menu-outer'

			, [

				'position'=> 'fixed'

				, 'top && left'=> '0px'

				, 'width'=> '0vw'

				, 'height'=> '0vh'

				, 'z-index'=> '0'

				, 'background-color'=> 'rgba(' . $Core->styleProperty('dark-background-color-rgb') . ', .75)'


			]

		);

		$Core->selector('.ui-menu.ux-open .ui-menu-outer'

			, [

				'width'=> '100vw'

				, 'height'=> '100vh'

				// , 'background-color'=> 'rgba(' . $Core->styleProperty('dark-background-color-rgb') . ', .75)'


			]

		);

		$Core->selector('.ui-menu .ui-menu-items'

			, [

				'position'=> 'fixed'

				, 'z-index'=> '5'

				, 'flex-wrap'=> 'wrap'

				, 'flex-direction'=> 'column !important'

				, 'z-index'=> '100'

				, 'top && left'=> '0px'

				, 'width'=> '256px'

				, 'height'=> '100vh'

				, 'background-color'=> (

					( $Core::GetColorIntensity($Core->styleProperty('dark-background-color')) ) 

					? $Core::LDColor($Core->styleProperty('dark-background-color'), -70) 

					: $Core->styleProperty('dark-background-color') 

				)


			]

		);

		$Core->selector('.ui-menu .ui-menu-body'

			, [

				'overflow-x'=> 'hidden'

				, 'flex-direction'=> 'inherit !important'

				, 'width'=> '256px'

				// , 'flex-wrap'=> 'no-wrap'

				, 'overflow-y'=> 'auto'

			]

		);

		$Core->selector('.ui-menu.ux-open .ui-menu-items'

			, [

				'transform'=> 'translateX(0px)'

				, 'animation'=> 'UIMenuOnMobileIn 150ms ease'

			]

		);

		$Core->selector('.ui-menu.ux-close .ui-menu-items'

			, [

				'transform'=> 'translateX(-256vw)'

				, 'animation'=> 'UIMenuOnMobileOut 150ms ease'

			]

		);



		$Core->selector('.ui-menu.ux-open .ui-menu-items .ui-menu-item'

			, [

				'color'=> $Core->styleProperty('palette-light-color')

				, 'border-bottom'=> '1px dashed rgba(' . $Core->styleProperty('palette-light-color-rgb') . ',.1)'

			]

		);


		$Core->selector('.ui-menu .ui-menu-head'

			, [

				'color'=> $Core->styleProperty('palette-light-color')

				, 'display'=> 'flex'

				, 'border-bottom'=> '1px dashed rgba(' . $Core->styleProperty('palette-light-color-rgb') . ',.1)'

			]

		);


	$Core->closeMedia();


	$Core->keyframes('UIMenuOnMobileIn', '{0%{' . $Core::browserKey('transform', 'translateX(-256px)') . '} 100%{' . $Core::browserKey('transform', 'translateX(0px)') . '} }', true);

	$Core->keyframes('UIMenuOnMobileOut', '{0%{' . $Core::browserKey('transform', 'translateX(0px)') . '} 100%{' . $Core::browserKey('transform', 'translateX(-256px)') . '} }', true);

/* Menu :  / FIN */






/* Bouton de Porté : ScopeButton / DEBUT */

	$Core->selector('.ui-navbar .ui-navbar-scope-button'

		, [

			'color'=> ( $Core->GetColorIntensity( $Core->styleProperty('palette-secondary-color') )->is == false ) 

				? $Core->styleProperty('palette-light-color') 

				: $Core->styleProperty('palette-dark-color')

			, 'background-color'=> $Core->styleProperty('palette-secondary-color')

		]

	);


/* Bouton de Porté : ScopeButton / FIN */





/* 
	Barre de Navigation / FIN //////////////////////////////////////////
*/











/* 
	OnlyBar / DEBUT //////////////////////////////////////////
*/

	$Core->selector('.ui-header-onlybar:not(.disable)'

		, [

			'width'=> '100vw'

			// , 'z-index'=> '105'

			, 'height'=> '64px'

		]

	);

	$Core->selector('.ui-header-onlybar + .ui-navbar:not(.disable)'

		, [

			'top'=> '64px'

		]

	);

	$Core->selector('.ui-header-modules'

		, [

			'background-color'=> ( $Core->GetColorIntensity( $Core->styleProperty('palette-primary-color') )->is == true ) 

				? 'rgba(255,255,255,.1)' : 'rgba(0,0,0,.1)'

			, 'margin-top && margin-bottom'=> '7px'

		]

	);

	$Core->selector(

			'.ui-header-modules'

			. ',.ui-header-modules > *'

		, [

			'border-radius'=> '5px'

		]

	);

	$Core->selector(

			'.ui-header-modules-container'

			. ',.ui-header-modules-progress-bar'

			. ',.ui-header-modules-container > *'

			. ',.ui-header-modules-progress-bar > *'

		, [

			'border-radius'=> 'inherit'

		]

	);

		$Core->selector(

				'.ui-header-modules-container'

				. ',.ui-header-modules-progress-bar'

			, [

				'top && left'=> '0px'

				, 'width && height'=> '100%'

			]

		);

		$Core->selector('.ui-header-modules-container'

			, [

				// 'background-color'=> 'red'

			]

		);

		$Core->selector('.ui-header-modules-progress-bar'

			, [

				// 'background-color'=> 'yellow'

			]

		);



	$Core->selector('.ui-header-tools'

		, [

			// 'background-color'=> 'rgba(255,255,255,.5)'

		]

	);


/* 
	OnlyBar / FIN //////////////////////////////////////////
*/













/* 
	Conteneur de la page / DEBUT //////////////////////////////////////////
*/

	$Core->selector(

			'body .ui-navbar.pos-fixed:not(.disable) + .ui-container'

			. ',body .ui-navbar.pos-fix:not(.disable) + .ui-container'

		, [

			'padding-top'=> '48px'

		]

	);


	$Core->selector(

			'body .ui-header-onlybar + .ui-navbar.pos-fixed:not(.disable) + .ui-container'

			. ',body .ui-header-onlybar + .ui-navbar.pos-fix:not(.disable) + .ui-container'

		, [

			'padding-top'=> '112px'

		]

	);


	/* Axe traditionnel des page : Y */
		
		$Core->selector('body:not(.ux-page-axe-x) .ui-container'

			, [

				'width'=> '100vw'

			]

		);



	/* Axe du style metro : X */

		$Core->selector('body.ux-page-axe-x .ui-container'

			, [

				'height'=> '100vh'

			]

		);


/* 
	Conteneur de la page / FIN //////////////////////////////////////////
*/











/* 
	Barre de Progression / DEBUT //////////////////////////////////////////
*/


	$Core->selector('.ui-progress-bar'

		, [

			'min-width'=> '64px'

			, 'min-height'=> '1px'

			, 'height'=> '3px'

			, 'background-color'=> $Core->styleProperty('dark-background-color')

		]

	);

	$Core->selector('.ui-progress-bar .ui-progress-track'

		, [

			'width'=> '0%'

			, 'height'=> '100%'

			, 'background-color'=> $Core->styleProperty('palette-primary-color')

		]

	);


/* 
	Barre de Progression / FIN //////////////////////////////////////////
*/







/* 
	Barre d'attente / DEBUT //////////////////////////////////////////
*/


	$Core->selector('.ui-wait-bar'

		, [

			'min-width'=> '64px'

			, 'min-height'=> '1px'

			, 'overflow'=> 'hidden'

			, 'position'=> 'relative'

			, 'background-color'=> $Core->styleProperty('dark-background-color')

		]

	);

	$Core->selector('.ui-wait-bar .ui-wait-unit'

		, [

			'height'=> '100%'

			, 'position'=> 'absolute'

			, 'top && left'=> '0px'

			, 'height'=> 'inherit'

			// , 'transition'=> 'all 200ms'

			, 'background-color'=> $Core->styleProperty('palette-primary-color')

		]

	);

	$Core->selector('.ui-wait-bar .ui-wait-unit'

		, [

			'animation'=> 'ggnUIWaitBar 5000ms linear infinite' 

			, 'width'=> '50%'

		]

	);

	$Core->selector('.ui-wait-bar .ui-wait-unit:nth-child(2n+1)'

		, [

			'animation'=> 'ggnUIWaitBar2 2150ms linear infinite' 

			, 'background-color'=> $Core->styleProperty('palette-tertiary-color')

			, 'width'=> '80%'

		]

	);

	$Core->selector('.ui-wait-bar .ui-wait-unit:nth-child(3n)'

		, [

			'animation'=> 'ggnUIWaitBar 1150ms linear infinite' 

			, 'background-color'=> $Core->styleProperty('background-color')

			, 'width'=> '80%'

		]

	);


	$Core->keyframes('ggnUIWaitBar', '{0%{left: -55%;width:50%;} 20%{width:10%;} 70%{width:40%;} 100%{width:1%;left: 101%;} }', true);

	$Core->keyframes('ggnUIWaitBar2', '{0%{left: -50%;width:50%;}  90%{width:20%;} 100%{width:1%;left: 101%;} }', true);


/* 
	Barre d'attente / FIN //////////////////////////////////////////
*/










/* 
	Swap Button : Bouton de permutation  / DEBUT //////////////////////////////////////////
*/


	$Core->selector('.ui-btn-swap'

		, [

			'background-color'=> 'rgba(' . $Core->styleProperty('palette-dark-color-rgb') . ',.3)'

			, 'width'=> '32px'

			, 'height'=> '7px'

			, 'overflow'=> 'hidden'

			// , 'border-radius'=> '20px'

			// , 'border'=> '2px solid rgba(' . $Core->styleProperty('palette-dark-color-rgb') . ',.5)'

		]

	);


	$Core->selector('.ui-btn-swap > .ui-swap-track'

		, [

			'background-color'=> 'rgba(' . $Core->styleProperty('palette-dark-color-rgb') . ',.5)'

			, 'width'=> '16px'

			, 'height'=> '100%'

			// , 'border-radius'=> '360%'

			, 'margin-left'=> '-17px'

			, 'cursor'=> 'default'

		]

	);


	$Core->selector('.ui-btn-swap[checked]'

		, [

			// 'background-color'=> $Core->styleProperty('background-color')

			'background-color'=> 'rgba(' . $Core->styleProperty('palette-primary-color-rgb') . ',.4)'

			// , 'border'=> '2px solid ' . $Core->styleProperty('palette-primary-color')

		]

	);


	$Core->selector('.ui-btn-swap[checked] > .ui-swap-track'

		, [

			'background-color'=> $Core->styleProperty('palette-primary-color')

			, 'margin-left'=> '17px'

		]

	);


	$Core->selector('.ui-btn-swap input[type="checkbox"]'

		, [

			'display'=> 'none'

		]

	);


/* 
	Swap Button : Bouton de permutation  / FIN //////////////////////////////////////////
*/











/* 
	Slider Button : Bouton de permutation  / DEBUT //////////////////////////////////////////
*/


	$Core->selector('.ui-btn-slider'

		, [

			'background-color'=> $Core->styleProperty('dark-background-color')

			, 'min-width'=> '64px'

			, 'height'=> '3px'

			, 'position'=> 'relative'

			, 'cursor'=> 'pointer'

		]

	);

	$Core->selector('.ui-btn-slider > .ui-slider-track'

		, [

			'background-color'=> $Core->styleProperty('palette-primary-color')

			, 'width'=> '30%'

			, 'height'=> '100%'

			, 'top && left'=> '0px'

		]

	);

	$Core->selector(

			'.ui-btn-slider > .ui-slider-track'

			. ',.ui-btn-slider > .ui-slider-track > .ui-slider-handler'

		, [

			'position'=> 'absolute'

		]

	);

	$Core->selector('.ui-btn-slider > .ui-slider-track > .ui-slider-handler'

		, [

			'background-color'=> $Core->styleProperty('palette-primary-color')

			, 'width && height'=> '12px'

			, 'border-radius'=> '360%'

			, 'margin-left'=> '-16px'

			, 'right'=> '-8px'

			, 'top'=> '-4px'

		]

	);


/* 
	Slider Button : Bouton de permutation  / FIN //////////////////////////////////////////
*/












/* 
	Items  Liste / DEBUT //////////////////////////////////////////
*/


	$Core->selector('.ui-items-box'

		, [

			
		]

	);


	$Core->selector('.ui-items-box .list'

		, [

			
		]

	);


	$Core->selector('.ui-items-box .list .ui-item[class*="-hover"]:hover *'

		, [

			'color' => 'inherit !important'

		]

	);


	$Core->selector('.ui-items-box .list .ui-item'

		, [

			'border-bottom' => '1px solid ' . $Core->styleProperty('border-color')

			, 'flex-direction' => 'row'

		]

	);

	$Core->selector('.ui-items-box .list .ui-item:last-child'

		, [

			'border-bottom' => '0px solid '

		]

	);

	$Core->selector('.ui-items-box .list .ui-item .ui-item-content'

		, [

			// 'flex' => '1 auto'

		]

	);

	$Core->selector('.ui-items-box .list .ui-item .ui-item-title'

		, [

			'font-size' => '18px'

			, 'padding' => '8px 16px 0px'
			
		]

	);

	$Core->selector('.ui-items-box .list .ui-item .ui-item-about'

		, [

			'font-size' => '14px'

			, 'padding' => '0px 16px 12px'
			
		]

	);

	$Core->selector('.ui-items-box .list .ui-item .ui-item-infos'

		, [

			'font-size' => '11px'

			, 'padding' => '0px 16px 8px'
			
		]

	);

	$Core->selector('.ui-items-box .list .ui-item .ui-item-infos .ui-item-infos-entry'

		, [

			'padding' => '0px 4px'
			
		]

	);

	$Core->selector('.ui-items-box .list .ui-item .ui-item-tools'

		, [

			// 'flex-direction' => 'row'
			
		]

	);

	$Core->selector('.ui-items-box .list .ui-item .ui-item-tools .ui-item-tool'

		, [

			'width' => '32px'
			
		]

	);


/* 
	Items  Liste / FIN //////////////////////////////////////////
*/

