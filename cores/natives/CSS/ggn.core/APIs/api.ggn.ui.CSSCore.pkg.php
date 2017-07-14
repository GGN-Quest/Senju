/* Fichier : Gougnon.CSS.UI.cssg, Nom : Gougnon CSS Framework, version 0.0.2.160611.1005, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');






/*

	GUI Wndoo // DEBUT ////////////////////////////////////

*/


	/*

		Wndoo : Normal // DEBUT
		
	*/

	$Core->selector('.ggn-ui-wndoo > .head'

		, [

			'z-index'=>'10'

			// ,'box-shadow'=>'0px 0px 10px rgba(0,0,0,.3)'
			
		]

	);


	$Core->selector('.ggn-ui-wndoo > .head .btn-submit'

		, [

			'color'=>'' . $Core->styleProperty('palette-light-color') . ''

			,'background-color'=>'rgba(' . $Core->styleProperty('palette-dark-color-rgb') . ',.1)'
			
		]

	);


	$Core->selector('.ggn-ui-wndoo > .head .btn-close'

		, [

			// 'color'=>'' . $Core->styleProperty('notice-error-color') . ''

			// ,'background-color'=>'' . $Core->styleProperty('notice-error-background-color') . ''
			
		]

	);

	$Core->selector('.ggn-ui-wndoo > .head .btn-close:hover'

		, [

			'color'=>'#fff'

			,'background-color'=>'' . $Core->LDColor($Core->styleProperty('notice-error-background-color'), -20) . ''
			
		]

	);






	/* Zone de chargement / DEBUT */

		$Core->selector('.ggn-ui-wndoo > .loader'

			, [

				'width'=>'100%'

				, 'height'=>'0px'
			]

		);

	/* Zone de chargement / FIN */






	/* Zone de treatement */
	$Core->selector('.ggn-ui-wndoo > .uhead > .uh'

		, [

			'height'=>'0px'

		]

	);

	$Core->selector('.ggn-ui-wndoo > .uhead > .uh.open'

		, [

			'height'=>'256px'

		]

	);




	/* Outils */
	$Core->selector('.ggn-ui-wndoo > .uhead > .tools a'

		, [

			'color'=>$Core->styleProperty('palette-light-color')

		]

		);


		$Core->selector('.ggn-ui-wndoo > .uhead > .tools > .tool'

			, [

				'padding'=>'9px 16px'

				,'border-radius'=>'0px'

				,'transition'=>'all 300ms ease'

			]

		);

		$Core->selector('.ggn-ui-wndoo > .uhead > .tools > .tool .icon:nth-child(0)'

			, [

				'padding-left'=>'8px'

			]

		);

		$Core->selector('.ggn-ui-wndoo > .uhead > .tools > .tool .icon:nth-child(1)'

			, [

				'padding-right'=>'8px'

			]

		);

		$Core->selector(

				'.ggn-ui-wndoo > .uhead > .tools > .tool:hover:not(.label)'

				.',.ggn-ui-wndoo > .uhead > .tools > .tool.active'

			, [

				'background-color'=>'rgba(0,0,0,.2)'

			]

		);

	
	/*

		Wndoo : Normal // FIN
		
	*/


/*

	GUI Wndoo // FIN ////////////////////////////////////

*/


