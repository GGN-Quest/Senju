<?php


/*
	Copyright GOBOU Y. Yannick
	
*/
	
namespace GGN\DPO;



global $_DPO_DEVICE;




/* DPO */

new Using('DPO\Page');

new Using('DPO\Procedure');

new Using('DPO\Theme');

// new Using('GeoLocation/Country/CI');



/* Plugins */

new \GGN\Using('Plugins');

// new \GGN\Using('String');

new \GGN\Plugin\HTML('Models');

new \GGN\Plugin\PHP('MiPi.0.1');



/* 
	Noyau CSS // DEBUT ------------------
*/

	$CSSCore = \_GGN::CSSCore('ggn.core');


/* 
	Noyau CSS // FIN ------------------
*/








/* 
	Activation 
*/

if(\_GGN::varn('SUBSCRIBEPAGE_ACTIVE')!=='1'){

	$this->eventOn('ERROR.404', 'Disable');

	$this->close();

}




	/* Donnée du formulaire transferé par méthode (GET/POST) */

	foreach ( explode(' ', 'firstname lastname email username') as $VName) {

		${'_S' . ucfirst($VName)} = \Register::_REQUEST($VName, '');
		
	}







/* 
	Initialisation du Theme 
*/

$tpl = new Theme\Preset(\_GGN::varn('SUBSCRIBEPAGE_THEME'));



$tpl->Register = $this;


$tpl->title = \_GGN::varn('SUBSCRIBEPAGE_TITLE');



/* 
	Style de la page
*/

$tpl->style = \_GGN::varn('SUBSCRIBEPAGE_STYLE');



/* 
	Noyau CSS
*/

$CSSCore->Style($tpl->style);

$tpl->CSSCore = $CSSCore;





/* 
	Fichier Hote 
*/

$tpl->host = 'subscribe';



$tpl->Register = $this;


// $tpl->title = '';

// $tpl->palette = '';


$tpl->preset('tag.head');




/*
	Composant : "normal.header" // ENTETE
*/
// $tpl->component('normal.header');




/*
	CSS
*/

$tpl->head->cssPackages([

	'ggn.awake.confirm'

]);




/*
	Script
*/

$tpl->head->jsPackages([

	'ggn.connect.subscribe'

	,'ggn.awake.confirm'

	,'ggn.com.service'

]);









/* Corps de la page */
$tpl->body = new Theme\Body([

	'class'=>'disable-x-scrollbar ' . ($_DPO_DEVICE->current=='-c'? '': 'scroll-on-mobile')

]);



	$tpl->body->sheet = new Theme\Tag([

		'class'=>'gui sheet'
		
		// ,'ggn-scrollbar'=>'true'
		
		// ,'scrollbar-wheel-delta'=>'50'
		
		// ,'scrollbar-axe'=>'y'

	]);



	$tpl->body->sheet->node->Content = new Theme\Tag([

		'class'=>'gui _w10 big-container'

		// ,'scrollbar-content'=>'true'

	]);
	












/* Entete : debut */

$header = new Theme\Tag([

	'id'=>'header'

	,'tag'=>'header'

	,'class'=>'gui flex row bg-primary-l box-shadow-dark '

]);



		/* Logo */
		
		$header->node->Logo = (new Theme\Tag(['class'=>'logo padding-tb-x16 padding-lr-x16 align-center ' ]))

			->text('<a href="' . HTTP_HOST . '" >')

				->text('<img class="logo gui-fx h-auto x192-w" src="' . HTTP_HOST . 'logo/mipi-text.png">')

			->text('</a>')

		;





		/* Menu */
		// $header->node->menu = new Theme\Tag(['class'=>'menu-nav col-0 flex start' ]);

		// 	$_MenuPage = new \GGN\Plugin\HTML\Model\Brick('Menu/Default'

		// 		, [

		// 			'uriBase'=>HTTP_HOST

		// 			,'host'=>$tpl->host

		// 			,'attributes' => []

		// 			,'class' => 'principal'

		// 			,'flex' => 'row'

		// 			,'items'=>[
						
		// 				// 'OUT'=>[
						
		// 				// 	'label'=>'Se déconnecter'
						
		// 				// 	, 'link'=>'./logout?complete'
						
		// 				// 	, 'title'=>'Quitter l\'application'
						
		// 				// ]

		// 				// 'Home'=>[
						
		// 				// 	'label'=>'<span class="gui iconx text-x26" ggn-handler-click="Gabarit.Ajax" ajax-href="home" >home</span>'
						
		// 				// 	, 'link'=>'home'
						
		// 				// 	, 'title'=>'Allez à l\'accueil'
						
		// 				// 	, 'click'=>'return false;'
						
		// 				// ]

		// 				// , 'Composer'=>[
						
		// 				// 	'label'=>'Composer'
						
		// 				// 	, 'link'=>'./sms.engine/composer.app'
						
		// 				// 	, 'title'=>''
						
		// 				// 	, 'click'=>'return false;'
							
		// 				// ]

		// 				// , 'Orders'=>[
						
		// 				// 	'label'=>'Offres'
						
		// 				// 	, 'link'=>'./sms.engine/orders.app'
						
		// 				// 	, 'title'=>''
						
		// 				// 	, 'click'=>'return false;'
							
		// 				// ]

		// 			]

		// 		]
		// 	);

		// $header->node->menu->node->content = new Theme\Content( $_MenuPage->html );

		/* Menu : fin */




