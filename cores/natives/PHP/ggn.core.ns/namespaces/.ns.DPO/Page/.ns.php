<?php

	/**
	 * GGN DPO Page
	 *
	 * @version 0.1
	 * @update 150911.0854
	*/




/*
	Nom de l'espace
*/
namespace GGN\DPO\Page;


	/* Chargement du script */
	new \GGN\DPO\Using('DPO\Transcriber');




	if(!defined('GGN\DPO\Page\CDxS_')){

		define('GGN\DPO\Page\CDxS_', 'cdx;inst;driver.settings;');

	}

	if(!defined('GGN\DPO\Page\CDxP_')){

		define('GGN\DPO\Page\CDxP_', 'cdx;inst;driver.property;');

	}

	if(!defined('GGN\DPO\Page\CDxM_')){

		define('GGN\DPO\Page\CDxM_', 'cdx;inst;many.method;');

	}

	if(!defined('GGN\DPO\Page\CDxH_')){

		define('GGN\DPO\Page\CDxH_', 'cdx;inst;head.tag;');

	}

	if(!defined('GGN\DPO\Page\CDxB_')){

		define('GGN\DPO\Page\CDxB_', 'cdx;inst;body.tag;');

	}

	if(!defined('GGN\DPO\Page\CDxLYR_')){

		define('GGN\DPO\Page\CDxLYR_', 'cdx;inst;layout.layer;');

	}

	if(!defined('GGN\DPO\Page\CDxTPL_')){

		define('GGN\DPO\Page\CDxTPL_', 'cdx;inst;tpl.class;');

	}





	if(!class_exists('\GGN\DPO\Page\Invoke')){
			
		Class Invoke extends \GGN\DPO\Invoke{
				
			const NAME = 'Gougnon DPO Page';
			
			const VERSION = '0.1';
			
			const UPDATE = '160921.1223';







		} // Class 'Invoke'


	} // If class exists 'Invoke'







	if(!class_exists('\GGN\DPO\Page\Secure')){
			
		Class Secure extends Invoke{
				
			const NAME = 'Gougnon DPO Page : Disposition de sécurrité';
			
			const VERSION = '0.1';
			
			const UPDATE = '150911.0854';



			/* Déclaration */
			public function __construct(){

				$this->args = func_get_args();

			}



			/* Pas de iframe comme parent : Retour le code JS */
			static public function noIframeAccessScript(){return 'if(window.parent.length!=0){window.top.location="' . \Gougnon::currentURL() . '";}';}

			static public function Tag_NoIframeAccessScript(){return '<script type="text/javscript">' . self::noIframeAccessScript() . '</script>';}




		} // Class 'Secure'


	} // If class exists 'Secure'







	if(!class_exists('\GGN\DPO\Page\RenderingScheme')){
			
		Class RenderingScheme extends Invoke{
				
			const NAME = 'Gougnon DPO Page : Disposition du générateur de la page';
			
			const VERSION = '0.1';
			
			const UPDATE = '150911.0854';




			/* Disposition */

				/* Disposition : HTML5 */
				public $html5 = [
					'head' => ['shortcut','title','meta','css.package','link','css','writing']
					,'body' => ['writing','js.package','script','js']
				];

				/* Disposition : HTML4 */
				public $html4 = [
					'head' => ['shortcut','title','meta','css.package','link','css','js.package','script','js','writing']
					,'body' => ['writing']
				];

				/* Disposition : Contenu de la balise "BODY" */
				public $body = [
					'body' => ['writing','js']
				];

				/* Disposition : Contenu de la balise "HEAD" */
				public $head = [
					'head' => ['shortcut','title','meta','css.package','link','css','js.package','script','js','writing']
				];




			/* Déclaration */
			public function __construct(){

				$this->default = $this->html5;

			}





		} // Class 'RenderingScheme'


	} // If class exists 'RenderingScheme'







	if(!class_exists('\GGN\DPO\Page\Init')){

			
		Class Init extends Invoke{
				
			const NAME = 'Gougnon DPO Page : Initialiser';
			
			const VERSION = '0.1';
			
			const UPDATE = '150911.0854';



			/* Code retourné de la page */
			public $code = false;



			/* Déclaration */
			public function __construct($tpl = false){
				
				$this->tpl = (is_object($tpl)) ? $tpl: false;

			}


			/* Codex de traitement */
			protected function initCodex(){
				
				if(is_object($this->engine) && method_exists($this->engine, 'CDx')){

					/* Propriété */
					$this->engine

						->CDx('name', ['property'=>'name'])
						->CDx('version', ['property'=>'version'])
						->CDx('style', ['property'=>'packageStyle'])
						->CDx('palette', ['property'=>'packagePalette'])

						->CDx('jsFramework', ['property'=>'JSFramework'])
						->CDx('jsFrameworkVersion', ['property'=>'JSFrameworkVersion'])

						->CDx('cssFramework', ['property'=>'CSSFramework'])
						->CDx('cssFrameworkVersion', ['property'=>'CSSFrameworkVersion'])

						// ->CDx('title', ['property'=>'title'])
						// ->CDx('theme', ['property'=>'theme'])

						/* Methodes */
						->CDx('doctype', ['method'=>'doctype'])
						->CDx('html', ['method'=>'html'])
						// ->CDx('meta', ['method'=>'meta'], CDxM_)
						// ->CDx('link', ['method'=>'callCSS'], CDxM_)
						// ->CDx('css', ['method'=>'css'], CDxM_)
						// ->CDx('script', ['method'=>'callJS'], CDxM_)
						// ->CDx('js', ['method'=>'js'], CDxM_)

						/* Parcourir */
						// ->CDx('head', ['browse'=>true])
						// ->CDx('body', ['browse'=>true])
					;

				}

				return $this;
			}


			/* Génération de la page */
			public function start($return = false, $part = 'complete'){
				
				// var_dump($return);exit('here // ' . __LINE__);

				if(isset($this->engine) && is_object($this->engine) && method_exists($this->engine, 'rendering')){


					if($return === true){


						$this->code = $this->engine->rendering(true,$part);

					}
					
					else{

						$this->engine->rendering(false, $part);

					}

				}

				return $this;
			}





			/* Moteur de rendu de la page de la page */
			public function engine(){

				$this->engine = new Engine($this->tpl);

				$this->initCodex();
				
				return $this;
			}


			/* Disposition du générateur de la page */
			public function schema($array = false){

				$this->engine->schema = (is_array($array)) ? $array : (new Schema())->default ;

				return $this;
			}





		} // Class 'Init'


	} // If class exists 'Init'






	if(!class_exists('\GGN\DPO\Page\Engine')){


			
		Class Engine extends Invoke{
				
			const NAME = 'Gougnon DPO Page : Moteur de rendu';
			
			const VERSION = '0.1';
			
			const UPDATE = '150911.0854';






			
			/* Instuctions */
			public $_data = [];
			public $_codex = [];


			/* Ecriture direct */
			protected $__head = [];
			protected $__body = [];


			/* Rendu HTML */
			protected $rHTML = '';


			/* Declaration */
			public function __construct($tpl = false){
				
				$this->tpl = $tpl;

			}




			/* Codex */
			/* Ajout */
			public function CDx($key = false, $behavior = false, $type = CDxS_){

				$this->_codex[$key] = ['behavior'=>$behavior ,'type'=>$type];

				return $this;
			}




			
			/* Contenu HTML lors du rendu */
			protected function rHTML($string = false, $add = false, $return = false){

				if(is_string($string)){
					if($return == true){
						$this->rHTML .= $string;
					}
					else{

						if($add==true){
							$this->_addToBody($string);
						}
						else if($add==false){
							$this->driver->body($string);
						}
						else{}
					}
				}

				// var_dump(func_get_args());

				return $this;
			}
			protected function resetRHTML(){
				$this->rHTML = '';
			}
			




			/* Traitement unitaire */
			protected function render($data = false, $config = [], $nstt = []){

				$rRendering = false;
				// $rHTML = '';


				/* Configuration du rendu */
				$this->rCfg = !is_array($config) ? [] : $config;


				/* Instruction du rendu */
				$this->rNstt = !is_array($nstt) ? [] : $nstt;



				/* Configuration : Usage du codex pour le rendu */
				$this->rCfg['RunCodex'] = (isset($this->rCfg['RunCodex'])) ? $this->rCfg['RunCodex']: true;


				/* Retourner le corps du rendu */
				$this->rNstt['ReturnHTML'] = $rH = (isset($this->rNstt['ReturnHTML'])) ? $this->rNstt['ReturnHTML']: false;



				/* Rendu */
				if(is_array($data) || is_object($data)){

					foreach ($data as $key => $value) {

						/* Instruction du codex */
						if(isset($this->_codex[$key]) && $this->rCfg['RunCodex']===true){

							$codex = $this->_codex[$key];
							
							$behavior = $codex['behavior'];
							
							$type = $codex['type'];


							/* Propriété du driver */
							if(isset($behavior['property'])){
								$this->driver->{$behavior['property']} = $value;
							}
							

							/* Methode de driver */
							if(isset($behavior['method'])){
								
								if($type==CDxM_){

									if(is_array($value)){
										foreach ($value as $k => $arg) {
											$this->driver->{$behavior['method']}($arg);
										}
									}

									else{
										$this->driver->{$behavior['method']}($value);
									}
											

								}

								else{
									$this->driver->{$behavior['method']}($value);
								}
								
							}


							/* Parcourir */
							if(isset($behavior['browse'])){

								$rRendering = $this->render($value, false, $this->rNstt);

							}


						}
						/* Instruction du codex : FIN */



						/* Instruction native */
						
						/* Objet et Classe */
						if(is_object($value)){

							$object = $value; 

							/* Classe Tx */
							if(isset($object->_Tx) && is_array($object->_Tx) && isset($object->_Tx[0])){

								/* Traitement */
								switch ($object->_Tx[0]) {

									/* Paramètres */
									case \GGN\DPO\Theme\TPL_INSTANCE_SETTINGS_:
										unset($object->_Tx);

										if(is_object($object) || is_array($object)){
											foreach ($object as $key => $value) {
												$this->driver->{$key} = $value;
											}
										}

									break;

									
									/* Entete */
									case \GGN\DPO\Theme\TPL_INSTANCE_HEAD_:
										
										foreach ($object as $n => $d) {


											switch(strtolower($n)){

												/* Ecrire dans le head */
												case 'writing': 
													if(is_array($d)){foreach ($d as $v) {$this->_addToHead($v); } }
													else{if(is_string($d)){$this->_addToHead($d); } }
												break;

												/* Ecrire dans le body : non-orienté */
												case 'write': 
													if(is_array($d)){foreach ($d as $v) {$this->driver->head($v); } }
													else if(is_string($d)){$this->driver->head($d); }
												break;


												/* Titre de la apge */
												case 'title': if(is_string($d)){$this->driver->title = $d; } break;

												case 'meta': 
													if(is_array($d)){foreach ($d as $v) {call_user_func_array([$this->driver, 'meta'], $v);} }
													if(is_string($d)){$this->driver->meta($d);}
												break;

												case 'csspackage':
													if(is_array($d)){foreach ($d as $v) {$this->driver->cssPackages($v); } }
													if(is_string($d)){$this->driver->cssPackages($d);}
												break;

												case 'jspackage':
													if(is_array($d)){foreach ($d as $v) {$this->driver->jsPackages($v); } }
													if(is_string($d)){$this->driver->jsPackages($d);}
												break;

												case 'link':
													if(is_array($d)){foreach ($d as $v) {$this->driver->callCSS($v); } }
													if(is_string($d)){$this->driver->callCSS($d);}
												break;

												case 'style': 
													if(is_array($d)){foreach ($d as $v) {call_user_func_array([$this->driver, 'style'], [$v]); } }
													if(is_string($d)){$this->driver->_css($d);}
												break;

												case 'script': 
													if(is_array($d)){foreach ($d as $v) {call_user_func_array([$this->driver, 'callJS'], is_string($v)?[$v]: $v); } }
													if(is_string($d)){$this->driver->callJS($d);}
												break;

												case 'js':
													if(is_array($d)){foreach ($d as $v) {call_user_func_array([$this->driver, 'js'], is_array($v)?$v: [$v]);} }
													if(is_string($d)){$this->driver->js($d);}
												break;

												case 'shortcut':
													if(is_string($d)){$this->driver->shortcut($d);}
													if(is_array($d)){foreach ($d as $v) {call_user_func_array([$this->driver, 'shortcut'], $v);} }
												break;

												default:
													if(is_object($d)){$rRendering = $this->render([$d], ['RunCodex'=>false], $this->rNstt);}
													if(is_array($d)){$rRendering = $this->render($d, false, $this->rNstt); }
												break;


											}

										}
										
									break;


									/* Corps de la page */
									case \GGN\DPO\Theme\TPL_INSTANCE_BODY_:

										unset($object->_Tx);


										/* Attributs de la balise */
										



										foreach ($object as $n => $d) {


											switch(strtolower($n)){

												/* Attributes du body */
												case 'attributes': 
													foreach ($d as $name => $value) {
														$this->driver->bodyAttrib($name, $value);
													}
												break;

												/* Ecrire dans le body : non-orienté */
												case 'write': 
													if(is_array($d)){foreach ($d as $v) {$this->rHTML($v ,false, $rH); } }
													else if(is_string($d)){$this->rHTML($d  ,false, $rH); }
												break;

												/* Ecrire dans le body : orienté */
												case 'writing': 
													if(is_array($d)){foreach ($d as $v) {$this->rHTML($v  ,true, $rH); } }
													else if(is_string($d)){$this->rHTML($d  ,true, $rH); }
												break;

												case 'script': 
													if(is_array($d)){foreach ($d as $v) {call_user_func_array([$this->driver, 'callJS'], is_string($v)?[$v]: $v); } }
													if(is_string($d)){$this->driver->callJS($d);}
												break;

												case 'js': 
													if(is_array($d)){foreach ($d as $v) {call_user_func_array([$this->driver, 'js'], is_string($v)?[$v]: $v);} }
													if(is_string($d)){$this->driver->js($d);}
												break;

												default:
													if(is_object($d)){$rRendering = $this->render([$d], ['RunCodex'=>false], $this->rNstt); }
													if(is_array($d)){$rRendering = $this->render($d, false, $this->rNstt); }
													else{}
												break;

											}
										}

									break;






									/* Contenu brute */
									case \GGN\DPO\Theme\TPL_INSTANCE_CNT_:

										unset($object->_Tx);
										// var_dump($object);

										if(isset($this->driver) && isset($object->data)){

											if(is_string($object->data)){
												$this->rHTML($object->data ,true, $rH);
											}
											else{
												if(is_object($object->data)){
													$rRendering = $this->render([$object->data], ['RunCodex'=>false], $this->rNstt);
												}

											}		
										}

									break;






									/* Brique du Theme */
									case \GGN\DPO\Theme\TPL_INSTANCE_BRICK_:

										unset($object->_Tx);

										if(isset($this->tpl) && is_object($this->tpl) && is_object($this->tpl) && is_object($this->tpl)){
											


											/* 
												Theme prédefini
											*/
											if($this->tpl->_Tx[0] == \GGN\DPO\Theme\TPL_INSTANCE_PRESET_){

												if(method_exists($this->tpl, 'brick')){

													$this->tpl->brick($object->asset['name']);

												}

											}




											/* 
												Theme personnalisé 
											*/
											if($this->tpl->_Tx[0] == \GGN\DPO\Theme\TPL_INSTANCE_CUSTOM_){


											}


											// var_dump($this->tpl->_BRICKS_);exit;


											/* 
												Affichage de la brique
											*/
											if(isset($this->tpl->_BRICKS_->{$object->asset['name']})){

												/* Brique */
												$brick = $this->tpl->_BRICKS_->{$object->asset['name']};


												/* Existence et fonctionnalité du Theme de la brique */
												if(isset($brick['template']) && is_callable($brick['template'])){


													/* Nouvelle instance */
													$inst = new \_GGNCustomObject($brick);



													/* Execution du Theme de la brique */
													$bri = call_user_func_array($inst->template, ((isset($object->asset['arguments'])) ? $object->asset['arguments']: []) );


													/* Ajout de nouveau attributes a partir de l'appelle */
													if(isset($object->asset['attributes'])){

														
														foreach ($object->asset['attributes'] as $ky => $ve) {
															
															if(strtolower($ky)!='tagname' && strtolower($ky)!='tag'){

																if(is_string($ve)){

																	$bri->attributes[$ky] = ( (isset($bri->attributes[$ky]) && is_string($bri->attributes[$ky])) ? $bri->attributes[$ky] : '') . ' ' . $ve;

																}

																else if(is_array($ve)){

																	if(isset($bri->attributes[$ky]) && is_array($bri->attributes[$ky])){

																		$bri->attributes[$ky] = \Gougnon::mergeArray($bri->attributes[$ky], $ve);

																	}

																}

																else{

																	$bri->attributes[$ky] = $ve;
																	
																}


															}

														
														}


													}


													/* Nouveau rendu pour la brique */
													$rRendering = $this->render( [ $bri ] ,(isset($object->asset['render.args'])) ? $object->asset['render.args']: [] , $this->rNstt);
													
												}

											}

											/* 
												Sinon
											*/
											else{

												/* 
													Message d'erreur definit
												*/
												if(isset($object->asset['error']) && is_callable($object->asset['error']) ){

													$return = $object->asset['error']('brick.unavailable');

													if(is_string($return)){$this->rHTML($return  ,true, $rH);}

												}

												/* 
													Message d'erreur par default
												*/
												else{

													$this->rHTML('<br>Brique ' . ($object->asset['name']) . ' introuvable<br>' ,true, $rH);

												}

											}



										}

										/* 
											Sinon
										*/
										else{
												
											/* 
												Impossible de charger une brique
											*/
											$this->rHTML('<br>Erreur lors du chargement de la brique<br>' ,true, $rH);

										}


									break;




									/* Calque */
									case \GGN\DPO\Theme\TPL_INSTANCE_TAG_:

										unset($object->_Tx);

										if(isset($this->driver)){


											/* Nom de la balise */
											$tag = (isset($object->asset->tagName)) ? $object->asset->tagName: 'div';


											/* Attributs de la balise */
											$attrib = (isset($object->attributes)) ? ' ' . \GGN\DPO\Util::setAttributes($object->attributes) :'';


											/* Ecriture de la balise */
											$this->rHTML('<' . $tag . $attrib . '>' ,true, $rH);


												/* Contenu */
												foreach ($object->node as $n => $d) {


													/* Nouveau rendu */
													if(is_object($d)){
														$rRendering = $this->render([$n=>$d], ['RunCodex'=>false], $this->rNstt);
													
													}

													/* Sinon */
													else{

														/* Chaine de charatère */
														if(is_string($d)){
															
															$this->rHTML($d ,true, $rH);
														
														}

													}

												}

											$this->rHTML('</' . $tag . '>' ,true, $rH);

										}

									break;




									/* Procedure : Base de donnée */
									case \GGN\DPO\Procedure\PROC_INSTANCE_DB_:
										global $database;

										if(isset($object->query) && isset($object->table) && isset($object->each) && is_callable($object->each)){

											$return = [];
											$q = isset($object->query) ? $object->query: false;
											$tbl = isset($object->table) ? $object->table: false;
											$name = (is_array($tbl) && isset($tbl[0]) && is_string($tbl[0])) ? $tbl[0]: (is_string($object->table) ? $object->table: false);
											$nativeTbl = (is_array($tbl) && isset($tbl[1]) && is_bool($tbl[1])) ? $tbl[1]:  false;
											// $reslt = $database::RESULTS_METHOD_LINE_OBJECT;
											// $reslt = (is_array($tbl) && isset($tbl[2]) && is_bool($tbl[2])) ? $tbl[2]:  true;


											/*
												Utilisation de cache par le TPL
											*/
											if(isset($this->tpl->useCache) && $this->tpl->useCache === true){

												$c='';

												// var_dump(call_user_func($object->empty));
												// var_dump($this->render(call_user_func($object->empty), false, ['ReturnHTML'=>true]));
												// exit;

												/* Ouverture de la fonction */
												$c.='<?php if(!isset($database)){global $database;}';
												$c.='call_user_func_array(function($database){';
												$c.='';

												$t = ($nativeTbl==false) ? $database->GetTablesName($tbl): $tbl;
												$c.='$query = $database->SelectFromTable("'.$name.'", "'.$q.'", '.(($nativeTbl==true)?'true':'false').' );';

													$c.='if(is_object($query) && method_exists($query, "results") ){';

														$c.='$query->results($database::RESULTS_METHOD_LINE_OBJECT);';

														/* Si vide */
														$c.='if($query->row <= 0){';
															if(isset($object->empty)){
																if(is_callable($object->empty)){
																	$empty = $this->render([call_user_func($object->empty)], false, ['ReturnHTML'=>true]);
																	$empty = \GGN\DPO\Transcriber::CaCode($empty);
																	$c.= ' ?>' . $empty . '<?php ';
																	$this->resetRHTML();
																}
																else{
																	$c.= 'Aucune donnée trouvée';
																}
															}
														$c.='}';

														/* liste des données */
														$c.='if($query->row > 0){';

															$c.= 'foreach ($query->data as $key => $data) {';
																$c.= ' ?>';
																	$proto = $this->render([call_user_func($object->each)], false, ['ReturnHTML'=>true]);
																	$proto = \GGN\DPO\Transcriber::CaCode($proto);
																	$c.= $proto;
																	$this->resetRHTML();
																$c.= '<?php ';
															$c.= '}';

														$c.='}';


													$c.='}';

													/* Echec Requete */
													$c.='else{';
														if(isset($object->failure) && is_callable($object->failure)){
															$failure = $this->render([call_user_func($object->failure)], false, ['ReturnHTML'=>true]);
															$failure = \GGN\DPO\Transcriber::CaCode($failure);
															$c.= ' ?>' . $failure . '<?php ';
															$this->resetRHTML();
														}
														else{
															$c.= 'Echec lors du tratement de la requette';
														}

													$c.='}';

												/* Fermture de la fonction */
												$c.='}, [$database]);';
												$c.=' ?>';

												array_push($return, $c);
												
											}


											/* 
												N'utilise pas de cache 
											*/
											else{

												$query = $database->SelectFromTable($name, $q, $nativeTbl);

												if(is_object($query) && method_exists($query, 'results') ){

													$query->results($database::RESULTS_METHOD_LINE_OBJECT);

													if($query->row <= 0){
														if(isset($object->empty) && is_callable($object->empty)){
															array_push($return, call_user_func($object->empty) );
														}
														else{
															$rRendering = $this->render([new \GGN\DPO\Theme\Content('Aucune donnée trouvée')], false, $this->rNstt);
														}
													}

													if($query->row > 0){

														$NewRender = clone $this;

														foreach ($query->data as $key => $data) {

															$proto = $NewRender->render([call_user_func($object->each, $data)], false, ['ReturnHTML'=>true ]);

															foreach ($data as $varname => $varvalue) {

																$proto = str_replace('%' . $varname . '%', utf8_encode($varvalue), $proto);

															}

															array_push($return, $proto);

															$NewRender->resetRHTML();

														}


													}

												}

												else{
													if(isset($object->failure) && is_callable($object->failure)){
														array_push($return, call_user_func($object->failure) );
													}
													else{
														$rRendering = $this->render([new \GGN\DPO\Theme\Content('Echec lors du tratement de la requette')], false, $this->rNstt);
													}

												}

											}




											/* Génération */
											foreach ($return as $ret) {

												if(is_string($ret)){
													$this->rHTML($ret ,true, $rH);
												}

												else if(is_object($ret) || is_array($ret)){
													$rRendering = $this->render([$ret], false, $this->rNstt);
												}

												else{}

											}

										}

									break;
									



									// default:break;
								}

								// echo '<pre>';
								// print_r($value);
								// echo '</pre>===============================';
								// exit;

							}

						}

						/* Instruction native : FIN */


					}

					return ($this->rNstt['ReturnHTML'] === true) ? $this->rHTML : $rRendering;

				}


			}



			/* Rendu */
			public function rendering($return = false, $part = 'complete'){



				/* Driver DPO */
				$this->driver = new \GGN\DPO\Driver();




				/* Rendu */
				$this->render($this->tpl);

				// var_dump($this->driver); exit;


				switch($part){

					/* Générer uniquement le "HEAD" */
					case 'head':

						/* Schema */
						$this->schema = (new RenderingScheme())->head;

						/* Schema du rendu */
						$this->applySchema();

						if($return==true){ return $this->driver->generateInnerHead(true); }

						else{ $this->driver->generateInnerHead(false); }


					break;



					/* Générer uniquement le "BODY" */
					case 'body':

						/* Schema */
						$this->schema = (new RenderingScheme())->body;

						/* Schema du rendu */
						$this->applySchema();

						if($return==true){ return $this->driver->generateInnerBody(true); }

						else{ $this->driver->generateInnerBody(false); }


					break;



					/* Générer completement la page */
					case 'complete': default:
					
						/* Responsivité */
						if(isset($this->tpl->settings) && isset($this->tpl->settings->responsive)){

							$this->driver->responsivity = $this->tpl->settings->responsive;

						}


						/* Menu contextuel de la souris */
						if(isset($this->tpl->settings) && isset($this->tpl->settings->{'context.menu'})){

							if($this->tpl->settings->{'context.menu'} == true){
								$this->driver->js('(function(o){o.oncontextmenu=function(){};})(document);');
							}
							else{
								$this->driver->js('(function(o){o.oncontextmenu=function(){return false;};})(document);');
							}

						}


						/* Schema du rendu */
						$this->applySchema();


						/* Retour du rendu */

						if($return==true){ return $this->driver->generate(true); }

						else{ $this->driver->generate(false); }

				break;

				}

			}





			/*
				Schematisation du générateur
			*/
			public function applySchema(){

				$this->schema = (isset($this->schema)) ? $this->schema: (new RenderingScheme())->default;

				foreach($this->schema as $tag => $data){

					for($part=0; $part < count($data); $part++) { 


						switch ($data[$part]) {

							case 'shortcut': if(strtolower($tag) == 'head'){$this->driver->_shortcut();} break;
							
							case 'meta': if(strtolower($tag) == 'head'){$this->driver->_meta();} break;

							case 'title': if(strtolower($tag) == 'head'){$this->driver->_title();} break;

							case 'css.package': $this->driver->_cssPackages(); break;

							case 'js.package': $this->driver->_jsPackages(); break;

							case 'link': $this->driver->_css('-call'); break;

							case 'script': $this->driver->_javascript('-call'); break;

							case 'css': $this->driver->_css('-code'); break;

							case 'js': $this->driver->_javascript('-code'); break;

							case 'writing': 

								if(strtolower($tag) == 'head'){$this->_head();} 

								if(strtolower($tag) == 'body'){$this->_body();} 

							break;

							
							default: break;
						}
					}

				}


			}




			/* Ecriture dans l'entete */
			public function _addToHead($string = ''){
				array_push($this->__head, $string);
			}

			public function _head(){

				foreach ($this->__head as $value) {

					if(is_string($value)){
						$this->driver->head($value);
					}

				}

			}



			/* Ecriture dans la page */
			public function _addToBody($string = '', $return = false){
				array_push($this->__body, $string);
				return ($return===true) ? $string : $this;
			}

			public function _body(){

				// var_dump($this->__body);exit;

				foreach ($this->__body as $value) {

					if(is_string($value)){
						$this->driver->body($value);
					}

				}

			}





		} // Class 'Engine'


	} // If class exists 'Engine'












?>