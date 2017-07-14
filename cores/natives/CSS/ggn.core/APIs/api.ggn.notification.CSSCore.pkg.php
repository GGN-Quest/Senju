/* Fichier : Gougnon.CSS.Connect.Login.cssg, Nom : Gougnon CSS Framework, version 0.0.1, update 150924.0315, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php

	/* PARAMETRES */
	require self::commonFile('.settings');



/* Principal */
$Core->selector('#ggn-notification-api.gui.notification'
	, [
		// 'overflow'=>'hidden !important'
		'width'=>'450px'
		// ,'width'=>'100vw'
		,'height'=>'1vh'
		// ,'flex-wrap'=>'wrap'
		,'z-index'=>'1962 !important'
		// ,'margin-left && margin-right'=>'3vw !important'
		,'transition'=>'height 0.35s ease-out'
	]
);

$Core->selector('.gui.notification'
	, [
		'background-color'=>'transparent'
	]
);


$Core->selector('.gui.notification.hide'
	, [
		'transform'=>'translateY(-100vh)'
		// ,'width'=>'100vw !important'
		,'opacity'=>'1'
		,'animation'=>'ggnTranslate-YOut 0.3s ease-out'
		// ,'height'=>'1vh'
	]
);


$Core->selector('.gui.notification.show'
	, [
		'transform'=>'translateY(0%)'
		,'width'=>'450px !important'
		,'opacity'=>'1'
		,'animation'=>'ggnTranslate-YIn 0.3s ease-out'
		,'height'=>'100vh'
	]
);







/* Utilitaires */
$Core->selector('.gui.notification .mgn', ['margin-top && margin-bottom'=>'3px'] );
$Core->selector('.gui.notification .mgn:first-child', ['margin-top'=>'0px'] );
$Core->selector('.gui.notification .mgn:last-child', ['margin-bottom'=>'0px'] );

// $Core->selector('.gui.notification a', ['color'=>$Core->styleProperty('font-color'), 'text-decoration'=>'underline', 'font-style'=>'italic'] );

$Core->selector('.gui.notification .shadow', ['box-shadow'=>'0px 0px 5px rgba(0,0,0,.5)'] );







/* Entete */
$Core->selector('.gui.notification > .header'
	, [
		'width'=>'450px'
		,'color'=>$Core->styleProperty('font-color')
		,'background-color'=>$Core->styleProperty('background-color')
		,'border-top'=>'2px solid rgba(255,255,255,.1)'
		,'margin-top'=>'10px'
		// ,'color'=>$Core->styleProperty('font-color')
		// ,'background-color'=>$Core->styleProperty('palette-primary-color')
	]
);

$Core->selector('.gui.notification > .header.fx', ['animation'=>'ggnTranslate-YIn 0.2s ease-out'] );

$Core->selector('.gui.notification > .header > .title'
	, [
		'font-size'=>'15px'
		,'padding'=>'5px 20px 10px'
		,'flex'=>'1'
		,'font-family'=>$Core->styleProperty('headling-fontLight-family')

	]
);



/* Outils */
$Core->selector('.gui.notification > .header > .tools'
	, [
		// ''=>''
	]
);

$Core->selector('.gui.notification > .header > .tools > .tool'
	, [
		'width && height'=>'25px'
		// ,'background-color'=>'red'
		,'margin-right'=>'3px'
	]
);


$Core->selector('.gui.notification > .header > .tools > .tool:last-child'
	, [
		'margin-right'=>'10px'
	]
);







/* Pied */
$Core->selector('.gui.notification > .footer'
	, [
		'position'=>'absolute'
		,'bottom'=>'-5px'
		,'width'=>'100%'
		,'transition'=>'bottom 0.3s ease-out'
		,'background-color'=>$Core->styleProperty('palette-primary-color')
	]
);

$Core->selector('.gui.notification.show > .footer', ['background-color'=>'transparent']);


$Core->selector('.gui.notification > .footer:hover'
	, [
		'bottom'=>'-35px'
		,'border-bottom'=>'5px solid rgba(255,255,255,.1)'
	]
);

$Core->selector('.gui.notification > .footer .label'
	, [
		'font-size'=>'14px'
		,'text-align'=>'center'
		,'padding'=>'10px 20px 5px'
		,'opacity'=>'0'
		,'transition'=>'opacity 0.3s ease-out'
	]
);

