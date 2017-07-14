/* Fichier : Gougnon.CSS.Awake.Confirm.cssg, Nom : Gougnon CSS Framework, version 0.0.1.150303.1434, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');









$Core->selector('.ggn-messenger textarea'

	, [

		'resize'=>'none'
		
	]

);





/*

	Composeur Flottant // DEBUT //////////////////////////////////

*/

$Core->selector('.ggn-messenger.float-composer'

	, [

		'background-color'=>$Core->styleProperty('background-color:hover')
		
	]

);


$Core->selector('.ggn-messenger.float-composer .title .close'

	, [

		'border-bottom-left-radius'=>'5px'
		
	]

);


$Core->selector('.ggn-messenger.float-composer .container .editor'

	, [

		'margin && border-width && border-radius'=>'0px'
		
	]

);



$Core->selector('.ggn-messenger.float-composer .container .buttons .button'

	, [

		'margin && border-width && border-radius'=>'0px'
		
	]

);

/*

	Composeur Flottant // FIN //////////////////////////////////

*/





















/*

	Echanges de message : Dial Ease // FIN //////////////////////////////////

*/


/* Formulaire */
$Core->selector('.ggn-messenger.dial-ease > .form'

	, [

		'background-color'=>'rgba(0,0,0,.1)'

		,'transition'=>'background-color 0.3s ease'
			
	]

);

$Core->selector('.ggn-messenger.dial-ease > .form.focus'

	, [

		'background-color'=>'rgba(0,0,0,.25)'

		,'border'=>'1px solid ' . $Core->styleProperty('palette-primary-color')
			
	]

);

$Core->selector('.ggn-messenger.dial-ease > .form > .editor > .input '

	, [

		// 'white-space'=>'normal'

		'color'=>$Core->styleProperty('palette-light-color')

		,'background-color && border-color'=>'transparent'

		// ,'overflow-wrap && word-wrap'=>'break-word'
			
	]

);



/* Conteneur */
$Core->selector('.ggn-messenger.dial-ease > .container'

	, [

		'transition'=>'all 0.3s ease'
			
	]

);


/* Ecran */
$Core->selector('.ggn-messenger.dial-ease > .container > .screen '

	, [

		// 'transition'=>'all 0.3s ease'
			
	]

);


$Core->selector('.ggn-messenger.dial-ease > .container > .screen > .speecher'

	, [
			
	]

);

$Core->selector('.ggn-messenger.dial-ease > .container > .screen > .speecher.me > .thumb'

	, [

		'right'=>'-24px'

		,'margin-top'=>'10%'
			
	]

);

$Core->selector('.ggn-messenger.dial-ease > .container > .screen > .speecher.you > .thumb'

	, [

		'left'=>'-24px'

		,'margin-top'=>'10%'
			
	]

);


$Core->selector('.ggn-messenger.dial-ease > .container > .screen > .speecher.me'

	, [

		'margin-right'=>'6%'

		,'color'=> $Core->styleProperty('palette-light-color')

		,'background-color'=>'rgba(' . $Core->styleProperty('palette-light-color-rgb') . ',.16)'
			
	]

);

$Core->selector('.ggn-messenger.dial-ease > .container > .screen > .speecher.you'

	, [

		'margin-left'=>'6%'

		,'color'=> $Core->styleProperty('palette-dark-color')

		,'background-color'=>'' . $Core->styleProperty('palette-light-color') . ''
			
	]

);

/*

	Echanges de message : Dial Ease // FIN //////////////////////////////////

*/
