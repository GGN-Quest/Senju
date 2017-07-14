<?php 
/*

	<phpcore name="empty">
		Verifi si une variable est vide
	</phpcore>
	
*/
	
		$i = $args;
		$return = FALSE;
		if(strlen(str_replace(' ', '', $i[0])) == 0): $return = TRUE; endif;
		return $return;
		
		
?>