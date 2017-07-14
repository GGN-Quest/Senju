<?php
	

global $_Gougnon;


	$this->requireSlashPathARCRenderClass('COM.SERVICES/default');


	$serv = [];


	// foreach(explode('/',$this->gFile) as $k => $value){

	// 	if($k>0){

	// 		array_push($serv, $value);

	// 	}

	// }



	$Services = new GGN_COM_SERVICES(implode('/', \Gougnon::arrayValues($this->concatenate, 1) ));
	// $Services = new GGN_COM_SERVICES(implode('/', $serv));

	$Services->Register = $this;



	if($this->AcceptToken == true){

		$Services->Load();

		$Services->Service['GGN_REGEDIT_ACCEPT_TOKEN'] = true;

	}
	

	if($this->AcceptToken === false){

		$Services->Service = [];

		$Services->Service['GGN_REGEDIT_ACCEPT_TOKEN'] = $this->AcceptToken;
		
	}

	
	$Service = $Services->ToJSON();



	if(!is_string($Service)){

		echo '{"response":"data.encoding.not.supported"}';

	}
	

	else{

		_GGN::write($Service);
		
	}

	
?>