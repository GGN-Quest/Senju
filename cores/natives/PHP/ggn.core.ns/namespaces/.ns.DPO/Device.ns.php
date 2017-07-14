<?php

	/**
	 * GGN DPO Device
	 *
	 * @version 1.2
	 * @update 150910.0900
	 * @Require Gougnon Framework
	*/




/*
	Nom de l'espace
*/
namespace GGN\DPO;
	


	if(!class_exists('\GGN\DPO\Device')){
			
		Class Device extends Invoke{

			const NAME = 'Gougnon DPO Device';
			
			const VERSION = '1.2';
			
			const UPDATE = '150910.0900';

			public $userAgent;

			public $accept;
			
			public $current;
			
			public $name;
			

			protected $mobileDevices = [
				"android-mobile" => "android.*mobile"
				, "android-tablet" => "android(?!.*mobile)"
				, "blackberry" => "blackberry"
				, "blackberrytablet" => "rim tablet os"
				, "iphone" => "(iphone|ipod)"
				, "ipad" => "(ipad)"
				, "palm" => "(avantgo|blazer|elaine|hiptop|palm|plucker|xiino)"
				, "windows" => "windows ce; (iemobile|ppc|smartphone)"
				, "windowsphone" => "windows phone os"
				, "generic" => "(cldc|docomo|novarra|reqwirelessweb|kindle|mobile|mmp|midp|pocket|psp|symbian|smartphone|treo|up.browser|up.link|vodafone|wap|opera mini)"
				];

			protected $computerDevices = [
				"msie" => "msie|trident"
				, "edge" => "Edge"
				, "firefox" => "firefox"
				, "opera" => "opera"
				, "opera" => "opr"
				, "chrome" => "chrome"
				, "safari" => "safari"
				, "flock" => "flock"
				, "netscape" => "netscape"
				];

			
			/* -m: mobile; -c: Ordinateur; -u: indefini */
			public function __construct(){
				$this->userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '';
				$this->accept = isset($_SERVER['HTTP_ACCEPT']) ? strtolower($_SERVER['HTTP_ACCEPT']) : '';
				$this->current = ($this->isMobileDevice())?'-m':(($this->isComputerDevice())?'-c':'-u');
					
				if (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
					$this->current = '-m';}
					
				elseif(strpos($this->accept, 'text/vnd.wap.wml') > 0 || strpos($this->accept, 'application/vnd.wap.xbody+xml') > 0) {
					$this->current = '-m';
					} 
				else{}
					
				}
				
				
				
			public function get($device){return substr_count($this->userAgent, strtolower($device))>0?true:false;}

			
			/* Mozilla */
			public function isMozilla(){return $this->get('mozilla');}
			public function isGecko(){return $this->get('gecko');}
			public function isLikeGecko(){return $this->get('like gecko');}
			
			
			
			/* AppleWebkit */
			public function isKhtml(){return $this->get('khtml');}
			public function isWebkit(){return $this->get('webkit');}
			public function isAppleWebkit(){return $this->get('applewebkit');}
			
			
			/* Microsoft Internet Explorer */
			public function isIE(){return $this->get('trident/')||$this->get('msie')||$this->get('Microsoft Internet Explorer');}
			public function isIE7(){return $this->get('msie 7');}
			public function isIE8(){return $this->get('msie 8');}
			public function isIE9(){return $this->get('msie 9');}
			public function isIE10(){return $this->get('msie 10');}
			public function isIE11(){return $this->isIE()&&$this->get('rv:11');}
			public function isIEMobile(){return $this->get('iemobile');}
			public function isXbox(){return $this->get('xbox');}
			public function isXboxOne(){return $this->get('xboxOne');}
				
				
				
			/* Detection Navigateur Ordinateur */
			protected function isComputerDevice(){
				$return = false;
				foreach($this->computerDevices as $device => $agent){
					if($this->detectComputerDevice($device)===true){
						$this->name = $device;
						$return = true;
						break;
						}
					}
				return $return;
				}
				
			public function detectComputerDevice($device){return (isset($this->computerDevices[$device]))?((preg_match('/'.$this->computerDevices[$device].'/i', $this->userAgent))?true: false):false; }
				
				
				
				
			/* Detection Navigateur Mobile */
			protected function isMobileDevice(){
				$return = false;
				foreach($this->mobileDevices as $device => $agent){
					if($this->detectMobileDevice($device)===true){
						$this->name = $device;
						$return = true;
						break;
						}
					}
				return $return;
			}
				
			public function detectMobileDevice($device){
				return (isset($this->mobileDevices[$device]))?((preg_match('/'.$this->mobileDevices[$device].'/i', $this->userAgent))?true: false):false;
			}
				
				
				
				
				
			/* Detection */
			public function __call($name, $args){
				$device = strtolower(substr($name, 2));
				return (isset($this->mobileDevices[$device]))?$this->detectMobileDevice($device): ((isset($this->computerDevices[$device]))?$this->detectComputerDevice($device): 'undefined');
				}
				
				





		} // Class 'Device'


	} // If class exists 'Device'




?>