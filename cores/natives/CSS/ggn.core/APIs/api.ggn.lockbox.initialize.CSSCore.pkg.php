/* Fichier : Gougnon.CSS.lockbox.confirm.cssg, Nom : Gougnon CSS lockbox.confirm, version 0.0.1.141029.1216, site: http://Gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php
/* PARAMETRES */
require self::commonFile('.settings');







/* LockBox  */
$Core->Code('.ggn-lockbox[gui-api="g.lockbox"]{');
$Core->Code('}');

$Core->Code('.ggn-lockbox[gui-api-lockbox="ultra.light"]{');
	$Core->Code('background-color: rgba(0,0,0,.50);');
$Core->Code('}');

$Core->Code('.box.ggn-lockbox[gui-api-lockbox="ultra.box"],.box.ggn-lockbox{');
	$Core->Code('background-color: '.$Core->styleProperty('palette-dark-color').';');
	$Core->Code('color: '.$Core->styleProperty('palette-light-color').';');
	$Core->Code($Core::browserKey('box-shadow', '0px 0px 5px rgba(0,0,0,.5)'));
$Core->Code('}');

$Core->Code('.box.ggn-lockbox{');
	$Core->Code('');
$Core->Code('}');

$Core->Code('.box.ggn-lockbox > form{');
	$Core->Code('width:100%;');
	$Core->Code('height:100%;');
	$Core->Code('margin:0px;');
	$Core->Code('padding:0px;');
	// $Core->Code('background-color:red;');
$Core->Code('}');

// $Core->Code('.box.ggn-lockbox  div.bl{');
// 	// $Core->Code('display:table;');
// 	$Core->Code('width:100%;');
// 	$Core->Code('height:100%;');
// $Core->Code('}');



$Core->selector('.box.ggn-lockbox  div.bl'
	, [
		'width && height'=>'100%'
		// ,'display'=>['-webkit-flex', 'flex']
		,'flex-direction'=>'column'
	]
);

$Core->selector('.box.ggn-lockbox  div.bl > div.blk'
	, [
		// 'display'=>['-webkit-flex', 'flex']
		'flex-direction'=>'column'
	]
);

$Core->selector('.box.ggn-lockbox  div.bl > div.blk.container'
	, [
		'flex'=>'1'
	]
);

$Core->selector('.box.ggn-lockbox  div.bl > div.blk > div.cell'
	, [
		// 'display'=>['-webkit-flex', 'flex']
	]
);

$Core->selector('.box.ggn-lockbox  div.bl > div.blk > div.cell.title'
	, [
		'margin-bottom'=>'auto'
		,'flex-direction'=>'column'
	]
);

$Core->selector('.box.ggn-lockbox  div.bl > div.blk > div.cell.content'
	, [
		'flex'=>'1'
		,'flex-direction'=>'column'
	]
);

$Core->selector('.box.ggn-lockbox  div.bl > div.blk > div.cell.buttons'
	, [
		'margin-top'=>'auto'
		,'flex-direction'=>'row'
	]
);


// $Core->Code('.box.ggn-lockbox  div.bl > div.blk{');
// 	// $Core->Code('display:table-row;');
// $Core->Code('}');

// $Core->Code('.box.ggn-lockbox  div.bl > div.blk > div.cell.title');
// $Core->Code(',.box.ggn-lockbox  div.bl > div.blk > div.cell.content');
// $Core->Code(',.box.ggn-lockbox  div.bl > div.blk > div.cell.buttons{');
// 	// $Core->Code('display:table-cell;');
// $Core->Code('}');


$Core->Code('.box.ggn-lockbox  div.bl > div.blk > div.cell.buttons{');
	$Core->Code('height:45px;');
$Core->Code('}');



$Core->Code('.box.ggn-lockbox  div.bl > div.blk > div.cell.title{');
	$Core->Code($textEllipsis);
	$Core->Code('font-size:20px;');
	// $Core->Code('height:55px;');
	$Core->Code('padding:12px 15px;');
	$Core->Code('text-align:center;');
	$Core->Code('vertical-align:middle;');
	$Core->Code('color: '.$Core->styleProperty('palette-secondary-color').';');
	$Core->Code('font-family: '.$Core->styleProperty('headling-font-family').';');
	$Core->Code('border-bottom: 5px solid '.$Core->styleProperty('palette-secondary-color').';');
$Core->Code('}');



$Core->Code('.box.ggn-lockbox  div.bl > div.blk > div.cell.content{');
	$Core->Code('padding:10px 15px;');
	$Core->Code('font-size:14px;');
	// $Core->Code('margin:auto;');
$Core->Code('}');






?>