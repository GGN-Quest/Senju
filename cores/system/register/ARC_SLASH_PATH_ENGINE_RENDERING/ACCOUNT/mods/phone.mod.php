<?php

/*
	Copyright GOBOU Y. Yannick
	
*/
namespace GGN\DPO;


	global $GLANG;





if(isset($this->USER) && is_array($this->USER)){





	// $identity = \GUSERS::identity($this->USER['UKEY']);




	$phones = [];





	if(isset($this->USER['PHONE']) && is_string($this->USER['PHONE']) && !\Gougnon::isEmpty( $this->USER['PHONE'] )){

		$phones = explode(',', $this->USER['PHONE']);

	}







	$tpl->head->script($tpl->_url . 'account.phone.js?style=' . $tpl->style);



	$Form = (new Theme\Tag([

		'tag'=>'form'

		,'action'=>'#'

		,'method'=>'POST'

		,'name'=>'accountPhonesForm'

		,'onsubmit'=>"return false;"

	]));





	


	$BlocName = (new Theme\Tag([

		'class'=>'padding-x16 margin-t-x16'

		,'id'=>'bloc-fields'

	]))

		->text('<div class="h3 no-ff margin-tb-x12 text-thin">Vos contacts téléphonique</div>')


		->text('<div class="gui box info text-x14 padding-tb-x12 padding-lr-x16 box-rounded">Veuillez entrer vos numéros mobile que vous souhaitez associer à votre compte.</div>')



		// ->text('<div class="field-input xl styled gui box-rounded gui flex row center box-shadow-light" id="account-identity-lastname-field"><span class="gui icon iconx" title="Minimum : 2  Maximun : 32">phone</span><input type="text" name="lastname" placeholder="Prénom" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#account-identity-lastname-field,#account-identity-lastname-info" focus-class="focus,enable" required pattern=".{2,32}" maxlength="32" value=""></div>')

		// ->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="account-identity-lastname-info">Minimum : 2, Maximun : 32 Caratères</div>')


	;




	foreach ($phones as $pkey => $phone) {

		$i = (new Theme\Tag([

			'class'=>'field-input xl styled gui box-rounded gui flex row center box-shadow-light'

			,'id'=>'account-identity-phone-' . $pkey . '-field'

		]))

			->text('<span class="gui icon iconx" >phone</span><input type="text" name="phone_' . $pkey . '" placeholder="Numéro" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#account-identity-phone-' . $pkey . '-field" focus-class="focus,enable" value="' . $phone . '"><span class="gui icon iconx cursor-pointer" onclick="this.parentNode.remove();">close</span>')

		;


		$BlocName->node->{'item_' . $pkey} = $i;
		
	}




	$Form->node->BlocName = $BlocName;














	$BlocAdd = (new Theme\Tag([

		'class'=>'padding-x4 margin-t-x4'

	]))

		// ->text('<div class="h3 no-ff margin-tb-x12 text-thin"></div>')

		->text('<input type="button" class="button text-x16" value="Ajouter un nouveau numéro" id="add-field">')

	;



	$tpl->body->js('(function(add, flds, f){');
	
		$tpl->body->js('if(isObj(add)){');
		
			$tpl->body->js('add.on("click", function(){');


				$tpl->body->js('var els = f.elements, k = els.length||0, id = "account-identity-phone-";');

				$tpl->body->js('id += k;');

				$tpl->body->js('id += "-field";');


				$tpl->body->js('var i = flds.create({id:id, cn:"field-input xl styled gui box-rounded gui flex row center box-shadow-light"});');


				$tpl->body->js('var ct = \'<span class="gui icon iconx" >phone</span><input type="text" name="phone_\';');

					$tpl->body->js('ct += k;');

					$tpl->body->js('ct += \'" placeholder="Numéro" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#account-identity-phone-\';');

					$tpl->body->js('ct += k;');

					$tpl->body->js('ct += \'-field" \';');

					$tpl->body->js('ct += \' focus-class="focus,enable" value="" required>\';');


					$tpl->body->js('i.html(ct);');



			$tpl->body->js('});');

		$tpl->body->js('}');

	$tpl->body->js('})(G("#add-field"), G("#bloc-fields") , document.accountPhonesForm );');



	$Form->node->BlocAdd = $BlocAdd;

















	$BlocSubmit = (new Theme\Tag([

		'class'=>'padding-x4 margin-t-x4'

	]))

		// ->text('<div class="h3 no-ff margin-tb-x12 text-thin"></div>')

		->text('<input type="submit" class="button active text-x16" value="Enregistrer">')


	;



	$Form->node->BlocSubmit = $BlocSubmit;











	$tpl->body->sheet->node->container->node->ModContainer->node->Form = $Form;


}
