<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS GGN_DOWNLOADER
	PAGE cores/_GGNs/PHP/Register.core.g/ARC_ENGINE_RENDING/GGN.DOWNLOADER/default.arc-render
======================================================
	
*/

/*
	CLASS 'GGN_DOWNLOADER'
*/

new \GGN\Using('Numeric');



if(!class_exists('GGN_DOWNLOADER')){


Class GGN_DOWNLOADER{






		static public function GetPrecept($FileName, $Dir = false){

			$Dir = is_string($Dir) ? $Dir : dirname(__FILE__);

			$File = $Dir . '/' . $FileName;

			return (is_file($File)) ? json_decode(file_get_contents($File), GStorages::JSON_OPT()) : false;

		}





		static public function IsAuthorized($Url = false){

			$Settings = self::GetPrecept('.settings');


			if(is_array($Settings) && is_string($Url) ){

				$Authorized = $Settings['Authorized'];

				$Domain = parse_url($Url, PHP_URL_HOST);

				if(in_array($Domain, $Authorized)){

					return true;

				}

				else{

					return false;

				}


			}

			else{

				return false;

			}


		}






		static public function GetFileInfo($url){

		  	$output = [

		  		'size'=>0

		  		, 'filename'=>''

		  		, 'version'=>''

		  	];

		  	$curl = curl_init($url);


			curl_setopt( $curl, CURLOPT_NOBODY, true );

			curl_setopt( $curl, CURLOPT_HEADER, true );

			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );

			curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );

			curl_setopt( $curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] );


			$data = curl_exec( $curl );

			curl_close( $curl );


			if( $data ) {

			    $size = "unknown";

			    $name = "unknown";

			    $status = "unknown";

			    $version = "unknown";


			    if( preg_match("/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches ) ) {

			    	$status = (isset($matches[1])) ? (int)$matches[1] : '';

			    }

			    if( preg_match("/Content-Length: (\d+)/", $data, $matches ) ) {

			    	$size = (isset($matches[1])) ? (int)$matches[1] : '';

			    }

			    if( preg_match('/File-Version: (.*)/', $data, $matches ) ) {

			    	$version = (isset($matches[1])) ? str_replace("\r", '', $matches[1]) : '';

			    }

			    if( preg_match('/Content-Disposition: .*filename=[\"|\']([^ ]+)[\"|\']/', $data, $matches ) ) {

			    	$name = (isset($matches[1])) ? $matches[1] : '';

			    }


			    if( $status == 200 || ($status > 300 && $status <= 308) ) {

			    	$output['size'] = $size;

			    	$output['version'] = $version;

			    	$output['sizeLabel'] = (new \GGN\Numeric\Unit($size, 1))->Label;

			    	$output['filename'] = $name;

			    }

	 		}

	  		return $output;

		}


	}

	
}




?>