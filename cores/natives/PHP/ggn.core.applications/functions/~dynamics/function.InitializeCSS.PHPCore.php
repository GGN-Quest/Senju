 <?php
	
	$return = false;

	if(isset($context->Main)){

		$CSSCore = $context->Core->CSS;



		if($context->Params->FullScreen===TRUE){
		}

			$context->Head->style([
				'html,body,.gui.sheet'=> [
					'height'=> '100%'
				]
			]);

			$context->Head->style([
				'body'=> [
					'overflow'=> 'hidden'
					,'position'=> 'fixed'
				]
			]);


			/* Splash Screen */
			$context->Head->style([

				'body > .splash-screen' => [
					'position'=>'fixed'
					,'left'=>'0px'
					,'top'=>'0px'
					,'width'=>'100vw'
					,'height'=>'100vh'
					,'background-color'=>$CSSCore->styleProperty('dark-background-color')
					,'z-index'=>'1000000 !important'
					,'overflow'=>'hidden'
				]

			, 'body > .splash-screen div.image' => []

			, 'body > .splash-screen div.label' => [
					'font-size'=>'2vw'
					, 'font-family'=>$CSSCore->styleProperty('headling-font-family')
					, 'opacity'=>'0.9'
				]

			, 'body > .splash-screen .ggn-splash-notice' => [
					'font-size'=>'12px'
					,'color'=>'rgba('.$CSSCore->styleProperty('font-color-rgb').',.3)'
					,'padding'=>'7px 10px'
					,'width'=>'250px'
					// ,'background-color'=>'rgba('.$CSSCore->styleProperty('font-color-rgb:hover').',.05)'
					// ,'border'=>'1px solid '.$CSSCore->styleProperty('font-color:hover').''
				]

			, 'body > .splash-screen .ggn-splash-notice-li' => [
					'font-size'=>'10px'
					,'padding'=>'5px 8px'
					,'width'=>'100px'
					,'color'=>'rgba('.$CSSCore->styleProperty('font-color-rgb').',.1)'
					// ,'background-color'=>'rgba('.$CSSCore->styleProperty('font-color-rgb:hover').',.1)'
				]

			]);

	}


?>