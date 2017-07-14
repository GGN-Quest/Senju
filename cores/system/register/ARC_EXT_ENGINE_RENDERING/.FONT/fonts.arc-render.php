<?php
/*
	Copyright GOBOU Y. Yannick
======================================================
	CLASS FontRender
	PAGE cores/_GGNs/PHP/Register.core.g/ARC_ENGINE_RENDING/.PNG/FontRender.arc-render
======================================================

	Moteur de rendu d'images PNG
	
*/

/*
	CLASS 'FontRender'
*/
// echo 'loading...';exit;

class FontRender extends Render{
	
	public function __construct($file = '', $mode = false){

		global $GLANG;

		$this->syslang = $GLANG;

		$this->arguments = func_get_args();

		$this->file = $file;

		$this->mode = $mode;

	}
	


	public function generate(){

		if($this->mode == 'base.64'){

			header('Content-Type: text/plain');

			self::write( base64_encode(file_get_contents($this->file)) );

		}

		elseif($this->mode == 'utf.8'){

			header('Content-Type: text/plain');

			self::write( utf8_encode(file_get_contents($this->file)) );

		}

		else{

			header('Content-Type: ' . $this->GetMime());

			$this->contents = file_get_contents($this->file);

			self::write($this->contents);

		}

	}


	/* Update : 160913.0826 */
	public function GetMime(){

		$Exp = explode('.', $this->file);

		$Lim = count($Exp) - 1;

		$Ext = (isset($Exp[$Lim])) ? $Exp[$Lim] : false;



		switch ($Ext) {

			case 'svg': $Mime = 'image/svg+xml'; break;

			case 'ttf': $Mime = 'application/x-font-truetypel'; break;

			case 'otf': $Mime = 'application/x-font-opentype'; break;

			case 'woff': $Mime = 'application/font-woff'; break;

			case 'woff2': $Mime = 'application/font-woff2'; break;

			case 'eot': $Mime = 'application/vnd.ms-fontobject'; break;

			case 'sfnt': $Mime = 'application/font-sfnt'; break;
			
			default: 

				$Mime = 'application/octet-stream'; 
				
			break;

		}


		return $Mime;

	}


	
	
}

	


	

	$this->Render = new FontRender($this->file, Register::_GET('mode', false));

	$this->Render->generate();
	
?>