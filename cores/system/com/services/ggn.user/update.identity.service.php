 <?php
/*
	Copyright GOBOU Y. Yannick
	
*/


	global $database;


if(isset($this->Register->USER) && is_array($this->Register->USER)){



	$this->Response(true);

	$treat = $this->node('treat');

	$treat->update = false;







	/* Recuperation */

	$_lastname = Register::_POST('lastname', false);

	$_firstname = Register::_POST('firstname', false);

	$_nickname = Register::_POST('nickname', false);

	$_birth_day = Register::_POST('birth_day', false);

	$_birth_month = Register::_POST('birth_month', false);

	$_birth_year = Register::_POST('birth_year', false);

	$_sexe = Register::_POST('sexe', false);




	if(

		is_string($_lastname)

		&& is_string($_firstname)

		&& is_string($_nickname)

		&& is_string($_birth_day)

		&& is_string($_birth_month)

		&& is_string($_birth_year)

		&& is_string($_sexe)

	){


		$treat->update = \GUSERS::updateIdentity($this->Register->USER['UKEY'], $_firstname, $_lastname, $_nickname, $_sexe, mktime(0, 0, 0, $_birth_month + 1, $_birth_day, $_birth_year) );

		$this->Response(true);



	}

	else{

		$this->Response('data.failed');

	}


}

else{

	
	$this->Response('require.login');

}



