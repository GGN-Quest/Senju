<?php




/*

	GUI Setup // DEBUT ////////////////////////////////////

*/


	$Core->selector('.ui-setup-item'

		, [

			'opacity'=>'0.0001 !important'

			,'transform'=>'translateY(30%) translateX(30%) !important'
			
			,'transition'=>'all 300ms ease-out !important'

		]

	);

	$Core->selector('.ui-setup-item.axe-x'

		, [

			'opacity'=>'0.0001 !important'

			,'transform'=>'translateX(30%) !important'

		]

	);

	$Core->selector('.ui-setup-item.axe-y'

		, [

			'opacity'=>'0.0001 !important'

			,'transform'=>'translateY(30%) !important'

		]

	);




	$Core->selector(

			'.ui-setup-item.setup-show'

		, [

			'opacity'=>'1 !important'

			,'transform'=>'translateY(0%) translateX(0%) !important'

		]

	);


	$Core->selector('.ui-setup-item.setup-out.axe-x'

		, [

			'opacity'=>'0.0001 !important'

			,'transform'=>'translateX(-30%) !important'

		]

	);

	$Core->selector('.ui-setup-item.setup-out.axe-y'

		, [

			'opacity'=>'0.0001 !important'

			,'transform'=>'translateY(-30%) !important'

		]

	);


/*

	GUI Setup // DEBUT ////////////////////////////////////

*/


?>