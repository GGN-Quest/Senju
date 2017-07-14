<?php


/* PARAMETRES */
require self::commonFile('.settings');






$Core->Code(/* Fichier : Gougnon.CSS.Photo.cssg, Nom : Gougnon CSS Framework, version 0.0.1.150420.0934, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */);
	



/*

	PhotoShot : Viewer // DEBUT
	
*/

	$Core->selector('.ggn-photoshot-viewer .container .item .over-tag'

		, [

			'width && height'=>'100%'

			,'background-color'=>'transparent'

		]

	);

	$Core->selector('.ggn-photoshot-viewer .container .item .over-tag .iconx'

		, [

			'transform'=>'scale(10)'

			,'opacity'=>'0.1'

		]

	);


	$Core->selector(

			'.ggn-photoshot-viewer .container .item:hover .over-tag .iconx:after'

			.',.ggn-photoshot-viewer .container .item:focus .over-tag .iconx:after'

		, [

			'content'=>'"zoom_in"'

		]

	);


	$Core->selector(

			'.ggn-photoshot-viewer .container .item:hover .over-tag'

			.',.ggn-photoshot-viewer .container .item:focus .over-tag'

		, [

			'background-color'=>'rgba(0,0,0,.75)'

		]

	);

	$Core->selector(

			'.ggn-photoshot-viewer .container .item:hover .over-tag .iconx'

			.',.ggn-photoshot-viewer .container .item:focus .over-tag .iconx'

		, [

			'transform'=>'scale(1)'

			,'opacity'=>'1'

		]

	);






	$Core->selector(

			'.ggn-photoshot-viewer .details .browser'

			.',.ggn-photoshot-viewer .details .closer'

		, [

			'top'=>'0px'

			,'background-color'=>'rgba(' . $Core->styleProperty('palette-primary-color-rgb') . ',.32)'

		]

	);

	$Core->selector('.ggn-photoshot-viewer .details .closer'

		, [

			'left'=>'60px'

		]

	);

	$Core->selector('.ggn-photoshot-viewer .details .browser:hover'

		, [

			'background-color'=>$Core->styleProperty('palette-primary-color')

		]

	);

	$Core->selector('.ggn-photoshot-viewer .details .closer:hover'

		, [

			'background-color'=>$Core->styleProperty('notice-error-background-color')

		]

	);

	$Core->selector('.ggn-photoshot-viewer .details .browser.next'

		, [

			'right'=>'0px'

		]

	);

	$Core->selector('.ggn-photoshot-viewer .details .browser.prev'

		, [

			'left'=>'0px'

		]

	);


	$Core->selector('.ggn-photoshot-viewer .details .infos'

		, [

			'background'=>$Core->backgroundGradientValue('transparent 5%, ' . $Core->styleProperty('palette-primary-color') . ' ')

		]

	);


/*

	PhotoShot : Viewer // FIN
	
*/
