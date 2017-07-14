<?php

/*
	Copyright GOBOU Y. Yannick
	
*/
namespace GGN\DPO;


	global $GLANG;





if(isset($this->USER) && is_array($this->USER)){






	$tpl->head->script($tpl->_url . 'account.password.js?style=' . $tpl->style);



	$Form = (new Theme\Tag([

		'tag'=>'form'

		,'action'=>'#'

		,'method'=>'POST'

		,'name'=>'accountPasswordForm'

		,'onsubmit'=>"return false;"

	]));





	


	$BlocName = (new Theme\Tag([

		'class'=>'padding-x16 margin-t-x16'

	]))

		->text('<div class="h3 no-ff margin-tb-x12 text-thin">Changer de mot de passe</div>')



		->text('<div class="field-input xl styled gui box-rounded gui flex row center box-shadow-black" id="account-password-old-field"><span class="gui icon key" title="Minimum : 2  Maximun : 32"></span><input type="password" name="old" placeholder="Ancien mot de passe" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#account-password-old-field,#account-password-old-info" focus-class="focus,enable" required pattern=".{8,32}" maxlength="32" ></div>')

		->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="account-password-old-info">Minimum : 8, Maximun : 32 Caratères</div>')



		->text('<div class="field-input xl styled gui box-rounded gui flex row center box-shadow-black" id="account-password-new-field"><span class="gui icon key" title="Minimum : 2  Maximun : 32"></span><input type="password" name="new" placeholder="Nouveau mot de passe" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#account-password-new-field,#account-password-new-info" focus-class="focus,enable" required pattern=".{8,32}" maxlength="32" ></div>')

		->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="account-password-new-info">Minimum : 8, Maximun : 32 Caratères</div>')



		->text('<div class="field-input xl styled gui box-rounded gui flex row center box-shadow-black" id="account-password-confirm-field"><span class="gui icon key" title="Minimum : 2  Maximun : 32"></span><input type="password" name="confirm" placeholder="Confirmer votre nouveau mot de passe" ggn-handler-focus="Gabarit.Input.Focus" gabarit-focus="#account-password-confirm-field,#account-password-confirm-info" focus-class="focus,enable" required pattern=".{8,32}" maxlength="32" ></div>')

		->text('<div class="gui box info text-x12 padding-x12 box-rounded disable" id="account-password-confirm-info">Minimum : 8, Maximun : 32 Caratères</div>')


	;



	$Form->node->BlocName = $BlocName;














	$BlocSubmit = (new Theme\Tag([

		'class'=>'padding-x16 margin-t-x16'

	]))

		->text('<div class="h3 no-ff margin-tb-x12 text-thin"></div>')

		// ->text('<button class="active button text-x16"><span class="gui icon save x16 margin-r-x8"></span> Enregistrer</button>')

		->text('<input type="submit" class="button active text-x16" value="Enregistrer">')


	;



	$Form->node->BlocSubmit = $BlocSubmit;











	$tpl->body->sheet->node->container->node->ModContainer->node->Form = $Form;


}
