<?php
	
	if(isset($args[0]) && is_string($args[0])){

		$acc = explode(' ', 'À Á Â Ã Ä Å Ç È É Ê Ë Ì Í Î Ï Ò Ó Ô Õ Ö Ù Ú Û Ü Ý à á â ã ä å ç è é ê ë ì í î ï ð ò ó ô õ ö ù ú û ü ý ÿ _');

		$nac = explode(' ', 'A A A A A A C E E E E I I I I O O O O O U U U U Y a a a a a a c e e e e i i i i o o o o o o u u u u y y @');

		return str_replace($acc, $nac, $args[0]);
		
	}

?>