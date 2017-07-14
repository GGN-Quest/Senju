/* Fichier : Gougnon.CSS.Awake.Confirm.cssg, Nom : Gougnon CSS Framework, version 0.0.1.150303.1434, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');









$Core->selector('.gui.awake-api-encompass > .container > .content  .awk-confirm'

	, [

		'box-shadow'=>'0px 0px 7px rgba(0,0,0,.5)'
		
	]

);




$Core->selector('.gui.awake-api-encompass > .container > .content  .awk-confirm > .title'

	, [

		// 'padding'=>'7px 12px'

		'background-color'=> $Core->styleProperty('palette-primary-color')

		, 'color'=> $Core->styleProperty('palette-light-color')

		// ,'border-bottom'=>'5px solid ' . $Core->styleProperty('palette-primary-color')

	]

);




$Core->selector('.gui.awake-api-encompass > .container > .content  .awk-confirm > .content'

	, [

		'flex'=>'1'

	]

);




$Core->selector('.gui.awake-api-encompass > .container > .content  .awk-confirm > .content .textual'

	, [

		'padding'=>'10px 15px'

	]

);




$Core->selector('.gui.awake-api-encompass > .container > .content  .awk-confirm > .buttons'

	, [

		'border-top'=>'1px solid rgba(' . $Core->styleProperty('palette-light-color-rgb') . ',.05)'

	]

);




$Core->selector('.gui.awake-api-encompass > .container > .content  .awk-confirm > .buttons > .button'

	, [

		'flex'=>'1'

		,'border-radius'=>'0px'

		,'background-color && border-color'=>'transparent'

	]

);

$Core->selector('.gui.awake-api-encompass > .container > .content  .awk-confirm > .buttons > .button.active'

	, [

		'background-color && border-color'=> $Core->styleProperty('palette-primary-color')

	]

);




$Core->selector('.gui.awake-api-encompass > .container > .content  .awk-confirm .content textarea'

	, [

		'resize'=> 'none'

	]

);


$Core->selector(

		'.gui.awake-api-encompass > .container > .content  .awk-confirm .content .field-input'

	, [

		'background-color'=> 'rgba(255,255,255,.02)'

		,'border'=>'0px solid'

		,'border-radius'=> '0px'

		,'width'=> '100%'

		,'margin-top'=> '3px'

	]

);

$Core->selector(

		'.gui.awake-api-encompass > .container > .content  .awk-confirm .content .field-input > *'

	, [

		'color'=> $Core->styleProperty('palette-light-color')

	]

);

// $Core->selector(

// 		'.gui.awake-api-encompass > .container > .content  .awk-confirm .content .field-input > input'

// 		.',.gui.awake-api-encompass > .container > .content  .awk-confirm .content .field-input > textarea'

// 	, [

// 		'flex'=> '1 auto'

// 	]

// );


$Core->selector(

		'.gui.awake-api-encompass > .container > .content  .awk-confirm .content .field-input:hover'

	, [

		'background-color'=>'rgba(255,255,255,.05)'

	]

);
