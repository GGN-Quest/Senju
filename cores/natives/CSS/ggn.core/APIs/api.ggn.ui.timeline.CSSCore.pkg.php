/* Fichier : Gougnon.CSS.Styler.cssg, Nom : Gougnon CSS Styler, version 0.0.1.150303.1434, site: http://gougnon.com , Copyright 2013 GOBOU Y. Yannick */
<?php




/* PARAMETRES */
require self::commonFile('.settings');








/* Initialisation / DEBUT ////////////////////////////////////////// */

	$Core->selector('.ui-timeline'

		, [

		]

	);

/* Initialisation / FIN ////////////////////////////////////////// */






/* Vertical / DEBUT ////////////////////////////////////////// */

	$Core->selector('.ui-timeline-vertical .ui-timeline-line'

		, [

			'width'=> '3px'

			, 'background-color'=> $Core->styleProperty('background-color')

		]

	);

	$Core->selector('.ui-timeline-vertical .ui-timeline-details'

		, [

			'margin-left && margin-right'=> '-14px'

		]

	);

	$Core->selector('.ui-timeline-vertical .ui-timeline-details .ui-timeline-detail'

		, [

			'margin-top && margin-bottom'=> '10px'

		]

	);

	$Core->selector('.ui-timeline-vertical .ui-timeline-panel'

		, [

			'margin-left && margin-right'=> '16px'

			, 'background-color'=> 'rgba(' . $Core->styleProperty('background-color-rgb') . ',.4)'

		]

	);



	$Core->selector('.ui-timeline-vertical .ui-timeline-pointer'

		, [

			'width'=> '24px'

		]

	);

	$Core->selector('.ui-timeline-vertical .ui-timeline-pointer .ui-timeline-pointer-track'

		, [

			'width && height'=> '12px'

			, 'margin-top'=> '16px'

			, 'border-radius'=> '360%'

			, 'border'=> '6px solid ' . $Core->LDColor($Core->styleProperty('palette-primary-color'), -30)

			, 'background-color'=> $Core->styleProperty('palette-primary-color')

		]

	);


	$Core->selector(

			'.ui-timeline-vertical .ui-timeline-date-day'

			. ', .ui-timeline-vertical .ui-timeline-date-my'

			. ', .ui-timeline-vertical .ui-timeline-date-number'

		, [

			'text-align'=> 'center'

			// , 'color'=> $Core->styleProperty('palette-primary-color')

		]

	);


	$Core->selector('.ui-timeline-vertical .ui-timeline-date-day'

		, [

			'font-size'=> '14px'

		]

	);

	$Core->selector('.ui-timeline-vertical .ui-timeline-date-my'

		, [

			'font-size'=> '14px'

		]

	);

	$Core->selector('.ui-timeline-vertical .ui-timeline-date-number'

		, [

			'font-size'=> '48px'

		]

	);

	$Core->selector('.ui-timeline-vertical .ui-timeline-indicator-track'

		, [

			'border'=> '5px solid ' . $Core->styleProperty('palette-primary-color')

		]

	);

	$Core->selector('.ui-timeline-vertical .ui-timeline-info-title'

		, [

			'font-size'=> '18px'

		]

	);

	$Core->selector('.ui-timeline-vertical .ui-timeline-info-about'

		, [

			'font-size'=> '12px'

		]

	);

	$Core->selector('.ui-timeline-vertical .ui-timeline-info-sub'

		, [

			'font-size'=> '12px'

		]

	);

/* Vertical / FIN ////////////////////////////////////////// */

