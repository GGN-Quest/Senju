<?php

	
	/* PARAMETRES */
	require $Core::commonFile('.settings');


	/* Paramètre commun */
	include dirname(__FILE__) . '/common.php';


	/* GUI Box */

	$Core->selector('.error-section-box'
		, [
			// 'background-color'=>$Core->styleProperty('background-color')
			// ,'box-shadow'=>'0px 0px 10px ' . $Core->styleProperty('shadow-color')
		]
	);





	$Core->selector(
			'.up'
			.',.error-section-box .outer'
			.',.error-section-box .outer > .inner'
		, [
			'border-radius'=>'100%'
		]
	);



	$Core->selector('.up'
		, [
			'background-color'=>$Core->styleProperty('palette-primary-color')
			,'box-shadow'=>'0px 0px 10px ' . $Core->styleProperty('shadow-color')
			// ,'animation'=>'ggnBouncedOut 0.3s ease-in-out'
		]
	);

	$Core->selector('.up .outer'
		, [
			'background-color'=> 'rgba(0,0,0,.2)'
			,'animation'=>'ggnBouncedOut 1s ease-in-out'
			// 'background-color'=>$Core->styleProperty('background-color')
		]
	);

	$Core->selector('.up .outer > .inner'
		, [
			// ,'padding'=>'20px'
		]
	);

	$Core->selector('.up .outer > .inner'
		, [
			'animation'=>'ggnBouncedIn 0.3s ease-in-out'
		]
	);

	$Core->selector('.up .outer > .inner img'
		, [
			'margin-top'=>'-30px'
		]
	);




	$Core->selector('.error-section-box .title'
		, [
			'font-size'=>'32px'
			,'margin-top'=>'-30px'
		]
	);


	$Core->selector('.error-section-box .about'
		, [
			'font-size'=>'20px'
			,'margin-top'=>'-10px'
		]
	);



	$Core->selector('.error-section-box .buttons'
		, [
			'margin'=>'30px'
		]
	);

	$Core->selector('.error-section-box .buttons > button'
		, [
			'margin-left && margin-left'=>'5px'
		]
	);



	/* GUI Sheet */
	// $Core->selector('.gui.error-section'
	// 	, [
	// 		'display'=>'-webkit-flex'
	// 		,'display'=>'flex'
	// 		,'align-items'=>'center'
	// 		,'justify-content'=>'center'
	// 		// ,'flex-direction'=> 'column'
	// 		,'width && height'=>'100%'
	// 	]
	// );



	/* GUI Box */
	// $Core->selector('.error-section-box'
	// 	, [
	// 		// 'margin'=>'auto'
	// 	]
	// );

	// $Core->selector('.error-section-box > .code'
	// 	, [
	// 		'font-size'=>'100px'
	// 		,'padding'=>'5px 10px'
	// 		,'font-family'=>'RobotoThin ' . $Core->styleProperty('headling-fontThin-family')
	// 		// ,'color'=>'' . $Core->styleProperty('font-color:hover') . ' '
	// 	]
	// );

	// $Core->selector('.error-section-box > .content'
	// 	, [
	// 		'padding'=>'30px 10px 15px'
	// 	]
	// );

	// $Core->selector('.error-section-box > .content > .title'
	// 	, [
	// 		'font-size'=>'25px'
	// 		,'text-transform'=>'uppercase'
	// 		// ,'color'=>'' . $Core->styleProperty('font-color:hover') . ' '
	// 	]
	// );


	// $Core->selector('.error-section-box > .content > .about'
	// 	, [
	// 		'font-size'=>'18px'
	// 		,'margin-top'=>'-5px'
	// 	]
	// );

	// $Core->selector('.error-section-box > .content > .error-code'
	// 	, [
	// 		'font-size'=>'11px'
	// 		,'padding-top'=>'0px'
	// 		,'text-transform'=>'lowercase'
	// 		// ,'color'=>'' . $Core->styleProperty('font-color:hover') . ' '
	// 		,'color'=>'rgba(' . $Core->styleProperty('palette-dark-color') . ',.4) '
	// 	]
	// );







?>