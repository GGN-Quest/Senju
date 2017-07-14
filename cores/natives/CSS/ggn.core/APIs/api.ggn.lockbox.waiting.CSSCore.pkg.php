/* Fichier : Gougnon.CSS.lockbox.waiting.cssg, Nom : Gougnon CSS lockbox.waiting, version 0.0.1.141029.1216, site: http://Gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php
/* PARAMETRES */
require self::commonFile('.settings');




$Core->Code('div.box.ggn-lockbox.ggn-lockbox-waiting-locker > div.bl > div.blk > div.cell.content .waiting{');
	$Core->Code('display:flex;');
$Core->Code('}');

$Core->Code('div.box.ggn-lockbox.ggn-lockbox-waiting-locker > div.bl > div.blk > div.cell.content .waiting > .label{');
	$Core->Code('flex:1;');
	$Core->Code('font-size:20px;');
	$Core->Code('color:'.$Core->styleProperty('font-color').';');
	$Core->Code('font-family: '.$Core->styleProperty('headling-fontLight-family').';');
	$Core->Code('padding-left:10px;');
$Core->Code('}');



?>