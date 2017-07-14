<?php

	global $GRegister, $database;





	$js = '';

	$js .= '(function(){';

		$js .= 'G("#ggn-sheet").addClass("gui flex column");';

		$js .= 'G("#ggn-sheet-container").addClass("col-0 gui flex column");';

		// $js .= 'G(".ui-columns").addClass("col-0");';

	$js .= '})();';





	$this->Tpl->Body->js($js);



?>