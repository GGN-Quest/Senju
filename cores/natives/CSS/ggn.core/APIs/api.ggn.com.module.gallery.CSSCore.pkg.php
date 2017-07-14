/* Fichier : Gougnon.CSS.framework.cssg, Nom : Gougnon CSS Framework, version 0.0.1.140103.1748, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');


$Core->selector('.gui.gallery'
	, [
		'padding && margin'=> '0px'
	]
);


$Core->selector('.gui.gallery .list'
	, [
		'padding && margin'=> '0px'
	]
);


$Core->selector('.gui.gallery .list.photo'
	, [
		'padding'=> '0px'
		,'display'=> 'flex'
		,'align-items'=> 'left'
		,'flex-wrap'=> 'wrap'
	]
);


$Core->selector('.gui.gallery .list.photo > .item'
	, [
		'margin'=>'4px'
		// ,'min-width && min-height'=>'256px'
		,'background-color'=>'rgba(0,0,0,.2)'
		,'background-repeat'=>'no-repeat'
		,'background-position'=>'center'
		,'background-size'=>'100%'
	]
);


$Core->selector('.gui.gallery .list.photo > .item > .layer'
	, [
		'width && height'=>'inherit'
		,'background-color'=>'rgba(255,255,255,.0)'
		,'transition'=>'background-color 0.3s ease-in-out'
	]
);


$Core->selector('.gui.gallery .list.photo > .item:hover > .layer'
	, [
		'background-color'=>'rgba(255,255,255,.75)'
		,'background-repeat'=>'no-repeat'
		,'background-position'=>'center'
	]
);

$Core->selector('.gui.gallery .list.photo > .item:hover > .layer'
	, [
		'background-color'=>'rgba(255,255,255,.75)'
		,'background-repeat'=>'no-repeat'
		,'background-position'=>'center'
	]
);

$Core->selector('.gui.gallery .list.photo > .item:hover > .layer.remove'
	, [
		'background-image'=>'url('.$GAppsPath . 'cross.png?mode=-gd&width=16&height=16)'
	]
);


$Core->selector('.gui.gallery .list.photo > .item .label-center'
	, [
		'text-shadow'=>'0px 0px 5px #000'
		,'width && height'=>'100%'
		,'text-align'=>'center'
		,'color'=>'#fff'
		,'background-color'=>'rgba(0,0,0,.5)'
	]
);










?>