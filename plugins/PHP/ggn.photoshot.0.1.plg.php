<?php
/*
	Copyright 2016 GOBOU Yannick
*/


namespace GGN\Plugin\PHP\PhotoShot;





if(!class_exists('\GGN\Dir\Path')){

	new \GGN\Using('Dir');

}




if(!class_exists('\GGN\File\Path')){

	new \GGN\Using('File');

}





if(!class_exists('\GGN\Plugin\PHP\PhotoShot\Gallery')){


	Class Gallery{


		const PATH = 'image://ggn.photoshot.gallery/';

		const LENGTH = 50;


		var $Scan = false;


		public function __construct($Key = false, $Page = 0){


			if(is_string($Key) && is_numeric($Page)){

				$this->Key = $Key;

				$this->Page = $Page;

				$this->Dir = \GGN\Path\Protocol::Value(self::PATH);

				$this->Path = \GGN\Path\Name::Format($this->Dir . $this->Key);

				$this->URLPath = \GGN\Path\Name::Format(HTTP_HOST . basename($this->Dir) ) . \GGN\Path\Name::Format( basename($this->Key) );

			}

		}


		static public function IsImage($Name){

			$is = false;

			try{

				$Info = getimagesize($Name);

				if(isset($Info['mime'])){

					switch ($Info['mime']) {

						case 'image/jpeg': case 'image/jpg': case 'image/png': case 'image/gif': case 'image/bmp': $is = true; break;
						
					}

				}

			}

			catch(Exception $e){}

			return $is;

		}


		static public function Info($FileName){

			$File = $FileName . '.info';

			$Out = ['src' => false, 'title' => false, 'about' => false];

			if(is_file($File)){

				$Out = json_decode(\GGN\File\Content::Get($File), \GStorages::JSON_OPT());

			}

			return $Out;

		}


		public function Images($Key = false){

			if(is_string($this->Path) && is_dir($this->Path)){

				$Scan = \Gougnon::scanFolder($this->Path);

				$Out = [];


				$Start = $this->Page * self::LENGTH;

				$End = $Start + self::LENGTH;

				$k0 = 0;


				foreach ($Scan as $k => $image) {

					$name = basename($image);

					if($k0 >= $Start && $k0 < $End && self::IsImage($image)){

						$Info = self::Info($image);

						$Info['src'] = $name;

						$Out[] = $Info;

						$k0++;

					}

				}
					

				return $Out;

			}

			else{

				return false;

			}

		}




	}


}

