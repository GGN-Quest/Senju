/* Fichier : Gougnon.CSS.Photo.cssg, Nom : Gougnon CSS Framework, version 0.0.1.150420.0934, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');



	



/*

	Photo : Wndoo // DEBUT
	
*/

	$Core->selector('.ggn-photo-wndoo'

		, [

			// ''=>''

		]

	);


	/* Navigation */
	$Core->selector('.ggn-photo-wndoo > .container .screen-image'

		, [

			'background-size' => 'auto 100%'

		]

	);



	/* Navigation */
	$Core->selector('.ggn-photo-wndoo > .container .navigate'

		, [

			'opacity' => '0'

		]

	);

	$Core->selector('.ggn-photo-wndoo > .container:hover .navigate'

		, [

			'color' => $Core->styleProperty('palette-light-color')

			,'background-color' => 'rgba(0,0,0,.2)'

			,'opacity' => '1'

		]

	);

	// $Core->selector('.ggn-photo-wndoo > .container .navigate:hover'

	// 	, [

	// 		'color' => $Core->styleProperty('palette-light-color')

	// 		,'background-color' => $Core->styleProperty('palette-primary-color')

	// 	]

	// );


	/* Navigation : Gauche */
	$Core->selector('.ggn-photo-wndoo > .container .navigate.left'

		, [

			'margin-left' => '-20px'

			,'top && left' => '0px'

		]

	);

	$Core->selector('.ggn-photo-wndoo > .container:hover .navigate.left'

		, [

			'margin-left' => '0px'

		]

	);


	/* Navigation : Droit */
	$Core->selector('.ggn-photo-wndoo > .container .navigate.right'

		, [

			'margin-right' => '-20px'

			,'top && right' => '0px'

		]

	);

	$Core->selector('.ggn-photo-wndoo > .container:hover .navigate.right'

		, [

			'margin-right' => '48px'

		]

	);



	/* Outils */

	$Core->selector('.ggn-photo-wndoo > .container .tools'

		, [

			'background-color'=>'rgba(0,0,0,.1)'

			,'right && top'=>'0px'

		]

	);

	$Core->selector('.ggn-photo-wndoo > .container:hover .tools'

		, [

			'background-color'=>'rgba(0,0,0,.43)'

		]

	);

	$Core->selector('.ggn-photo-wndoo > .container .tools > .tab'

		, [

			// 'display'=>'none'

		]

	);


	$Core->selector('.ggn-photo-wndoo > .container .tools:hover'

		, [

			'width'=>'320px'

			,'box-shadow'=>'10px 10px 20px 10px rgba(0,0,0,.75)'

		]

	);

	$Core->selector('.ggn-photo-wndoo > .container .tools:hover > .menu'

		, [

			'color'=>$Core->styleProperty('font-color')

			,'background-color'=>$Core->styleProperty('background-color:hover')

		]

	);

		$Core->selector('.ggn-photo-wndoo > .container .tools > .menu > .icon'

			, [

				'font-size'=>'16px'

				,'padding'=>'16px'

				// ,'cursor'=>'default'

			]

		);

		$Core->selector('.ggn-photo-wndoo > .container .tools > .menu > .icon.bg-primary'

			, [

				'color'=>$Core->styleProperty('palette-light-color')

			]

		);





	$Core->selector('.ggn-photo-wndoo > .container .tools:hover > .tab'

		, [

			'color'=>$Core->styleProperty('font-color')

			// ,'display'=>'block'

			,'background-color'=>$Core->styleProperty('background-color')

		]

	);


/*

	Photo : Wndoo // FIN
	
*/
