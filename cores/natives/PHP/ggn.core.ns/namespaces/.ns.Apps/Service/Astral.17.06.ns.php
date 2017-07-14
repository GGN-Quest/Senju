<?php

	/**
	 * GGN Apps Service Astral
	 *
	 * @version 0.1 
	 * @update 170424.1215
	 * @Require Gougnon Framework
	*/



/*
	Nom de l'espace
*/
namespace GGN\Apps\Service\Astral;
	


	/* Plugins */

	new \GGN\Using('Plugins');

	new \GGN\Using('String');

	new \GGN\Plugin\PHP('Astral.0.1');







	if(!class_exists('\GGN\Apps\Service\Astral\Invoke')){

		/*
			Invoke
		*/
		Class Invoke {

			const NAME = "GGN Apps\Service\Astral";

			const VERSION = "0.1";

			const UPDATE = "170424.1215";






		} // Class Invoke


	} // if class_exists 'Invoke'






	if(!class_exists('\GGN\Apps\Service\Astral\Trigger')){

		/*
			Trigger
		*/
		Class Trigger extends Invoke{

			const NAME = "GGN Apps\Service\Astral Trigger";


			const AddonsSlugVar = 'addon-slug-';


			public function __invoke(){



			}



			static public function AddGerant($Args = false){

				global $database, $GRegister;

				$return = ['accept-request'=>false, 'response'=>'Ex000'];


				if(

					is_array($GRegister->USER) 

					&& isset($GRegister->USER['ACCOUNT_TYPE']) 

					&& $GRegister->USER['ACCOUNT_TYPE'] >= 4

					&& isset($Args['username'])

					&& isset($Args['password'])

				){

					$usr = $Args['username'];

					$pwd = $Args['password'];


					$User = new \GUSERS($usr, $pwd);


					if( $User->create(['ACCOUNT_TYPE'=>'2', 'ACTIVE_ACCEPTED'=>'1']) ){

						return ['accept-request'=>true, 'response'=>true];

					}

					else{

						return ['accept-request'=>true, 'response'=>false];

					}
					

				}

				else{

					$return['response'] = 'ExUsr002'; return $return;

				}


				return $return;

			}



			static public function UserAddonsUsing($Args = false){

				global $database, $GRegister;

				$return = ['accept-request'=>false, 'response'=>'Ex000'];

				$Astral = new \Astral();

				$Ukey = (isset($Args['user-key'])) ? $Args['user-key'] : false;


				if(
					is_array($GRegister->USER) 

					&& isset($GRegister->USER['ACCOUNT_TYPE']) 

					&& $GRegister->USER['ACCOUNT_TYPE'] >= 4

					&& is_string($Ukey)

				){

					$dbrd0 = $database->DeleteFromTable($Astral->Tables->UserAddons, " WHERE UKEY='" . $Ukey . "' ");

					foreach ($Args as $name => $value) {

						$sub = substr($name, 0, strlen(self::AddonsSlugVar));

						if($sub == self::AddonsSlugVar){

							$Slug = substr($name, strlen(self::AddonsSlugVar));

							$dbrd = $database->InsertIntoTable($Astral->Tables->UserAddons

								, " VALUES(NULL, '" . $Ukey . "', '" . str_replace('-', '.', $Slug) . "', '" . time() . "', '1') "

							);

						}
						
					}

					return ['accept-request'=>true, 'response'=>true];

				}


				else{

					$return['response'] = 'ExUsr002'; return $return;

				}


				return $return;

			}



			static public function GetGerants($Args = false){

				global $database, $GRegister;

				$return = ['accept-request'=>false, 'response'=>'Ex000', 'list'=>[]];


				if(

					is_array($GRegister->USER) 

					&& isset($GRegister->USER['ACCOUNT_TYPE']) 

					&& $GRegister->USER['ACCOUNT_TYPE'] >= 4

				){

					$Astral = new \Astral();

					$Get = $database->SelectFromTable('NATIVE_USERS', "WHERE ACCOUNT_TYPE='2' AND ACCEPT='1' ");

					if(is_object($Get)){

						$Get->results($Astral->DBMeth);

						$return['accept-request'] = true;

						$return['response'] = true;

						$return['list'] = [];


						if($Get->row > 0){

							foreach ($Get->data as $key => $user) {

								$return['list'][] = [

									'username' => $user->USERNAME

									, 'datetime' => $user->DATETIME

									, 'key' => $user->VERS

								];
								
							}


						}

					}

					else{

						$return['response'] = 'ExRq001'; return $return;					

					}

				}

				else{

					$return['response'] = 'ExUsr002'; return $return;

				}


				return $return;

			}





		} // Class Trigger


	} // if class_exists 'Trigger'










				






