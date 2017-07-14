 /* Fichier : Gougnon.CSS.framework.cssg, Nom : Gougnon CSS Framework, version 0.0.1.140103.1748, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');



$Core->selector('[gui-api-background-animate="ggn.ba.box"]'
	, [
		'overflow'=>'hidden'
		,'position'=>'absolute'
		,'width'=>'100%'
		,'height'=>'100%'
	]
);

$Core->selector('[gui-api-background-animate="ggn.ba.box"] > .panel'
	, [
		'position'=>'absolute'
		,'opacity'=>'0'
		,'z-index'=>'0'
		,'top'=>'0px'
		,'left'=>'0px'
		,'width'=>'100%'
		,'height'=>'100%'
		,'background-repeat'=>'no-repeat'
		,'background-position'=>'center'
	]
);

$Core->selector('[gui-api-background-animate="ggn.ba.box"] > .panel.background-animate-play'
	, [
		'animation'=>'GGNSlideIt 30s ease-in-out infinite'
	]
);

$Core->selector('[gui-api-background-animate="ggn.ba.box"] > .panel.focus'
	, [
		'z-index'=>'2'
	]
);




/* ANIMATION ======================================================================= */
$Core->Code(
	$Core->keyframes('GGNSlideIt'
		, '{0%{background-size:100%;} 75%{background-size:250%;} 100%{background-size:100%;} }'
		)
	);


?>