$Core->selector(
		'.gui.notification.hide > .footer .label'
		.',.gui.notification.hide:hover > .footer .label'
	, [
		'opacity'=>'1'
	]
);

$Core->selector('.gui.notification.show > .footer .label'
	, [
		'opacity'=>'0'
	]
);







/* Conteneur */
$Core->selector('.gui.notification > .container'
	, [
		'width'=>'450px'
		,'height'=>'94vh'
		,'overflow'=>'hidden'
		,'overflow-y'=> ($GUI['is.mobile']===true)?'auto':'hidden'
	]
);

$Core->selector('.gui.notification > .container:hover'
	, [
		'overflow-y'=> 'auto'

	]
);

/* Items */
$Core->selector('.gui.notification > .container > .items'
	, [
		'position'=>'relative'
		,'perspective'=>'200px'
	]
);



/* Items > item */
$Core->selector('.gui.notification > .container > .items > .item'
	, [
		'position'=>'relative'
		// ,'z-index'=>'1'
		,'padding'=>'0px'
		// ,'border-top'=>'2px solid rgba(255,255,255,.2)'
		,'margin'=>'5px 10px'
		,'margin-top'=>'-5vh'
		,'height'=>'1px'
		,'overflow'=>'hidden'
		// ,'margin-left && margin-right'=>'10px'
		// ,'border-top'=>'1px solid rgba(255,255,255,.1)'

		,'transition'=>'height 0.3s ease-out'

		// ,'transform'=>'rotateX(50deg)'

		// ,'color'=>$Core->styleProperty('font-color')
		// ,'background-color'=>$Core->styleProperty('palette-primary-color')
	]
);

$Core->selector(
		'.gui.notification > .container > .items > .item.show'
		// .',.gui.notification.show > .container > .items > .item.show'
	, [
		'height'=>'70px'
		,'transition'=>'margin-top 0.3s ease-out'
	]
);

$Core->selector('.gui.notification > .container > .items > .item.fx'
	, [
		'animation'=>'ggnRotateXIn 0.3s ease-out'
		,'height'=>'70px'
	]
);

$Core->selector('.gui.notification > .container > .items > .item.closing'
	, [
		'animation'=>'ggnRotate-XOut 0.5s ease-out'
		,'transform'=>'rotateX(-89deg)'
		,'opacity'=>'0.0'
		,'height'=>'0px'
		,'transition'=>'height 0.3s ease-out'
	] 
);

$Core->selector('.gui.notification > .container > .items > .item:first-child'.',.gui.notification > .container > .items:hover > .item:first-child', ['margin-top'=>'5px'] );
$Core->selector('.gui.notification > .container > .items > .item:last-child', ['margin-bottom'=>'5px'] );



$Core->selector(
		'.gui.notification > .container > .items:hover > .item'
		// .',.gui.notification.hide > .container > .items > .item'
	, [
		'margin-top'=>'0%'
		// 'transform'=>'translateY(-100%)'
	]
);


/* Item && Item > text */
$Core->selector(
		'.gui.notification > .container > .items > .item'
		.',.gui.notification > .container > .items > .item > .text'
	, [
		'color'=>$Core->styleProperty('font-color')
		,'background-color'=>$Core->styleProperty('background-color')
	]
);



$Core->selector('.gui.notification > .container > .items > .item > .icon'
	, [
		'width'=>'96px'
		,'height'=>'auto'
		,'background-color'=>$Core->styleProperty('dark-background-color')
	]
);

$Core->selector('.gui.notification > .container > .items > .item > .text'
	, [
		'flex'=>'1'
		,'padding'=>'10px 15px'
	]
);

	$Core->selector('.gui.notification > .container > .items > .item > .text > .title'
		, [
			'font-size'=>'15px'
			,'font-family'=>$Core->styleProperty('headling-fontLight-family')
		]
	);

	$Core->selector('.gui.notification > .container > .items > .item > .text > .content'
		, [
			'font-size'=>'12px'
		]
	);


$Core->selector('.gui.notification > .container > .items > .item > .tools'
	, [
		// 'flex'=>'1 auto'
	]
);

$Core->selector('.gui.notification > .container > .items > .item > .tools > .tool'
	, [
		'width && height'=>'25px'
		// ,'background-color'=>'red'
	]
);

$Core->selector('.gui.notification > .container > .items > .item > .tools > .tool:first-child'
	, [
		'margin-right'=>'10px'
	]
);


