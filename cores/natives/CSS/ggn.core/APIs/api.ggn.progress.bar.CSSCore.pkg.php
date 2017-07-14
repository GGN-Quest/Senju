/* Fichier : Gougnon.CSS.ggn.progress.bar.cssg, Nom : Gougnon CSS ggn.progress.bar, version 0.0.1.141029.1216, site: http://Gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php
/* PARAMETRES */

$textEllipsis = 'white-space:nowrap;overflow:hidden;text-overflow:ellipsis;';



/* Gougnon UI Progress API */
$Core->Code('div[gui-api="ggn.progress"]{position:relative;overflow:hidden;}');
$Core->Code('div[gui-api="ggn.progress"][gui-api-progress="ggn.progress.bar"]{');
	$Core->Code('background-color:'.$Core->styleProperty('dark-background-color').';');
	$Core->Code('min-height:1px;');
$Core->Code('}');

$Core->Code('div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress="purcent.bar"]');
$Core->Code(',div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress="cache.bar"]');
$Core->Code(',div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress="text.bar"]');
$Core->Code(',div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress="work.bar"]');
$Core->Code('{');
	$Core->Code('position:absolute;');
	$Core->Code('min-height:1px;');
	$Core->Code('height:100%;');
	$Core->Code('overflow:hidden;');
	
$Core->Code('}');

$Core->Code('div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress] > div[gui-api-progress="label.bar"]');
$Core->Code('{');
	$Core->Code('text-overflow:hidden;');
	$Core->Code('white-space:nowrap;');
	$Core->Code('font-size:12px;');
	$Core->Code('overflow:hidden;');
	$Core->Code('text-align:center;');
$Core->Code('}');

$Core->Code('div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress] > div[gui-api-progress="label.bar"] > div[gui-api-progress="label.bar:text"]');
$Core->Code('{');
	$Core->Code('display:table-cell;');
	$Core->Code('text-align:center;');
	$Core->Code('vertical-align:middle;');
$Core->Code('}');



$Core->Code('div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress="purcent.bar"]{');
	$Core->Code('background-color: '.$Core->styleProperty('palette-primary-color').';');
$Core->Code('}');

$Core->Code('div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress="purcent.bar"] > div[gui-api-progress="label.bar"]{');
	$Core->Code('color:#fff;');
$Core->Code('}');



$Core->Code('div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress="cache.bar"]{');
	// $Core->Code('background-color: #c0c0c0;');
	$Core->Code('background-color: '.$Core->styleProperty('font-color').';');
$Core->Code('}');

$Core->Code('div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress="cache.bar"] > div[gui-api-progress="label.bar"]{');
	$Core->Code('color:#e0e0e0;');
$Core->Code('}');



$Core->Code('div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress="text.bar"]{');
	$Core->Code('background-color: transparent !important;');
	$Core->Code('width:100%;');
	$Core->Code('height:100%;');
$Core->Code('}');

$Core->Code('div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress="text.bar"] > div[gui-api-progress="label.bar"]{');
	$Core->Code('color:#222;');
$Core->Code('}');



$Core->Code('div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress="work.bar"]{');
	$Core->Code('background-color: '.$Core->styleProperty('palette-secondary-color').';');
$Core->Code('}');

$Core->Code('div[gui-api-progress="ggn.progress.bar"] > div[gui-api-progress="work.bar"] > div[gui-api-progress="label.bar"]{');
	$Core->Code('color:#fff;');
$Core->Code('}');


?>