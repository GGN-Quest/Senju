<?php
	
	namespace GGN\DPO;
	

	$return = [

		 'template' => function($Content = false){


			$brick = new Theme\Tag([

				'tag'=>'section'

				,'class'=>'section-full-container gui flex'

			]);


			if(!is_bool($Content)){

				$brick->node->Content = $Content;

			}


			return $brick;

		}

	];



?>