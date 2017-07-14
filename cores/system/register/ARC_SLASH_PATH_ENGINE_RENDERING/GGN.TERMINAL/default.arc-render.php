<?php


/*
	Copyright GOBOU Y. Yannick
	
*/
	
namespace GGN\DPO;


if(!class_exists('\GGN\Path\Invoke')){

	new \GGN\Using('Path');

}



	if(!is_array($this->USER)){

		header("location:" . \_GGN::setvar(\_GGN::varn('LOGIN_PAGE')) . "?next=" . urlencode(\Gougnon::currentURL()) . "&");

		exit;

	}


	if($this->USER['ACCOUNT_TYPE'] < 4){

		$this->eventOn('ERROR.403', 'ggn.terminal:denied');

		$this->close();

	}




	/* Paramètres / DEBUT /////////////////////////////////////////////////// */

		$Settings = [];

		$Settings['display'] = \Register::_REQUEST('display', false);

		$Settings['macro'] = \Register::_REQUEST('macro', false);

	/* Paramètres / FIN /////////////////////////////////////////////////// */









$_TITLE = \GSystem::TERMINAL_TITLE;

	$TTL = explode(' ', $_TITLE);

$_TITLE_TAG = $TTL[0] . ' <span class="mac gui-fx">' . implode(' ', \Gougnon::arrayValues($TTL, 1)) . '</span>';






/* Exception dans la gestion des jetons de sécurité / DEBUT */
	
	$RegisterException = \RegisterSecure::TokenException('ggn.terminal.com.service.token', 'com.services/ggn.terminal/do.command');
	
	if(!$RegisterException){

		\_GGN::wCnsl('<h1>Erreur Jéton d\'autorisation</h1>Impossible de créer le jéton');

	}

/* Exception dans la gestion des jetons de sécurité / FIN */






/* DPO */

global $_DPO_DEVICE;

new Using('DPO\Page');

new Using('DPO\Procedure');

new Using('DPO\Theme');






/* Plugins */

new \GGN\Using('Plugins');

// new \GGN\Using('String');

new \GGN\Plugin\HTML('Models');









