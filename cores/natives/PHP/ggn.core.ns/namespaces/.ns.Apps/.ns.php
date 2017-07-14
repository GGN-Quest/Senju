<?php

	/**
	 * GGN Apps Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\Apps;
	

	
	/* Using */
	if(!class_exists('\GGN\Apps\Using')){

		Class Using{

			public function __construct($ns){ $this->object = clone new \GGN\Using($ns); }

		} 

	}






	/* Système */
	new \GGN\Using('System');

	
	/* Environnement des chemins */
	new \GGN\Using('Path');
	
	
	/* Environnement des dossiers */
	new \GGN\Using('Dir');
	

	/* Environnement des fichiers */
	new \GGN\Using('File');


	/* DPO */
	new \GGN\Using('DPO\Page');

	new \GGN\Using('DPO\Theme');

	new \GGN\Using('DPO\Procedure');

	new \GGN\Using('DPO\Layout');




	/* Utilisateur */
	new \GGN\Using('User');

	new \GGN\Using('User\Prefs');







	if(!class_exists('\GGN\Apps\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{

			const NAME = "GGN APPS";

			const VERSION = "0.1";

			const UPDATE = "170703.1128";


			static public function tExit($txt = ""){

				\_GGN::wCnsl("<div style='font-size:32px;'>" . self::NAME . "</div><div style='font-size:17px;'>" . $txt . "<br><i>version : " . self::VERSION . ", mise à jour : " . self::UPDATE . "</i></div>");

			}



		} // Class Invoke


	} // if class_exists 'Invoke'









	// if(!class_exists('\GGN\Apps\Var')){

	// 	/*
	// 		Var
	// 	*/
	// 	Class Var{

	// 		const NAME = "GGN Variables";

	// 		const VERSION = "0.1";

	// 		const UPDATE = "161109.0822";



	// 		static public function Params(){

	// 			return [

	// 				"style"

	// 			];

	// 		}



	// 	} // Class Var


	// } // if class_exists 'Var'









	if(!class_exists('\GGN\Apps\Get')){ 

		/*
			Get
		*/
		Class Get{



			/* Manifest de l'application  / DEBUT */

				static public function Manifest($Key = false){

					if(is_string($Key)){

						$Path = __CORES_SYSTEM_COM_VENDOR__ . 'app/' . $Key . '/';

						if(is_dir($Path)){

							$Manifest = $Path . 'manifest.json';

							if(is_file($Manifest)){

								return json_decode(file_get_contents($Manifest), \GStorages::JSON_OPT());

							}

							else{return null;}

						}

						else{return false;}

					}

					else{return false; }

				}

			/* Manifest de l'application  / FIN */




			/* Recherche un driver / DEBUT */

				static public function Handler($Name = false, $args = false){

					if(is_string($Name)){

						return \GGN\System\Driver::State('app/' . $Name, $args);

					}

					else{

						return false;

					}


				}

			/* Recherche un driver / FIN */





			/* Utilise Ajax / DEBUT */

				static public function UsesAjax(){

					return (isset($_SERVER['HTTP_X_REQUESTED_WIDTH'])) ? $_SERVER['HTTP_X_REQUESTED_WIDTH'] : FALSE;

				}

			/* Utilise Ajax / FIN */




		} // Class Get


	} // if class_exists 'Get'










	if(!class_exists('\GGN\Apps\Engine')){

		/*
			Engine
		*/
		Class Engine extends Invoke{


			var $Key;

			var $Tpl;

			var $_Handler;


			var $UserSession = false;

			var $AppSession = false;



			/* Constructrice de la Classe / DEBUT */

				public function __construct($Key = false, $Config = [], $Manifest = []){

					if(is_string($Key)){

						$this->Key = $Key;


						if(is_array($Config)){

							foreach ($Config as $Name => $Value) {

								$this->{$Name} = $Value;
								
							}


							/* Style Personnel de l'utilisateur Connecté / DEBUT */

								if(isset($this->acceptUserPref) && is_array($this->acceptUserPref) && isset($this->handler) ){

									if(isset($this->acceptUserPref['style']) && $this->acceptUserPref['style'] === true){

										if(isset($this->handler['args']) ){


											$PSGSSS = \GGN\User\Prefs\Sheet::Get('theme.style');

											$PSGSSS = (is_array($PSGSSS)) ? (isset($PSGSSS[$Key]) ? $PSGSSS[$Key] : $PSGSSS['default']) : false ;

											$this->handler['args'][1] = is_array($this->handler['args'][1]) ? $this->handler['args'][1] : [];

											$this->handler['args'][1]['style'] = ($PSGSSS) ? $PSGSSS : $this->handler['args'][1]['style'];

										}

									}

								}
								

							/* Style Personnel de l'utilisateur Connecté / FIN */





							// $this->_Handler = (isset($this->handler) && is_array($this->handler)) ? $this->handler : [];

							// $this->_Handler['name'] = (isset($this->_Handler['name']) && is_string($this->_Handler['name'])) ? $this->_Handler['name'] : false;

							// $this->_Handler['args'] = (isset($this->_Handlerdler['args']) && is_array($this->_Handler['args'])) ? $this->_Handler['args'] : false;


							$this->Manifest = $Manifest;

							$this->URL = (isset($this->Manifest['URL'])) ? \_GGN::setvar($this->Manifest['URL']) : false;

							$this->Res = (isset($this->Manifest['Res'])) ? \_GGN::setvar($this->Manifest['Res']) : false;


							$this->Built = new \_GGNCustomObject();

						}

					}

				}

			/* Constructrice de la Classe / FIN */




			/* Démarrage / DEBUT */

				public function GoToLogin($message = ''){

					$UsesAjax = Get::UsesAjax();

					$message = (isset($args[0]))?'&message='  . $args[0]:'';


					$location = \_GGN::setvar( \_GGN::varn('LOGIN_PAGE') 
					
						. '?app=' . $this->Manifest['Key'] . '&next=' 
					
						. urlencode( \Gougnon::currentURL() )
					
						. $message
					
						);


					if($UsesAjax == false){
					
						if(@header('location:' . $location )){exit;}
					
					}

					else if($UsesAjax == true){
					
						echo ('<script type="text/javascript">location.href="' . $location . '";</script>'); exit;
					
					}
					

				}

			/* Constructrice de la Classe / FIN */




			/* Démarrage / DEBUT */

				public function Start($Page = false){

					global $GRegister;



					$this->Tpl = Get::Handler($this->handler['name'], $this->handler['args']);




					/* Style / DEBUT */

						if(isset($this->Style)){

							$this->Tpl->style = $this->Style;

						}

					/* Style / DEBUT */





					/* Session / DEBUT */

						if(isset($this->session)){


							/* Conformisation / DEBUT */

								if(is_array($this->session)){

									$this->session['user'] = (isset($this->session['user']) && is_bool($this->session['user']) ) ? $this->session['user'] : true;

									$this->session['app'] = (isset($this->session['app']) && is_bool($this->session['app']) ) ? $this->session['app'] : true;

								}

								if(is_bool($this->session)){

									$callback = $this->session;

									$this->session = [];

									$this->session['user'] = $callback;

									$this->session['app'] = $callback;

								}

								if(!is_array($this->session) && !is_bool($this->session)){

									$this->session = [ 'user' => true, 'app' => true ];

								}

							/* Conformisation / FIN */




							/* Verification / DEBUT */

								if($this->session['user'] === true){

									$this->UserSession = (isset($GRegister->USER) && is_array($GRegister->USER)) ? $GRegister->USER : false;

									if(!$this->UserSession){

										$this->GoToLogin();

										$GRegister->close();
										
									}

								}

								if($this->session['app'] === true){

									$this->AppSession = \GSystem::requires('users.login.app/sessions', $this->Manifest['Key']);

									if(!$this->AppSession){

										$this->GoToLogin();

										$GRegister->close();
										
									}

								}

							/* Verification / FIN */


						}

					/* Session / FIN */








					/* Accessibilité de l'application par l'utilisateur */

					/* Verification du niveau d'access / DEBUT */

						if(isset($this->accessibility) ){

							if(is_numeric($this->accessibility) && $this->accessibility > 0){

								if(isset($this->UserSession) && is_array($this->UserSession)){

									if($this->UserSession['ACCOUNT_TYPE'] < $this->accessibility){

										$GRegister->eventOn('ERROR.403', 'accappx0.2');	

										$GRegister->close();								

									}

								}

								else{

									$GRegister->eventOn('ERROR.403', 'accappx0.1');

									$GRegister->close();								

								}

							}

						}

					/* Verification du niveau d'access / FIN */








					/* Librairie NS / DEBUT */

						if(isset($this->namespace) ){

							/* Depuis un 'array' */

							if(is_array($this->namespace)){

								foreach ($this->namespace as $ns) {

									new \GGN\Using($ns);
									
								}

							}

							/* Depuis une chaine 'str' */

							if(is_string($this->namespace)){

								foreach (explode(';', $this->namespace) as $ns) {

									new \GGN\Using($ns);
									
								}

							}

						}

					/* Librairie NS / FIN */







					if(is_object($this->Tpl)){


						if(!Get::UsesAjax()){

							$this->TPLInit();

							$this->Tpl->Settings = new \GGN\DPO\Theme\Settings();

							$this->Tpl->Settings

								->add('context.menu', (isset($this->settings['context.menu'])) ? $this->settings['context.menu'] : false )

								->add('responsive', (isset($this->settings['responsive'])) ? $this->settings['responsive'] : false )

								// ->add('fullscreen', (isset($this->settings['fullscreen'])) ? $this->settings['fullscreen'] : false )

							;


							$this->Tpl->Head = new \GGN\DPO\Theme\Head();

							$this->TPLHead();





							$this->Tpl->Body = new \GGN\DPO\Theme\Body();



							/* Structure de la page / DEBUT  */

								if(isset($this->playout) && is_string($this->playout)){

									$Layout = new \GGN\DPO\Layout\Preset($this->playout, $this->Tpl);

									$this->Tpl = $Layout->Mount();


									if(!is_object($this->Tpl)){

										\_GGN::wCnsl('<h1>"Layout" introuvable</h1>');

									}

									else{

										$this->Tpl->Body->Sheet

											->attrib('id', 'ggn-sheet')

											->addClass('gui sheet')

										;

										if(isset($this->Tpl->Body->Sheet->node->Container))

											$this->Tpl->Body->Sheet->node->Container

												->attrib('id', 'ggn-sheet-container')

											;


										$this->HideNavBar();

									}


								}


								if(!isset($this->playout) || !is_string($this->playout)){

									$this->Tpl->Body->Sheet = new \GGN\DPO\Theme\Tag([

										'id' => 'ggn-sheet'

										, 'class' => 'gui sheet'

									]);

								}

							/* Structure de la page / FIN  */


							$this->PopStarter($Page);

							$this->FloatingMenu();


							$Page = new \GGN\DPO\Page\Init($this->Tpl);

							$Page

								->engine()

								->schema( (new \GGN\DPO\Page\RenderingScheme())->html5 )

								->start();

							;
							
						}


						if(Get::UsesAjax()){

							$this->Tpl->Body = new \GGN\DPO\Theme\Body();

							$this->Tpl->Body->Sheet = new \GGN\DPO\Theme\Tag(['class'=>'col-0 del-this']);


							$this->PopStarter($Page);



							/* Transmutation / DEBUT */

								$Sheet = $this->Tpl->Body->Sheet;

									unset($this->Tpl->Body->Sheet);

								$Body = $this->Tpl->Body;

								$this->Tpl->Body = new \GGN\DPO\Theme\Body();

								$this->Tpl->Body = \Gougnon::mergeArray($this->Tpl->Body, $Body, true);


								if(!isset($Sheet->node->Container)){

									$this->Tpl->Body = \Gougnon::mergeArray($this->Tpl->Body, $Sheet, true);
									
								}

								if(isset($Sheet->node->Container)){

									$this->Tpl->Body = \Gougnon::mergeArray($this->Tpl->Body, $Sheet->node->Container->node, true);
									
								}

							/* Transmutation / FIN */


							$Page = new \GGN\DPO\Page\Init($this->Tpl);

							$Page->engine()->start(false, 'body');


						}


					}


					if(!is_object($this->Tpl)){

						echo 'use native html';

					}

					exit;

				}

			/* Démarrage / FIN */








			/* Initialisation du TPL / DEBUT */

				public function TPLInit(){


					if(is_object($this->Tpl)){

						if(!Get::UsesAjax()){

							$this->Tpl

								->doctype('html')

								->html('itemscope', '')

								->html('itemtype', 'http://schema.org/Other')

							;

						}

					}

					else{

						echo 'init native html template';

					}


				}

			/* Initialisation du TPL / FIN */









			/* Menu Flottant / DEBUT */

				public function FloatingMenu(){


					if(is_object($this->Tpl)){

						if(isset($this->floatingMenu) && is_array($this->floatingMenu) ){


							if(!Get::UsesAjax()){

								$Ftm = $this->floatingMenu;

								if(isset($Ftm['items']) && is_array($Ftm['items'])){ unset($Ftm['items']); }

								$this->Tpl->Body->js('(function(){');

									$this->Tpl->Body->js('GApp.FloatingMenu.State(' . (json_encode($Ftm, \GStorages::JSON_OPT())) . ');');

								$this->Tpl->Body->js('})();');

							}


							if(isset($this->floatingMenu['items']) && is_array($this->floatingMenu['items'])){

								foreach ($this->floatingMenu['items'] as $Name => $Item) {

									if(is_array($Item)){

										$this->Tpl->Body->js('(function(){');

											$this->Tpl->Body->js('GApp.FloatingMenu.Add("' . $Name . '", ' . (json_encode($Item, \GStorages::JSON_OPT())) . ');');

										$this->Tpl->Body->js('})();');

									}

								}

							}


						}

					}

					else{

						echo 'init native html FloatingMenu';

					}


				}

			/* Menu Flottant / FIN */









			/* PopStarter / DEBUT */

				public function PopStarter($_Page = false){


					if(is_object($this->Tpl)){

						if(isset($this->popstate)){

							$Boot = (isset($this->popstate['boot'])) ? $this->popstate['boot'] : "index";

							$Prefix = (isset($this->popstate['prefix'])) ? $this->popstate['prefix'] : "";

							$Ext = (isset($this->popstate['ext'])) ? $this->popstate['ext'] : ".php";


							$Path = \GGN\Path\Protocol::Value($this->Manifest['Path']);


							$Path_ = '';


							$PPath = explode('/', $_Page);

							$K = count($PPath);

							$Page = $Prefix . ((!is_string($_Page) || \Gougnon::isEmpty($_Page)) ? $Boot : $_Page) . $Ext;


							if($K > 1){

								$Key = $K - 1;

								$TPath = (implode('/', \Gougnon::arrayValues($PPath, 0, $Key) )) . '/';

								$Page = $TPath . $Prefix . (implode('/', \Gougnon::arrayValues($PPath, $Key) )) . $Ext;

							}


							$File = $Path . $Page;


							// exit($File);


							if(is_file($File)){

								include $File;

							}

							else{


								/* Mode : Autonome / DEBUT */

									if(isset($this->autonomous) && ($this->autonomous === true)){


										$Error = $Path . $Prefix . 'error.404' . $Ext;

										if(is_file($Error)){

											try{header(\_GGN::HTTP_HEADER_404);} catch(Exception $e){}

											include $Error;

										}

										else{

											global $GRegister;

											$GRegister->eventOn('ERROR.404');

											$GRegister->close();

										}

									}

								/* Mode : Autonome / FIN */



								/* Mode : Non-Autonome / DEBUT */

									else{

										global $GRegister;

										$GRegister->eventOn('ERROR.404');

										$GRegister->close();

									}

								/* Mode : Non-Autonome / FIN */



							}



						}

					}

					else{

						echo 'init native html popstate';

					}


				}

			/* PopStarter / FIN */







			/* Entete du TPL / DEBUT */

				public function TPLHead(){


					if(is_object($this->Tpl)){


						$Favicone = (isset($this->autonomous) && $this->autonomous === true)

							? \_GGN::setvar( isset($this->head['shortcut']) ? \_GGN::setvar( $this->head['shortcut'] ) : \_GGN::varn('FAVICON') )

							: \_GGN::setvar( \_GGN::varn('FAVICON') )

						;



						/* Head : Initialisation / DEBUT */

							$this->Tpl->Head


								/* 
									Titre de la page
								*/

								->title( isset($this->head['title']) ? $this->head['title'] : \_GGN::varn('HOMEPAGE_TITLE') )


								/* 
									Favicone 
								*/

								->shortcut( $Favicone . '?mode=-gd&width=64&height=64&resize=true&resizeby=0&quality=-high' )


								->meta('name', 'msapplication-square70x70logo', '' . $Favicone . '?mode=-gd&width=70&height=70&resize=true&resizeby=0&quality=-high')

								->meta('name', 'msapplication-square150x150logo', '' . $Favicone . '?mode=-gd&width=150&height=150&resize=true&resizeby=0&quality=-high')

								->meta('name', 'msapplication-square310x310logo', '' . $Favicone . '?mode=-gd&width=310&height=310&resize=true&resizeby=0&quality=-high')


								->link(['rel'=>'apple-touch-icon','sizes'=>'48x48','href'=>'' . $Favicone . '?mode=-gd&width=48&height=48&resize=true&resizeby=0&quality=-high'])

								->link(['rel'=>'apple-touch-icon','sizes'=>'64x64','href'=>'' . $Favicone . '?mode=-gd&width=64&height=64&resize=true&resizeby=0&quality=-high'])

								->link(['rel'=>'apple-touch-icon','sizes'=>'76x76','href'=>'' . $Favicone . '?mode=-gd&width=76&height=76&resize=true&resizeby=0&quality=-high'])

								->link(['rel'=>'apple-touch-icon','sizes'=>'120x120','href'=>'' . $Favicone . '?mode=-gd&width=120&height=120&resize=true&resizeby=0&quality=-high'])

								->link(['rel'=>'apple-touch-icon','sizes'=>'152x152','href'=>'' . $Favicone . '?mode=-gd&width=152&height=152&resize=true&resizeby=0&quality=-high'])

								->link(['rel'=>'apple-touch-icon','sizes'=>'192x192','href'=>'' . $Favicone . '?mode=-gd&width=192&height=192&resize=true&resizeby=0&quality=-high'])

								->link(['rel'=>'apple-touch-icon','sizes'=>'196x196','href'=>'' . $Favicone . '?mode=-gd&width=196&height=196&resize=true&resizeby=0&quality=-high'])




								/* 
									Balise Meta dans le 'head'
								*/

								->meta('charset', 'utf-8')
								
								->meta('name', 'mobile-web-app-capable', 'yes')
								
								->meta('name', 'viewport', 'width=device-width,initial-scale=1, maximum-scale=1.0, user-scalable=no')

								->meta('name', 'theme-color', $this->Tpl->Cores->CSS->styleProperty('palette-primary-color') )

								->meta('name', 'msapplication-navbutton-color', $this->Tpl->Cores->CSS->styleProperty('palette-primary-color') )

								->meta('name', 'apple-mobile-web-app-capable', 'yes')

								->meta('name', 'apple-mobile-web-app-status-bar-style', 'black-translucent')


								/*
									Packages CSS
								*/

								->cssPackages([

									'ggn.app'

									, 'ggn.icons'

									// , 'ggn.gabarit'

									, 'ggn.ui'

									, 'ggn.ui.styler'


								])


								/*
									Packages JS
								*/
								
								->jsPackages([

									'ggn.app'

									, 'ggn.com.service'

									, 'ggn.gabarit'

									, 'ggn.ui'

								])



								/* Style */
								->style([

										'html,body,.gui.sheet'=>[

											'width && height'=>'100%'

										]

								])



								->write('<base href="' . \_GGN::setvar($this->Manifest['URL']) . '" target="_self">')
							
							;

						/* Head : Initialisation / FIN */






						/* Framework / DEBUT */

							if(isset($this->framework) && is_array($this->framework) ){


								if(isset($this->framework['css']) && is_string($this->framework['css'])){

									$this->Tpl->cssFramework = $this->framework['css'];

								}


								if(isset($this->framework['css-version']) && is_string($this->framework['css-version'])){

									$this->Tpl->cssFrameworkVersion = $this->framework['css-version'];

								}


								if(isset($this->framework['js']) && is_string($this->framework['js'])){

									$this->Tpl->jsFramework = $this->framework['js'];

								}


								if(isset($this->framework['js-version']) && is_string($this->framework['js-version'])){

									$this->Tpl->jsFrameworkVersion = $this->framework['js-version'];

								}


							}

						/* Framework / FIN */






						/* Packages / DEBUT */

							if(isset($this->packages) && is_array($this->packages) ){


								if(isset($this->packages['css']) && is_array($this->packages['css'])){

									$this->Tpl->Head->cssPackages($this->packages['css']);

								}


								if(isset($this->packages['js']) && is_array($this->packages['js'])){

									$this->Tpl->Head->jsPackages($this->packages['js']);

								}


							}

						/* Packages / FIN */






						/* Ressources / DEBUT */

							if(isset($this->ressources) && is_array($this->ressources) ){

								$ResHost = (\_GGN::setvar($this->Manifest['Res']));


								if(isset($this->ressources['fonts']) && is_array($this->ressources['fonts']) ){

									$host = (isset($this->ressources['fonts.host']) && is_string($this->ressources['fonts.host']) ) ? $this->ressources['fonts.host'] : HTTP_HOST . 'font?family=';

									foreach ($this->ressources['fonts'] as $font) {

										$this->Tpl->Head->link(\_GGN::setvar($host) . $font . '&style=' . $this->Tpl->style);
										
									}

								}


								if(isset($this->ressources['css']) && is_array($this->ressources['css'])){

									foreach ($this->ressources['css'] as $css) {

										$rcss = 

										$this->Tpl->Head->link(\_GGN::setvar($ResHost . $css));

									}

								}


								if(isset($this->ressources['js']) && is_array($this->ressources['js'])){

									foreach ($this->ressources['js'] as $js) {

										$this->Tpl->Head->script(\_GGN::setvar($ResHost . $js));

									}

								}


							}

						/* Ressources / FIN */







						/* Head : Meta / DEBUT */

						if(isset($this->head['meta']) && is_array($this->head['meta']) ){

							foreach ($this->head['meta'] as $value) {
								
								call_user_func(

									[$this->Tpl->Head, 'meta']

									, ((isset($value[0])) ? $value[0] : false)

									, ((isset($value[1])) ? $value[1] : false)

									, ((isset($value[2])) ? $value[2] : false) 

								);

							}

						}

						/* Head : Meta / FIN */



					}


					else{

						echo 'init native entete du template';

					}


				}

			/* Entete du TPL / FIN */








			/* Chargement des plugins / DEBUT */

				public function TemplatesPlugins(){


					new \GGN\Using('Plugins');

					new \GGN\Plugin\HTML('Models');



					/* Pour les templates par Objet / DEBUT */

						if(is_object($this->Tpl)){


						}

					/* Pour les templates par Objet / HTML */



					/* Pour les Natifs HTML / DEBUT */

						else{

						}

					/* Pour les Natifs HTML / HTML */


				}

			/* Chargement des plugins / FIN */









			/*  / DEBUT */

				public function SetMenu($P = false){

					if(isset($this->menu)){

						$P = (is_array($P)) ? $P : (is_array($this->menu) ? $this->menu : []);


						$P['uriBase'] = (isset($P['uriBase'])) ? $P['uriBase'] : \_GGN::setvar($this->Manifest['URL']);

						$P['host'] = (isset($P['host'])) ? $P['host'] : (isset($this->host) ? $this->host : false);

						$P['attributes'] = (isset($P['attributes'])) ? $P['attributes'] : [];

						$P['class'] = (isset($P['class'])) ? $P['class'] : 'principal';

						$P['flex'] = (isset($P['flex'])) ? $P['flex'] : 'row';

						$P['items'] = (isset($P['items']) && is_array($P['items'])) ? $P['items'] : (isset($this->menu->items) && is_array($this->menu->items) ? $this->menu->items : []);


						$this->Built->Menu = new \GGN\Plugin\HTML\Model\Brick('Menu/UI-Styler', $P);

						return $this->Built->Menu;

					}
					
					return false;

				}

			/*  / FIN */









			/* Brique / DEBUT */

				public function Brick($Name, $args = []){

					$Path = \GGN\Path\Protocol::Value($this->Manifest['Path']);

					$File = $Path . 'brick.' . $Name . '.php';

					if(is_file($File)){ include $File; }

					else{ self::tExit("Brique manquante : '" . $Name . "' "); }

				}

			/* Brique / FIN */









			/* Entete / DEBUT */

				public function Header($args = [], $WithContainer = true){

					if(!Get::UsesAjax()){

						$this->Brick('header', $args);

					}



					/* Conteneur / DEBUT */

						if($WithContainer === true){

							$this->Container();

						}

					/* Conteneur / FIN */


				}

			/* Entete / FIN */







			/* Pied / DEBUT */

				public function Footer($args = []){

					if(!Get::UsesAjax()){

						$this->Brick('footer', $args);

					}

				}

			/* Pied / FIN */








			/* Conteneur / DEBUT */

				public function Container(){

					if(!isset($this->Tpl->Body->Sheet->node->Container)){

						if(!Get::UsesAjax()){

							$this->Tpl->Body->Sheet->node->Container = new \GGN\DPO\Theme\Tag([

								'id' => 'ggn-sheet-container'

								, 'class' => 'ui-container'

							]);

						}


					}


					if(Get::UsesAjax()){

						$this->Tpl->Body->Sheet->node->Container = new \GGN\DPO\Theme\Tag([

							'class' => ''

						]);

					}


				}

			/* Conteneur / FIN */









			/* Barre de navigation de l'app / DEBUT */

				public function HideNavBar(){

					/* Cacher certains elements / DEBUT  */

						if(isset($this->Tpl->Body->Sheet->node->NavBar)){

							$this->Tpl->Body->Sheet->node->NavBar

								->addClass('disable')

								->removeClass('enable')

							;

						}

						if(isset($this->Tpl->Body->Sheet->node->OnlyBar)){

							$this->Tpl->Body->Sheet->node->OnlyBar

								->addClass('disable')

								->removeClass('enable')

							;

						}

					/* Cacher certains elements / FIN  */

				}


				public function ShowNavBar(){

					/* Cacher certains elements / DEBUT  */

						if(isset($this->Tpl->Body->Sheet->node->NavBar)){

							$this->Tpl->Body->Sheet->node->NavBar

								->removeClass('disable')

							;

						}

						if(isset($this->Tpl->Body->Sheet->node->OnlyBar)){

							$this->Tpl->Body->Sheet->node->OnlyBar

								->removeClass('disable')

							;

						}

					/* Cacher certains elements / FIN  */

				}


				public function NavBar($Icon = false, $Menu = false, $Mods = false, $Options = false){

					global $GRegister;


					if(is_object($this->Tpl)){


						if(!Get::UsesAjax()){


							$this->ShowNavBar();

							$this->SetMenu();


							/* Arguments / DEBUT */


								$Icon = (is_array($Icon)) ? $Icon : [

									'url' => '?hlr'

									,'source' =>

										(	
											(isset($this->autonomous) && $this->autonomous === true) ? 

												(
													(isset($this->Manifest['Icon']) && is_string($this->Manifest['Icon'])) 

													? \_GGN::setvar($this->Manifest['Icon']) : HTTP_HOST . 'logo/ggn.senju.png'

												)

												:

												(HTTP_HOST . 'logo/ggn.senju.png')

										)

										. '?mode=-gd&width=80&height=80&filter=colorize:' 

										. $this->Tpl->Cores->CSS->Colorize['palette-light-color'] 

										. '&quality=-high&resize=true&resizeby=1'

								];


								$Menu = (is_string($Menu)) ? $Menu : (isset($this->Built->Menu->html) ? $this->Built->Menu->html : ''); // Menu


								$Mods = (is_string($Mods)) ? $Mods : ''; // Module


								$Options = (is_string($Options)) ? $Options : ''; // Option


							/* Arguments / FIN */




							/* En cas d'Erreur / DEBUT */

								// $P['error'] = (isset($P['error'])) ? $P['error'] : function($code = false){
								
								// 	return 'Impossible de charger la brique de l\'entete de l\'application';
								
								// };

							/* En cas d'Erreur / FIN */

							


							/* Déclaration / DEBUT */

								// $this->Tpl->Body->Sheet->node->NavBar = new \GGN\DPO\Theme\Tag([

								// 	'id' => 'ggn-nav-bar'

								// 	, 'class' => 'ui-navbar row'

								// ]);

								// $this->Tpl->Body->Sheet->node->NavBar->node->Content = new \GGN\DPO\Theme\Brick('Header', [

								// 	'CSSCore' => $this->Tpl->Cores->CSS

								// 	, 'attributes' => $P['attributes']

								// 	, 'arguments' => $P['arguments']

								// 	,'error'=> $P['error']

								// ]);



								/* Logo / DEBUT */

									if(isset($Icon)){

										if(isset($this->Tpl->Body->Sheet->node->OnlyBar->node->Logo->node->Icon)){

											$this->Tpl->Body->Sheet->node->OnlyBar->node->Logo->node->Icon

												->attrib('src', $Icon['source'] )

												->attrib('style', [

													'width' => 'auto'

													, 'height' => '52px'

												])

												->attrib('alt', \_GGN::varn('SITENAME') )

											;

										}

										elseif(isset($this->Tpl->Body->Sheet->node->NavBar->node->Content->node->Logo->node->Icon)){

											$this->Tpl->Body->Sheet->node->NavBar->node->Content->node->Logo->node->Icon

												->attrib('src', $Icon['source'] )

												->attrib('style', [

													'width' => 'auto'

													, 'height' => '28px'

												] )

												->attrib('alt', \_GGN::varn('SITENAME') )

											;

										}

										else{

										}

									}

								/* Logo / FIN */








								/* Menu de la page / DEBUT */

									if(isset($this->Tpl->Body->Sheet->node->NavBar->node->Content->node->Menu)){


										$this->Tpl->Body->Sheet->node->NavBar->node->Content->node->Menu

											->text($Menu)

										;

									}

								/* Menu de la page / FIN */








								/* Module / DEBUT */

									if(isset($Mods)){

										if(isset($this->Tpl->Body->Sheet->node->NavBar->node->Content->node->Module)){


											/* Module de l'entete : Barre de recherche / DEBUT */

												$this->Tpl->Body->Sheet->node->NavBar->node->Content->node->Module

													->addClass('col-0')

													->text( $Mods )

												;

											/* Module de l'entete : Barre de recherche / FIN */

										}



									}

									if(isset($this->Tpl->Body->Sheet->node->OnlyBar->node->Modules)){

										$this->Tpl->Body->Sheet->node->OnlyBar->node->Modules

											->text('&nbsp;')

										;
										
									}

								/* Module / FIN */









								/* Option / DEBUT */

									if(isset($this->Tpl->Body->Sheet->node->NavBar->node->Content->node->Option)){


										$this->Tpl->Body->Sheet->node->NavBar->node->Content->node->Option

											->addClass('gui flex row end')

											->text('<div class="col-0">&nbsp;</div>')

											->text('<div class="x48-h x96-w gui flex center padding-l-x8 text-x16"><span class="text-ellipsis text-upper-first color-light">' . $GRegister->USER['USERNAME'] . '</span></div>')

											->text( $Options )

											->text('<a href="' . HTTP_HOST . 'account?wr" ajax-capture="false"><div class="x48-h x32-w gui flex center padding-r-x4"><div class="gui iconx text-x20 color-light cursor-pointer" title="Gestion de compte" ui-icon="settings"></div></div></a>')

											->text('<a href="' . HTTP_HOST . 'logout?" ajax-capture="false"><div class="x48-h x32-w gui flex center padding-r-x4"><div class="gui iconx text-x20 color-light cursor-pointer" title="Se Déconnecter" ui-icon="exit_to_app"></div></div></a>')

											->text('<div class="x48-h x16-w mi-disable">&nbsp;</div>')

										;

									}

								/* Option / FIN */



							/* Déclaration / FIN */



						}


					}


					else{

						echo 'init native barre de navigation';

					}


				}

			/* Barre de navigation de l'app / FIN */






		} // Class Engine


	} // if class_exists 'Engine'









	if(!class_exists('\GGN\Apps\Behavior')){

		/*
			Behavior
		*/
		Class Behavior extends Invoke{


			Const SecExt = '.behavior';

			Const CMD_DATA_INIT = '{"Status":true,"Users":[]}';





			/* Déclaration */
			public function __construct($key = false){

				$App = new \GAPPS($key);

				if(is_object($App->Infos)){

					$this->App = $App;
					
				}

			}


			/* Dossier */
			static public function Path($key = ''){

				return __CORES_SYSTEM_COM_BEHAVIORS__ . (is_string($key) && !\Gougnon::isEmpty($key) ? $key . '/': '');

			}



			/* Ajouter une Section */
			public function _Section($section = false, $behavior = false){

				if(is_object($this->App->Infos) && is_string($section)){

					$k = $this->App->Infos->Key;

					$d = self::Path($k) . $section . '/';

					if(!is_dir($d)){

						$create = new \GGN\Dir\Create($d);

					}

					return $d;

				}

			}





			/* Gestion des Branches */
			public function BrancheFile($section = false, $branche = false){

				if(is_object($this->App->Infos) && is_string($section)){

					$k = $this->App->Infos->Key;

					return self::Path($k) . $section . '/' . $branche . self::SecExt;

				}

				else{

					return false;

				}

			}




			/* Obtenir une branche */
			public function GetBranche($section, $branche, $dataInit){

				$bran = $this->BrancheFile($section, $branche);

				$Vef = !is_file($bran);

				$d=[];

				$create = true;

				/* Creation du fichier s'il n'existe pas */
				if($Vef){

					$create = $this->createBranche($section, $branche, $dataInit);

				}

				/* Si le fichier existe */
				if($create==true){

					$d = $this->LoadBranche($section, $bran);

				}


				return $d;

			}



			public function UpdateBranche($user, $section, $branche, $value, $dataInit){

				$cmds = $this->GetBranche($section, $branche, $dataInit);

				$r = false;


				/* Pour un seul utilisateur */
				if(is_string($user) && is_array($cmds) && isset($cmds['Users']) && is_array($cmds['Users'])){	

					$r = true;

					$cmds['Status'] = null;

					$cmds['Users'][$user] = $value;

				}


				/* Pour un ensemble d'utilisateurs */
				if(is_array($user)){
					
					if(is_array($cmds) && isset($cmds['Users']) && is_array($cmds['Users'])){

						$r = true;

						$cmds['Status'] = null;

						foreach ($user as $uv) {

							$cmds['Users'][$uv] = $value;
							
						}

					}

				}


				/* Pour tous les utilisateurs */
				if(is_bool($user) && $user===false && is_array($cmds) ){	

					$r = true;

					$cmds['Status'] = $value;

					$cmds['Users'] = [];

				}




				/* Creation de la branche */
				$create = $this->createBranche($section, $branche, json_encode($cmds, \GStorages::JSON_OPT()));



				return $cmds;

			}




			/* Charger une branche */
			public function LoadBranche($section = false, $branche = false){

				$f = $this->BrancheFile($section, $branche);

				if(is_string($branche) && is_file($branche)){

					$c = file_get_contents($branche);

					try{

						return json_decode($c, \GStorages::JSON_OPT());
					}
					catch(Exception $e){

						return false;

					}


				}

				else{

					return false;
					
				}


			}


			public function createBranche($section = false, $branche = false, $content = ''){

				$file = $this->BrancheFile($section, $branche);

				return new \GGN\File\Create($file, $content);

			}





			/* Gestion des commandes */
			public function GetCommand($branche){

				return $this->GetBranche('commands', $branche, self::CMD_DATA_INIT);

			}





			public function SetCommand($user, $branche, $value){

				return $this->UpdateBranche($user, 'commands', $branche, $value, self::CMD_DATA_INIT);

			}






		} // Class Behavior


	} // if class_exists 'Behavior'









	if(!class_exists('\GGN\Apps\Controller')){

		/*
			Controller
		*/
		Class Controller extends Invoke{


			var $App;

			/* Déclaration */
			public function __construct($key = false){

				$App = new \GAPPS($key);

				if(isset($App->Infos) && is_object($App->Infos)){

					$this->App = $App;

					$this->Key = $App->Infos->Key;
					
				}

			}


			/* Mettre l'application en Pause */
			public function isApp(){

				return isset($this->App->Infos) && is_object($this->App->Infos);

			}


			/* Mettre l'application en Pause */
			public function Pause($user = false){

				$r=false;

				if($this->isApp()){

					$be = new Behavior($this->Key);

					$r = $be->SetCommand($user, 'Play', false);

				}

				return $r;

			}



			/* Mettre l'application en Play */
			public function Play($user = false){

				$r=false;

				if($this->isApp()){

					$be = new Behavior($this->Key);

					$r = $be->SetCommand($user, 'Play', true);

				}

				return $r;

			}



			/* Mettre l'application en Play */
			public function GetPlay(){

				$r=false;

				if($this->isApp()){

					$be = new Behavior($this->Key);

					$r = $be->GetCommand('Play');

				}

				return $r;

			}




		} // Class Controller


	} // if class_exists 'Controller'








	if(!class_exists('\GGN\Apps\Size')){

		/*
			Size
		*/
		Class Size extends Invoke{

			var $Path = [];
			
			var $Value = 0;
			
			var $Res = 0;

			var $ResPaths = [

				'images' => __IMAGES__
				
				,'fonts' => __FONTS__
				
				,'sound' => __SOUNDS_FILE__
				
				,'js' => __JAVASCRIPTS__
				
				,'svg' => __SVG__
				
				,'captcha' => __CAPTCHA__
				
				,'lang' => __LANGS__
				
				,'theme' => __THEMES__
				
				,'css' => __CSS__
				
				,'swf' => __SHOCKWAVES_X__
				
				,'videos' => __VIDEOS__

			];



			public function __construct($app = false){

				if(is_object($app) && isset($app->Infos)){
					
					$nfo = $app->Infos;

					$this->ResPaths['html.plugin'] = (__PLUGINS__ . 'HTML/');
					
					$this->ResPaths['php.plugin'] = (__PLUGINS__ . 'PHP/');


					/* Cacul des ressources */
					$res = 0;
					
					$resPath = substr($nfo->ResURL, strlen(HTTP_HOST));;
					
						foreach ($this->ResPaths as $key => $path) {
					
							$p = $path . $resPath;
					
							if(is_dir($p)){
					
								$val = (new \GGN\Dir\Size($p, true))->Value;
					
								$this->Path[$key] = $val;
					
								$res += $val;
					
							}
					
						}
					
					$this->Res = $res;


					/* Calcul de l'espace utilisé pour l'application */
					
					$appPath = \Gougnon::getPathFromProtocol($nfo->Path);
					
					$Op = (new \GGN\Dir\Size($appPath, true))->Value;
					
					$this->Path['app'] = $Op;


					/* Calcul de l'espace utilisé pour l'application par le Fournisseur */
					
					$vPath=\GAPPS::IN_COM_DIR($app->Key);
					
					$vOp = (new \GGN\Dir\Size($vPath, true))->Value;
					
					$this->Path['vendor'] = $vOp;


					/* Journal des activités */
					
					$clf = $app->COMLogFile();
					
					if(is_file($clf)){
					
						$fzclf = filesize($clf);
					
						$this->Path['com.log'] = $fzclf;
					
						$this->Value += $fzclf;
					
					}


					$this->Value += $res;
					
					$this->Value += $Op;
					
					$this->Value += $vOp;

				}

			}

		} // Class Size


	} // if class_exists 'Size'











	if(!class_exists('\GGN\Apps\Vendor')){

		/*
			Vendor
		*/
		Class Vendor extends Invoke{


			var $Manifest;

			var $Key;

			var $Triggered = false;

			var $Config = false;

			var $Engine = false;

			var $VendorPath = false;






			/* Constructrice de la classe / DEBUT */

				public function __construct($Key = false, $Param = []){


					if(is_array($Param)){

						foreach ($Param as $key => $value) {

							$this->{$key} = $value;
							
						}

					}


					$this->Key = $Key;

					$this->Manifest = Get::Manifest($Key);

					$this->VendorPath = __CORES_SYSTEM_COM_VENDOR__ . 'app/' . $Key . '/';

					$this->VendorPath = (is_dir($this->VendorPath)) ? $this->VendorPath : false;

				}

			/* Constructrice de la classe / FIN */







			/* Assembleur  / DEBUT */

				public function Assembler(){

					if(is_dir($this->VendorPath)){

						$File = $this->VendorPath . 'assembly.json';

						if(is_file($File)){

							$this->Config = json_decode(file_get_contents($File), \GStorages::JSON_OPT());

							if(is_array($this->Config)){return true;}

							else{return null;}

						}

						else{return null;}

					}

					else{return false;}

				}

			/* Assembleur  / FIN */






			/* Ouverture  / DEBUT */

				public function Open($Page){

					$Status = false;

					if($Status = $this->Assembler()){

						$this->Engine = (new Engine($this->Key, $this->Config, $this->Manifest))

							->Start($Page)

						;

					}

					else{

						if($Status === null){

							self::tExit("Impossible d'assembler l'application, données manquantes");

						}

						else{

							self::tExit("Impossible d'assembler l'application, l'application est introuvable");

						}

					}

				}

			/* Ouverture  / FIN */




		} // Class Vendor


	} // if class_exists 'Vendor'










				






