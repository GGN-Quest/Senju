<?php
/*
	Copyright GOBOU Y. Yannick
	
*/



/*
	Plugin : Captcha
*/
if(!class_exists('GCAPTCHA')){

	\Gougnon::loadPlugins('PHP/GCaptcha.0.1');

}





$error = false;



$firstname = Register::_POST('firstname', '');

$lastname = Register::_POST('lastname', '');



$username = Register::_POST('username', '');

$password = Register::_POST('password', '');

$password2 = Register::_POST('password2', '');

$contact = trim(Register::_POST('contact', ''));

$email = Register::_POST('email', '');



$birth_day = Register::_POST('birth_day', '');

$birth_month = Register::_POST('birth_month', '');

$birth_year = Register::_POST('birth_year', '');

$sexe = Register::_POST('sexe', '');



$captcha = Register::_POST('captcha', '');

$cgu = Register::_POST('cgu', '');







/* Captcha */
$vcaptcha = new GCAPTCHA('ggn.users.subscribe');





if(!preg_match(\_GGN::PATTERN_USERNAME, $username)){

	$error = 'username.failed';

	$this->Response($error);

	return false;

}





/* Nom */

if(\Gougnon::isEmpty($firstname)){

	$error = 'firstname.empty';

	$this->Response($error);
	
	return false;

}


// else if(!preg_match(\_GGN::PATTERN_NAME, $firstname)){

// 	$this->Response('firstname.failed');

// 	return false;

// }

if(strlen($firstname) < 3 || strlen($firstname) > 32){

	$error = 'firstname.failed';

	$this->Response($error);
	
	return false;

}





/* Prenom */

if(\Gougnon::isEmpty($lastname)){

	$error = 'lastname.empty';

	$this->Response($error);
	
	return false;

}


// else if(!preg_match(\_GGN::PATTERN_NAME, $lastname)){

// 	$this->Response('lastname.failed');

// 	return false;

// }

if(strlen($lastname) < 3 || strlen($lastname) > 32){

	$error = 'lastname.failed';

	$this->Response($error);
	
	return false;

}




/* Nom d'utilisateur */

if(\Gougnon::isEmpty($username)){

	$error = 'username.empty';

	$this->Response('username.empty');
	
	return false;

}

if(strlen($username) < 0 || strlen($username) > 32){

	$error = 'username.failed';

	$this->Response($error);
	
	return false;

}







/* Mot de passe */

if(\Gougnon::isEmpty($password)){

	$error = 'pwd.empty';

	$this->Response($error);
	
	return false;

}


if($password!=$password2){

	$error = 'pwd.confirm.failed';

	$this->Response($error);
	
	return false;

}





/* Contact */

if(\Gougnon::isEmpty($contact)){
	
	$error = 'contact.empty';

	$this->Response($error);

	return false;
	
}

if(!is_numeric($contact)){

	$error = 'contact.failed';

	$this->Response($error);
	
	return false;

}







/* Email */

if(!\Gougnon::isEmpty($email)){

	if(!preg_match(\_GGN::PATTERN_EMAIL, $email)){

		$error = 'email.failed';

		$this->Response($error);
		
		return false;

	}

}





/* Sexe */

if(!is_numeric($birth_day) || !is_numeric($birth_month) || !is_numeric($birth_year)){

	$error = 'birth.date.failed';

	$this->Response($error);
	
	return false;

}





/* Sexe */

if(!is_numeric($sexe)){

	$error = 'sexe.failed';

	$this->Response($error);
	
	return false;

}




/* Captcha */

if(!$vcaptcha->Validate($captcha, true)){

	$error = 'captcha.failed';

	$this->Response($error);
	
	return false;

}




if(isset($error)){


	if($error != false){

		$this->Response($error);

		return false;

	}


	else{



		$lSubscribe = new \GGN\Using('Connect/Subscribe');


		$lLogin = new \GGN\Using('Connect/Login');


		$connect = \GGN\Connect\Subscribe\Invoke::Main([

			/*
				Nom
			*/
			'firstname'=> $firstname
			

			/*
				Prenom
			*/
			,'lastname'=> $lastname
			




			/*
				Nom d'utilisateur ou email
			*/
			,'username'=> $username
			

			/*
				Mot de passe
			*/
			, 'password'=> $password
			

			/*
				Mode de connexion (email/Nom d'utilisateur)
			*/
			, 'mode'=> strtolower(_GGN::varn('ACTIVESESSION_MODE'))
			


			/*
				Email
			*/
			, 'email'=> $email



			/*
				Contacts
			*/
			, 'phone'=> $contact
			




			/*
				Sexe
			*/
			, 'sexe'=> $sexe
			




			/*
				Naissance
			*/
			, 'birth'=> mktime(0, 0, 0, $birth_month + 1, $birth_day, $birth_year)
			




			/*
				Classe 'com.service'
			*/
			, 'com.service'=>$this


		]);





		/*
			Tentative d'inscription : Validation des variables requires
		*/
		if($connect->attempt()===true){


			/* Connecter l'utilisateur Maintenant // DEBUT */

				$connect->attemptUserLogin();

				$USER = $connect->user;

			/* Connecter l'utilisateur Maintenant // FIN */




			/* Fonctionnalité : Additionnelle / DEBUT */


				/* Ajout de l'offres / DEBUT */

					$UKEY = $connect->user['UKEY'];

					new \GGN\Using('Plugins');

					new \GGN\Plugin\PHP('MiPi.0.2');

					$MiPi = (new \MiPi());

					$MiPi->SetUserOrder($UKEY);

				/* Ajout de l'offres / FIN */



				/* Envoi de message au client / DEBUT */

					// 

					$response = $MiPi->SendTexto($UKEY, "MinePicked", $contact, "", "Bienvenue sur notre plateforme. Votre compte a ete cree avec succes, veuillez penser a acheter un package.", false);

					// $MiPi->SendTexto($contact, "MinePicked", $contact, "Bienvenue sur notre plateforme. Connectez-vous avec le nom d\'utilisateur : " . $USER['USERNAME'] . " et le mot de passe : " . $USER['PASSWORD'] . " ", false);

				/* Envoi de message au client / FIN */


			/* Fonctionnalité : Additionnelle / FIN */




			$connect->responses('subscribe.success');


		}


		/*
			Echec de la tentative d'inscription
		*/
		else{

			$connect->responses('attempt.failed');

		}



	}

	


}



	
