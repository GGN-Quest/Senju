<?php

	
/* PARAMETRES */
require $Core::commonFile('.settings');





$Core->selector('body'
	, [
		'letter-spacing'=>'-0.03em'

		, 'background-color'=>$Core->styleProperty('background-color:hover')
	]
);


$Core->selector('a:hover, a:focus'
	, [
		'text-decoration'=>'none'
	]
);





/* 
	MAC : onlybar / DEBUT //////////////////////////////////////////
*/

$Core->selector('.ui-mac-onlybar'

	, [

		// 'box-shadow'=> '0px 0px 15px  rgba(0,0,0,.0)'

	]

);

/* 
	MAC : onlybar / FIN //////////////////////////////////////////
*/





/* NavBar / DEBUT */

	$Core->selector('.ui-navbar'

		, [

			'box-shadow'=> '0px 0px 10px  rgba(0,0,0,.16)'

		]

	);

/* NavBar / FIN */






/* Les "x-content" / DEBUT */

	$Core->selector('[class*=" x-content-"],[class^="x-content-"]'

		, [

			'background-color'=>'transparent'

			, 'background-size'=>'100% auto'

			, 'background-repeat'=>'no-repeat'

			, 'background-position'=>'center'

		]

	);


	$Core->selector('[class*=" x-content-"].with-nav-bar,[class^="x-content-"].with-nav-bar'

		, [

			'padding-top'=>'52px'

		]

	);


	$Core->selector('[class*=" x-content-"] > .content > .thumb,[class^="x-content-"] > .content > .thumb'

		, [
			
		]

	);


	$Core->openMedia(' (max-width: '.$Core::SCREEN_M_MAX.') ');

		$Core->selector('[class*=" x-content-"],[class^="x-content-"]'

			, [

				'background-size'=>'auto 100%'

			]

		);

	$Core->closeMedia();




/* Les "x-content" / FIN */







/* Les Blocs / FIN */

	$Core->selector('.blocs.trigger-out'

		, [

			'transform'=>'translateY(100%)'

		]

	);

	$Core->selector('.blocs.trigger-in'

		, [

			'transform'=>'translateY(0%)'

		]

	);

/* Les Blocs / FIN */











/* Moteur de recherche / DEBUT */

// $Core->selector(

// 		'.ggn-search-bar.focus'

// 		. ',.ggn-search-bar-suggest.focus'

// 	, [

// 		'box-shadow'=>'0px 0px 10px rgba(' . $Core->styleProperty('dark-shadow-color-rgb') . ',.3)'

// 	]
// );

$Core->selector('.ggn-search-bar .field-input'
	, [

		'background-color'=> 'rgba(' . $Core->styleProperty('palette-light-color-rgb') . ',.2) '
		
		
		,'border-radius'=>'3px'

	]
);

$Core->selector('.ggn-search-bar.focus .field-input'
	, [

		'border-radius'=>'0px'
		


	]
);

$Core->selector('.ggn-search-bar .gui.gabarit.tag-select.focus'
	, [

		'background-color'=> 'rgba(' . $Core->styleProperty('palette-light-color-rgb') . ',.2) '

	]
);

$Core->selector('.ggn-search-bar .gui.gabarit.tag-select.focus > .options'
	, [

		'background-color'=> $Core->styleProperty('palette-primary-color')

	]
);

/* Moteur de recherche / FIN */







/* Page / DEBUT */

$Core->selector('.page-column-center'
	, [

		'background-color'=> 'rgba(' . $Core->styleProperty('background-color-rgb') . ',.4)'

		, 'box-shadow'=> '0px 0px 20px rgba(0,0,0,.16)'

	]
);

/* Page / FIN */







?>
