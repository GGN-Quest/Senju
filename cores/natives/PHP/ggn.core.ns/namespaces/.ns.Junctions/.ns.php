<?php

	/**
	 * GGN Junctions Invoke
	 *
	 * @version 0.1 
	 * @update 150814.1321
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\Junctions;
	
	





	/* Using */
	if(!class_exists('\GGN\Junctions\Using')){
	
		Class Using{
	
			public function __construct($ns){ $this->object = clone new \GGN\Using($ns); }
	
		} 
	
	}




	
	




	if(!class_exists('\GGN\DPO\Invoke')){new \GGN\Using('DPO');}

	if(!class_exists('\GGN\DPO\Page\Invoke')){new \GGN\Using('DPO\Page');}

	if(!class_exists('\GGN\DPO\Theme\Invoke')){new \GGN\Using('DPO\Theme');}

	if(!class_exists('\GGN\DPO\Procedure\Invoke')){new \GGN\Using('DPO\Procedure');}



	
	




	if(!class_exists('\GGN\Path\Invoke')){

		new \GGN\Using('Path');

	}










	if(!class_exists('\GGN\Junctions\Invoke')){

		/*
			Invoke
		*/
		Class Invoke{


			CONST Ext = '.json';


			CONST LayoutPrefix = 'layout.';

			CONST LayoutExt = '.php';


			CONST LayoutIPrefix = 'info.';

			CONST LayoutIExt = '.json';


			CONST DataPrefix = 'block.';

			CONST DataExt = '.php';



			CONST PAGE_ORIENT = 'column';

			CONST PAGE_FWK_CSS_ARC = 'CSSFramework';

			CONST PAGE_FWK_CSS_VER = 'senju.nightly.0.1';

			CONST PAGE_FWK_JS_ARC = 'JSFramework';

			CONST PAGE_FWK_JS_VER = 'nightly.0.1';



			static public function Dir(){return \__CORES_SYSTEM_JUNCTIONS__;}

			static public function VendorDir(){return \__CORES_SYSTEM_JUNCTIONS__ . 'vendor/';}

			static public function LayoutDir(){return \__CORES_SYSTEM_JUNCTIONS__ . 'layouts/';}

			static public function DataDir(){return \__CORES_SYSTEM_JUNCTIONS__ . 'data/';}


		} // Class Invoke


	} // if class_exists 'Invoke'










	if(!class_exists('\GGN\Junctions\Viewer')){

		/*
			Viewer
		*/
		Class Viewer extends Invoke{


			var $Key;

			var $Type;

			var $ViewMode;

			var $Tpl;



			/* Transcription / DEBUT */

				var $Transcribed = [

					'Doctype'=>false

					, 'Head'=>false

					, 'Body'=>false

				];

			/* Transcription / FIN */



			/* Infos Entete / DEBUT */

				var $TPL_TITLE = 'GGN Sense Viewer';

			/* Infos Entete / FIN */


			public function __construct($Key = false, $Type = 'layout', $ViewMode = false){

				$this->Key = $Key;

				$this->Type = $Type;

				$this->ViewMode = (is_bool($ViewMode)) ? $ViewMode : false;

				$this->TPL_ICON = HTTP_HOST . 'ggn.sense/app.icon.png';

			}



			/* Template / DEBUT */

				public function DPOTemplate(){


					if($this->ViewMode == true){

						$DPO = new \GGN\DPO\Theme\Custom();

						/* Driver DPO */

						$sDriver = new \GGN\DPO\Driver;

						$DPO->sDriver = $sDriver;

						$DPO->InitializeCores();


					}


					if($this->ViewMode == false){

						$DPO = new \GGN\DPO\Theme\Preset( (isset($this->Settings['theme'])) ? $this->Settings['theme'] : \_GGN::varn('SYSTEM_THEME') );

					}




					/* 
						Style du package du theme
					*/

					$DPO->style = \_GGN::varn('HOMEPAGE_STYLE');



					/* 
						Le Doctype de la page
					 */
					$DPO->doctype('html');




					/* 
						Paramètres de la page
					 */

					$DPO->settings = new \GGN\DPO\Theme\Settings();
					
					$DPO->settings

						->add('context.menu', true)

						->add('responsive', true)

					;





					/* Chargement du style du Noyau */

					$DPO->Cores->CSS->Style($DPO->style);
						
					$DPO->Cores->CSS->ColorsToParam();


					/* 
						Création de l'entete de la page
					 */
					$DPO->Head = new \GGN\DPO\Theme\Head();



					/* 
						Paramètres
					*/

						$this->TPL_TITLE = ($this->ViewMode === true) ? $this->TPL_TITLE : (isset($this->Settings['title']) ? $this->Settings['title'] : \_GGN::varn('SITENAME'));

							$this->TPL_TITLE = \_GGN::setvar($this->TPL_TITLE);


						$this->TPL_ICON = ($this->ViewMode === true) ? $this->TPL_ICON : (isset($this->Settings['icon']) ? $this->Settings['icon'] : \_GGN::varn('FAVICON'));

							$this->TPL_ICON = \_GGN::setvar($this->TPL_ICON);


					/* Debut de la sequence 'Head' */
					$DPO->Head
						
						->title($this->TPL_TITLE)

						/* 
							Favicone 
						*/
						->shortcut($this->TPL_ICON)

						// ->shortcut(\HTTP_HOST . '' . $this->TPL_ICON . '')


						/* 
							Balise Meta dans le 'head'
						*/
						->meta('charset', 'utf-8')
						
						->meta('http-equiv', 'pragma', 'cache')
						
						->meta('name', 'mobile-web-app-capable', 'yes')
						
						->meta('name', 'viewport', 'width=device-width,initial-scale=1, maximum-scale=1.0, user-scalable=no')


						->meta('name', 'theme-color', $DPO->Cores->CSS->styleProperty('palette-primary-color'))


						->meta('name', 'msapplication-navbutton-color', $DPO->Cores->CSS->styleProperty('palette-primary-color'))


						->meta('name', 'apple-mobile-web-app-capable', 'yes')

						->meta('name', 'apple-mobile-web-app-status-bar-style', 'black-translucent')
					



						/* Favicones */
						
						->meta('name', 'msapplication-square70x70logo', '' . $this->TPL_ICON . '?mode=-gd&width=70&height=70&resize=true&resizeby=0&quality=-high')

						->meta('name', 'msapplication-square150x150logo', '' . $this->TPL_ICON . '?mode=-gd&width=150&height=150&resize=true&resizeby=0&quality=-high')
						
						->meta('name', 'msapplication-square310x310logo', '' . $this->TPL_ICON . '?mode=-gd&width=310&height=310&resize=true&resizeby=0&quality=-high')


						->link(['rel'=>'apple-touch-icon','sizes'=>'48x48','href'=>'' . $this->TPL_ICON . '?mode=-gd&width=48&height=48&resize=true&resizeby=0&quality=-high'])

						->link(['rel'=>'apple-touch-icon','sizes'=>'64x64','href'=>'' . $this->TPL_ICON . '?mode=-gd&width=64&height=64&resize=true&resizeby=0&quality=-high'])

						->link(['rel'=>'apple-touch-icon','sizes'=>'76x76','href'=>'' . $this->TPL_ICON . '?mode=-gd&width=76&height=76&resize=true&resizeby=0&quality=-high'])

						->link(['rel'=>'apple-touch-icon','sizes'=>'120x120','href'=>'' . $this->TPL_ICON . '?mode=-gd&width=120&height=120&resize=true&resizeby=0&quality=-high'])

						->link(['rel'=>'apple-touch-icon','sizes'=>'152x152','href'=>'' . $this->TPL_ICON . '?mode=-gd&width=152&height=152&resize=true&resizeby=0&quality=-high'])

						->link(['rel'=>'apple-touch-icon','sizes'=>'192x192','href'=>'' . $this->TPL_ICON . '?mode=-gd&width=192&height=192&resize=true&resizeby=0&quality=-high'])

						->link(['rel'=>'apple-touch-icon','sizes'=>'196x196','href'=>'' . $this->TPL_ICON . '?mode=-gd&width=196&height=196&resize=true&resizeby=0&quality=-high'])


						/* 
							Framework CSS
						*/

						/* Packges de la page */
						// ->cssPackages()
						


						/* Packges du manifest */
						// ->cssPackages()



						/* Style Générale du theme */
						// ->link()



						/* Style du theme */
						// ->css()
						


						/* Code Général du Style du theme */
						// ->style()



						/* Framework JS */
						// ->jsPackages(['ggn.com.service'])


						/* Packges du manifest */
						// ->jsPackages()



						/* 
							Fichier JS
						*/
						// ->script($DPO->_url . '')


						/* 
							Script Générale du theme 
						*/
						// ->script()



						/* 
							Code JS
						*/
						// ->js()


						// ->write('<base href="'.HTTP_HOST.'" target="_self">')

					/* Fermeture de la sequence 'Head' */
					;


					/* 
						Création du corps de la page
					 */

					$DPO->Body = new \GGN\DPO\Theme\Body();

						$DPO->Body->Sheet = new \GGN\DPO\Theme\Tag(['class'=>'gui sheet']);
						

						/* Orientation de la page / DEBUT */

							if(isset($this->Settings['orientation']) && is_string($this->Settings['orientation'])){

								$DPO->Body->Sheet->addClass('' . (($this->Settings['orientation'] == 'row') ? 'flex row' : '') );

							}

						/* Orientation de la page / FIN */



					/* Mode Viewer : actif / DEBUT */

						if($this->ViewMode === true){

							$DPO->Body->attrib('ggn-junction-key', $this->Key);

							$DPO->Head->css(HTTP_HOST . 'ggn.sense.viewer/style.showing.css');

							$DPO->Head

								->cssPackages([

									'ggn.icons'
									
								])

								->jsPackages([

									'ggn.ui'

									, 'ggn.key.shot'

									, 'ggn.sense.junctions.editor'

								])

								->link(HTTP_HOST . 'font?family=roboto.thin')

								->link(HTTP_HOST . 'font?family=roboto.condensed.regular')

								->link(HTTP_HOST . 'font?family=roboto.condensed.black')

							;

						}

					/* Mode Viewer : actif / FIN */





					$this->Tpl = $DPO;


					/* Mode Viewer : inactif / DEBUT */

						if($this->ViewMode === false){


							/* Framework CSS / DEBUT */
							
								if(isset($this->Settings['fwk-css-arc']) && is_string($this->Settings['fwk-css-arc']) && !\Gougnon::isEmpty($this->Settings['fwk-css-arc']) ){

									$this->Tpl->cssFramework = $this->Settings['fwk-css-arc'];
								}

								if(isset($this->Settings['fwk-css-version']) && is_string($this->Settings['fwk-css-version']) && !\Gougnon::isEmpty($this->Settings['fwk-css-version']) ){

									$this->Tpl->cssFrameworkVersion = $this->Settings['fwk-css-version'];
								}

								if(isset($this->Settings['fwk-css-api']) && is_string($this->Settings['fwk-css-api']) && !\Gougnon::isEmpty($this->Settings['fwk-css-api']) ){

									$this->Tpl->Head->cssPackages( explode(',', $this->Settings['fwk-css-api']) );

								}

							/* Framework CSS / FIN */




							/* Framework JS / DEBUT */
							
								if(isset($this->Settings['fwk-js-arc']) && is_string($this->Settings['fwk-js-arc']) && !\Gougnon::isEmpty($this->Settings['fwk-js-arc']) ){

									$this->Tpl->jsFramework = $this->Settings['fwk-js-arc'];
								}

								if(isset($this->Settings['fwk-js-version']) && is_string($this->Settings['fwk-js-version']) && !\Gougnon::isEmpty($this->Settings['fwk-js-version']) ){

									$this->Tpl->jsFrameworkVersion = $this->Settings['fwk-js-version'];
								}

								if(isset($this->Settings['fwk-js-api']) && is_string($this->Settings['fwk-js-api']) && !\Gougnon::isEmpty($this->Settings['fwk-js-api']) ){

									$this->Tpl->Head->jsPackages( explode(',', $this->Settings['fwk-js-api']) );

								}

							/* Framework JS / FIN */




							/* Master de la page / DEBUT */
							
								if(isset($this->Settings['master']) && is_string($this->Settings['master']) && !\Gougnon::isEmpty($this->Settings['master']) ){

									$Master = \GGN\Path\Protocol::Value( dirname($this->Settings['master']) ) . basename($this->Settings['master']);


									if(is_file($Master)){

										include $Master;

									}

								}

							/* Master de la page / FIN */

						}

					/* Mode Viewer : inactif / FIN */





				}

			/* Template / FIN */





			/* Atouts JS et CSS / DEBUT */

				public function Assets($P = false){


					if(is_string($P)){

						$this->Tpl->Head
						
							/* Packges du manifest du thème */
							->cssPackages(isset($this->Tpl->manifest->package->css->{'' . $P . ''}->list) && is_object($this->Tpl->manifest->package->css->{'' . $P . ''}->list) ? $this->Tpl->manifest->package->css->{'' . $P . ''}->list: false )

							/* Style du theme */
							->link(isset($this->Tpl->manifest->links->{'' . $P . ''}->list) && is_object($this->Tpl->manifest->links->{'' . $P . ''}->list) ? $this->Tpl->manifest->links->{'' . $P . ''}->list: '')


							/* Code du Style du theme */
							->css(isset($this->Tpl->manifest->css->{'' . $P . ''}->list) && is_object($this->Tpl->manifest->css->{'' . $P . ''}->list) ? $this->Tpl->manifest->css->{'' . $P . ''}->list: '')


							/* Code du Style du theme */
							->style(isset($this->Tpl->manifest->style->{'' . $P . ''}->list) && is_object($this->Tpl->manifest->style->{'' . $P . ''}->list) ? $this->Tpl->manifest->style->{'' . $P . ''}->list: '')



							/* Packges du manifest du thème */
							->jsPackages(isset($this->Tpl->manifest->package->js->{'' . $P . ''}->list) && is_object($this->Tpl->manifest->package->js->{'' . $P . ''}->list) ? $this->Tpl->manifest->package->js->{'' . $P . ''}->list: '')
							

							/* Script du theme */
							->script(isset($this->Tpl->manifest->scripts->{'' . $P . ''}->list) && is_object($this->Tpl->manifest->scripts->{'' . $P . ''}->list) ? $this->Tpl->manifest->scripts->{'' . $P . ''}->list: '')


							/* Code JS du theme */
							->js(isset($this->Tpl->manifest->js->{'' . $P . ''}->list) && is_object($this->Tpl->manifest->js->{'' . $P . ''}->list) ? $this->Tpl->manifest->js->{'' . $P . ''}->list: '')

						;
						

					}




					$this->Tpl->Head
					
						/* Package CSS */
						->cssPackages($this->Tpl->manifest->package->css->list)


						/* Package CSS */
						->jsPackages($this->Tpl->manifest->package->js->list)

					
						/* Code CSS Général du theme */
						->link($this->Tpl->manifest->links->list)

						
						/* Code JS Général du theme */
						->js($this->Tpl->manifest->js->list)

					;



				}

			/* Atouts JS et CSS / FIN */





			/* Démarrer la séquence / DEBUT */

				public function Start(){

					$this->Vendor = new \GGN\Junctions\Vendor($this->Key);

					$this->Part = $this->Vendor->Get($this->Type);

					$this->Settings = $this->Vendor->Get('settings');


					$this->DPOTemplate();


					// /* Styles / DEBUT */

					// 	if(is_array($this->Part) && is_array($this->Part['styles'])){

					// 		$this->Tpl->Head->style($this->Part['styles']);

					// 	}

					// /* Styles / FIN */


				}

			/* Démarrer la séquence / FIN */






			/* Dispositif / DEBUT */

				public function Layout(){


					if(isset($this->Tpl) && is_object($this->Tpl)){



						if($this->Type == 'layout'){

							if(is_array($this->Part)){
								

								/* Propriétés / DEBUT */

									// if(isset($this->Part['properties']) && is_array($this->Part['properties'])){

									// 	foreach ($this->Part['properties'] as $name => $value) {

											$this->Tpl->Body->Sheet->attrib("style", ["min-width" => "100%"]);
											
									// 	}

									// }

								/* Propriétés / FIN */


								
								/* Racine / DEBUT */

									if(isset($this->Part['root']) && is_array($this->Part['root'])){


										/* Separateur / DEBUT */

											if($this->ViewMode === true){

												$Sep0 = (new \GGN\DPO\Theme\Tag(['class'=>' gui flex center viewer-layout-add-new-layer gui-fx disable-scrollbar']));

												$Sep0->node->Shape = (new \GGN\DPO\Theme\Tag([

													'class'=>'shape-add gui flex center cursor-pointer iconx text-x32 box-rounded-biggest'

													, 'handler-click'=>'Sense.Layout.Tool.Layer.Choose'

													, 'junction-layer-rank'=>'0'

													, 'junction-layer-insert'=>'before'

												]))->text('&nbsp;');


												if(empty($this->Part['root'])){

													$Sep0->addClass('active');

												}


												$this->Tpl->Body->Sheet->node->{'_seprator_0_'} = $Sep0;

											}

										/* Separateur / FIN */


										foreach ($this->Part['root'] as $nodeKey => $node) {

											if(is_array($node)){

												$Tag = $this->BuildNodes($node, $nodeKey);


												$this->Tpl->Body->Sheet->node->{'_layer_' . $nodeKey} = $Tag;


												/* Mode Viewer : actif / DEBUT */

													if($this->ViewMode === true){

														$this->Tpl->Body->Sheet->node->{'_layer_' . $nodeKey}

															->addClass('cursor-pointer viewer-layout-parent-layer')

														;

														$Sep = (new \GGN\DPO\Theme\Tag(['class'=>' gui flex center viewer-layout-add-new-layer gui-fx disable-scrollbar']));

														$Sep->node->Shape = (new \GGN\DPO\Theme\Tag([

															'class'=>'shape-add gui flex center cursor-pointer iconx text-x32 box-rounded-biggest'

															, 'handler-click'=>'Sense.Layout.Tool.Layer.Choose'

															, 'junction-layer-rank'=>'' . $nodeKey

															, 'junction-layer-insert'=>'after'

														]))->text('&nbsp;');

														$this->Tpl->Body->Sheet->node->{'_add_' . $nodeKey} = $Sep;
														
													}

												/* Mode Viewer : actif / FIN */



												/* Mode Viewer : inactif / DEBUT */

													if($this->ViewMode === false){

														// $this->Tpl->Body->Sheet->node->{'_layer_' . $nodeKey}

														// 	->text('cursor-pointer viewer-layout-parent-layer')

														// ;

														
													}

												/* Mode Viewer : inactif / FIN */

											}
											
										}

									}

								/* Racine / FIN */


							}

						}




					}

					return $this;

				}


				public function BuildNodes($node = false, $parentKey = false){

					$brick = false;


					if(isset($this->Tpl) && is_object($this->Tpl) && is_array($node)){


						if(is_array($this->Part) ){

							$node['name'] = isset($node['name']) ? $node['name'] : 'N/A';


							/* Type / DEBUT */

								$node['type'] = isset($node['type']) ? $node['type'] : 'layer';

								$brick = self::LayoutSample($node['type']);

								$info = Layout::Info($node['type']);

							/* Type / FIN */


							if(is_object($brick)){

								// $brick->text($node['name']);

								/* Dimensions / DEBUT */

									if(isset($node['size'])){

										$brick->attrib(

											"style", [

												"width" => (isset($node['size'][0])) ? $node['size'][0] : false

												, "height" => (isset($node['size'][1])) ? $node['size'][1] : false

											]

										);

									}

								/* Dimensions / FIN */




								if(isset($brick->node)){

									$this->NodeHitCounter = 0;

									$_this = $this;

									$this->GetDataLayer($brick, function($Brick, $attr, $parentKey) use ($_this, $node, $info){

										$K = $_this->NodeHitCounter;



										if($_this->Type == 'layout' ){
											

											/* Mode Viewer : inactif / DEBUT */

											if($_this->ViewMode === false){

												if(isset($node['linked-blocks'][$K])){

													$File = Data::File($node['linked-blocks'][$K]);

													if(is_file($File)){

														include $File;

													}

													else{

														$Brick->text('<!-- Junction///Bloc introuvable -->');

													}

												}

												else{

													$Brick->text('<!-- Junction///Aucun Bloc assigné -->');

												}

											}

											/* Mode Viewer : inactif / DEBUT */



											/* Mode Viewer : actif / DEBUT */

											if($_this->ViewMode === true){


												$DValue = (is_string($attr) && !\Gougnon::isEmpty($attr))

													? $attr 

													: ( ucfirst(isset($info['title']) ? $info['title'] : $node['name']) )

												;

													

												$Value = (isset($node['linked-blocks']) && is_array($node['linked-blocks']) )

													? ((isset($node['linked-blocks'][$K]) && is_string($node['linked-blocks'][$K])  && !\Gougnon::isEmpty($node['linked-blocks'][$K]) ) ? 'BLOC///' . $node['linked-blocks'][$K] : $DValue)

													: ($DValue)

												;


												$Brick

													->addClass('viewer-layout-layer gui-fx margin-lr-x4 gui flex center text-x18 text-ellipsis')


													->attrib('handler-click', "Junction.Layer.Edit")

													->attrib('junction-layout-layer-rank', "" . $parentKey)

													->attrib('junction-layout-layer-type', "" . $node['type'])

													->text($Value)

												;

											}

											/* Mode Viewer : actif / FIN */


										}




										$_this->NodeHitCounter++;

									}, $parentKey);


								}





								/* Contenu du Calques / DEBUT */

									if(isset($node['layers']) && is_array($node['layers'])){

										foreach ($node['layers'] as $key => $value) {

											$brick->node->{'_layer_' . $key} = $this->BuildNodes($value);
											
										}

									}

								/* Contenu du Calques / FIN */



							}


						}


					}

					return $brick;

				}

			/* Dispositif / FIN */






			/* Calque de données / DEBUT */

				public function GetDataLayer($node = false, $callback = false, $parentKey = false){

					if(is_object($node)){

						if(isset($node->attributes) && isset($node->attributes['junction-data-layer']) ){

							try{

								$callback($node, $node->attributes['junction-data-layer'], $parentKey);

							}

							catch(Exception $Error){}

						}

						else{

							if(isset($node->node)){

								foreach ($node->node as $key => $_nde) {
									
									$this->GetDataLayer($_nde, $callback, $parentKey);

								}

							}


						}

					}

					return $this;

				}

			/* Calque de données / FIN */






			/* Exemple de disposition / DEBUT */

				static public function LayoutSample($type = false){

					if(is_string($type)){

						$Brick = false;

							$File = self::LayoutDir() . self::LayoutPrefix . $type . self::LayoutExt;

							if(is_file($File)){

								include $File;

							}

						return $Brick;

					}

					else{return false; }

				}

			/* Exemple de disposition / FIN */






			/* Arrete la séquence pour génération / DEBUT */

				public function Close($Out = false){
			
					$Page = new \GGN\DPO\Page\Init($this->Tpl);

					$Page

						->engine()

						->schema( (new \GGN\DPO\Page\RenderingScheme())->html5 )

					;
						

					if($Out == false){

						$Page->start();

					}

					else{

						$Page->start(true);

						$this->Page = $Page;
						
						if(isset($Page->engine->driver->_head) && is_array($Page->engine->driver->_doctype)){

							$this->Transcribed['Doctype'] = $Page->engine->driver->_doctype;

						}

						if(isset($Page->engine->driver->_head) && is_array($Page->engine->driver->_head)){

							$this->Transcribed['Head'] = implode('', $Page->engine->driver->_head);

						}

						if(isset($Page->engine->driver->_body) && is_array($Page->engine->driver->_body)){

							$this->Transcribed['Body'] = implode('', $Page->engine->driver->_body);

						}


					}

				}

			/* Arrete la séquence pour génération / FIN */





		} // Class Viewer


	} // if class_exists 'Viewer'









	if(!class_exists('\GGN\Junctions\Update')){

		/*
			Update
		*/
		Class Update extends Invoke{


			var $Key;


			public function __construct($Key = false){

				$this->Key = $Key;

			}



			public function Put($Part, $Name = false, $Rank = false, $Insert = 'after'){

				$this->Vendor = new Vendor($this->Key);

				$this->Get = $this->Vendor->Get($Part);

				$Root = (isset($this->Get['root'])) ? $this->Get['root'] : false;

				$NewRoot = [];


				if(is_array($Root) && is_string($Name)){

					$New = ['type' => $Name];


					if(empty($Root)){

						$NewRoot[] = $New;

					}

					if(!empty($Root)){

						$Root[] = false;

						foreach ($Root as $gRank => $DataRoot) {

							/* Apres / DEBUT */
								
								if($Insert == 'after' && $Rank == ($gRank - 1) ){

									$NewRoot[] = $New;

								}

							/* Apres / FIN */
							

							/* Avant / DEBUT */

								if($Insert == 'before' && $Rank == ($gRank - 1) ){

									$NewRoot[] = $New;

								}

							/* Avant / FIN */


							if(is_array($DataRoot)){

								$NewRoot[] = $DataRoot;
								
							}
							
						}

					}


					/* Remplacement / DEBUT */

						$this->Get['root'] = $NewRoot;

						return $this->Vendor->Update($Part, $this->Get);

					/* Remplacement / FIN */

				}


				return false;

			}




			public function Remove($Part, $Rank = false){

				$this->Vendor = new Vendor($this->Key);

				$this->Get = $this->Vendor->Get($Part);

				$Root = (isset($this->Get['root'])) ? $this->Get['root'] : false;

				$NewRoot = [];



				if(is_array($Root) && is_numeric($Rank) ){

					if(isset($Root[$Rank])){



						/* Suppression de l'entrée / DEBUT */

							unset($Root[$Rank]);

						/* Suppression de l'entrée / FIN */



						/* Reorganisation / DEBUT */

							foreach ($Root as $Value) {

								$NewRoot[] = $Value;
								
							}

						/* Reorganisation / FIN */



						/* Remplacement / DEBUT */

							$this->Get['root'] = $NewRoot;

							return $this->Vendor->Update($Part, $this->Get);

						/* Remplacement / FIN */


						
					}

				}


				return false;

			}




		} // Class Update


	} // if class_exists 'Update'









	if(!class_exists('\GGN\Junctions\Data')){

		/*
			Data
		*/
		Class Data extends Invoke{



			static public function File($Name = false){

				if(is_string($Name)){

					$File = self::DataDir() . self::DataPrefix . $Name . self::DataExt;

					if(is_file($File)){

						return $File;

					}

				}


				return false;

			}

			static public function Blocks(){

				$Out = [];

				$Dir = self::DataDir();

				$Scan = \Gougnon::scanFolder( $Dir );

				if(is_array($Scan)){

					foreach ($Scan as $File) {

						$Base = basename($File);

						if( (substr($Base, 0, strlen(self::DataPrefix)) == self::DataPrefix) && (substr($Base, -1 * strlen(self::DataExt)) == self::DataExt) ){

							$Name = substr($Base, strlen(self::DataPrefix), -1 * strlen(self::DataExt));

							$Out[$Name] = \GGN\Path\Protocol::Detect( $Dir ) . self::DataPrefix . $Name . self::DataExt;

							// $Out[$Name] = json_decode( \GGN\File\Content::Get( self::DataDir() . self::DataPrefix . $Name . self::DataExt ), \GStorages::JSON_OPT());


						}
						
					}

				}

				return $Out;

			}




			static public function BlockContent($Name){

				$File = self::DataDir() . self::DataPrefix  . $Name . self::DataExt ;

				if(is_file($File)){

					return \GGN\File\Content::Get($File);

				}

				else{

					return false;

				}

			}




			static public function Put($Name, $Content = ''){

				$File = self::DataDir() . self::DataPrefix  . $Name . self::DataExt ;

				return \Gougnon::createFile($File, $Content);

			}




		} // Class Data


	} // if class_exists 'Data'










	if(!class_exists('\GGN\Junctions\Layout')){

		/*
			Layout
		*/
		Class Layout extends Invoke{



			static public function Info($Name){

				$File = self::LayoutDir() . self::LayoutIPrefix . $Name . self::LayoutIExt;

				if(is_file($File)){

					return json_decode( \GGN\File\Content::Get($File), \GStorages::JSON_OPT());

				}

				else{

					return false;

				}

			}


			static public function Availables(){

				$Out = [];

				$Scan = \Gougnon::scanFolder( self::LayoutDir() );

				if(is_array($Scan)){

					foreach ($Scan as $File) {

						$Base = basename($File);

						if( (substr($Base, 0, strlen(self::LayoutIPrefix)) == self::LayoutIPrefix) && (substr($Base, -1 * strlen(self::LayoutIExt)) == self::LayoutIExt) ){

							$Name = substr($Base, strlen(self::LayoutIPrefix), -1 * strlen(self::LayoutIExt));

							$Out[$Name] = json_decode( \GGN\File\Content::Get( self::LayoutDir() . self::LayoutIPrefix . $Name . self::LayoutIExt ), \GStorages::JSON_OPT());

						}
						
					}

				}

				return $Out;

			}

		} // Class Layout


	} // if class_exists 'Layout'









	if(!class_exists('\GGN\Junctions\Vendor')){

		/*
			Vendor
		*/
		Class Vendor extends Invoke{


			var $Key;

			var $Path;


			public function __construct($Key = false){

				if(is_string($Key)){

					$this->Key = $Key; 

					$this->Path = \GGN\Path\Name::Format(self::VendorDir() . $Key); 

				}

			}



			/*
				Mise à jour des informations d'une jonction
			*/
			public function Update($Part = false, $New = []){

				if(is_string($Part)){

					$File = $this->Path . $Part . self::Ext;

					if(is_file($File)){

						return \Gougnon::createFile( $File, json_encode($New, \GStorages::JSON_OPT()) );

					}

				}

				return false;

			}



			/*
				Les informations d'une jonction
			*/
			public function Get($Part = false){

				if(

					isset($this->Key) && is_string($this->Key) 

					&& isset($this->Path) && is_string($this->Path)

				){

					if(is_dir($this->Path)){

						if(is_string($Part)){

							$File = $this->Path . $Part . self::Ext;

							if(is_file($File)){

								return json_decode(\GGN\File\Content::Get($File), \GStorages::JSON_OPT());

							}

							else{return null;}

						}

						else{

							$Scan = \Gougnon::scanFolder($this->Path);

							if(is_array($Scan)){

								$Out = [];

								foreach ($Scan as $P) {

									if(self::HasExt($P)){

										$N = substr(basename($P), 0, -1 * strlen(self::Ext));

										$C = \GGN\File\Content::Get($P);

										$Out[$N] = json_decode($C, \GStorages::JSON_OPT());

									}
									
								}

								return $Out;

							}

							else{return null; }

						}

					}

					else{return false;}
					
				}

				else{return false;}

			}



			/* 
				Possède l'extention
			*/
			static public function HasExt($File){

				return substr($File, -1 * strlen(self::Ext) ) == self::Ext;

			}



			/* 
				Toutes les junctions dans la racine 
			*/
			static public function Root(){

				$Dir = self::VendorDir();

				$Load = \Gougnon::iScanFolder($Dir);

				$Out = [];


				foreach ($Load as $File) {

					if(self::HasExt($File)){

						$F = dirname($File);

						$Fi = \GGN\Path\Name::OutBase($F, $Dir);

						// $Fi = \GGN\Path\Protocol::Detect($F);

						if(!in_array($Fi, $Out)){

							array_push($Out, $Fi);
							
						}

					}
					
				}

				return $Out;

			}

			


			/* 
				Création d'une Jonction vide
			*/
			static public function CreateEmpty($Path = false){

				if(is_string($Path)){

					$Dir = \GGN\Path\Name::Format(self::VendorDir() . $Path);

					if(!is_dir($Dir)){

						if(\Gougnon::createFolders($Dir)){

							if(

								\Gougnon::createFile($Dir . 'layout.json', '{"root":[]}')

								&& \Gougnon::createFile($Dir . 'settings.json', '{}')

							){

								return true;
								
							}


						}

						else{return false;}

					}

					else{return null;}

				}

				return false;

			}

			
			


			/* 
				Création d'une Jonction vide
			*/
			static public function Delete($Path = false){

				if(is_string($Path)){

					$Dir = \GGN\Path\Name::Format(self::VendorDir() . $Path);

					if(is_dir($Dir)){

						if(\GGN\Dir\Remove($Dir)){

							return true;
							
						}

					}

					else{return null;}

				}

				return false;

			}





		} // Class Vendor


	} // if class_exists 'Vendor'




