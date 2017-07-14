<?php

	/**
	 * GGN User Interactions
	 *
	 * @version 1.2
	 * @update 150910.0900
	 * @Require Gougnon Framework
	*/




/*
	Nom de l'espace
*/
namespace GGN\User\Interactions;
	


	if(!class_exists('\GGN\User\Interactions\Invoke')){
			
		Class Invoke {
				
			const NAME = 'Gougnon User Interactions';
			
			const VERSION = '0.1';
			
			const UPDATE = '160429.1440';



			static public function ViewCookieName(){

				return \_GGNCrypt::_sha256('ggn.user.Interactions.view.counter', 1);

			}



			static public function _DBMethod(){

				global $database;

				return $database::RESULTS_METHOD_LINE_OBJECT;

			} 





		} // Class 'Invoke'


	} // If class exists 'Invoke'






	if(!class_exists('\GGN\User\Interactions\Get')){
		
		Class Get extends Invoke{


			static public function Where($Where){

				global $database;

				$get = $database->SelectFromTable('NATIVE_INTERACTION_ENTITIES', $Where);

				if(is_object($get)){

					$get->results(self::_DBMethod());

					return $get;

				}

				return false;

			} 


			static public function Received($To, $row = '10', $start = '0'){

				return self::Where("WHERE _TO='$To' AND AVAILABLE='1' ORDER BY DATETIMES DESC LIMIT " . $start . ", " . $row . " ");

			} 


			static public function Sent($From, $q = false, $row = '10', $start = '0'){

				$q = (is_string($q)) ? " AND " . $q : "";

				return self::Where("WHERE _FROM='$From' " . $q . " AND AVAILABLE='1' ORDER BY DATETIMES DESC LIMIT " . $start . ", " . $row . " ");

			} 


			static public function MId($MId, $row = '10', $start = '0'){

				return self::Where("WHERE _MID='$MId' AND AVAILABLE='1' ORDER BY DATETIMES DESC LIMIT " . $start . ", " . $row . "");

			} 


			static public function Type($key){
	
				$_TYPE = [

					'Photo.Like' => [

						'title'=>'Photo aimé'

						,'expression'=>'a aimé votre photo'

					]

					,'Photo.Comment' => [

						'title'=>'Photo commentée'

						,'expression'=>'a commenté votre photo'

					]

					,'Blog.View' => [

						'title'=>'Blog visité'

						,'expression'=>'a visité votre blog'

					]

					,'Blog.Like' => [

						'title'=>'Blog aimé'

						,'expression'=>'a aimé votre blog'

					]


				];


				return isset($_TYPE[$key]) ? $_TYPE[$key] : false;

			} 


		} // Class 'Get'


	} // If class exists 'Get'





