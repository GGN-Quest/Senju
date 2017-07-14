<?php

	$return = false;


	if(is_object($context)){

		/* Paramètres */
		$context->ParamsData = [

			/* Chaine de caractères */
			'Title'=>['type'=>'string', 'defaultValue'=>_GGN::varn('GAPPS_TITLE')]

			, 'Lang'=>['type'=>'string', 'defaultValue'=>'fr']
			
			, 'Shortcut'=>['type'=>'string', 'defaultValue'=>HTTP_HOST . 'favicon.png']
			
			, 'Viewport'=>['type'=>'string', 'defaultValue'=>'width=device-width,initial-scale=1']
			
			, 'Charset'=>['type'=>'string', 'defaultValue'=>'utf-8']
			





			/* Booleen */
			, 'ActiveSplashScreen'=>['type'=>'boolean', 'defaultValue'=>false]
			
			, 'ActiveStatutBar'=>['type'=>'boolean', 'defaultValue'=>true]

			, 'Responsivity'=>['type'=>'boolean', 'defaultValue'=>true]

			, 'FullScreen'=>['type'=>'boolean', 'jspkg'=>'ggn.application.fullscreen', 'csspkg'=>'ggn.application.fullscreen', 'defaultValue'=>false]
			
			, 'ActiveNavBar'=>['type'=>'boolean', 'jspkg'=>'ggn.application.navbar', 'csspkg'=>'ggn.application.navbar', 'defaultValue'=>true]
			




			/* Array */
			,'Icon'=>['type'=>'array', 'defaultValue'=>['normal'=>HTTP_HOST.'splash/ggn-apps.png', 'hover'=>HTTP_HOST.'splash/ggn-apps.png' ]]

			, 'SplashScreen'=>['type'=>'array', 'defaultValue'=>['type'=>'text/html', 'html'=>addslashes('<img src="'.HTTP_HOST.'splash/ggn-apps.png" />')]]
			// , 'SplashScreen'=>['type'=>'array', 'defaultValue'=>['type'=>'text/html', 'html'=>addslashes('<div class="gui loading circle x48"></div>')]]

			, 'NavBarMenu'=>['type'=>'array', 'defaultValue'=>[]]
			
			, 'NavBarTray'=>['type'=>'array', 'defaultValue'=>[]]





		];


		$return = true;
	}

?>