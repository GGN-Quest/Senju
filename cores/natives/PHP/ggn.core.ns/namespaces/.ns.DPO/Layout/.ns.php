<?php

	/**
	 * GGN DPO Layout
	 *
	 * @version 0.1
	 * @update 170108.0854
	*/




/*
	Nom de l'espace
*/
namespace GGN\DPO\Layout;
	


	use GGN\DPO\Theme;








	if(!class_exists('\GGN\DPO\Layout\Invoke')){
			
		Class Invoke extends \GGN\DPO\Invoke{
				
			const NAME = 'Gougnon DPO Layout';
			
			const VERSION = '0.1';
			
			const UPDATE = '170108.0859';

			const LAYOUT_PAGE_PATH = 'dpo://layouts.pages';

			const LAYOUT_BRICKS_PATH = 'dpo://layouts.bricks';

			const EXT = '.dpol';



			public function __construct(){}


		} // Class 'Invoke'


	} // If class exists 'Invoke'







	if(!class_exists('\GGN\DPO\Layout\Brick')){

			
		Class Brick extends Invoke{



			public function __construct($Name = false, $Node = false){

				$this->Name = $Name;

				$this->Node = $Node;

				$this->Path = \GGN\Path\Protocol::Value(self::LAYOUT_BRICKS_PATH);

			}


			public function Mount(){

				$File = $this->Path . $this->Name . self::EXT;

				if(is_file($File) && is_object($this->Node) ){

					$Mount = false;

					try{

						$Json = json_decode(\GGN\File\Content::Get($File), \GStorages::JSON_OPT() );

						$Json['tpl'] = $this->Node;


						$this->Mounting = new Mounting($Json);

						$this->Mounting->BuildNodes($this->Node, $Json['sheet']);


					}

					catch(Exception $E){

						\_GGN::wCnsl(

							'<h1>DPO</h1> La structure de la brique comporte des irrégularité!!<br> Message : ' 

							. $E->getMessage() . ', Ligne : ' 

							. $E->getFile()

						);

					}


					return $this->Node;

				}

				else{

					return false;

				}

			}



		} // Class 'Brick'


	} // If class exists 'Brick'







	if(!class_exists('\GGN\DPO\Layout\Preset')){

			
		Class Preset extends Invoke{


			var $Name = false;

			var $Tpl = false;

			var $Mounting = false;



			public function __construct($Name = false, $Tpl = false){

				$this->Name = $Name;

				$this->Tpl = $Tpl;

				$this->Path = \GGN\Path\Protocol::Value(self::LAYOUT_PAGE_PATH);

			}



			public function Mount(){

				$File = $this->Path . $this->Name . self::EXT;

				if(is_file($File) && is_object($this->Tpl) ){

					$Mount = false;

					try{

						$Json = json_decode(\GGN\File\Content::Get($File), \GStorages::JSON_OPT() );

						$Json['tpl'] = $this->Tpl;

						$this->Mounting = new Mounting($Json);

						$this->Tpl = $this->Mounting->Mount();

					}

					catch(Exception $E){

						\_GGN::wCnsl(

							'<h1>DPO</h1> La structure de la page comporte des irrégularité!!<br> Message : ' 

							. $E->getMessage() . ', Ligne : ' 

							. $E->getFile()

						);

					}


					return $this->Tpl;

				}

				else{

					return false;

				}

			}


				
		} // Class 'Preset'


	} // If class exists 'Preset'







	if(!class_exists('\GGN\DPO\Layout\Mounting')){
			
		Class Mounting extends Invoke{
				
			const NAME = 'Gougnon DPO Layout : Mounting';
			
			const VERSION = '0.1';
			
			const UPDATE = '170108.0859';



			public $Stump = [];

			public $Tpl = false;

			public $Axe = 'Y';

			public $Sheet = false;

			public $CountTag = 0;


			public function __construct($Stump = false, $Tpl = false){

				$this->Stump = $Stump;

				if(is_array($this->Stump)){

					$this->Tpl = (isset($this->Stump['tpl']) && is_object($this->Stump['tpl'])) ? $this->Stump['tpl'] : false;

					$this->Axe = (isset($this->Stump['axe']) && is_string($this->Stump['axe'])) ? strtoupper($this->Stump['axe']) : 'Y';

					$this->Sheet = (isset($this->Stump['sheet']) && is_array($this->Stump['sheet'])) ? $this->Stump['sheet'] : false;

				}
				
			}



			public function InitPoles(){

				global $_DPO_DEVICE;

				if(is_object($this->Tpl)){


					foreach ($this->Tpl as $key => $Val) {

						if(is_object($Val) ){


							foreach ($Val as $k => $Obj) {
								
								if($k == '_Tx' && is_array($Obj) && isset($Obj[0]) ){


									if($Obj[0] == Theme\TPL_INSTANCE_HEAD_){

										$this->Head = $Val;


										$this->Head 
											/* 
												Balise Meta dans le 'head'
											*/
											->meta('charset', 'utf-8')
											
											->meta('http-equiv', 'pragma', 'cache')
											
											->meta('name', 'mobile-web-app-capable', 'yes')
											
											->meta('name', 'viewport', 'width=device-width,initial-scale=1, maximum-scale=1.0, user-scalable=no')


											->meta('name', 'theme-color', $this->Tpl->Cores->CSS->styleProperty('palette-primary-color'))


											->meta('name', 'msapplication-navbutton-color', $this->Tpl->Cores->CSS->styleProperty('palette-primary-color'))


											->meta('name', 'apple-mobile-web-app-capable', 'yes')

											->meta('name', 'apple-mobile-web-app-status-bar-style', 'black-translucent')

										;
										

									}

									if($Obj[0] == Theme\TPL_INSTANCE_BODY_){

										$this->Body = $Val;


										if($this->Axe == 'X'){$this->Body->addClass('ux-page-axe-x disable-y-scrollbar'); }

										if($this->Axe == 'Y'){$this->Body->addClass('ux-page-axe-y disable-x-scrollbar'); }


										if(is_object($_DPO_DEVICE)){

											// if(isset($_DPO_DEVICE->current) && $_DPO_DEVICE->current == '-c'){

											// 	$this->Body->addClass('ux-on-computer');

											// }

											if(isset($_DPO_DEVICE->current) && $_DPO_DEVICE->current != '-c'){

												$this->Body->addClass('ux-on-mobile');

											}

										}

									}


								}


							}


						}
						
					}

				}
				
				return $this;

			}



			public function BuildNodes($Node = false, $Merge = false){


				if(is_array($Merge) && is_object($Node)){


					$CountTag = 0;


					foreach ($Merge as $key => $layer) {

						if(is_array($layer)){


							$Nd = new Theme\Tag();




							/* Attributs / DEBUT */

								foreach ($layer as $k => $attrib) {

									/* Commande 'ON' / DEBUT */

										$E = explode(':', $k);

										$C = (isset($E[0])) ? strtoupper($E[0]) : '';

										$V = (isset($E[1])) ? strtoupper($E[1]) : '';



										if($C == 'ON'){

											$V = strtoupper($V);

											if($this->Axe == $V){


												foreach ($attrib as $an => $va) {

													$typ = gettype($va);

													if($typ == 'string'){

														$Nd->attributes[$an] = (isset($Nd->attributes[$an])) ? ($Nd->attributes[$an] . ' ' . $va) : $va;

													}

													if($typ == 'array'){

														if( isset($Nd->attributes[$an]) ){

															$Nd->attributes[$an] = \Gougnon::mergeArray($Nd->attributes[$an], $va);

														}

														else{

															$Nd->attrib($an, $va);

														}

													}


												}



											}

											unset($layer[$k]);

										}

									/* Commande 'ON' / FIN */



									else {

										if($k == 'name' || $k == 'node' || $k == 'tag' || $k == 'tagname'){

											if($k == 'tagname' || $k == 'tag'){

												$Nd->tagName($attrib);

											}

											continue;

										}

										else{

											$Nd->attrib($k, $attrib);

										}

									}

							
								}

							/* Attributs / FIN */





							/* Création du noeud / DEBUT */

								// $Name = 'Entry-' . $CountTag;

								$Name = (isset($layer['name']) && is_string($layer['name']) && !\Gougnon::isEmpty($layer['name']) && strtoupper($layer['name']) != '~AUTO') 

									? $layer['name'] 

									: ('Entry-' . $CountTag)

								;

								$Node->node->{$Name} = $Nd;

							/* Création du noeud / FIN */





							/* Ajout d'autre Noeuds / DEBUT */

								if(isset($layer['node'])){

									$this->BuildNodes($Node->node->{$Name}, $layer['node']);

								}

							/* Ajout d'autre Noeuds / FIN */





							$CountTag++;


						}

						
					}



				}




			}



			public function Mount(){

				if(is_object($this->Tpl)){

					$this->InitPoles();


					$this->Tpl->axe = $this->Axe;

					if(is_object($this->Body)){

						$this->Body->Sheet = new Theme\Tag([

							'id' => 'ggn-sheet'

							, 'class' => 'gui sheet'

						]);

						$this->BuildNodes($this->Body->Sheet, $this->Sheet);

					}

					return $this->Tpl;

				}


				return false;

			}






		} // Class 'Mounting'


	} // If class exists 'Mounting'






?>