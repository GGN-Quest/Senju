<?php

	
/* PARAMETRES */
require self::commonFile('.settings');





$Core->selector('body'

	, [

		// 'letter-spacing'=>'-0.03em'

		// , 'background-color'=>$Core->styleProperty('background-color:hover')

	]

);




/* Lien / DEBUT */

	$Core->selector('a:hover, a:focus'

		, [

			'text-decoration'=>'none'

		]

	);

/* Lien / FIN */








/* Logo / DEBUT */

	$Core->selector('.header-logo'
		, [

			'padding'=>'12px 16px'

		]
	);

/* Logo / FIN */








/* Menu / DEBUT */

	$Core->selector(

			'.gui.gabarit.menu.principal > .items .item'

		, [

			'margin-top'=>'0px'

			, 'padding-left && padding-right'=>'12px'

			,'font-size'=>'14px'

			,'height'=>'42px'

			,'color'=>$Core->styleProperty('font-color')

		]
	);

	$Core->selector(

			'.gui.gabarit.menu.principal > .items .item.active'

		, [

			'background-color'=>'transparent'
		]
	);

	$Core->selector(

			'.gui.gabarit.menu.principal > .items .item:hover'

		, [

			'background-color'=>'transparent'

		]
	);


	$Core->selector(

			'.gui.gabarit.menu.principal > .items .item .item-decoration'


		, [

			'position'=>'absolute'

			, 'width'=>'90%'

			, 'margin-left'=>'5%'

			, 'height'=>'100%'

			, 'left && top'=>'0px'

			// , 'border-radius'=>'500%'

			, 'transform'=>'scale(0.0)'

			// ,'margin-top'=>'0px'

			,'transition'=>'all 250ms linear'

			,'background-color'=>'rgba(' . $Core->styleProperty('palette-light-color-rgb') . ',.16)'

			// ,'border-radius'=>'3px'

		]
	);

	$Core->selector(

			'.gui.gabarit.menu.principal > .items .item:hover .item-decoration'

			. ', .gui.gabarit.menu.principal > .items .item.active .item-decoration'

		, [

			'transform'=>'scale(1)'

			, 'border-radius'=>'3px'

			// 'height'=>'100%'

			// ,'margin-top'=>'10px'

		]
	);

	$Core->selector(

			'.gui.gabarit.menu.principal > .items .item.active .item-decoration'

		, [

			// 'margin-top'=>'5px'

		]
	);

/* Menu / FIN */

