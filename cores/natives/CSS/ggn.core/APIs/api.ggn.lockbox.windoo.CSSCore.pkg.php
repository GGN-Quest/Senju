/* Fichier : Gougnon.CSS.lockbox.waiting.cssg, Nom : Gougnon CSS lockbox.waiting, version 0.0.1.141029.1216, site: http://Gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php
/* PARAMETRES */
require self::commonFile('.settings');



/* ============= LockBox Windoo */
$Core->selector('.big.ggn-lockbox-windoo-locker.ggn-lockbox[gui-api="g.lockbox"]'
	, []
);

$Core->selector('.light.ggn-lockbox-windoo-locker.ggn-lockbox[gui-api-lockbox="ultra.light"]'
	, []
);

// $Core->selector('.box.ggn-lockbox-windoo-locker.ggn-lockbox[gui-api-lockbox="ultra.box"]'
// 	, [
// 		'background-color'=>'#e0e0e0'
// 		,'border-top'=>'3px solid #fff'
// 	]
// );


/* BOX */
$Core->selector('.box.ggn-lockbox-windoo-locker.ggn-lockbox  div.bl'
	, [
		'display'=>'block'
		,'height'=>'inherit'
	]
);


$Core->selector('.box.ggn-lockbox-windoo-locker.ggn-lockbox  div.bl > div.blk'
	, [
		'display'=>'block'
	]
);

$Core->selector(
		'.box.ggn-lockbox.ggn-lockbox-windoo-locker  div.bl > div.blk > div.cell.title'
		. ',.box.ggn-lockbox.ggn-lockbox-windoo-locker  div.bl > div.blk > div.cell.content'
	, [
		'display'=>'block'
	]
);

$Core->selector('.box.ggn-lockbox-windoo-locker.ggn-lockbox  div.bl > div.blk.header > div.cell.title'
	, [
		'font-size'=>'15px'
		,'text-align'=>'left'
		,'padding'=>'10px 20px'
		,'height'=>'20px'
		,'color'=>$Core->styleProperty('font-color')
	]
);

$Core->selector('.box.ggn-lockbox-windoo-locker.ggn-lockbox  div.bl > div.blk.header > div.cell.title > div.closer'
	, [
		'float'=>'right'
		,'font-size'=>'12px'
		,'text-align'=>'center'
		,'color'=>$Core->styleProperty('dark-font-color')
		,'cursor'=>'pointer'
	]
);

$Core->selector('.box.ggn-lockbox-windoo-locker.ggn-lockbox  div.bl > div.blk.body', ['height'=>'inherit']);


$Core->selector('.box.ggn-lockbox-windoo-locker.ggn-lockbox  div.bl > div.blk > div.cell.content'
	, [
		'vertical-align'=>'top'
		,'padding && margin'=>'0px'
		,'height'=>'inherit'
		,'overflow'=>'auto'
	]
);







?>