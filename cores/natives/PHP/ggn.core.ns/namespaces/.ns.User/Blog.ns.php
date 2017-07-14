<?php

	/**
	 * GGN User Blog
	 *
	 * @version 1.2
	 * @update 150910.0900
	 * @Require Gougnon Framework
	*/




/*
	Nom de l'espace
*/
namespace GGN\User\Blog;
	


	if(!class_exists('\GGN\User\Blog\Invoke')){
			
		Class Invoke {
				
			const NAME = 'Gougnon User Blog';
			
			const VERSION = '0.1';
			
			const UPDATE = '160429.1440';



			static public function ViewCookieName(){

				return \_GGNCrypt::_sha256('ggn.user.blog.view.counter', 1);

			}



			static public function _DBMethod(){

				global $database;

				return $database::RESULTS_METHOD_LINE_OBJECT;

			} 





		} // Class 'Invoke'


	} // If class exists 'Invoke'





	if(!class_exists('\GGN\User\Blog\Like')){
		
		Class Like extends Invoke{

			static public function Add($bid, $ukey = ''){

				global $database, $GRegister;


				$Get = self::Get($bid);

				$Add = false;


				if($Get->row <= 0){

					$Add = $database->InsertIntoTable('NATIVE_INTERACTION_ENTITIES', " VALUES(NULL, '" . $GRegister->USER['UKEY'] . "', '" . $ukey . "', 'Blog.Like', '$bid',  '$bid', '" . __IP__ . "', '" . time() . "', '1'); ");

				}

				return $Add;				

			} 


			static public function Get($bid){

				global $database;

				$get = $database->SelectFromTable('NATIVE_INTERACTION_ENTITIES',"WHERE  _NAME ='Blog.Like' AND _ENTITY ='$bid'");

				if(is_object($get)){

					$get->results(self::_DBMethod());

					return $get;

				}

				return false;

			} 


			static public function GetRow($bid){

				global $database;

				$get = self::Get($bid);

				if(is_object($get)){

					return $get->row;

				}

				return 0;

			} 


		} // Class 'Like'


	} // If class exists 'Like'





	if(!class_exists('\GGN\User\Blog\Data')){
		
		Class Data extends Invoke{


			static public function Where($Where){

				global $database;

				$get = $database->SelectFromTable('NATIVE_USERS_BLOGS', $Where );

				if(is_object($get)){

					$get->results(self::_DBMethod());

					return $get;

				}

				return false;

			} 



			static public function Get($bid){

				return self::Where("WHERE BID='$bid' ORDER BY DATETIMES ASC");

			} 


			static public function GetRow($bid){

				global $database;

				$get = self::Get($bid);

				if(is_object($get)){

					return $get->row;

				}

				return 0;

			} 


			static public function Update($bid, $data = false){

				global $database;

				if(is_array($data)){

					foreach ($data as $key => $value) {
						
						$Update = $database->UpdateTable('NATIVE_USERS_BLOGS', " SET " . $key . "='" . $value . "' WHERE BID='" . $bid . "' ");

					}

				}

				return 0;

			} 



		} // Class 'Data'


	} // If class exists 'Data'





	if(!class_exists('\GGN\User\Blog\Mine')){
		
		Class Mine extends Invoke{


			static public function Get($ukey){

				global $database;

				$get = $database->SelectFromTable('NATIVE_USERS_BLOGS',"WHERE UKEY='$ukey' ORDER BY DATETIMES ASC");

				if(is_object($get)){

					$get->results(self::_DBMethod());

					return $get;

				}

				return false;

			} 


			static public function GetRow($ukey){

				global $database;

				$get = self::Get($ukey);

				if(is_object($get)){

					return $get->row;

				}

				return 0;

			} 



		} // Class 'Mine'


	} // If class exists 'Mine'





	if(!class_exists('\GGN\User\Blog\Criterions')){
		
		Class Criterions extends Invoke{


			static public function Get($BID){

				global $database;

				$get = $database->SelectFromTable('NATIVE_USERS_BLOGS_CRITERIONS',"WHERE BID='$BID' AND AVAILABLE='1' ORDER BY VERS ASC");

				if(is_object($get)){

					$get->results(self::_DBMethod());

					return $get;

				}

				return false;

			} 


			static public function GetRow($BID){

				global $database;

				$get = self::Get($BID);

				if(is_object($get)){

					return $get->row;

				}

				return 0;

			} 




			static public function Reset($BID = false){

				global $database;
				
				$treat = false;
				
				if(is_string($BID)){

					$treat = $database->DeleteFromTable('NATIVE_USERS_BLOGS_CRITERIONS', " WHERE BID='" . $BID . "' ");
					
				}

				return ($treat==true) ? true : false;

			} 




			static public function Add($BID = false, $name = false, $value = ''){

				global $database;

				if(is_string($BID) && is_string($name) && is_string($value)){

					$value = addslashes(($value));

					$treat = $database->InsertIntoTable('NATIVE_USERS_BLOGS_CRITERIONS', " VALUES(NULL, '".$BID."', '" . $name . "', '" . $value . "', '1') ");
						
					return ($treat == true) ? true : false;

				}

				else{
					
					return false;
					
				}

			}




		} // Class 'Criterions'


	} // If class exists 'Criterions'









	if(!class_exists('\GGN\User\Blog\View')){
		
		Class View extends Invoke{

			static public function Add($bid, $ukey = ''){

				global $database, $GRegister;

				$Name = self::ViewCookieName() . $bid;

				$Add = false;


				if(!isset($_COOKIE[$Name]) ){

					$Add = $database->InsertIntoTable('NATIVE_INTERACTION_ENTITIES', " VALUES(NULL, '" . ((is_array($GRegister->USER) && isset($GRegister->USER['UKEY'])) ? $GRegister->USER['UKEY'] : __IP__) . "', '" . $ukey . "', 'Blog.View', '$bid', '$bid', '" . __IP__ . "', '" . time() . "', '1'); ");


				}

				setcookie($Name, __IP__, time() + \_GGN::varn('BLOGGING_COOKIE_VIEW_TIME') );

				return $Add;				

			} 


			static public function Get($bid){

				global $database;

				$get = $database->SelectFromTable('NATIVE_INTERACTION_ENTITIES',"WHERE  _NAME ='Blog.View' AND _ENTITY ='$bid'");

				if(is_object($get)){

					$get->results(self::_DBMethod());

					return $get;

				}

				return false;

			} 


			static public function GetRow($bid){

				global $database;

				$get = self::Get($bid);

				if(is_object($get)){

					return $get->row;

				}

				return 0;

			} 


		} // Class 'View'


	} // If class exists 'View'





	if(!class_exists('\GGN\User\Blog\FollowersCriterions')){
		
		Class FollowersCriterions extends Invoke{


			static public function Update($Criterions = ''){

				global $database, $GRegister;

				$ukey = $GRegister->USER['UKEY'];

				$row = self::GetRow($ukey);

				if($row > 0){

					$Update = $database->UpdateTable('NATIVE_INTERACTION_ENTITIES', " SET _DATA='" . $Criterions . "' WHERE _TO='" . $ukey . "' ");

				}

				else{

					$Update = $database->InsertIntoTable('NATIVE_INTERACTION_ENTITIES', " VALUES(NULL, '', '" . $ukey . "', 'Followers.Criterions', '', '', '" . $Criterions . "', '" . time() . "', '1'); ");

				}


				return $Update;				

			} 


			static public function Get($ukey){

				global $database;

				$get = $database->SelectFromTable('NATIVE_INTERACTION_ENTITIES',"WHERE  _NAME ='Followers.Criterions' AND _TO ='" . $ukey . "'");

				if(is_object($get)){

					$get->results(self::_DBMethod());

					return $get;

				}

				return false;

			} 


			static public function GetRow($ukey){

				global $database;

				$get = self::Get($ukey);

				if(is_object($get)){

					return $get->row;

				}

				return 0;

			} 


		} // Class 'FollowersCriterions'


	} // If class exists 'FollowersCriterions'








	if(!class_exists('\GGN\User\Blog\Cover')){
		
		Class Cover extends Invoke{


			static public function Update($bid, $new){

				global $database;

				$get = $database->SelectFromTable('NATIVE_USERS_BLOGS',"WHERE BID='$bid'");

				if(is_object($get)){

					$get->results(self::_DBMethod());

					return $database->UpdateTable('NATIVE_USERS_BLOGS'," SET COVER='" . $new . "' WHERE BID='$bid' ");

				}

				return false;

			} 


		} // Class 'Cover'


	} // If class exists 'Cover'








	if(!class_exists('\GGN\User\Blog\Logo')){
		
		Class Logo extends Invoke{


			static public function Update($bid, $new){

				global $database;

				$get = $database->SelectFromTable('NATIVE_USERS_BLOGS',"WHERE BID='$bid'");

				if(is_object($get)){

					$get->results(self::_DBMethod());

					return $database->UpdateTable('NATIVE_USERS_BLOGS'," SET LOGO='" . $new . "' WHERE BID='$bid' ");

				}

				return false;

			} 


		} // Class 'Logo'


	} // If class exists 'Logo'





	if(!class_exists('\GGN\User\Blog\Post')){
			
		Class Post extends Invoke{
				
			const NAME = 'Gougnon User Blog Post';
			
			const VERSION = '0.1';
			
			const UPDATE = '160429.1440';




			static public function Add($bid, $title, $composer, $assocType, $assocFiles){

				global $database;

				$ret = FALSE;


				$insert = $database->InsertIntoTable('NATIVE_USERS_BLOGS_POSTS', "VALUES(NULL, '" . addslashes($bid) . "', '" . addslashes($title) . "', '" . addslashes($composer) . "', '" . addslashes($assocType) . "', '" . addslashes($assocFiles) . "' , '" . time() . "', 1 ) ");


				if($insert){

					$ret = TRUE;

				}


				return $ret;

			} 



			static public function Get($bid = false, $Row = false, $RowStart = false, $Query = "", $unlim = false){

				global $database;

				$ret = FALSE;


				$Query = is_string($Query) ? $Query : "";

				$bid = is_string($bid) ? " BID='" . $bid . "' AND " : "";

				$Row = is_numeric($Row) ? $Row : \_GGN::varn('BLOGGING_POST_PER_PAGE');

					$Row = is_numeric($Row) ? $Row : 5;

				$RowStart = is_numeric($RowStart) ? $RowStart : 0;


				$limit = ($unlim===false) ? "LIMIT " . $RowStart . ", " . $Row . " " : "";


				$get = $database->SelectFromTable('NATIVE_USERS_BLOGS_POSTS', " WHERE " . $bid . " AVAILABLE='1' " . $Query . " ORDER BY VERS DESC " . $limit);


				if(is_object($get)){

					$get->results(self::_DBMethod());

					return $get;

				}

				else{

					return false;

				}


			} 



			static public function DateFormatted($DATETIMES){

				global $GLANG;



				$P_Year = date('Y', $DATETIMES);

					$P_Year = (date('Y') == $P_Year) ? '' : ' ' . $P_Year;



				$P_Dayi = date('d', $DATETIMES);

					$P_Day = (date('d') == $P_Dayi) ? $GLANG['DAY']['LABEL_CURRENT'] : ' le ' . $P_Dayi;

					$P_Day = ( (date('d') - 1) == $P_Dayi ) ? $GLANG['DAY']['LABEL_YESTERDAY'] : $P_Day;



				$P_Monthi = date('m', $DATETIMES) - 1;

					$P_Month = $GLANG['MONTH']['NAME'][ $P_Monthi < 0 ? 0 : $P_Monthi ];

					$P_Month = (date('m') == ($P_Monthi + 1) || $P_Day == $GLANG['DAY']['LABEL_CURRENT'] || $P_Day == $GLANG['DAY']['LABEL_YESTERDAY']) ? '' : $P_Month;



				$P_Time = date('H:i:s', $DATETIMES);



				$R = new \_GGNCustomObject();


				$R->Year = $P_Year;

				$R->Month = $P_Month;

				$R->Day = $P_Day;

				$R->Time = $P_Time;


				return $R;

			} 






		} // Class 'Post'


	} // If class exists 'Post'




?>