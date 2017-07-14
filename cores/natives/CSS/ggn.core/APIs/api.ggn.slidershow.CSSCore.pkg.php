/* Fichier : Gougnon.CSS.effect.cssg, Nom : Gougnon CSS Framework, version 0.0.1.150012.1127, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php

/* PARAMETRES */
require self::commonFile('.settings');




/* SliderShow */
$Core->selector('.ggn-slidershow'
	, [
		'position'=>'relative'
		,'width && height'=>'inherit'
		// ,'background-color'=>$Core->styleProperty('dark-background-color')
	]
);



/* SliderShow : Contenu */
$Core->selector('.ggn-slidershow > .content'
	, [

		'background-color'=>'transparent'
		,'width && height'=>'inherit'
		// ,'width && height'=>'100%' 
		,'margin-top'=>'0px' 
		,'position'=>'relative'
		,'overflow'=>'hidden'
		// ,'overflow-x'=>'auto'
	]
);



/* SliderShow : Content > Notice */
$Core->selector('.ggn-slidershow > .content > .notice'
	, [
		'font-size'=>'25px'
		,'width && height'=>'100%'
		,'color'=>$Core->styleProperty('dark-font-color')
		,'font-family'=>$Core->styleProperty('headling-fontLight-family')
	]
);

$Core->selector('.ggn-slidershow > .content > .notice > .message'
	, [
		'width && height'=>'100%'
	]
);

$Core->selector('.ggn-slidershow > .content > .notice > .message.error'
	, [
		'background-position'=>'center 43%'
		,'background-repeat'=>'no-repeat'
		,'padding'=>'0px'
		,'background-image'=>'url(' . $GAppsPath . 'cross.png' . $GUI['IMAGE_FILTER_TEXT_HOVER_TONE'] . '&width=32&height=32)'
	]
);




/* SliderShow : Content > Statut */
$Core->selector('.ggn-slidershow > .content > .status'
	, [
		'position'=>'absolute'
		,'width && height'=>'25px'
		,'left && bottom'=>'20px'
	]
);

$Core->selector('.ggn-slidershow > .content > .progress'
	, [
		'background-color'=>'rgba('.$Core->styleProperty('font-color-rgb:hover').',.2)'
		,'width'=>'100%'
		,'height'=>'3px'
		,'position'=>'absolute'
		,'left && bottom'=>'0px'
	]
);

$Core->selector('.ggn-slidershow > .content > .progress > .track'
	, [

		'background-color'=>'rgba('.$Core->styleProperty('font-color-rgb:hover').',.75)'
		,'width'=>'0.1%'
		,'height'=>'100%'
		,'transition'=>'width,height, 0.1s ease-out'
	]
);



$Core->selector('.ggn-slidershow > .content > .panel'
	, [
		'height'=>'100%'
		,'position'=>'relative'
		,'flex-wrap'=>'wrap'
	]
);

$Core->selector('.ggn-slidershow > .content > .panel > .item'
	, [

		'position'=>'relative'

		,'width && height'=>'100%'

		,'background-size'=>'100% auto'

	]
);

$Core->selector('.ggn-slidershow > .content > .panel > .item > .info'
	, [
		'position'=>'absolute'
		,'width'=>'100%'
		,'bottom && left'=>'0px'
		,'padding'=>'15px 25px'
		,'background-color'=>'rgba('.$Core->styleProperty('dark-background-color-rgb').',.60)'
	]
);

$Core->selector('.ggn-slidershow > .content > .panel > .item > .info > .title'
	, [
		'font-size'=>'35px'
		,'font-family'=>$Core->styleProperty('headling-fontLight-family')
	]
);

$Core->selector('.ggn-slidershow > .content > .panel > .item > .info > .about'
	, [
		'font-size'=>'25px'
		,'font-family'=>$Core->styleProperty('headling-fontLight-family')
	]
);



$Core->selector('.ggn-slidershow > .content > .browser'
	, [
		'width'=>'48px'
		,'height'=>'100%'
		,'position'=>'absolute'
		,'top'=>'0px'
		,'font-size'=>'25px'
	]
);

$Core->selector('.ggn-slidershow > .content > .browser.left'
	, [
		'left'=>'-48px'
		,'transition'=>'left 0.3s ease-out'
	]
);

$Core->selector('.ggn-slidershow > .content:hover > .browser.left'
	, [
		'left'=>'0px'
	]
);

$Core->selector('.ggn-slidershow > .content > .browser.right'
	, [
		'right'=>'-48px'
		,'transition'=>'right 0.3s ease-out'
	]
);

$Core->selector('.ggn-slidershow > .content:hover > .browser.right'
	, [
		'right'=>'15px'
	]
);





$Core->openMedia(' (max-width: ' . $Core::SCREEN_M_MIN . ') ');


	$Core->selector('.ggn-slidershow > .content > .panel > .item'
		, [

			'background-size'=>'auto 100%'

		]
	);



$Core->closeMedia();


