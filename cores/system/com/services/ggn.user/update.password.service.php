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

	$old = Register::_POST('old', false);

	$new = Register::_POST('new', false);

	$confirm = Register::_POST('confirm', false);




	if(

		is_string($old)

		&& is_string($new)

		&& is_string($new)

	){


		if($old == $new){

			$this->Response('is.same');

		}

		elseif($new != $confirm){

			$this->Response('is.different');

		}


		else{


			$User = new \GUSERS($this->Register->USER['USERNAME'], $old);


			if($User->exists()){

				if($User::iUpdatePassword($this->Register->USER['UKEY'], $new)){

					$this->Response(true);

					$treat->update = true;

				}

				
			}

			else{

				$this->Response('password.failed');

			}


		}


	}

	else{

		$this->Response('data.failed');

	}


}

else{

	
	$this->Response('require.login');

}



