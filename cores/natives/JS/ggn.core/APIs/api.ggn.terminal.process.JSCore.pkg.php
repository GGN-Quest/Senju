<?php new \GGN\Using('System/xCMD'); ?>/* GougnonJS.Terminal.Process, version : 0.1, update : 160903#2209, Copyright GOBOU Y. Yannick 2016 */

(function(GScript){

	GScript.check('GTerminal', function(){

		GTerminal.Process = {<?php GGN\System\xCMD\Process::Write(); ?> };

	});

})(GScript);
