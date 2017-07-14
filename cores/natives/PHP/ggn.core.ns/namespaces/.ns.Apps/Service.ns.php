<?php

	/**
	 * GGN Apps\Service Invoke
	 *
	 * @version 0.1 
	 * @update 170424.1215
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\Apps\Service;
	




	if(!class_exists('\GGN\Apps\Service\Invoke')){

		/*
			Invoke
		*/
		Class Invoke extends \GGN\Apps\Invoke{

			const NAME = "GGN Apps\Service";

			const VERSION = "0.1";

			const UPDATE = "170424.1215";


			const TokenExt = ".client-token";

			const PSUC = 7;




		} // Class Invoke


	} // if class_exists 'Invoke'





	if(!class_exists('\GGN\Apps\Service\ClientToken')){

		/*
			ClientToken
		*/
		Class ClientToken extends Invoke{

			const NAME = "GGN Apps\Service\ClientToken";

			const VERSION = "0.1";

			const UPDATE = "170424.1215";




			public function __construct($ToValid = false){


				$File = __CORES_SYSTEM_CLIENTS_TOKENS__ . $ToValid . self::TokenExt;


				if(is_file($File)){

					$this->Accepted = self::Decrypt($File);

				}

				else{

					$this->Accepted = false;

				}


			}




			/* Création du jeton / DEBUT */

				static public function Create($Name = false, $Ukey = false, $AppKey = false, $SKey = false, $Login = true, $Expire = 0){

					$Crypt = self::Crypt(

						$Name

						, $Ukey

						, $AppKey

						, $SKey

						, $Login

					);




					$kV = [

						'expire' => $Expire

						, 'x.auth' => $Crypt

					];




					$DeCrypt = self::Decrypt($kV, false);



					if( is_array($DeCrypt) && isset($DeCrypt['Name']) && is_string($DeCrypt['Name']) ){

						$File = __CORES_SYSTEM_CLIENTS_TOKENS__ . $DeCrypt['Name'] . self::TokenExt;

						
						if(!is_dir(dirname($File))){\Gougnon::createFolders(dirname($File)); }

						if(\Gougnon::createFile(

							$File

							, json_encode($kV , \GStorages::JSON_OPT())

						)){

							return $DeCrypt;

						}

						return false;

					}

					else{

						return false;

					}


				}

			/* Création du jeton / DEBUT */




			/* Création du jeton / DEBUT */

				static public function Crypt($Name = false, $Ukey = false, $AppKey = false, $SKey = false, $Login = true){

					$Token = [];

					$Token['Name'] = '';

					$NameCrypt = '';



					if(is_string($Ukey) || is_bool($Ukey)){

						$Token['Key.User'] = $Ukey;

						$NameCrypt = $Ukey;

					}


					if(is_string($AppKey)){
						
						$Token['Key.App'] = $AppKey;

					}


					if(is_string($Name)){

						$Token['Name'] .= $Name . '';

					}


					if(is_string($SKey)){

						$Token['Key.Special'] = \_GGNCrypt::_sha256($SKey, 3);

						$Token['Name'] .= '@' . \_GGNCrypt::_md5(HTTP_HOST . '://' . $NameCrypt . '@' . $SKey . ':' . $Name . date('YmdHis'), 3);

					}


					if($Login === true){

						$Token['Uses.Login'] = $Login;

					}


					$Token['Property.Create.Time'] = time();
					


					return \_GGNCrypt::base64Encode( json_encode($Token, \GStorages::JSON_OPT()), self::PSUC );

				}

			/* Création du jeton / DEBUT */








			/* Décriptage du jeton / DEBUT */

				static public function Decrypt($File = false, $IsFile = true){

					$Get = ($IsFile === true) ? \GGN\File\Content::JSON($File) : $File ;


					$Authorize = [];




					if(

						is_array($Get)

						&& (isset($Get['expire']) && (is_numeric($Get['expire']) || is_bool($Get['expire'])))

						&& (isset($Get['x.auth']) && is_string($Get['x.auth']))

					){

						try{
							

							$xAuth = json_decode(\_GGNCrypt::base64Decode(json_encode($Get['x.auth'], \GStorages::JSON_OPT()), self::PSUC ), \GStorages::JSON_OPT());

							$Get['expire'] = (is_numeric($Get['expire'])) ? $Get['expire'] : 0;

							$Unlimited = $Get['expire'] > 1 ? false : true;

							$Authorize['Expire'] = ($Unlimited === true) ? false : !($Get['expire'] > time()) ;




							if(isset($xAuth['Key.User']) && is_string($xAuth['Key.User']) ){

								if($xAuth['Key.User'] == '-current'){

									global $GRegister;

									if(is_array($GRegister->USER)){

										$Authorize['User'] = $GRegister->USER;

									}

								}

								else{

									$User = \GUSERS::byUkey( ($xAuth['Key.User'] ), \_GGNDB::RESULTS_METHOD_LINE);

									if(is_object($User)){

										if($User->row <= 0){return false;}

										else{

											$Authorize['User'] = $User->data[0];
										}

									}

								}


							}



							if(isset($xAuth['Key.App']) && is_string($xAuth['Key.App']) ){

								$Authorize['App'] = $xAuth['Key.App'];

							}



							if(isset($xAuth['Key.Special']) && is_string($xAuth['Key.Special']) ){

								$Authorize['Special'] = $xAuth['Key.Special'];

							}



							if(isset($xAuth['Name']) && is_string($xAuth['Name']) ){

								$Authorize['Name'] = $xAuth['Name'];

							}



							if(isset($xAuth['Uses.Login']) ){

								$Authorize['Login'] = $xAuth['Uses.Login'];

							}



							if(isset($xAuth['Property.Create.Time']) && is_numeric($xAuth['Property.Create.Time']) ){

								$Authorize['Created'] = $xAuth['Property.Create.Time'];

							}

						}

						catch(Exception $e){

							Invoke::tExit('Erreur ' . $e->message . ' / ligne : ' . $e->line );

						}


					}


					return $Authorize;


				}

			/* Décriptage du jeton / DEBUT */






		} // Class ClientToken


	} // if class_exists 'ClientToken'






	if(!class_exists('\GGN\Apps\Service\Init')){

		/*
			Init
		*/
		Class Init extends Invoke{

			const NAME = "GGN Apps\Service\Init";

			const VERSION = "0.1";

			const UPDATE = "170424.1215";



			var $App = false;

			var $Token = false;

			var $Bind = false;

			var $Options = false;




			public function __construct($App = false, $Token = false, $Options = false){

				$this->App = $App;

				$this->Token = $Token;

				$this->Options = $Options;

			}



			public function AcceptBind(){

				$Bind = false;



				if(is_object($this->App) && is_object($this->Token)){


					/* Si le jeton support l'application / DEBUT */

						if(

							isset($this->App->Manifest['Key']) 

							&& isset($this->Token->Accepted['App']) 

						){

							if(

								is_string($this->App->Manifest['Key']) 

								&& is_string($this->Token->Accepted['App']) 

							){


									// echo "<pre>";
									// 	var_dump($this->App->Manifest['Key']);
									// 	var_dump($this->Token->Accepted['App']);
									// echo "</pre>";
									// exit;



								// if($this->App->Manifest['Key'] != $this->Token->Accepted['App']){

									$Mapp = $this->App->Manifest['Key'];

									$Tapp = $this->Token->Accepted['App'];

									$Expl1 = explode('.', $Tapp);


									if(count($Expl1) > 2 && (substr($Mapp, 0, strlen($Tapp)) == $Tapp) ){

										global $GRegister;


										if(

											isset($this->Token->Accepted['User']) 

											&& is_array($this->Token->Accepted['User'])

										){

											$Bind = false;
										

											if(

												isset($GRegister->USER) 

												&& is_array($GRegister->USER)

												&& isset($GRegister->USER['UKEY']) 

												&& isset($this->Token->Accepted['User']['UKEY']) 

											){

												if($GRegister->USER['UKEY'] == $this->Token->Accepted['User']['UKEY']){

													$Bind = true;												

												}

											}
 

										}

										else{

											$Bind = true;
											
										}


									}


								// }


								// if($this->App->Manifest['Key'] == $this->Token->Accepted['App']){

									

								// }


							}


						}

					/* Si le jeton support l'application / FIN */

				}


				$this->Bind = $Bind;

				return $this->Bind;

			}



			public function Open($Method = false){

				/* Initialisation / DEBUT */

					$Options = false;

					$this->AcceptBind();



				/* Initialisation / FIN */

				if(

					$this->Bind === true 

					&& isset($this->App->Manifest) 

					&& is_array($this->App->Manifest) 

					&& isset($this->Token->Accepted) 

					&& is_array($this->Token->Accepted) 

				){

					if(is_string($Method) && !\Gougnon::isEmpty($Method) ){

						$Manifest = $this->App->Manifest;


						if(

							isset($Manifest['App.Service.Path'])

							&& isset($Manifest['App.Service.Namespace'])

						){


							$Path = dirname(__FILE__) . '/Service/' . $Manifest['App.Service.Path'] . \GGN\Using::NS_EXT;

							if(is_file($Path)){

								include $Path;


								$ServiceNS = $Manifest['App.Service.Namespace'];

								$Service = new $ServiceNS;



								if(method_exists($Service, $Method)){

									if(is_array($this->Options)){$Options = (isset($this->Options['arguments'])) ? $this->Options['arguments'] : [];}

									$Return = call_user_func([$Service, $Method], $Options);

									echo json_encode($Return, \GStorages::JSON_OPT());

								}

								else{

									self::tExit('Echec /// Methode introuvable.');
									
								}
							}

							else{

								self::tExit('Echec /// Service introuvable.');

							}


						}

						else{

							self::tExit('Echec /// Paramètres du Service introuvable.');					

						}

					}

					else{

						self::tExit('Echec /// Methode non définie.');					

					}

				}

				else{

					self::tExit('Accès réfusé /// Impossible de vous lier à ce service. ');

				}


			}


		} // Class Init


	} // if class_exists 'Init'











				






