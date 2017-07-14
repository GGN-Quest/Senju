<?php
/*
	Copyright GOBOU Y. Yannick
	
*/




	$fullname = Register::_POST('fullname', false);

	$phone = Register::_POST('phone', false);

	$email = Register::_POST('email', false);

	$rmessage = Register::_POST('rmessage', false);


	$error = false;



	// $res = $this->node('');





	if(!is_string($fullname)){

		$this->Response('fullname.failed');

		$error = true;

	}



	if(!is_numeric($phone)){

		$this->Response('phone.failed');

		$error = true;

	}



	if(!preg_match(\_GGN::PATTERN_EMAIL, $email)){

		$this->Response('email.failed');

		$error = true;

	}



	if(!is_string($rmessage)){

		$this->Response('message.failed');

		$error = true;

	}



	if(Gougnon::isEmpty($rmessage)){

		$this->Response('message.failed');

		$error = true;

	}





	if($error === true){



	}



	if($error === false){


		$infolines = _GGN::varn('SYSTEM_INFOLINES');


			$t = 'Infoline Contacté';

			$c = '';
			$c .= 'Nom et Prénom(s) : <b>' . $fullname . '</b><br><br>';
			$c .= 'Contacts : <b>' . $phone . '</b><br><br>';
			$c .= 'email : <b>' . $email . '</b><br><br>';
			$c .= 'Message : <br><b>';
			$c .= $rmessage;
			$c .= '</b><br><br>';
			
			$s = _GGN::varn('SITENAME') . ' - ' . $t;

			$h  = 'MIME-Version: 1.0' . "\r\n";

			$h .= 'Content-type: text/html; charset=utf-8' . "\r\n";

			$h .= 'From: ' . _GGN::varn('SITENAME') . ' <no-reply@' . $_SERVER['HTTP_HOST'] . '>' . "\r\n";
			
			
			
			$res = $this->node('result');
			
			$res->to = $infolines;
			
			

		if(@mail($infolines, $s, $c, $h)){

			$this->Response('contact.success');

		}


		else{

			$this->Response('contact.failed');

		}



	}


