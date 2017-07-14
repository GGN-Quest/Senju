/* Fichier : Gougnon.CSS.Ressources.cssg, Nom : Gougnon CSS Framework, version 0.0.1.150420.0934, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');








/* UI */
$Core->selector('.ggn-rsrc-ui'

	, [
		
	]

);



/* Items des importations */
$Core->selector('.ggn-rsrc-ui .import-items'

	, [

		// ''=>''
		
	]

);

$Core->selector('.ggn-rsrc-ui .import-items > .item'

	, [

		// ''=>''
		
	]

);

$Core->selector('.ggn-rsrc-ui .import-items > .item > .thumb'

	, [

		'background-color'=> 'rgba(' . $Core->styleProperty('palette-dark-color-rgb') . ',.3)'

		,'background-repeat'=> 'no-repeat'

		,'background-position'=> 'center'

		,'background-size'=> '100%'
		
	]

);

$Core->selector('.ggn-rsrc-ui .import-items > .item > .progress > .bar'

	, [

		'background-color'=>'rgba(255,255,255,.3)'

		,'height'=>'7px'

		,'overflow'=>'hidden'
		
	]

);

$Core->selector('.ggn-rsrc-ui .import-items > .item > .progress > .bar > .track'

	, [

		'background-color'=>'#fff'
		
	]

);





/* Formulaire d'importation  */
$Core->selector('.ggn-rsrc-ui-import-form'

	, [

		// ''=>''
		
	]

);

$Core->selector('.ggn-rsrc-ui-import-form > .choose'

	, [

		'background-color'=>'rgba(0,0,0,.2)'
		
	]

);
