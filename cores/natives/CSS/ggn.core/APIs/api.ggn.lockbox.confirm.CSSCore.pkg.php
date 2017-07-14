/* Fichier : Gougnon.CSS.lockbox.confirm.cssg, Nom : Gougnon CSS lockbox.confirm, version 0.0.1.141029.1216, site: http://Gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php
/* PARAMETRES */
require self::commonFile('.settings');






/* LockBox Confirm */

$Core->Code('div.box.ggn-lockbox.ggn-lockbox-confirm-locker > form > div.bl > div.blk > div.cell.content input[type="password"]');
$Core->Code(',div.box.ggn-lockbox.ggn-lockbox-confirm-locker > form > div.bl > div.blk > div.cell.content input[type="text"]{');
	$Core->Code('width:93%;');
	$Core->Code('padding-top:10px;');
	$Core->Code('padding-bottom:10px;');
	$Core->Code('font-size:15px;');
	$Core->Code('background-color:transparent;');
	$Core->Code('border:0px solid transparent;');
	$Core->Code('border-bottom:1px solid '.$Core->styleProperty('palette-primary-color').';');
$Core->Code('}');



$Core->Code('div.box.ggn-lockbox.ggn-lockbox-confirm-locker > form > div.bl > div.blk > div.cell.buttons{');
	$Core->Code('font-size:20px;');
	// $Core->Code('height:100%;');
	$Core->Code('margin:0px;');
	$Core->Code('padding:0px;');
	$Core->Code('text-align:center;');
	$Core->Code('vertical-align:middle;');
	$Core->Code('border-top: 1px solid rgba('.$Core->styleProperty('dark-font-color-rgb').',.15);');
$Core->Code('}');





$Core->Code('div.box.ggn-lockbox.ggn-lockbox-confirm-locker > form > div.bl > div.blk > div.cell.buttons > .button');
$Core->Code(',div.box.ggn-lockbox.ggn-lockbox-confirm-locker > form > div.bl > div.blk > div.cell.buttons > .button.active{');
	$Core->Code($textEllipsis);
	$Core->Code($Core::size('100%'));
	$Core->Code('margin:0px;');
	// $Core->Code('padding:10px 15px;');
	$Core->Code('cursor:pointer;');
	$Core->Code('border:0px solid !important;');
	$Core->Code('color: '.$Core->styleProperty('palette-primary-color').';');
	$Core->Code('font-size: 17px;');
	$Core->Code('font-family: '.$Core->styleProperty('headling-font-family').';');
	$Core->Code('background-color: transparent;');
	$Core->Code('border-right:1px solid rgba('.$Core->styleProperty('dark-font-color-rgb').',.1) !important;');
	$Core->Code($Core::browserKey('border-radius', '0px !important'));
	$Core->Code($Core::browserKey('transition', 'background-color 0.3s ease-in-out'));
$Core->Code('}');

$Core->Code('div.box.ggn-lockbox.ggn-lockbox-confirm-locker > form > div.bl > div.blk > div.cell.buttons > .button:last-child{');
	$Core->Code('border-right:0px solid !important;');
$Core->Code('}');


$Core->Code('div.box.ggn-lockbox.ggn-lockbox-confirm-locker > form > div.bl > div.blk > div.cell.buttons > .button.active');
$Core->Code(',div.box.ggn-lockbox.ggn-lockbox-confirm-locker > form > div.bl > div.blk > div.cell.buttons > .button:active');
$Core->Code(',div.box.ggn-lockbox.ggn-lockbox-confirm-locker > form > div.bl > div.blk > div.cell.buttons > .button:hover{');
	$Core->Code('color: '.$Core->styleProperty('font-color').';');
	$Core->Code('background-color: '.$Core->styleProperty('palette-primary-color').' !important;');
$Core->Code('}');


$Core->Code('div.box.ggn-lockbox.ggn-lockbox-confirm-locker > form > div.bl > div.blk > div.cell.buttons > .button.active{');
	// $Core->Code('background-color: rgba('.$Core->styleProperty('dark-background-color-rgb:hover').',.5);');
$Core->Code('}');





?>