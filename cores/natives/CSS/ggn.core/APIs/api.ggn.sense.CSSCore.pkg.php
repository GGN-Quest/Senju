/* Fichier : Gougnon.CSS.Sense.cssg, Nom : Gougnon CSS Sense, version 0.0.1.150303.1434, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');






$Core->selector('body,div'
	
	, [
	
		'text-transform' => 'uppercase'
	
	]

);






$Core->selector('.sense-junc-layout'
	
	, [

		'text-transform' => 'initial'
	
		, 'background-color' => '#282828'

		, 'width && height' => '128px'
	
	]

);






$Core->selector('.sense-moveobject-states'
	
	, [

		'background-color' => '' . $Core->styleProperty('palette-primary-color')

		, 'width && height' => '64px'

		, 'z-index' => '999999'

		, 'color' => '' . $Core->styleProperty('palette-dark-color')

		// , 'border' => '1px solid ' . $Core->styleProperty('palette-primary-color')
	
	]

);







$Core->selector('.sense-tool-btn'
	
	, [

		'border' => '0px solid transparent'

		, 'padding' => '4px'
	
	]

);


