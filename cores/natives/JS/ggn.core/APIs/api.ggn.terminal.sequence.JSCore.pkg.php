<?php new \GGN\Using('System/xCMD'); ?>/* GougnonJS.Terminal.Sequence, version : 0.1, update : 160903#2209, Copyright GOBOU Y. Yannick 2016 */


(function(GScript){

	GScript.check('GTerminal', function(){

		GTerminal.Sequence = {<?php GGN\System\xCMD\Sequences::Write(); ?> };

	});

})(GScript);