/* 
	Initialisation du Theme 
*/

	$tpl = new Theme\Custom();


	$tpl->Register = $this;


	$tpl->InitializeCores();



	$tpl->title = $_TITLE;


	$tpl->style = \GSystem::TERMINAL_STYLE;






	/* 
		Chemin des données
	*/
	$tpl->_path = 'ggn.terminal/';
	

	/* 
		URL des données
	*/
	$tpl->_url = \HTTP_HOST . $tpl->_path;
	




	/* Noyau CSS*/
	$tpl->Cores->CSS->Style($tpl->style);




	/* 
		Le Doctype de la page
	 */
	$tpl->doctype('html');




	/* 
		Pour les Meta de Google Plus
	 */

	$tpl->html('itemscope', '');

	$tpl->html('itemtype', 'http://schema.org/Other');




	/* 
		Paramètres de la page
	 */
	$tpl->settings = new Theme\Settings();
	
	$tpl->settings->add('context.menu', true)->add('responsive', true);





	/* 
		Création de l'entete de la page
	 */
	$tpl->head = new Theme\Head();


		/* 
			Titre de la page
		 */
		/* Debut de la sequence 'Head' */
		$tpl->head
			
			->title(isset($tpl->title) ? $tpl->title : \_GGN::varn('HOMEPAGE_TITLE'))

			/* 
				Favicone 
			*/
			->shortcut( \_GGN::setvar(\_GGN::varn('FAVICON')) )


			/* 
				Balise Meta dans le 'head'
			*/
			->meta('charset', 'utf-8')
			
			->meta('http-equiv', 'pragma', 'cache')
			
			->meta('name', 'mobile-web-app-capable', 'yes')
			
			->meta('name', 'viewport', 'width=device-width,initial-scale=1, maximum-scale=1.0, user-scalable=no')


			->meta('name', 'theme-color', $tpl->Cores->CSS->styleProperty('palette-primary-color'))


			->meta('name', 'msapplication-navbutton-color', $tpl->Cores->CSS->styleProperty('palette-primary-color'))


			->meta('name', 'apple-mobile-web-app-capable', 'yes')

			->meta('name', 'apple-mobile-web-app-status-bar-style', 'black-translucent')
		



			/* Meta de référencement */

			// ->meta('name', 'google-site-verification', "")
			
			->meta('name', 'Description', "Terminal d'administration de GGN")

			->meta('name', 'Robots', "all")

			->meta('name', 'Author', "GGN Frameworks")

			->meta('name', 'Copyright', "2016 GGN Lab.")


		
		
			/* Meta Facebook */
			
			->meta('property', 'og:title', \_GGN::varn('SITENAME'))
			
			->meta('property', 'og:image', \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=310&height=310&resize=true&resizeby=0&quality=-high')
			
			->meta('property', 'og:site_name', \_GGN::varn('SITENAME') )
			
			->meta('property', 'og:description', "Terminal d'administration de GGN")
			
		
		
		
			/* Meta Google Plus */
			
			->meta('itemprop', 'name', \_GGN::varn('SITENAME'))
			
			->meta('itemprop', 'description', "Terminal d'administration de GGN")
			
			->meta('itemprop', 'image', \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=310&height=310&resize=true&resizeby=0&quality=-high')
			
		
			



			/* Favicones */
			
			->meta('name', 'msapplication-square70x70logo', '' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=70&height=70&resize=true&resizeby=0&quality=-high')

			->meta('name', 'msapplication-square150x150logo', '' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=150&height=150&resize=true&resizeby=0&quality=-high')
			
			->meta('name', 'msapplication-square310x310logo', '' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=310&height=310&resize=true&resizeby=0&quality=-high')


			->link(['rel'=>'apple-touch-icon','sizes'=>'48x48','href'=>'' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=48&height=48&resize=true&resizeby=0&quality=-high'])

			->link(['rel'=>'apple-touch-icon','sizes'=>'64x64','href'=>'' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=64&height=64&resize=true&resizeby=0&quality=-high'])

			->link(['rel'=>'apple-touch-icon','sizes'=>'76x76','href'=>'' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=76&height=76&resize=true&resizeby=0&quality=-high'])

			->link(['rel'=>'apple-touch-icon','sizes'=>'120x120','href'=>'' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=120&height=120&resize=true&resizeby=0&quality=-high'])

			->link(['rel'=>'apple-touch-icon','sizes'=>'152x152','href'=>'' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=152&height=152&resize=true&resizeby=0&quality=-high'])

			->link(['rel'=>'apple-touch-icon','sizes'=>'192x192','href'=>'' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=192&height=192&resize=true&resizeby=0&quality=-high'])

			->link(['rel'=>'apple-touch-icon','sizes'=>'196x196','href'=>'' . \_GGN::setvar(\_GGN::varn('FAVICON')) . '?mode=-gd&width=196&height=196&resize=true&resizeby=0&quality=-high'])






			/* 
				Framework CSS
			*/

			/* Packges de la page */
			->cssPackages([

				'ggn.awake.confirm'

				,'ggn.icons'

			])


			/* Style Externe */
			->link($tpl->_url . 'init.css?style=' . $tpl->style)



			/* Ajout de Polices */
			->font('roboto.thin')

			->font('roboto.bold')

			->font('roboto.black')

			->font('roboto.condensed.regular')



			/* Style Interne */
			// ->css('')


			/* 
				Code CSS
			*/
			->style(

				[

					'html,body,.gui.sheet'=>[

						'height'=>'100%'

					]

				]

			)




			/* 
				Framework JS
			*/

			->jsPackages([

				'ggn.com.service'

				,'ggn.terminal'

				,'ggn.key.shot'

				,'ggn.awake.confirm'
				
			])

			

			/* 
				Fichier JS
			*/

			->script($tpl->_url . 'init.js?style=' . $tpl->style)
			



			/* 
				Code JS interne
			*/

			// ->js()





			->write('<base href="'.HTTP_HOST.'" target="_self">')


	/* Fermeture de la sequence 'Head' */
	;







/* 
	Fichier Hote 
*/

$tpl->host = '';







/* Corps de la page */
$tpl->body = new Theme\Body([

	'class'=>'disable-scrollbar '
	// 'class'=>'disable-x-scrollbar ' . ($_DPO_DEVICE->current=='-c'? '': 'scroll-on-mobile')

]);



	$tpl->body->sheet = new Theme\Tag([

		'class'=>'gui sheet'

	]);



	// $tpl->body->ProcessTag = new Theme\Tag([

	// 	'id'=>'process-tag'

	// 	,'class'=>'pos-absolute vw10 process-tag prc-close  gui flex column gui-fx'

	// ]);


	$tpl->body->sheet->node->Face = new Theme\Tag([

		'class'=>'vw10 vh10 disable-scrollbar ter-face fs gui flex column gui-fx'

	]);
	
	










/* Entete : debut */

	$header = new Theme\Tag([

		'id'=>'header'

		,'tag'=>'header'

		,'class'=>'app-header gui flex col-0 wrap end column gui-fx'

	]);


	
	$header->node->Titre = (new Theme\Tag(['class'=>'title text-thin text-upper text-spacing-ml color-primary gui-fx', 'id'=>'app-title']))

		// ->text('GGN <span class="mac gui-fx">Terminal</span>')

		->text($_TITLE_TAG)

	;


	
	$header->node->ModBar = (new Theme\Tag(['class'=>'mod text-spacing-ml text-upper gui-fx text-left gui flex start ']))

		->text('<div id="waiting" class="disable gui loading circle x16 margin-t-x4 margin-r-x8"></div>')

		->text('<div id="cmd-mod-status" class="disable"></div>')

		->text('<div id="cmd-mod" class="col-0">Bienvenue</div>')


	;



	$tpl->body->sheet->node->Face->node->header = $header;

/* Entete : fin */











/* Corps : debut */

	$Corps = new Theme\Tag([

		'id'=>'cmd-corps'

		,'class'=>'corps gui-fx gui pos-relative'

	]);


	$Corps->node->ProcessTag = new Theme\Tag([

		'id'=>'process-tag'

		,'class'=>'pos-absolute vw10 process-tag prc-close gui flex column gui-fx'

	]);


	
	$Corps->node->Content = (new Theme\Tag(['class'=>'console gui-fx']))

		->text('')

	;



	$tpl->body->sheet->node->Face->node->Corps = $Corps;

/* Corps : fin */











/* Entree Commande : debut */

	$CMDInput = new Theme\Tag([

		'id'=>'cmd-input'

		,'class'=>'cmd-input gui flex start row gui-fx'

	]);



	$CMDInput->node->Field = (new Theme\Tag(['class'=>'field gui flex row col-0 gui-fx']))

		// ->text('<div class="gui icon iconx">person</div>')

		->text('<span class="username gui-fx">' . ucfirst($this->USER['USERNAME']) . ' </span>')

		->text('<div class="gui icon iconx">keyboard_arrow_right</div>')

		->text('<div class="col-0 gui flex row"><form action="#" class="cmd-composer _w10" onsubmit="return false;"><input type="text" name="cmd" class="composer _w10 color-primary gui-fx" placeholder="Entrez une Commande" required> <input type="hidden" name="operator-name" value="' . \GSystem::TERMINAL_NAME . '"> <input type="hidden" name="operator-version" value="' . \GSystem::TERMINAL_VERSION . '" > <input type="hidden" name="operator-update-version" value="' . \GSystem::TERMINAL_UPDATE_VERSION . '" > <input type="hidden" name="operator-key" value="' . \GSystem::TERMINAL_KEY . '" > <input type="hidden" name="operator-title" value="' . \GSystem::TERMINAL_TITLE . '" > <input type="hidden" name="operator-style" value="' . \GSystem::TERMINAL_STYLE . '" > <input type="submit" value="" class="disable"> <input type="hidden" name="ggn-registry-token-exception" value="' . $RegisterException[0] . '" > <input type="hidden" name="ggn-registry-token-exception-key" value="' . $RegisterException[1] . '" > <input type="submit" value="" class="disable"></form></div>')

	;



	$tpl->body->sheet->node->Face->node->CMDInput = $CMDInput;

/* Entree Commande : fin */









/* Splash Screen / DEBUT */

	$Splash = new \GGN\Plugin\HTML\Model\Brick(

		'SplashScreen/Default'

		, [ 

			'triggerOut' => false

			, 'style' => 'bg-dark color-light-l'

			, 'label' => '<div class="gui flex column"> <div class="text-x32 text-thin text-left vw9" >' . $_TITLE_TAG . '</div><div class="text-left text-x20 gui flex column vw9"><div class="" id="ggn-splash-screen-loader-label">Initialisation...</div><div class="gui loading circle x32 light padding-lr-x12 margin-t-x8" ></div></div></div>'

			, 'version' => '<div class="text-left text-x16  padding-lr-x32">Version ' . \GSystem::TERMINAL_VERSION . '</div> <div class="text-left text-x12 padding-b-x28 opacity-x60 padding-lr-x32">Mise à jour ' . \GSystem::TERMINAL_UPDATE_VERSION . '</div>'

			// ,'CSSCore' => $tpl->Cores->CSS

		]

	);



	$tpl->head->style($Splash->css);

	$tpl->body->write($Splash->html);

	$tpl->body->js($Splash->js);

/* Splash Screen / FIN */









/* Dernier Traitement / DEBUT //////////////////////////////////////// */



	/* Affichage : Max / DEBUT //////////////////////////////////////// */

		if($Settings['display'] == 'max'){

			$tpl->body->sheet->node->Face->node->header->addClass('disable');

			$tpl->body->sheet->node->Face->node->CMDInput->addClass('disable');

			$tpl->body->sheet->node->Face->removeClass('fs')->addClass('fu');


			$tpl->body->js('GEvent(window).listen("load", function(){');

				$tpl->body->js('(function(G){');

					$tpl->body->js('GScript.check("GTerminal", function(){');

						$tpl->body->js('GTerminal.Get.T.Console("<div class=\'h4 padding-tb-x12 padding-lr-x16\'>GGN Terminal ' . \GSystem::TERMINAL_VERSION . ' </div>");');

						// $tpl->body->js('GTerminal.Get.T.Console("<div class=\'h5\'>Affichage : Maximisé</div>");');

					$tpl->body->js('});');

				$tpl->body->js('})(G);');


				$tpl->body->js('(function(Toast){');

					$tpl->body->js('Toast({title:"GGN Terminal", text:"Affichage : Maximisé", delay:2000}).bubble();');

				$tpl->body->js('})(GToast);');


			$tpl->body->js('});');

		}

	/* Affichage : Max / FIN //////////////////////////////////////// */





	/* Execution : Macro (Ensemble de line de commande) / DEBUT //////////////////////////////////////// */

		if(is_string($Settings['macro']) || is_array($Settings['macro'])){


			$xMacro = [];

			$aMacro = (is_string($Settings['macro']) ? [$Settings['macro']] : $Settings['macro']);


				foreach ($aMacro as $key => $Macro) {

					if(!\Gougnon::isEmpty($Macro)){

						$xMacro[] = [$key=>$Macro, 'time'=> time()];

					}
					
				}


			$jMacro = json_encode( $xMacro, \GStorages::JSON_OPT());

			// $xMacro = json_encode( (is_string($Settings['macro']) ? [$Settings['macro']] : $Settings['macro']), \GStorages::JSON_OPT());
			

			$tpl->body->js('GEvent(window).listen("load", function(){');

				$tpl->body->js('(function(){');

					$tpl->body->js('GScript.check("GTerminal", function(){');


						$tpl->body->js('GTerminal.Get.InstanceUsed = true;');

						$tpl->body->js('G(function(){var Ter = GTerminal.Get;');

							$tpl->body->js('Ter.StateMacro(' . $jMacro . ');');

							$tpl->body->js('Ter.PlayMacro();');

						$tpl->body->js('}).timeout(500);');


					$tpl->body->js('});');

				$tpl->body->js('})();');

			$tpl->body->js('});');
			

		}

	/* Execution : Macro (Ensemble de line de commande) / FIN //////////////////////////////////////// */



/* Dernier Traitement / FIN //////////////////////////////////////// */











/* Page */

$page = new Page\Init($tpl);

/* Moteur de rendu */

$page->engine()->schema( (new Page\RenderingScheme())->html5 )->start();



// var_dump($this);exit;


