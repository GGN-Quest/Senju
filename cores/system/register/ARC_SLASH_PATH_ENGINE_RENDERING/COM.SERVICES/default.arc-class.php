<?php
/*
	Copyright GOBOU Y. Yannick
*/

/*
	CLASS 'GGN_COM_SERVICES'
*/

global $_Gougnon;






/* CLASS */
class GGN_COM_SERVICES{

	const EXT = '.service.php';
	const TNLEXT = '.tunnel.php';


	var $Register=false;
	var $Path=false;
	var $Service=[];




	function __construct(){

		$this->Args = func_get_args();
		$this->COM = isset($this->Args[0])?$this->Args[0]:false;
		$this->ServicesPath = __CORES_SYSTEM_COM__ . 'services/';
		$this->TunnelsPath = __CORES_SYSTEM_COM__ . 'tunnels/';
		$this->Service['response'] = '';
		
	}


	/* Chargement */
	public function Load(){
		$this->ServiceFile = $this->ServicesPath . (is_string($this->COM) ? $this->COM . self::EXT : '');

		if(is_file($this->ServiceFile)){
			@header(_GGN::HTTP_HEADER_200);
			include $this->ServiceFile;
		}
		else{
			@header(_GGN::HTTP_HEADER_404);
			$this->Service['response'] = 'service.not.found';
		}

	}




	/* Outils */
	public function Response($data){
		$this->Service['response'] = $data;	
	}
	
	public function AddNodeClass(){
		$new = new _GGNCustomObject([
			"Node"=>function($name){
				print_r($name);
				// $this->{$name} = GGN_COM_SERVICES::AddNodeClass();
			}
		]);

		return $new;
	}
	
	public function Node($name){
		$new = new _GGNCustomObject();
		// $new = self::AddNodeClass();
		$this->Service[$name] = $new;
		return $new;
	}
	



	/* JSON */
	public static function JSON_OPT(){
		return JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE;	
	}
	


	public function ToJSON(){
		return (!isset($this->Service)) ? false : @json_encode($this->Service, self::JSON_OPT());
	}



	/* Tunnel */
	public function Tunnel($tunnel, $dataType, $args){
		$tnl = $this->TunnelsPath . (is_string($tunnel) ? $tunnel . self::TNLEXT : '');

		if(is_file($tnl)){
			include $tnl;
		}
		else{
			return false;
		}
		
	}
	


} 


	
?>