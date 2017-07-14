<?php
	
/* 
	
	GImages 0.1 

*/
	
if(!class_exists('GImages')){


	ini_set('max_input_time', 300);

	ini_set('max_execution_time', 300);

	ini_set("memory_limit", \_GGN::varn('MEMORY_LIMIT') );


class GImages extends Render{


	protected $param = [];
	protected $rogner = false;
	protected $resizeby = false;
	protected $autoResizeBy = false;
	
	var $quality = 5;
	
	
	
	
	
	
	
	public function __construct(){
		global $GLANG;
		$this->syslang = $GLANG;
		$this->arguments = func_get_args();
		$this->file = $this->arguments[0];
		$this->width = (isset($this->arguments[1]))?$this->arguments[1]: FALSE;
		$this->height = (isset($this->arguments[2]))?$this->arguments[2]: FALSE;
		$this->viewSource = strtolower((isset($this->arguments[3]))?$this->arguments[3]: 'false');
		$this->generateMode = strtolower((isset($this->arguments[4]))?$this->arguments[4]: '-default');
		$this->qualityMode = strtolower((isset($this->arguments[5]))?$this->arguments[5]: '-medium');
		
		$this->_filter = (isset($this->arguments[6]))?strtolower($this->arguments[6]): FALSE;
		
		$this->dispositionName = '-'.HOST.'--'.basename($this->file).'';
		
		
		/* Fichier et Source Primaires */
		$this->image = ($this->file);
		$this->info = @getimagesize($this->image);
		$this->imageSource = file_get_contents($this->image);
		
		}
	
	
	public function GetType(){
		$this->type = strtolower(str_replace('image/', '', $this->info['mime']));
		}
		
		
	
	
	public function GetQuality(){

		switch($this->qualityMode){
			case '-low':$this->quality = 1;break;
			case '-medium':$this->quality = 5;break;
			case '-high':$this->quality = 9;break;
			default:$this->quality = (is_numeric($this->qualityMode)) ? $this->qualityMode : $this->quality;break;
		}
		
	}
		
		
	
	
	public function GetSize(){
		$this->sizer = [];
		$this->__width = $this->info[0];
		$this->__height = $this->info[1];
		$this->sizer['width'] = ($this->width===FALSE || !is_numeric($this->width))?$this->__width: $this->width;
		$this->sizer['height'] = ($this->height===FALSE || !is_numeric($this->height))?$this->__height: $this->height;
		
	}
		
	
	public function GetSizeBy(){
		$this->autoResizeBy = ($this->autoResizeBy !== FALSE)
			? ((strtolower($this->autoResizeBy)=='-width')?'-width':'-height')
			: (($this->__width >= $this->__height) ? '-width': '-height');
			 
	}
		
		
		
	
	
	protected function viewMode(){
		// return false;
		/* Entête addictionnelle */
		if($this->viewSource=='download'){
			header('Content-Type: application/stream-octet');
			header('Content-Disposition: attachment; filename="'.$this->dispositionName.'"');
			}
			
		if($this->viewSource=='view'){
			header('Content-Type: text/html');
			}
		
		if($this->viewSource=='download:base64'){
			header('Content-Type: application/stream-octet');
			header('Content-Disposition: attachment; filename="'.$this->dispositionName.'.base64.txt"');
			echo base64_encode($this->imageSource);exit(0);
			}
			
		if($this->viewSource=='view:base64'){
			header('Content-Type: text/html');
			echo base64_encode($this->imageSource);exit(0);
			}
			
		}
		
		
		
	
	public function open($output = null, $ins = false){
		$this->param['open'] = func_get_args();
		// $this->withResize = (isset($this->param['open']))? $this->param['open']: false;	
		$this->output = (isset($this->param['open'][0]))? $this->param['open'][0]: false;	
		
		$this->viewMode();
		
		
		/* Librairie GD */
		if($this->generateMode=='-gd' || $this->generateMode=='-sample'){
			
			/* type de fichier */
			$this->GetType();
			
			/* Qualité */
			$this->GetQuality();
			
			/* Source */
			// $this->source = imagecreatefromstring($this->imageSource);
			$this->imageCreateFromType();
			
			/* Dimension */
			$this->GetSize();
			$this->GetSizeBy();
			
			/* Miniature */
				$this->thumb = imagecreatetruecolor($this->sizer['width'], $this->sizer['height']);
				
					
				if($this->type=='png'){
					// $this->source = imagecreatefrompng($this->image);
					imagealphablending($this->thumb, false);
					imagesavealpha($this->thumb, true);  
					imagealphablending($this->source, true);
					}
					
				if($this->type=='gif'){ 
					$this->source = imagecreatefromgif($this->image);
					$GIFBGColor = imagecolorallocate($this->thumb, 210, 255, 229);
					imagefilledrectangle($this->thumb, 0, 0, 99, 99, $GIFBGColor);
					imagecolortransparent($this->thumb, $GIFBGColor);
					}
					
				
				imagecopyresampled($this->thumb, $this->source, 0, 0, 0, 0, $this->sizer['width'], $this->sizer['height'], $this->__width, $this->__height);

				
			/* Création */
			$this->create(($this->output!=false)?$this->output:null);

		}
			
		else{
			if(is_string($this->output)){
				$dir=dirname($this->output);
				if(!is_dir($dir)){Gougnon::createFolders($dir);}
				Gougnon::createFile($this->output, $this->imageSource);
			}
			else{

				if($ins===false){echo $this->imageSource; }
				
				if($ins===true){return $this->imageSource; }

			}
				
		}
			
	}
	
	
	
	
	
	public function imageCreateFromType(){
		switch($this->type){
			case 'jpg':$this->source = imagecreatefromjpeg($this->image);break;
			case 'jpeg':$this->source = imagecreatefromjpeg($this->image);break;
			case 'png':$this->source = imagecreatefrompng($this->image);break;
			case 'gif':$this->source = imagecreatefromgif($this->image);break;
			}
		}
	
	
	
	
	
	public function GetResize(){

		$this->resizer = [];

		$this->resizer['x'] = 0;
		$this->resizer['y'] = 0;
		$this->resizer['width'] = $this->__width;
		$this->resizer['height'] = $this->__height;



		if($this->resizeby === false){

			$w = $this->sizer['width'];

			$h = ($this->__height * $w) / $this->__width;

		}

		else{

			$h = $this->sizer['height'];

			$w = ($this->__width * $h) / $this->__height;

		}


		$this->resizer['width'] = ceil($w);

		$this->resizer['height'] = ceil($h);
		
			

		// if($this->sizer['width']<=$this->__width && $this->sizer['height']<=$this->__height){

		// 	if($this->resizeby===true){
		// 		if($this->autoResizeBy=='-width'){
		// 			$width = round(($this->__width*$this->sizer['height'])/$this->__height);
		// 			$height = $this->sizer['height'];
		// 			$this->sizer['width'] = ($width>$this->__width)?$this->__width:$width;
		// 			}
					
		// 		if($this->autoResizeBy=='-height'){
		// 			$width = $this->sizer['width'];
		// 			$height = round(($this->__height*$this->sizer['width'])/$this->__width);
		// 			$this->sizer['height'] = ($height>$this->__height)?$this->__height:$height;
		// 			}
					
		// 		$this->resizer['width'] = $this->sizer['width'];
		// 		$this->resizer['height'] = $this->sizer['height'];
			
		// 		$this->resizer['x'] = Gougnon::nuspacer($width, $this->sizer['width']);
		// 		$this->resizer['y'] = Gougnon::nuspacer($height, $this->sizer['height']);
		// 	}
			
		// 	else{
		// 		if($this->autoResizeBy=='-width'){
		// 			$width = $this->sizer['width'];
		// 			$height = round(($this->__height*$this->sizer['width'])/$this->__width);
		// 			}
					
		// 		if($this->autoResizeBy=='-height'){
		// 			$width = round(($this->__width*$this->sizer['height'])/$this->__height);
		// 			$height = $this->sizer['height'];
		// 			}
					
		// 		$this->resizer['width'] = $width;
		// 		$this->resizer['height'] = $height;
		// 		}
		// 	}

		
		}
		
		
	public function getResizeBy($w,$h,$ow,$oh){
		$prf = ($ow>$oh)?'-w':'-h';
		return ($prf=='-h')?(($h<$w)?'-height':'-width'): (($h>$w)?'-height':'-width');
	}
		
		
	public function resize($output = false, $resizeby = false, $rogner = false, $scale = false){

		$this->param['resize'] = func_get_args();

		$this->output = (isset($this->param['resize'][0]))?$this->param['resize'][0]: false;
		
		$this->resizeby = (isset($this->param['resize'][1]))?$this->param['resize'][1]: false;
		
		$this->rogner = (isset($this->param['resize'][2]))?$this->param['resize'][2]: false;
		

		$this->scale = (isset($this->param['resize'][3]))?$this->param['resize'][3]: false;

			$this->scale = (is_numeric($this->scale) && $this->scale > 0) ? $this->scale : 100;

			// $this->scale = (is_numeric($this->scale)) ? ($this->scale >= 100 ? 100 : (($this->scale <= 0) ? 0: $this->scale * 1)) : 100;


		/* Dimension */
		$this->GetSize();

		$this->_autoResizeBy = $this->getResizeBy($this->width,$this->height, $this->__width, $this->__height);

		$this->autoResizeBy = ($this->autoResizeBy=='-width'||$this->autoResizeBy=='-height') ? $this->autoResizeBy : $this->_autoResizeBy;


		// $this->autoResizeBy = ($this->autoResizeBy=='-width'||$this->autoResizeBy=='-height') ? $this->autoResizeBy : $this->getResizeBy($this->width,$this->height, $this->__width, $this->__height);


			
			/* Exiistence de la source */
			// if($this->output===false){echo 'stop here';return false;}
			
			
			/* type de fichier */
			$this->GetType();
			
			
			/* Qualité */
			$this->GetQuality();
			
			
			
			
			/* Redimensionnement */
			$this->GetResize();
			



		/* Création de l'image */
		$this->imageCreateFromType();



			/* Rogner */
			if($this->rogner===true){

				// $this->_rwidth = $this->resizer['width'];

				// $this->_rheight = $this->resizer['height'];

				// if($this->resizeby===true){
				// 	$this->_rwidth = ($this->width < $this->resizer['width']) ? $this->width:  $this->resizer['width'];
				// }

				// if($this->resizeby===false){
				// 	$this->_rheight = ($this->height < $this->resizer['height']) ? $this->height :  $this->resizer['height'];
				// }




				$this->resizer['x'] = floor(($this->__width - $this->sizer['width']) / 2);

					$this->resizer['x'] = $this->resizer['x'] < 0 ? 0 : $this->resizer['x'];

				$this->resizer['y'] = floor(($this->__height - $this->sizer['height']) / 2);

					$this->resizer['y'] = $this->resizer['y'] < 0 ? 0 : $this->resizer['y'];


				if($this->resizeby == false){

					$this->sizer['height'] = $this->__height < $this->sizer['height'] ? $this->resizer['height'] : $this->sizer['height'];

				}


				if($this->resizeby == true){

					$this->sizer['width'] = $this->__width < $this->sizer['width'] ? $this->resizer['width'] : $this->sizer['width'];

				}

				$this->resizer['width'] = $this->__width - $this->resizer['x'];

				$this->resizer['height'] = $this->__height - $this->resizer['y'];


				// $_wcb = $this->resizer['width'];

				// $_hcb = $this->resizer['height'];

				// $wcb = $this->sizer['width'];

				// $hcb = $this->sizer['height'];


				if($this->scale > 0){


					$scale_Width = floor(($this->scale * $this->__width) / 100) * 1;

					$scale_Height = floor(($this->scale * $this->__height) / 100) * 1;


					$limit_Width = $this->sizer['width'] * 1;

					$limit_Height = $this->sizer['height'] * 1;



					$this->resizer['width'] = $scale_Width < $limit_Width ? $limit_Width : $scale_Width;

					$this->resizer['height'] = $scale_Height < $limit_Height ? $limit_Height : $scale_Height;



					if($scale_Width < $limit_Width){

						$this->resizer['width'] = $limit_Width;

						$this->resizer['x'] = 0;

					}

					if($scale_Width >= $limit_Width){

						$this->resizer['x'] = ($this->resizer['width'] - $this->sizer['width']) ;

						// $this->resizer['width'] = $this->resizer['x'];

					}

					if($scale_Height < $limit_Height){

						$this->resizer['height'] = $limit_Height;

						$this->resizer['y'] = 0;

					}

					if($scale_Height >= $limit_Height){

						$this->resizer['y'] = ($this->resizer['height'] - $this->sizer['height']) ;

						// $this->resizer['height'] = $this->resizer['y'];

					}



					if($this->resizeby == false){

						$this->resizer['height'] = ($this->__height * $this->resizer['width']) / $this->__width;

					}



					if($this->resizeby == true){

						$this->resizer['width'] = ($this->__width * $this->resizer['height']) / $this->__height;

					}






					if($this->resizer['width'] < $limit_Width){

						$this->resizer['x'] = 0;

						$this->sizer['width'] = $this->resizer['width'];

					}

					if($this->resizer['width'] >= $limit_Width){

						$this->resizer['x'] = ($scale_Width - $this->sizer['width']) / 2;

					}

					if($this->resizer['height'] < $limit_Height){

						$this->resizer['y'] = 0;

						$this->sizer['height'] = $this->resizer['height'];

					}

					if($this->resizer['height'] >= $limit_Height){

						$this->resizer['y'] = ($scale_Height - $this->sizer['height']) / 2;

					}


					// $this->resizer['width'] -= $this->resizer['x'];

					// $this->resizer['height'] -= $this->resizer['y'];


					// var_dump($this->scale);

					// var_dump($this->resizeby);

					// // var_dump($rap);

					// var_dump($scale_Width);

					// var_dump($scale_Height);

					// var_dump($limit_Width);

					// var_dump($limit_Height);

					// var_dump($this->sizer);

					// var_dump($this->resizer);

					// exit;


				}


				$this->thumb = imagecreatetruecolor($this->sizer['width'], $this->sizer['height']);

				// $this->thumb = imagecreatetruecolor($this->resizer['width'], $this->resizer['height']);

				// $this->thumb = imagecreatetruecolor($this->_rwidth, $this->_rheight);

			}




			if($this->rogner!==true){

				$this->thumb = imagecreatetruecolor($this->resizer['width'], $this->resizer['height']);
			}



		


			if($this->type=='png'){
				// $this->source = imagecreatefrompng($this->image);
				imagealphablending($this->thumb, false);
				imagesavealpha($this->thumb, true);  
				imagealphablending($this->source, true);
			}
			
		
			if($this->type=='gif'){ 
				$this->source = imagecreatefromgif($this->image);
				$GIFBGColor = imagecolorallocate($this->thumb, 210, 255, 229);
				imagefilledrectangle($this->thumb, 0, 0, 99, 99, $GIFBGColor);
				imagecolortransparent($this->thumb, $GIFBGColor);
			}

				
		imagecopyresampled(
		
			$this->thumb
		
			, $this->source
		
			, 0, 0, $this->resizer['x'], $this->resizer['y']
		
			, $this->resizer['width'], $this->resizer['height']
		
			, $this->__width, $this->__height
		
			);
		
		
		/* Création */
		// if($this->output!==false){
		// 	$outputDir = dirname($this->output);
		// 	if(!is_dir($outputDir)){Gougnon::creatFolders($outputDir);}
		// }
		
		$this->create(($this->output===false)?null:$this->output);
		return true;}
	
	
	
	
	
	/* Création */
	public function create($output){

		

		if($this->_filter!==false){$this->applyFilter();}

		// var_dump($output); var_dump($this->output); exit;

		if(is_string($output)){
			$outputDir = dirname($output);
			if(!is_dir($outputDir)){Gougnon::createFolders($outputDir);}
		}
		

		switch($this->type){

			case 'jpg':imagejpeg($this->thumb, $output, (($this->qualityMode=='-high')?100: $this->quality)*10);break;
			
			case 'jpeg':imagejpeg($this->thumb, $output, (($this->qualityMode=='-high')?100: $this->quality)*10);break;
			
			case 'png':imagepng($this->thumb, $output, $this->quality);break;
				
			case 'gif':imagegif($this->thumb, $output);break;

		}
			
		imagedestroy($this->thumb);

	}
	
	
	

	
	/* Filtres */
	protected function applyFilter(){
		$exp = explode(';', rtrim(ltrim(trim($this->_filter))) );
		$row = count($exp);
			
			for($x=0; $x<$row; $x++){
				$this->filter($exp[$x]);
				}
			
		}
		
	protected function filter($cmd){
		$exp = explode(':', rtrim(ltrim(trim(urldecode($cmd)))) );
		$filter = isset($exp[0])?$exp[0]: false;
		$_args = isset($exp[1])?$exp[1]: '';
		$args = explode('|', $_args);
		
		// for($x=0; $x<=5; $x++){
			// $args[$x] = (!isset($args[0])) ? $args[0]: 0;
			// }
		
		// echo $filter;
		// echo '<pre>';
		// print_r($args);
		// echo '</pre>';
		// echo ((@_GGN::isUsable($args[2])) ? $args[2]: '->' . 0) . '<br>';
		// echo ((is_array($args[2])) ? 'is array': '->' . 0) . '<br>';
		
		// exit(0);
		
		
		if($filter=='negate'){@imagefilter($this->thumb, IMG_FILTER_NEGATE);}
		
		if($filter=='emboss'){@imagefilter($this->thumb, IMG_FILTER_EMBOSS);}
		
		if($filter=='grayscale'){@imagefilter($this->thumb, IMG_FILTER_GRAYSCALE);}
		
		if($filter=='selective.blur'){@imagefilter($this->thumb, IMG_FILTER_SELECTIVE_BLUR);}
		
		if($filter=='mean.removal'){@imagefilter($this->thumb, IMG_FILTER_MEAN_REMOVAL);}
		
		if($filter=='edgedetect'){@imagefilter($this->thumb, IMG_FILTER_EDGEDETECT);}
		
		if($filter=='gaussian.blur'){@imagefilter($this->thumb, IMG_FILTER_GAUSSIAN_BLUR);}
		
		if($filter=='convolution'){
			$v=[[1,2,1],[2,4,2],[1,2,1]];
			$o = (@_GGN::isUsable($args[0])? @eval('$v = ' . $args[0] . ';'): $v);
			imageconvolution($this->thumb
				, $v
				, (@_GGN::isUsable($args[1])?$args[1]:1)
				, (@_GGN::isUsable($args[2])?$args[2]:1)
				);
				
			}
		
		if($filter=='smooth'){imagefilter($this->thumb, IMG_FILTER_SMOOTH, (@_GGN::isUsable($args[0])?$args[0]:1) );}
		
		if($filter=='colorize'){
			@imagefilter($this->thumb, IMG_FILTER_COLORIZE
				, (@_GGN::isUsable($args[0])?$args[0]:0)
				, (@_GGN::isUsable($args[1])?$args[1]:0)
				, (@_GGN::isUsable($args[2])?$args[2]:0)
				);
			}
			
		if($filter=='contrast'){@imagefilter($this->thumb, IMG_FILTER_CONTRAST, (@_GGN::isUsable($args[0])?$args[0]:1) );}
		
		if($filter=='brightness'){@imagefilter($this->thumb, IMG_FILTER_BRIGHTNESS, (@_GGN::isUsable($args[0])?$args[0]:1) );}
			
		
		}
		
		
		
		
		
		
		
		
		
	/* Outil de Couleur */
	static public function HEXtoRGB($code){return Gougnon::HEXtoRGB($code);}

	static public function RGBtoHEX($r,$g,$b){return Gougnon::RGBtoHEX($r,$g,$b);}
	
	static public function RGBToParam($rgb){
		return implode('|',explode(',',$rgb));
	}
	
	
	
	
	
	
	
	
	
	
	}

		
}

?>