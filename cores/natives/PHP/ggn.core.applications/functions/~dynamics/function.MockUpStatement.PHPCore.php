<?php
	
	$return = false;


	if(is_object($context) && isset($context->Params->MockUpLayoutMode)){




		/* Activation des parties de la maquette en fonction du mode =================== */
		
			$context->Body->js('(function(){');

				$context->Body->js('var l=G(".'.$context::MockUpLayoutLeft.'")');
				$context->Body->js(',m=G(".'.$context::MockUpLayoutInside.'")');
				$context->Body->js(',r=G(".'.$context::MockUpLayoutRight.'")');
				$context->Body->js(',vl=G.isObject(l.element||"")?l:false');
				$context->Body->js(',vm=G.isObject(m.element||"")?m:false');
				$context->Body->js(',vr=G.isObject(r.element||"")?r:false');
				$context->Body->js(',Fx;');

				// $context->Body->js('Fx=function(ob,t,d,m){');
				// 	$context->Body->js('var fxn={},sty=GStyle,a,_n="transform",n=sty.getKeyOfBrowser(_n),opc=(m=="in")?"0.001->0.999":"0.999->0.001";');
				// 		$context->Body->js('fxn.opacity={value:opc,done:function(){ob.css({display:d}); }};');
				// 		$context->Body->js('t.timeline=150;');
				// 		$context->Body->js('fxn[n]=t;');
				// 		$context->Body->js('fxn[_n]=t;');
				// 		$context->Body->js('ob.animation(fxn);');
				// $context->Body->js('};');



			if($context->Params->MockUpLayoutMode==APPMockUpFullScreen){
				// $context->Body->js('if(vl){Fx(vl, {value:"0->-150:px", pattern:"translateX(LEVELUNIT)"}, "none", "out"); }');
				$context->Body->js('if(vl){vl.css({display:"none"});}');
				$context->Body->js('if(vm){vm.css({display:"block"});}');
				$context->Body->js('if(vr){vr.css({display:"none"});}');
			}

			if($context->Params->MockUpLayoutMode==APPMockUpNormal){
				// $context->Body->js('if(vl){Fx(vl, {value:"-50->0:px", pattern:"translateX(LEVELUNIT)"}, "block", "in"); }');
				$context->Body->js('if(vl){vl.css({display:"block"});}');
				$context->Body->js('if(vm){vm.css({display:"block"});}');
				$context->Body->js('if(vr){vr.css({display:"block"});}');
			}

			$context->Body->js('})();');

		/* Activation des parties de la maquette en fonction du mode FIN =================== */




		/* Declaration des fichiers CSS */
		$context->cssFilesStatement();



	}


?>