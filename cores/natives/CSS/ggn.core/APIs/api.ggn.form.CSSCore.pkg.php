/* Fichier : Gougnon.CSS.form.cssg, Nom : Gougnon CSS Framework, version 0.0.1.150508.1550, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php

/* PARAMETRES */
require self::commonFile('.settings');




$Core->selector('.gui.form'
	, [
		'padding'=>'10px 0px 0px'
	]
);

$Core->selector('.gui.form > .entry'
	, [
		'padding'=>'0px'
	]
);

$Core->selector('.gui.form > .entry.alone'
	, [
		'padding'=>'10px'
		,'padding-bottom'=>'0px'
		// ,'padding-bottom'=>'0px'
	]
);

$Core->selector('.gui.form > .entry > .label'
	, [
		'padding'=>'10px'
		,'font-size'=>'16px'
	]
);

$Core->selector('.gui.form > .entry.alone:last-child', ['padding-bottom'=>'15px']);


$Core->selector('.gui.form > .entry > .field'
	, [
		'padding'=>'2px'
	]
);

$Core->selector(
		'.gui.form > .entry > .field > input'
		. ',.gui.form > .entry > .field > select'
		. ',.gui.form > .entry > .field > textarea'
	, [
		'font-size'=>'16px'
		,'font-family'=>''.$Core->styleProperty('headling-font-family').''
		,'width'=>'85%'
	]
);


$Core->selector('.gui.form > .entry.buttons'
	, [
		'padding'=>'0'
		,'display'=>'flex'
		// ,'flex-direction'=>'row'
		,'margin-left'=>'-2px'
	]
);

$Core->selector('.gui.form > .entry.buttons > .button'
	, [
		'padding'=>'0'
		,'flex'=>'1'
	]
);

$Core->selector('.gui.form > .entry.buttons > .button > input'
	, [
		'font-size'=>'15px'
		,'padding'=>'15px 0px'
		,'width'=>'99%'
		,'height'=>'97%'
		,'border-width'=>'0px !important'
		,'color'=>''.$Core->styleProperty('button-font-color:hover').''
		,'background-color'=>'rgba('.$Core->styleProperty('button-background-color-rgb:hover').',.20)'
	]
);

$Core->selector('.gui.form > .entry.buttons > .button.active > input'
	, [
		'background-color'=>'rgba('.$Core->styleProperty('button-background-color-rgb:hover').',.45)'
	]
);

$Core->selector('.gui.form > .entry.buttons > .button > input:hover'
	, [
		'background-color'=>'rgba('.$Core->styleProperty('button-background-color-rgb:hover').',.60)'
	]
);

$Core->selector('.gui.form > .entry.buttons > .button.active > input:hover'
	, [
		'background-color'=>'rgba('.$Core->styleProperty('button-background-color-rgb:hover').',.99)'
	]
);


?>