/* Fichier : Gougnon.CSS.framework.cssg, Nom : Gougnon CSS Framework, version 0.0.1.150303.1434, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');





/* Utilitaires */
$Core->selector('*[gapp-href]', ['cursor'=> 'pointer !important']);
$Core->selector('.disable', ['display'=>'none']);
$Core->selector('.enable', ['display'=>'block']);






/* html */
$Core->selector('body'
	, [
		'overflow'=>'hidden'
	]
);

$Core->selector('body,div,td,textarea,input', ['font-family'=>'RobotoCondensedRegular, verdana, arial']);





/* Feuille d'Application */
$Core->selector('.gui.sheet.gapps[ggn-app]'
	, [
		'position'=>'absolute'
		,'left && top'=>'0px'
	]
);





/* Entête */
$Core->selector('body > .nav-bar'
	, [
		// 'display'=>'block'
		'width'=>'100vw'
		,'left'=>'0px'
		,'position'=>'fixed'
		,'top'=>'0px'
		,'padding-left && padding-right'=>'0 !important'
		,'z-index'=>'999990'
		,'transform'=>'translate3d(0px, 0px, 0px)'
	]
);




/* Corps */
$Core->selector('body > .gapps > .body-main'
	, [
		'position'=>'absolute !important'
		,'left'=>'0px'
		,'top'=>'0px'
		,'z-index'=>'0'
		,'width && height'=>'inherit'
	]
);


/* Section */
$Core->selector('.body-main .section'
	, [
		'padding && margin'=>'0 !important'
	]
);

$Core->selector('.body-main .section.large'
	, [
		'width'=>'inherit'
	]
);

$Core->selector('.body-main .section.fullscreen'
	, [
		'width && height'=>'inherit'
	]
);

$Core->selector('.body-main .section.container'
	, [
		'width'=>'1280px'
	]
);






/* Box */
$Core->selector('.box'
	, [
		'padding && margin'=>'0px'
		,'min-width'=>'320px'
	]
);

$Core->selector('.box > .title'
	, [
		'font-size'=>'20px'
		,'font-family'=>$Core->styleProperty('headling-font-family')
	]
);

$Core->selector('.box > .about'
	, [
		'font-size'=>'14px'
		,'font-family'=>$Core->styleProperty('headling-font-family')
	]
);

$Core->selector('.box > .content'
	, [
		'font-size'=>'13px'
	]
);

$Core->selector('.box > .content p'
	, [
		'margin-top && margin-bottom'=>'10px'
	]
);

$Core->selector('.box > .buttons'
	, [
		'padding-top && padding-bottom'=>'10px'
	]
);


/* Box Grand */
$Core->selector('.box.grand'
	, [
		'padding && margin'=>'0px'
	]
);

$Core->selector('.box.grand > .title'
	, [
		'font-size'=>'70px'
		,'font-family'=>$Core->styleProperty('headling-fontLight-family')
	]
);

$Core->selector('.box.grand > .about'
	, [
		'font-size'=>'30px'
		,'font-family'=>$Core->styleProperty('headling-fontLight-family')
	]
);





/* Pied */
$Core->selector('body > .status-bar'
	, [
		'position'=>'fixed'
		,'left'=>'0px'
		,'bottom'=>'0px'
		,'z-index'=>'999999 !important'
	]
);






/* App Locker */
$Core->selector('.big.gapps-locker[gui-api="g.lockbox"]'
	, []
);

$Core->selector('.light.gapps-locker[gui-api-lockbox="ultra.light"]'
	, [
		'background-color'=>'rgba(0,0,0,.75)'
	]
);

$Core->selector('.box.gapps-locker[gui-api-lockbox="ultra.box"]'
	, [
		'background-color'=>'transparent'
		,'color'=>'#fff'
		,'text-align'=>'center'
		,'box-shadow'=>'0px 0px 0px transparent'
	]
);

$Core->selector('.box.gapps-locker[gui-api-lockbox="ultra.box"] > .title'
	, [
		'font-size'=>'35px'
		,'font-family'=>$Core->styleProperty('headling-fontLight-family')
	]
);

$Core->selector('.box.gapps-locker[gui-api-lockbox="ultra.box"] > .message'
	, [
		'font-size'=>'15px'
	]
);


?>