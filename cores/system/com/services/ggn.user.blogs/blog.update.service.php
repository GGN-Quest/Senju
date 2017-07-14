<?php
/*
	Copyright GOBOU Y. Yannick
	
*/


if(is_array($this->Register->USER)){



	/* 
		Class 'STYLIVOIR' // DEBUT ------------------
	*/

	\Gougnon::loadPlugins('PHP/stylIvoir.2.0');


		$STYLIVOIR = new \StylIvoir('Create.Blogs.Now');


	/* 
		Class 'STYLIVOIR' // FIN ------------------
	*/






	new \GGN\Using('User\Blog');







	$UKEY = $this->Register->USER['UKEY'];

	$BID = Register::_POST('bid');

	$title = Register::_POST('blog-title');

	$about = Register::_POST('desc');

	$city = Register::_POST('city');

	$bType = Register::_POST('btype');

	// $contacts = Register::_POST('contacts');
	


	// $city = Register::_POST('city');



	$CurBlog = \GGN\User\Blog\Data::Get($BID);






	if($CurBlog->row <= 0){


		$this->Response('blog.not.found');

		return false;


	}


	else{



	/* 

		Petite Securité du type // DEBUT ------

	*/

		$MyAccountType = $STYLIVOIR->getUserAccountType($this->Register->USER['UKEY']);

		$AccountType = false;



		if($MyAccountType->row <= 0){
			
			$this->Response('account.type.failed');

			return false;

		}

		if($MyAccountType->row === 1){

			$AccountType = $MyAccountType->data[0]->_DATA;

			$blgtp = $STYLIVOIR->isChildOfAccountType($AccountType, $bType);




			if($blgtp===false){

				$this->Response('account.type.failed');

				return false;

			}


		}

			// print_r($blgtp);exit;


		$_AccountType = $STYLIVOIR->getAccountType($AccountType);



		if(!isset($_AccountType['child'][$blgtp])){
			
			$this->Response('blog.type.failed');

			return false;

		}


		$_BlogType = $_AccountType['child'][$blgtp];


		if(!isset($STYLIVOIR->BlogCriterions[$_BlogType['key']])){
			
			$this->Response('criterions.failed');

			return false;

		}

		$Criterions = $STYLIVOIR->BlogCriterions[$_BlogType['key']];



	/* 

		Petite Securité du type // FIN ------

	*/





	/*

		Verifications // DEBUT -------------

	*/

		if(\Gougnon::isEmpty($title)){

			$this->Response('title.empty:' . $title);

			return false;

		}



		if(strlen($title) < 3){

			$this->Response('title.char.not.enough');

			return false;

		}


		if(strlen($title) > 32){

			$this->Response('title.char.too.much');

			return false;

		}



	/*

		Verifications // FIN -------------

	*/




		/*

			Mots Clés
			
		*/
		


		$_keywords = [];


		foreach($Criterions as $crk => $Criterion) {

				$post = \Register::_POST($crk, false);


				if(is_string($Criterion) && is_string($post)){


					if(is_numeric($crk)){

						$nxn = explode('//', $Criterion)[0];

						$_keywords[$nxn] = ($post=='on') ? $nxn : $post;

					}

					if(is_string($crk)){

						$_keywords[$crk] = ($post=='on') ? $crk : $post;

					}

				}

				if(is_array($Criterion) && !is_bool($post)){

					if(is_array($post)){


						if(is_array($post)){

							foreach ($post as $pk => $pv) {
								
								$_keywords[$crk] = isset($_keywords[$crk]) ? $_keywords[$crk] : [];

								array_push($_keywords[$crk], $Criterion[$pv] );

							}

						}

					}

					else{

						array_push($_keywords[$crk], $Criterion[$post] );
						
					}



				}

			}




			if(count($_keywords) < 1){

				$this->Response('keywords.not.enough');

				return false;

			}



			\GGN\User\Blog\Data::Update(

				$BID

				, [

					'TITLE' => utf8_encode($title)

					, 'ABOUT' => $about

					, 'CITY' => $city

				]

			);

		
		
			
			\GGN\User\Blog\Criterions::Reset($BID);


			foreach ($_keywords as $n => $d) {
				
				if(is_array($d)){

					foreach ($d as $kkk => $hv) {
						
						\GGN\User\Blog\Criterions::Add($BID, $n, $hv);

					}
					
					continue;
	
				}
				
				else{
					
					if(is_string($n)){
						
						\GGN\User\Blog\Criterions::Add($BID, $n, $n);
						
					}
					
					continue;
					
				}
				


			}




			$this->Response(true);


	}



}

	
