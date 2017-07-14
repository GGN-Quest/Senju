<?php
/*
	Copyright 2013 GOBOU Y. Yannick
======================================================
	NAME 'Gougnon Native Core'
	CLASS 'GGNCore'
	PAGE 'cores/native.core.interface.php'
======================================================

*/





/* Interface "GGNCoreInterface" */
INTERFACE GGNCoreInterface{

	CONST GTYPE = 'GGN.CORE.INTERFACE';

	PUBLIC STATIC FUNCTION getCoreDir();
	PUBLIC STATIC FUNCTION functionsDir($function, $mode);
	PUBLIC STATIC FUNCTION isFunction($function, $mode);
	PUBLIC STATIC FUNCTION loadFunction($function, $args, $mode, $context);

}








/* Class "GGNCore" */
CLASS GGNCore{

	CONST GGNCore = 'Gougnon CORE.CLASS.ALPHA';
	CONST GGNCoreVersion = '0.1.150427.1108';
	CONST CoreFamily = 'GGN.Core.Family:ver.1504';


	public function isContextVar($string){if(is_object($this) && is_string($string)){return (isset($this->{$string})) ? $this->{$string} : false;} return false; }



}





/* Class "GGNCorePHP" */
CLASS GGNCorePHP extends GGNCore{

	CONST TYPE = 'PHP.CORE';

}





/* Class "GGNCoreJS" */
CLASS GGNCoreJS extends GGNCore{

	CONST TYPE = 'JS.CORE';

}





/* Class "GGNCoreCSS" */
CLASS GGNCoreCSS extends GGNCore{

	CONST TYPE = 'CSS.CORE';

}







?>