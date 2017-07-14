<?php
	
	$return = false;

	if(isset($args)){
		// $value = (isset($args[0]))?$args[0]:'';
		$column = (isset($args[0]))?((is_array($args[0]))?$args[0]:false):false;

			$output = new _GGNCustomObject();
			$output->header = self::unitHeader();

			$output->option = ["row"=>0, "column"=>$column];
			$output->data = [];
			
			if(is_array($column)){
				$count = 0;

				/*creation des colonnes */
				// foreach ($column as $tblk => $tbln) {
				// 	$output->data[$tbln] = [];
				// 	$count++;
				// }

			}
			else{}

			$output->footer = self::unitFooter();
		$return = $output;
	}


?>