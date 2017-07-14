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

	$_phones = [];


	foreach ($_POST as $key => $value) {

		$len = strlen('phone_');

		if(substr($key, 0, $len) == 'phone_'){

			if(is_numeric(trim($value))){

				array_push($_phones, $value);

			}

		}
		
	}



	/* Enregistrement */

	$treat->update = (new \GUSERS())->update("phone", implode(',', $_phones) , $this->Register->USER['UKEY']);




	/* Mise à niveau de la session */
	
	$Upgrade = (new \GGN\Connect\Invoke)

		->upgrade($this->Register->USER['UKEY'], $this->Register->USER['IDACCESS'])

	;



	$this->Response($Upgrade);





}

else{

	
	$this->Response('require.login');

}