$tpl->body->sheet->node->Content->node->header = $header;

/* Entete : fin */








/* Conteneur de la page : debut */

	/*
		Fusion avec le noeud principal
	*/

	$container = $tpl->body->sheet->node->Content;
		









	/* 
		Espacement en Haut // Debut -------------------------- 
	*/

		$container->node->Spacer = new Theme\Tag(['class'=>'page-space-top']);


	/* 
		Espacement en Haut // Fin -------------------------- 
	*/










	/* 
		Page // DEBUT -------------------------- 
	*/

		$container->node->Page = new Theme\Tag([
			'class'=>'gui flex row wrap center bloc-page _w10'	
		]);



		if(is_array($this->USER)){


			/* 
				Bloc // DEBUT -------------------------- 
			*/

				$Bloc = (new Theme\tag(['class'=>'title enable col-16 gui flex column']));


				/* 
					Titre // DEBUT -------------------
				*/
					$Bloc->node->Head = (new Theme\Tag(['class'=>'part col-16 gui flex wrap column  center']))

						->text('<div class="s-col-0 xh5 color-primary no-pddng">Déconnectez-vous</div>')

						->text('<div class="s-col-0 text-x18 color-primary no-pddng">Vous devez êtes déconnecté pour effectuer une nouvelle inscription</div>')

						->text('<div class="s-col-0 h2 color-primary padding-x32"><button onclick="history.go(-1)"><span class="gui iconx">arrow_back</span>&nbsp;&nbsp;&nbsp;Retour</button>&nbsp;<button onclick="location.href=\'logout?complete&next='.\urlencode(\Gougnon::currentURL()).'\'" class="active">Déconnexion&nbsp;&nbsp;&nbsp;<span class="gui iconx">arrow_forward</span></button></div>')

					;

				/* 
					Titre // FIN -------------------
				*/

				$container->node->Page->node->Bloc = $Bloc;

			/* 
				Bloc // FIN -------------------------- 
			*/

		}



		if(!is_array($this->USER)){

			$tpl->head->script($tpl->_url . 'subscribe.manager.js');




			// /* 
			// 	Barre laterale Gauche // DEBUT -------------------------- 
			// */

			// 	$PLeft = (new Theme\tag(['class'=>' enable col-0 mi-col-16 li-col-16 gui flex column  flex-order-1 mi-flex-order-2 li-flex-order-2 ']));


			// 	/* 
			// 		Titre // DEBUT -------------------
			// 	*/
			// 		$PLeft->node->Head = (new Theme\Tag(['class'=>'part col-16 gui flex wrap padding-t-x32 padding-b-x0 padding-lr-x16 ']))

			// 			->text('<div class="s-col-16 text-x5-vh color-primary no-pddng gui flex  mi-flex-center s-flex-center text-thin">Pourquoi créer un compte</div>')

			// 		;

			// 	/* 
			// 		Titre // FIN -------------------
			// 	*/

					

			// 	/* 
			// 		Contenu // DEBUT -------------------
			// 	*/
			// 		$PLeft->node->Content = (new Theme\Tag(['class'=>'part col-16 gui flex wrap']))


			// 			/* Detail : I */
			// 			->text('<div class="padding-x32">')

			// 				->text('<div class="s-col-16 text-x26 no-pddng gui flex mi-flex-center s-flex-center">Stylivoir est la première plateforme ivoirienne dédiée exclusivement à la mode et la beauté.</div>')

			// 				->text('<div class="s-col-16 text-x16 no-pddng gui flex mi-flex-center s-flex-center">Quand l’innovation et la création se mettent au service de l’intelligence, cela donne Stylivoir. Les professionnels du monde de la mode et de la beauté ont désormais un espace où ils pourront faire montre de leur talent.</div>')

			// 			->text('</div>')



			// 			/* Detail : II */
			// 			->text('<div class="padding-tb-x16 padding-lr-x32">')

			// 				->text('<div class="s-col-16 text-x26 no-pddng gui flex mi-flex-center s-flex-center">Stylivoir est un moyen très efficace de se faire de la pub 24h/24 et 7j/7 dans le but d’acquérir une nouvelle clientèle.</div>')

			// 				->text('<div class="s-col-16 text-x16 no-pddng gui flex mi-flex-center s-flex-center">Communiquer est une condition sine qua non pour se faire connaitre et donc pour développer son activité. Stylivoir vous donne gratuitement l’opportunité de vous vendre en tout temps.</div>')

			// 			->text('</div>')



			// 			/* Detail : II */
			// 			->text('<div class="padding-tb-x16 padding-lr-x32">')

			// 				->text('<div class="s-col-16 text-x26 no-pddng gui flex mi-flex-center s-flex-center">Stylivoir vous démarque de vos compétiteurs.</div>')

			// 				->text('<div class="s-col-16 text-x16 no-pddng gui flex mi-flex-center s-flex-center">Inscrivez-vous et donnez-vous la chance d’avoir un blog unique qui vous différencie de vos pairs en donnant le maximum d’information et en étant à l’écoute de vos followers.</div>')

			// 			->text('</div>')



			// 		;

			// 	/* 
			// 		Contenu // FIN -------------------
			// 	*/


				

			// 	$container->node->Page->node->PLeft = $PLeft;
			// /* 
			// 	Barre laterale Gauche // FIN -------------------------- 
			// */







			/* 
				Barre laterale Droite // DEBUT -------------------------- 
			*/

				$PRight = (new Theme\tag(['class'=>' col-4 mi-col-16 li-col-16 s-col-7 m-col-8 l-col-8 gui flex column flex-order-2 mi-flex-order-1 li-flex-order-1 ']));


				/* 
					Contenu // DEBUT -------------------
				*/
					$Form = (new Theme\Tag([
						
						'tag'=>'form'

						, 'class'=>'form part col-16 gui flex wrap'

						, 'method'=>'post'

						, 'action'=>'?and.now'

						, 'onsubmit'=>'return false;'

						, 'id'=>'ggn-subscribe-form'

						, 'captcha-bg-color'=>$CSSCore->styleProperty('palette-primary-color')

						, 'captcha-text-color'=>$CSSCore->styleProperty('palette-light-color')

						, 'captcha-name'=>'ggn.users.subscribe'

					]));


						$Form->node->Bloc = (new Theme\Tag([

							'class'=>'form-bloc gui pos-relative disable-scrollbar padding-x16'	

							, 'id'=>'ggn-subscribe-box'
							
						]));

						$Form->node->Bloc->node->Title = (new Theme\Tag([

							'class'=>'title x96-h gui flex column center'	

						]))

							->text('<span class="h3">Inscrivez-vous</span>')

						;



						$_MonthOptions = '';

						$_MonthOptions .= '<option >Mois</option>';

						for($drm = 0; $drm < 12; $drm++){

							$_MonthOptions .= '<option value="' . $drm . '">' . ucfirst($GLANG['MONTH']['NAME'][$drm]) . '</option>';

						}


						$Form->node->Bloc->node->Fields = (new Theme\Tag([

							'class'=>'form-fields col-16 gui-transition'	

						]))


							/* Nom */
							->text('<div class="field-input styled xl gui box-rounded gui flex row center box-shadow-dark" id="subscribe-firstname-field"><span class="gui iconx icon" >person</span><input class="col-0" style="width:30%" type="firstname" name="firstname" placeholder="Nom" value="' . $_SFirstname . '" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#subscribe-firstname-field,#subscribe-firstname-info" focus-class="focus,enable" required pattern=".{3,32}" > </div>')// <div class="col-0"></div> 

							->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="subscribe-firstname-info"><span class="iconx">info</span>&nbsp;&nbsp;&nbsp;Minimum : 3, Maximun : 32 Caratères</div>')

							// <input class="col-0" style="" type="lastname" name="lastname" placeholder="Prénom" value="' . $_SLastname . '" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#subscribe-firstname-field,#subscribe-lastname-info" focus-class="focus,enable" required pattern=".{3,32}">


							/* Prenom */
							->text('<div class="field-input styled xl gui box-rounded gui flex row center box-shadow-dark" id="subscribe-lastname-field"><span class="gui iconx icon ">person</span><input type="lastname" name="lastname" placeholder="Prénom" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#subscribe-firstname-field,#subscribe-lastname-info" focus-class="focus,enable" required pattern=".{3,32}"></div>')

							->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="subscribe-lastname-info"><span class="iconx">info</span>&nbsp;&nbsp;&nbsp;Minimum : 3, Maximun : 32 Caratères</div>')


							/* Sperateur */
							->text('<div class="margin-tb-x4" >&nbsp;</div>')


							/* Nom utilisateur */
							->text('<div class="field-input styled xl gui box-rounded gui flex row center box-shadow-dark" id="subscribe-username-field"><span class="gui iconx icon ">face</span><input type="username" name="username" placeholder="Nomd\'utilisateur" value="' . $_SUsername . '" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#subscribe-username-field,#subscribe-username-info" focus-class="focus,enable" required pattern=".{5,32}"></div>')

							->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="subscribe-username-info"><span class="iconx">info</span>&nbsp;&nbsp;&nbsp;Minimum : 5, Maximun : 32 Caratères, evitez les symboles à par "." et "-"</div>')


							/* Mot de passe */
							->text('<div class="field-input styled xl gui box-rounded gui flex row center box-shadow-dark" id="subscribe-password-field"><span class="gui iconx icon ">vpn_key</span><input type="password" name="password" placeholder="Mot de passe" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#subscribe-password-field,#subscribe-password-info" focus-class="focus,enable" required pattern=".{6,32}" ></div>')

							->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="subscribe-password-info"><span class="iconx">info</span>&nbsp;&nbsp;&nbsp;Minimum : 6, Maximun : 32 Caratères</div>')



							/* Confirmer Mot de passe */
							->text('<div class="field-input styled xl gui box-rounded gui flex row center box-shadow-dark" id="subscribe-confirm-password-field"><span class="gui iconx icon">vpn_key</span><input type="password" name="password2" placeholder="Confirmer Mot de passe" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#subscribe-confirm-password-field,#subscribe-confirm-password-info" focus-class="focus,enable" required ></div>')

							->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="subscribe-confirm-password-info"><span class="iconx">info</span>&nbsp;&nbsp;&nbsp;Entrez le même mot de passe que celui plus haut</div>')




							/* Sperateur */
							->text('<div class="margin-tb-x4" >&nbsp;</div>')


							/* Contact */
							->text('<div class="field-input styled xl gui box-rounded gui flex row center box-shadow-dark" id="subscribe-contact-field"><span class="gui iconx icon">phone</span><input type="tel" name="contact" placeholder="Exemple : 00 00 00 00" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#subscribe-contact-field,#subscribe-contact-info" focus-class="focus,enable" required pattern=".{8,11}" value=""></div>')

							->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="subscribe-contact-info"><span class="iconx">info</span>&nbsp;&nbsp;&nbsp;Entrez votre numéro de téléphone mobile <br> Ce numéro doit être un numéro de la Côte d\'Ivoire</div>')


							/* Email */
							->text('<div class="field-input styled xl gui box-rounded gui flex row center box-shadow-dark" id="subscribe-email-field"><span class="gui iconx icon">email</span><input type="email" name="email" placeholder="email@exemple.com" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#subscribe-email-field,#subscribe-email-info" focus-class="focus,enable" value="' . $_SEmail . '"></div>')

							->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="subscribe-email-info"><span class="iconx">info</span>&nbsp;&nbsp;&nbsp;Entrez votre adresse mail si vous en avez</div>')
							

							/* Sperateur */
							->text('<div class="margin-tb-x4" >&nbsp;</div>')



							/* Naissance */

							->text('<div class="field-input xl styled gui box-rounded gui flex row center box-shadow-dark" id="subscribe-birth-field"><span class="gui icon calendar" title="Minimum : 2  Maximun : 32"></span>')

								->text('<input class="col-0-no-i" style="width:20%" type="number" name="birth_day" placeholder="Jour" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#subscribe-birth-field,#subscribe-birth-info" focus-class="focus,enable" required max="31" step="1" value="">')

								->text('<select class="col-0-no-i" style="width:20%" name="birth_month" id="birth_month">' . $_MonthOptions . '</select>')

								->text('<input class="col-0-no-i" style="width:35%" type="number" name="birth_year" placeholder="Année" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#subscribe-birth-field,#subscribe-birth-info" focus-class="focus,enable" required min="' . (date('Y') - 99) . '" max="' . (date('Y') - 16) . '" step="1" value="">')

								->text('<div class="col-0"></div>')

							->text('</div>')

							->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="subscribe-birth-info">Age (min : 16 ans et max : 90 ans)</div>')



							/* Sexe */
							->text('<div class="field-input xl styled gui box-rounded gui flex row center box-shadow-dark" id="subscribe-sexe-field"><span class="gui icon iconx" title="Minimum : 2  Maximun : 32">person</span>')

								->text('<select name="sexe" id="sexe"><option value="0">Femme</option><option value="1">Homme</option><option value="2">Autre</option></select>')

							->text('</div>')





							/* Sperateur */
							->text('<div class="margin-tb-x4" >&nbsp;</div>')

							->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="subscribe-email-info"><span class="iconx">info</span>&nbsp;&nbsp;&nbsp;Entrez une adresse mail valide</div>')



							/* Image Captcha */
							/* 
								' . HTTP_HOST . 'captcha?name=user.subscribe&textcolor='.urlencode($CSSCore->styleProperty('palette-light-color')).'&bgcolor='.urlencode($CSSCore->styleProperty('palette-primary-color')).'
							*/
							->text('<div class="gui flex center _w10 bg-primary box-rounded" ><img class="disable" id="ggn-subscribe-captcha"></div>')


							/* Champs d'Entré Captcha */
							->text('<div class="field-input styled xl gui box-rounded gui flex row center box-shadow-dark" id="subscribe-captcha-field"><span class="gui iconx icon">verified_user</span><span class="gui iconx icon cursor-pointer color" id="ggn-subscribe-captcha-ctrl">sync</span><input type="captcha" name="captcha" placeholder="Entrez le code de sécurité ci-dessus" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#subscribe-captcha-field,#subscribe-captcha-info" focus-class="focus,enable" required autocomplete="off"></div>')

							->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="subscribe-captcha-info"><span class="iconx">info</span>&nbsp;&nbsp;&nbsp;Entrez le code du captcha plus haut</div>')



							/* CGU */
							->text('<div class="gui flex center text-x16 x64-h"><input type="checkbox" name="cgu" value="accept" required >&nbsp;&nbsp;&nbsp;J\'accepte les&nbsp; <a href="cug.html">Conditions Générales d\'Utilisation</a></div>')
							


							/* Bouton de soumission */
							->text('<div class="gui flex center x48-h"><input class="col-5 text-x18" type="button" value="Se connecter" onclick="location.href=\'login?new\'" >&nbsp;&nbsp;<input class="col-0 text-x18 active" type="submit" value="Continuer" ></div>')

						;


					$PRight->node->Form = $Form;

				/* 
					Contenu // FIN -------------------
				*/


				

				$container->node->Page->node->PRight = $PRight;
			/* 
				Barre laterale Droite // FIN -------------------------- 
			*/


		}





	/* 
		Page // FIN -------------------------- 
	*/






		







/*
	Composant : "normal.footer" // PIED DE PAGE
*/
// $tpl->component('normal.footer');


	$page = new Page\Init($tpl);

	/* Moteur de rendu */

	$page->engine()->schema( (new Page\RenderingScheme())->html5 )->start();




