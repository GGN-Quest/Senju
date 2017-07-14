/* G.Login Suite for Thème, Copyright GOBOU Y. Yannick 2014 */<?php global $_Gougnon; ?>

var GLoginResetPasswordFactorySuite=function(Lgn){



	if(typeof Lgn!=='object'){
		GToast('Erreur Variable Système introuvable').bubble();
		return false;
	}

	var sheet=G('body')
		,waitBox=G('#login-reset-password-wait-box')
		,submitBox=G('#login-reset-password-submit-box')
		,response=G(G.DOC.body).createElement({id:['Gougnon','Login-Reset-Password','Responses','pad'].join('--'),tag:'div'})
		,responses=function(txt){
			Lgn.waitOut();Lgn.unlockElements();Lgn.LSh.message('<?php echo _GGN::varn("SITENAME"); ?>',['<div class="alert-mini">',txt,'</div>'].join('') );
		};

	Lgn.LSh=GAwakeConfirm(
		'Confirm.Box'
		,{
			hote:sheet
			,locked:true
			,width:480
			,height:256
		}
	);

	Lgn.lockElements=function(){var o=this,a=arguments,els=o.form.elements;
		G(els).foreach(function(v){
			if(typeof v!='object'){return false;}
			v.setAttribute('disabled','true');
		});
	};

	Lgn.unlockElements=function(){var o=this,a=arguments,els=o.form.elements;
		G(els).foreach(function(v){
			if(typeof v!='object'){return false;}
			v.removeAttribute('disabled');
		});
	};

	/* Détection : Submit */
	Lgn.onSubmit=function(){var o=this;
		o.lockElements();

	};

	/* Wait */
	Lgn.waitIn=function(){
		submitBox.css({display:'none'});
		waitBox.css({display:'block'});
	};

	Lgn.waitOut=function(){
		submitBox.css({display:'block'});
		waitBox.css({display:'none'});
	};

	/* Détection : Wait */
	Lgn.onWait=function(){
		this.waitIn();
	};

	/* Détection : URL Fail */
	Lgn.onFail=function(){
		responses('Impossible d\'atteindre la page de traitement');
	};

	/* Détection : USER success */
	Lgn.onSuccess=function(){var o=this,h=''
		,prev=false
		,next=false
		,redir=false;

		var h0 = ''
			,p=false ,n=false
			;

			h0+='<div class="alert-mini">Votre mot de passe a bien été mit à jour.<br>Vous pouvez vous connecter avec votre nouveau mot de passe.</div>';

			Lgn.LSh.message('<?php echo _GGN::varn("SITENAME"); ?>',h0,{
				prev:p
				,redir:{label:'Se connecter',click:function(){
					
					GDocument().href("<?php echo _GGN::setvar(_GGN::varn('LOGIN_PAGE')); ?>?new:password:factor");

				}, focus:true }
				,next:n
			});

	};

	/* Détection : Erreur */
	Lgn.onError=function(id){
		var o=this,$id=id.trim()
		,txt=false;
		

		try{

			G.foreach(['resetPassword', 'resetPasswordConfirm'], function(v,n){
				if(txt!==false){return false;}
				var err=GLogin.error[v]||false;

				if(typeof err=='object'){
					if($id==err.objectFailed){txt=['Impossible de retrouver l\'object de l\'adresse mail.'].join('');return false;}
					if($id==err.empty){txt=['Le mot de passe ne doit pas être vide.'].join('');}
					if($id==err.failed){txt=['Le mot de passe n\'est pas valide.'].join('');}
					if($id==err.confirmFailed){txt=['Les deux mots de passe proposé ne sont pas identiques.'].join('');}
					if($id==err.min){var mn=o.cfg.min;
						txt=['Le ',(o.cfg.label||'').lower(),' doit compter au miminum '].join(''); txt+=mn; txt+=' caractère'; txt+=(mn>1)?'s':'';
						return false;
					}
					if($id==err.max){var mn=o.cfg.max;
						txt=['Le ',(o.cfg.label||'').lower(),' doit compter au miminum '].join(''); txt+=mn; txt+=' caractère'; txt+=(mn>1)?'s':'';
						return false;
					}
				}
				else{
					txt='Erreur : variable "ERROR" introuvable';
				}


			});

			if($id=='attempt.failed'){
				txt='Echec lors de la réinitialisation du mot de passe';
			}

			if($id=='attempt.email.undefined' || $id=='attempt.codex.undefined' || $id=='attempt.password.undefined' || $id=='attempt.password.confirm.undefined'){
				txt='Paramètres manquant';
			}


			if($id=='attempt.password.failed'){
				txt='Les informations que vous avez postées sont invalides';
			}

			if($id=='attempt.request.unavailable'){
				txt='Demande de reinitialisation de mot de passe erronée';
			}

			if($id=='attempt.user.missing'){
				txt='Utilisateur introuvable';
			}

			if($id=='attempt.user.unavailable'){
				txt='Utilisateur non valide';
			}

			if($id=='-ajax.object.failed'){
				txt='Votre navigateur ne support pas XHR';
			}

			if($id=='-ajax.error'){
				txt='Votre navigateur ne support pas XHR';
			}

			responses((txt===false)?'Erreur un problème est survenu lors de la tentative de connexion':txt);

		}catch(e){

			GToast(['Erreur JS Détecté lors du traitement : ', e.message].join('')).bubble();
		}


	};

	
};




