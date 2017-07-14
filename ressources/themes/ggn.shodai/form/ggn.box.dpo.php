<?php
	
	namespace GGN\DPO;
	

	$return = [


		'template' => function($form = [], $title = false, $inputs = false){

			$form = (is_array($form)) ? $form: [];

			$form['tag'] = 'form';

			$form['class'] = 'gui form box ' . ((isset($form['class']) && is_string($form['class'])) ? $form['class']: '');



			/* Brique */
			$brick = new Theme\Tag($form);


			
			/* Titre du box */
			if(is_string($title)){

				$brick->node->title = new Theme\Tag(['class'=>'title']);

				$brick->node->title->text($title);

			}


			/* Contenu */
			if(is_array($inputs)){

				$brick->node->container = new Theme\Tag(['class'=>'container']);

				// $brick->node->container->node->notice = new Theme\Tag(['class'=>'notification']);

				$brick->node->container->node->fields = new Theme\Tag(['class'=>'fields']);
				
				foreach ($inputs as $key => $element) {

					$field = new Theme\Tag(['class'=>'field']);


					if(isset($element['free.content']) && is_string($element['free.content'])){

						$field->text($element['free.content']);

					}

					$brick->node->container->node->fields->node->{$key} = $field;

					if(isset($element['label']) && is_string($element['label']) ){
						$label = new Theme\Tag(['tag'=>'label','class'=>'pre']);
						$label->text($element['label']);
						$brick->node->container->node->fields->node->{$key}->node->label = $label;
					}

					if(isset($element['input']) && is_array($element['input'])){
						$element['input']['tag'] = 'input';
						$iLabel = false;

						if(isset($element['input']['label']) ){
							$iLabel = (isset($element['input']['label'])) ? $element['input']['label']: false;
							unset($element['input']['label']);
						}

						$input = new Theme\Tag($element['input']);
						$brick->node->container->node->fields->node->{$key}->node->input = $input;


						if(is_string($iLabel)){

							$brick->node->container->node->fields->node->{$key}->text('<label class="sub">' . $iLabel . '</label>');
							
						}

					}


				}

			}



			return $brick;

		}


	];



?>