 /* Fichier : Gougnon.CSS.ScrollBar.cssg, Nom : Gougnon CSS Framework, version 0.0.1, update 151218.0945, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php

	/* PARAMETRES */
	require self::commonFile('.settings');



/*
	Pas Client Mobile // DEBUT ----------------------------------
*/

if($GUI['is.mobile'] === false){




	$PalettePrimaryColorDark = $Core::LDColor($Core->styleProperty('palette-primary-color'), -30);


	/* Principal */
	$Core->selector('[ggn-scrollbar]'
		, [
			'position'=>'relative !important'
			,'overflow'=> 'hidden !important'
		]
	);



	/* Contenu */
	$Core->selector('[ggn-scrollbar] > [scrollbar-content]'
		, [
			'position'=>'relative !important'
			,'top && left'=>'0px'
			,'z-index'=>'5'
		]
	);

	$Core->selector('[ggn-scrollbar] > [scrollbar-content][scrollbar-fx="swift"]'
		, [
			'transition'=>'top,left, 0.3s ease-in-out'
		]
	);



	/* Scroller */
		/* Axe : Y */
		$Core->selector('[ggn-scrollbar] > [y-scroll]'
			, [
				'top && right'=>'0px'
				,'width'=>'10px'
				// ,'margin-right'=>'3px'
				,'height'=>'100%'
				,'transition'=>'width,opacity, 0.3s ease-in-out'
			]
		);

		$Core->selector('[ggn-scrollbar][scrolling-now="out"] > [y-scroll]'
			, [
				'width'=>'1px'
				,'opacity'=>'0.5'
			]
		);

		$Core->selector('[ggn-scrollbar]:hover > [y-scroll]'
			, [
				'width'=>'10px'
				,'opacity'=>'1'
			]
		);


		$Core->selector('[ggn-scrollbar] > [y-scroll] > div.track'
			, [
				'top && right'=>'0px'
				,'width'=>'10px'
				// ,'margin-right'=>'-3px'
				,'height'=>'100%'
				,'transition'=>'width 0.3s ease-in-out'
			]
		);

		$Core->selector('[ggn-scrollbar][scrolling-now="out"] > [y-scroll] > div.track'
			, [
				'width'=>'1px'
				,'margin-right'=>'-0px'
				,'opacity'=>'0.5'
			]
		);

		$Core->selector('[ggn-scrollbar]:hover > [y-scroll] > div.track'
			, [
				'width'=>'10px'
				// ,'margin-right'=>'-3px'
				,'opacity'=>'1'
			]
		);



		/* Axe : X */
		$Core->selector('[ggn-scrollbar] > [x-scroll]'
			, [
				'bottom && left'=>'0px'
				,'height'=>'10px'
				// ,'margin-bottom'=>'3px'
				,'width'=>'100%'
				,'transition'=>'height,opacity, 0.3s ease-in-out'
			]
		);

		$Core->selector('[ggn-scrollbar][scrolling-now="out"] > [x-scroll]'
			, [
				'height'=>'1px'
				,'opacity'=>'0.5'
			]
		);

		$Core->selector('[ggn-scrollbar]:hover > [x-scroll]'
			, [
				'height'=>'10px'
				,'opacity'=>'1'
			]
		);


		$Core->selector('[ggn-scrollbar] > [x-scroll] > div.track'
			, [
				'bottom && left'=>'0px'
				,'height'=>'10px'
				,'margin-bottom'=>'-3px'
				,'width'=>'100%'
				,'transition'=>'height 0.3s ease-in-out'
			]
		);

		$Core->selector('[ggn-scrollbar][scrolling-now="out"] > [x-scroll] > div.track'
			, [
				'height'=>'1px'
				,'margin-bottom'=>'-0px'
				,'opacity'=>'0.5'
			]
		);

		$Core->selector('[ggn-scrollbar]:hover > [x-scroll] > div.track'
			, [
				'height'=>'10px'
				,'margin-bottom'=>'-3px'
				,'opacity'=>'1'
			]
		);




		/* Axe : XY */
		$Core->selector(
			'[ggn-scrollbar]:hover > [x-scroll]'
			. ',[ggn-scrollbar]:hover > [y-scroll]'
			, [
				'background'=>$Core->styleProperty('dark-background-color')
				,'z-index'=>'10'
				,'display'=>($GUI['is.mobile']===false) ? 'block !important' : 'none !important'
			]
		);

		$Core->selector(
			'[ggn-scrollbar] > [x-scroll]'
			. ',[ggn-scrollbar] > [y-scroll]'
			. ',[ggn-scrollbar] > [x-scroll] > div.track'
			. ',[ggn-scrollbar] > [y-scroll] > div.track'
			, [
				'border-radius'=>'20px'
				,'border-top-right-radius && border-bottom-right-radius'=>'0px'
			]
		);



		$Core->selector(
			'[ggn-scrollbar]:hover > [x-scroll] > div.track'
			. ',[ggn-scrollbar]:hover > [y-scroll] > div.track'
			, [
				'background-color'=>$PalettePrimaryColorDark
				// 'background-color'=>$Core->styleProperty('palette-primary-color')
				,'cursor'=>'default !important'
				,'transition'=>'background-color 0.3s ease-in-out'
			]
		);

		$Core->selector(
			'[ggn-scrollbar] > [x-scroll]:hover > div.track'
			. ',[ggn-scrollbar] > [y-scroll]:hover > div.track'
			, [
				'background-color'=>$Core->styleProperty('palette-secondary-color')
				,'cursor'=>'default !important'
			]
		);



}


/*
	Pas Client Mobile // FIN ----------------------------------
*/


