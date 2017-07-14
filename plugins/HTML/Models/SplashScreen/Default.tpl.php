<?php 
/*
	
	Copyright GOBOU Yannick

	version : 0.1
	update : 160903.2207

*/


	


	/* Version de votre application */
	$version = isset($version) && is_string($version) ? $version: '';
	


	/* Version de votre application */
	$label = isset($label) && is_string($label) ? $label: '';


	/* Style du claque global */
	$style = isset($style) && is_string($style) ? $style: 'bg-primary color-light-l';


	/* Déclencher le 'OUT' à la fin du chargement de la page */
	$triggerOut = isset($triggerOut) && is_bool($triggerOut) ? $triggerOut: true;











	/*
		CSS
	*/
		
	$css('#ggn-splash-screen'

		,[

			'display'=>['-webkit-flex', 'flex']

			,'width && height'=>'100%'

			// ,'min-width'=>'100vw'

			// ,'min-height'=>'100vh'

			,'background-color'=>'white'

			,'position'=>'fixed'

			,'top && left'=>'0px'

			,'z-index'=>'999999'

			,'opacity'=>'1'

		]

	);


	$css('#ggn-splash-screen > .global-label'

		,[

			'margin'=>'auto'

			// ,'width && height'=>'100%'

		]

	);


	$css('#ggn-splash-screen > .global-version'

		,[

			'position'=>'absolute'

			,'left'=>'0px'

			,'bottom'=>'0px'

			,'width'=>'inherit'

		]

	);





	/*
		Box principal
	*/
		
	$html('<div class="' . $style . ' gui-fx" id="ggn-splash-screen" >');


		$html('<div class="global-label" >');

			$html( $label );

		$html('</div>');

		$html('<div class="global-version" >' . $version . '</div>');

	$html('</div>');





	/*
		JavaScript
	*/
		
	$js('(function(W,G){');

		$js('var bx=G("#ggn-splash-screen"),bdy=G("body");');

		$js('var oflx = bdy.css("overflow-x");');

		$js('var ofly = bdy.css("overflow-y");');


		$js('W.GGNSplashScreenOut = function(){');

			$js('bx.opacity(0.01);');

			$js('bx.css({opacity:"0"});');

			$js('G(function(){');

				$js('bx.remove();');

				$js('bdy.css({"overflow-x":oflx, "overflow-y":ofly});');

			$js('}).timeout(G.CATs||500);');
			
		$js('};');



		$js('W.GGNSplashScreenTrigger = function(){');


			$js('bdy.css({"overflow-x":"hidden", "overflow-y":"hidden"});');


			if($triggerOut === true){

				$js('GEvent(W).listen("load", function(){');

					$js('G(function(){ GGNSplashScreenOut(); }).timeout(500);');
					
				$js('});');

			}



		$js('};');

		$js('return W;');

	$js('})(window,G).GGNSplashScreenTrigger();');







?>