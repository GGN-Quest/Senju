<?php
/*
	Copyright GOBOU Y. Yannick
	
*/
	
global $database, $_Gougnon, $GRegister;




if(!class_exists('GGN_UTIL_RSRC')){


	/**
	* GGN Système Util Ressources Class
	*/

	class GGN_UTIL_RSRC extends GSystem {


		const NAME = 'GGN System Util Ressources';

		const VERSION = '0.0.160418.1417';







		
		var $args = [];

		var $MIME_TYPE = [

			'TXT' => 'text/plain'

            ,'HTM' => 'text/html'

            ,'HTML' => 'text/html'

            ,'PHP' => 'text/html'

            ,'CSS' => 'text/css'

            ,'JS' => 'application/javascript'

            ,'JSON' => 'application/json'

            ,'XML' => 'application/xml'

            ,'SWF' => 'application/x-shockwave-flash'

            ,'FLV' => 'video/x-flv'

            // images

            ,'PNG' => 'image/png'

            ,'JPE' => 'image/jpeg'

            ,'JPEG' => 'image/jpeg'

            ,'JPG' => 'image/jpeg'

            ,'GIF' => 'image/gif'

            ,'BMP' => 'image/bmp'

            ,'ICO' => 'image/vnd.microsoft.icon'

            ,'TIFF' => 'image/tiff'

            ,'TIF' => 'image/tiff'

            ,'SVG' => 'image/svg+xml'

            ,'SVGZ' => 'image/svg+xml'

            // archives

            ,'ZIP' => 'application/zip'

            ,'RAR' => 'application/x-rar-compressed'

            ,'EXE' => 'application/x-msdownload'

            ,'MSI' => 'application/x-msdownload'

            ,'CAB' => 'application/vnd.ms-cab-compressed'

            // audio/video

            ,'MP3' => 'audio/mpeg'

            ,'QT' => 'video/quicktime'

            ,'MOV' => 'video/quicktime'

            // adobe

            ,'PDF' => 'application/pdf'

            ,'PSD' => 'image/vnd.adobe.photoshop'

            ,'AI' => 'application/postscript'

            ,'EPS' => 'application/postscript'

            ,'PS' => 'application/postscript'

            // ms office

            ,'DOC' => 'application/msword'

            ,'RTF' => 'application/rtf'

            ,'XLS' => 'application/vnd.ms-excel'

            ,'PPT' => 'application/vnd.ms-powerpoint'

            // open office

            ,'ODT' => 'application/vnd.oasis.opendocument.text'

            ,'ODS' => 'application/vnd.oasis.opendocument.spreadsheet',

		];



		function __construct(){

			global $GRegister;


			$this->args = func_get_args();

			$this->Register = $GRegister;
			
		}





		public function _Dir($useUser = false, $type){

			if($useUser === true){

				$dir = GUSERS::dataDir($this->Register->USER['USERNAME'], '%' . strtoupper($type) . '%');

			}

			else{

				$dir = GUSERS::dataDir('@guest.' . __CLIENT_IP__, '%' . strtoupper($type) . '%');


				if(is_string($useUser)){

					$get = GUSERS::get(" WHERE UKEY='" . $useUser . "' ", true);


					if($get->row > 0){

						$dir = GUSERS::dataDir($get->data[0]['USERNAME'], '%' . strtoupper($type) . '%');

						return $dir;

					}


				}

				if(isset($this->Register->USER['ACCOUNT_TYPE']) && ($this->Register->USER['ACCOUNT_TYPE'] >= _GGN::varn('ACCESS_RIGHT_RESSOURCES') ) ){

					$dir = __RESSOURCES__ . $type;

				}



			}

			return $dir;

		}





		public function _UDNm($useUser = false){

			if($useUser === true){

				$usrn = $this->Register->USER['USERNAME'];

			}

			else{

				$usrn = '@guest.' . __CLIENT_IP__;

				if(isset($this->Register->USER['ACCOUNT_TYPE']) && ($this->Register->USER['ACCOUNT_TYPE'] >= _GGN::varn('ACCESS_RIGHT_RESSOURCES') ) ){

					$usrn = $type;

				}


			}

			return $usrn;

		}





		static public function _URLMd($file = false){

			if(is_string($file)){

				$ex = explode('.', $file);

				$rex = array_reverse($ex);

				$ext = $rex[0];

				return implode('.', \Gougnon::arrayValues($ex, 0, count($ex)-1)) . '?ext=' . $ext;

			}

			else{

				return false;
				
			}

		}





		static public function _URLPh($rsrc = false){

			if(is_string($rsrc)){

				$ex = explode('/', $rsrc);

				return isset($ex[2]) ? implode('/', \Gougnon::arrayValues($ex, 3)) : false;

			}

			else{

				return false;
				
			}

		}





		public function MimeType(){

			if(isset($this->args[0])){

				$filename = $this->args[0];

				$ex = explode('.', $filename);

				$pop = strtoupper(array_pop($ex));


				if(array_key_exists($pop, $this->MIME_TYPE)){

					return $this->MIME_TYPE[$pop];

				}

				else{

					return 'application/octet-stream';

				}


			}

			else{

				return false;

			}

		}







	}


}





?>