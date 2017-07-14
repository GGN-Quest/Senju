<?php


require '../cores/run.php';


$username = Register::_POST('username', false);

$password = Register::_POST('password', false);


if(is_string($username) && is_string($password)){

	if(!\Gougnon::isEmpty($username) && !\Gougnon::isEmpty($password) ){

		$User = new GUSERS($username, $password);

		if($User->create(['ACCOUNT_TYPE'=>'5', 'ACTIVE_ACCEPTED'=>'1'])){

			echo '{"response":true}';

		}

		else{

			echo '{"response":false}';
			
		}

	}

	else{

		if(\Gougnon::isEmpty($username) && \Gougnon::isEmpty($password)){

			echo '{"response":true}';

		}

	}

}

else{

	echo '{"response":"var.not.found"}';

}