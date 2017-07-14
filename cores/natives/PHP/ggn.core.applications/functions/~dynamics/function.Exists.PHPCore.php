<?php

	$return = false;


	if(is_object($context)){

		global $database;

		$tres = (isset($args[0])) ? $args[0] : false;

		$database->Connect();

		$context->query="WHERE ";
		$context->query.="APPKEY='".$context->key."' ";
		$context->query.="AND AVAILABLE='1' ORDER BY VERS DESC";


		$context->getter = $database->SelectFromTable(self::TBL_, $context->query);
		$context->infos = false;



		if($context->getter==false){$return = FALSE;}

		if(is_object($context->getter)){
			$context->getter->results($tres);
			
			if($context->getter->row===1){
				$context->infos = $context->getter->data;
				$return = TRUE;
			}
			if($context->getter->row>1){$return = '-conflit.multi.app';}
		}
		

	}



?>