<?php
/*
	Copyright GOBOU Y. Yannick
	
*/


$CountingFailures = (new \RegisterSecure)->CountingFailures( _GGN::varn('LOGIN_FAILURES_NUMBERS') );



// print_r($CountingFailures->Accept());

// $CountingFailures->Count();

// $this->Register->close();




if($CountingFailures->Accept() === false){

	$CF = $this->node('CountingFailures');


		$CF->Limit = $CountingFailures->Limit;

		$CF->Rest = $CountingFailures->Rest;

		$CF->TimeRemaining = $CountingFailures->GetRemainingTime();

		$CF->dTimeRemaining = date('H:i:s', $CountingFailures->RestTime);


	$this->Response('try.over');

}

else{


	$lLogin = new \GGN\Using('Connect/Login');


	$connect = \GGN\Connect\Login\Invoke::Main([

		/*
			Nom d'utilisateur ou email
		*/
		'username'=> Register::_POST('username')
		

		/*
			Mot de passe
		*/
		, 'password'=> Register::_POST('password')
		

		/*
			Se souvenir de ce utilisateur pour prolongé la durée de la session
		*/
		, 'remember'=> Register::_POST('remember')
		

		/*
			Mode de connexion (email/Nom d'utilisateur)
		*/
		, 'mode'=> strtolower(_GGN::varn('ACTIVESESSION_MODE'))
		

		/*
			Application associé à la session
		*/
		, 'app'=> Register::_POST('app', false)
		

		/*
			Origne de la connexion
		*/
		, 'origin'=> Register::_POST('origin', 'ggn.connect')


		/*
			Classe 'com.service'
		*/
		, 'com.service'=>$this


	]);





	/*
		Tentative de connexion : Validation des variables requires
	*/
	if($connect->attempt()===true){

		$CountingFailures->Destroy();



		/* Mise à jour du log de l'utilisateur / DEBUT */

			new \GGN\Using('User');

			$log = new \GGN\User\Log('login', 'Nouvelle Connexion Acceptée!');

		/* Mise à jour du log de l'utilisateur / FIN */



		$connect->responses('login.success');

	}


	/*
		Echec de la tentative de connexion
	*/
	else{

		\RegisterLog::Add('-guest', 'login', 'echec de la tentative de connexion!');

		$CountingFailures->Count();

		$connect->responses('attempt.failed');


	}

}



	