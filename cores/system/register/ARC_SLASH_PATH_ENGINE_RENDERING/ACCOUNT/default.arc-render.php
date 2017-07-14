<?php

/*
	Copyright GOBOU Y. Yannick
	
*/
namespace GGN\DPO;



if(isset($this->USER) && is_array($this->USER)){



		// global $database;



	if(\_GGN::varn('ACCOUNTPAGE_ACTIVE') == 0){

		$this->eventOn('ERROR.404');

		$this->close();

	}





	/* Module à inclure */

	$__defaultMod = 'identity';

	$exMod = explode('/', $this->gFile);

	$arrMod = \Gougnon::arrayValues($exMod, 1);

	$Mod = dirname(__FILE__) . '/mods/' . ((empty($arrMod)) ? $__defaultMod : implode('/', $arrMod)) . '.mod.php';



	$BlocClassName = ' bloc-container bg-ncolor margin-x16 bg-ncolor margin-x16 box-rounded-normal ';


	









	/* DPO */

	new Using('DPO\Page');

	new Using('DPO\Procedure');

	new Using('DPO\Theme');






	/* Plugins */

	new \GGN\Using('Plugins');

	new \GGN\Plugin\HTML('Models');






	/* 
		Initialisation du Theme 
	*/

	$tpl = new Theme\Preset(\_GGN::varn('ACCOUNTPAGE_THEME'));


	$tpl->Register = $this;




	/* 
		Fichier Hote 
	*/

	$tpl->host = __FILE__;





	/* 
		Titre de la page
	 */
	$tpl->name = 'Gougnon Home Page API';

	$tpl->version = '0.1';

	$tpl->update = date('ymd.hi');

	$tpl->style = \_GGN::varn('ACCOUNTPAGE_STYLE');


	/* 
		Le Doctype de la page
	 */
	$tpl->doctype('html');



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
	$tpl->head->title(\_GGN::varn('ACCOUNTPAGE_TITLE'))

		/* 
			Favicone 
		*/
		->shortcut(\HTTP_HOST . 'favicon.png')


		/* 
			Balise Meta dans le 'head'
		*/
		->meta('charset', 'utf-8')
		
		->meta('http-equiv', 'pragma', 'cache')
		
		->meta('name', 'mobile-web-app-capable', 'yes')
		
		->meta('name', 'viewport', 'width=device-width,initial-scale=1')


		->meta('name', 'theme-color', $tpl->Cores->CSS->styleProperty('palette-primary-color'))


		->meta('name', 'msapplication-navbutton-color', $tpl->Cores->CSS->styleProperty('palette-primary-color'))


		->meta('name', 'apple-mobile-web-app-capable', 'yes')

		->meta('name', 'apple-mobile-web-app-status-bar-style', 'black-translucent')




		/* Favicones */
		
		->meta('name', 'msapplication-square70x70logo', 'favicon-x70.png')

		->meta('name', 'msapplication-square150x150logo', 'favicon-x150.png')
		
		->meta('name', 'msapplication-square310x310logo', 'favicon-x310.png')


		->link(['rel'=>'apple-touch-icon','sizes'=>'48x48','href'=>'favicon-x48.png'])

		->link(['rel'=>'apple-touch-icon','sizes'=>'64x64','href'=>'favicon-x64.png'])

		->link(['rel'=>'apple-touch-icon','sizes'=>'76x76','href'=>'favicon-x76.png'])

		->link(['rel'=>'apple-touch-icon','sizes'=>'120x120','href'=>'favicon-x120.png'])

		->link(['rel'=>'apple-touch-icon','sizes'=>'152x152','href'=>'favicon-x152.png'])

		->link(['rel'=>'apple-touch-icon','sizes'=>'192x192','href'=>'favicon-x192.png'])

		->link(['rel'=>'apple-touch-icon','sizes'=>'196x196','href'=>'favicon-x196.png'])






		/* 
			Framework CSS
		*/

		/* Packges de la page */
		->cssPackages([

			// 'ggn.scrollbar'

			// ,'ggn.slidershow'

			// // ,'ggn.messenger.0.1'
			
			// ,'ggn.ressources'

			// ,'ggn.ui'

			// ,'ggn.photo'

			// ,'ggn.photo.viewer'

			// ,'ggn.awake.confirm'

		])


		/* Packges du manifest */
		->cssPackages($tpl->manifest->package->css->list)


		/* Packges du manifest du thème */
		->cssPackages(isset($tpl->manifest->package->css->account->list) && is_object($tpl->manifest->package->css->account->list) ? $tpl->manifest->package->css->account->list: false)


		/* Style Générale du theme */
		->link($tpl->manifest->links->list)


		/* Style du account du theme */
		->link(isset($tpl->manifest->links->account->list) && is_object($tpl->manifest->links->account->list) ? $tpl->manifest->links->account->list: '')



		/* Style du theme */
		->css($tpl->manifest->css->list)



		/* Code du Style du account du theme */
		->css(isset($tpl->manifest->css->account->list) && is_object($tpl->manifest->css->account->list) ? $tpl->manifest->css->account->list: '')


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




		/* Code Général du Style du theme */
		->style($tpl->manifest->style->list)



		/* Code du Style du account du theme */
		->style(isset($tpl->manifest->style->account->list) && is_object($tpl->manifest->style->account->list) ? $tpl->manifest->style->account->list: '')






		/* 
			Framework JS
		*/

		->jsPackages([

			'ggn.com.service'
			
		])


		/* Packges du manifest */
		->jsPackages($tpl->manifest->package->js->list)


		/* Packges du manifest du thème */
		->jsPackages(isset($tpl->manifest->package->js->account->list) && is_object($tpl->manifest->package->js->account->list) ? $tpl->manifest->package->js->account->list: '')
		

		/* 
			Fichier JS
		*/
		// ->script($this->_url . 'normal.actions.js')


		/* 
			Script Générale du theme 
		*/
		->script($tpl->manifest->scripts->list)


		/* 
			Script du account du theme
		*/
		->script(isset($tpl->manifest->scripts->account->list) && is_object($tpl->manifest->scripts->account->list) ? $tpl->manifest->scripts->account->list: '')


		/* 
			Code JS
		*/
		->js('')



		/* 
			Code JS Général du account du theme
		*/
		->js($tpl->manifest->js->list)



		/* 
			Code JS du account du theme
		*/
		->js(isset($tpl->manifest->js->account->list) && is_object($tpl->manifest->js->account->list) ? $tpl->manifest->js->account->list: '')





		->write('<base href="'.HTTP_HOST.'" target="_self">')

	/* Fermeture de la sequence 'Head' */
	;







	/* Corps de la page */
	$tpl->body = new Theme\Body(['class'=>'bg-ncolor-d']);




		$tpl->body->sheet = new Theme\Tag([

			'class'=>'gui sheet'

		]);




			/* Entete */
			$tpl->body->sheet->node->head = new Theme\Tag([

				'class'=>'gui flex row wrap bg-primary box-shadow-dark'

			]);


				$tpl->body->sheet->node->head->node->Back = (new Theme\Tag([

					'tag'=>'a'

					,'href'=> '?ref=account'
					// ,'href'=> (is_string(__HTTP_REFERER__)) ? 'javascript:history.back();' : '?ref=account'

					,'class'=>'padding-x20 text-x18 gui iconx color-light-l'

				]))

					->text('home')

				;


				$tpl->body->sheet->node->head->node->Title = (new Theme\Tag([

					'class'=>'align-left text-x18 padding-tb-x16 padding-lr-x20 color-light-l'

				]))

					->text('Paramètres de compte')

				;



				$tpl->body->sheet->node->head->node->LogOut = (new Theme\Tag([

					'tag'=>'a'

					,'href'=>'logout?done'

					,'class'=>'align-right padding-x20 text-x18 bg-secondary gui iconx power-off color-light-l'

				]))

					->text('exit_to_app')

				;




			/* Conteneur */
			$tpl->body->sheet->node->container = new Theme\Tag([

				'class'=>'gui flex row wrap _w10'

			]);




				/* Menu lateral */
				$tpl->body->sheet->node->container->node->MenuSide = new Theme\Tag([

					'class'=>'mi-col-16 li-col-16 s-col-16 x320-w gui flex center column '

				]);





					$__MenuPage = new \GGN\Plugin\HTML\Model\Brick('Menu/Default'
						, [

							'uriBase'=>HTTP_HOST . 'account/'

							,'host'=>(isset($arrMod[0])) ? $arrMod[0] : $__defaultMod

							,'attributes' => []

							,'class' => 'text-x16 account-menu-side'

							,'flex' => 'column'

							,'items'=>[

								'Home'=>[
									'label'=>'Identité'
									, 'link'=>'identity'
									, 'title'=>'Modifier votre identité'
								]

								,'PWD'=>[
									'label'=>'Mot de passe'
									, 'link'=>'password'
									, 'title'=>'Modifier le mot de passe'
									, 'class'=>''
									
								]

								// ,'PHONE'=>[
								// 	'label'=>'Téléphone Mobile'
								// 	, 'link'=>'phone'
								// 	, 'title'=>'Gérer vos contacts mobile'
								// 	, 'class'=>''
									
								// ]

								// ,'Pref'=>[
								// 	'label'=>'Préférences'
								// 	, 'link'=>'preferences'
								// 	, 'title'=>'Lancer une recherche'
								// 	, 'class'=>''
									
								// ]


							]

						]
					);

	
				$tpl->body->sheet->node->container->node->MenuSide->node->title = (new Theme\Tag(['class'=>'x48-h padding-x16 h1 text-left _w9 text-ellipsis']))->text(ucfirst($this->USER['USERNAME']));

				$tpl->body->sheet->node->container->node->MenuSide->node->container = new Theme\Tag(['class'=>'_w10 col-0 gui flex wrap']);

				$tpl->body->sheet->node->container->node->MenuSide->node->container->text('<div class="align-top _w10">' . $__MenuPage->html . '</div>');






				/* Conteneur du module */
				$tpl->body->sheet->node->container->node->ModContainer = (new Theme\Tag([

					'class'=>'col-0 mi-col-16 li-col-16 s-col-0'

				]));







				/* Inclusion du module */
				$isMod =  is_file($Mod);


				/* Module trouvé */
				if($isMod){

					include $Mod;

				}


				/* Erreur de module */
				if(!$isMod){

					$this->eventOn('ERROR.404');

					$this->close();

				}









	/* 
		Page 
	*/
	$page = new Page\Init($tpl);




	/* 
		Moteur de rendu
	*/

	$page->engine()->schema( (new Page\RenderingScheme())->html5 )->start();









}

else{

	\Gougnon::goToLogin();

	$this->close();

}