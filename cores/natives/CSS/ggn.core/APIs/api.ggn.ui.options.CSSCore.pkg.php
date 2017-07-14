<?php




/*

	GUI Options // DEBUT ////////////////////////////////////

*/

	$Core->selector('.ui-options-parent'

		, [

			'width'=>'100%'

			, 'height'=>'100%'

			, 'bottom && left'=>'0px'

		]

	);

	$Core->selector('.ui-options-parent.omni'

		, [

			'background-color'=>'#000 !important'

			// , 'height'=>'auto !important'

		]

	);

	$Core->selector('.ui-options-light'

		, [

			'background-color'=>'rgba(0,0,0,.80)'

			, 'width && height'=>'100%'

			, 'bottom && left'=>'0px'

		]

	);

	$Core->selector('.ui-options-parent.omni .ui-options-light'

		, [

			'display'=>'none !important'

		]

	);

	// $Core->selector('.ui-options-parent.opened .ui-options-light', ['animation'=>'ggnBlurMotionOut 300ms ease-out'] );

	// $Core->selector('.ui-options-parent.closed .ui-options-light', ['animation'=>'ggnBlurMotionIn 300ms ease-out'] );

	$Core->selector('.ui-options-container'

		, [

			'width'=>'100%'

			, 'min-height'=>'48px'

			, 'bottom && left'=>'0px'

			, 'background-color'=> $Core::LDColor($Core->StyleProperty('background-color'), -10)

			, 'color'=> $Core->StyleProperty('font-color')

		]

	);

	$Core->selector('.ui-options-container.ui-bx-focus'

		, [

			'color'=> $Core->StyleProperty('palette-light-color') . ' !important'

			, 'background-color'=> $Core->LDColor($Core->StyleProperty('palette-primary-color'), -40) . ' !important'

		]

	);



	$Core->selector('.ui-options-container.xBar, .ui-options-parent.omni.xBar', ['height'=>'48px'] );

	$Core->selector('.ui-options-container.xSection, .ui-options-parent.omni.xSection', ['height'=>'128px'] );

	$Core->selector('.ui-options-container.xSmall, .ui-options-parent.omni.xSmall', ['height'=>'30%'] );

	$Core->selector('.ui-options-container.xNormal, .ui-options-parent.omni.xNormal', ['height'=>'50%'] );

	$Core->selector('.ui-options-container.xLarge, .ui-options-parent.omni.xLarge', ['height'=>'80%'] );

	$Core->selector('.ui-options-container.xFull, .ui-options-parent.omni.xFull', ['height'=>'100%'] );


	$Core->selector('.ui-options-parent.opened .ui-options-container', ['animation'=>'UIFxOptionIn 300ms ease-out'] );

	$Core->selector('.ui-options-parent.closed .ui-options-container', ['animation'=>'UIFxOptionOut 300ms ease-in'] );


	// $Core->selector('.ui-options-title'

	// 	, [

	// 		// 'font-size'=>'24px'

	// 		// , 'font-family'=>$Core->StyleProperty('headling-fontLight-family')

	// 	]

	// );






	/* Animation / DEBUT */

		$Core->keyframes('UIFxOptionIn'
		
			, 
		
				'{0%{'
				
					. $Core::browserKey('transform','translateY(100%)') .
				
				'} 100%{' 
				
					. $Core::browserKey('transform','translateY(0%)') .
				
				'} }'
		
			, true
		
		);

		$Core->keyframes('UIFxOptionOut'
		
			, 
		
				'{0%{'
				
					. $Core::browserKey('transform','translateY(0%)') .
				
				'} 100%{' 
				
					. $Core::browserKey('transform','translateY(100%)') .
				
				'} }'
		
			, true
		
		);

	/* Animation / FIN */


/*

	GUI Options // DEBUT ////////////////////////////////////

*/


?>