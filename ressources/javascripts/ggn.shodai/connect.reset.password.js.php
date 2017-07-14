/* G.Login Suite for Thème, Copyright GOBOU Y. Yannick 2014 */<?php global $_Gougnon; ?>

var GLoginResetPasswordSuite=function(Lgn){


	if(typeof Lgn!=='object'){
		GToast('Erreur Variable Système introuvable').bubble();
		return false;
	}

	var sheet=G('body')
		,waitBox=G('#login-reset-password-wait-box')
		,submitBox=G('#login-reset-password-submit-box')
		// ,response=G('body').createElement({id:['Gougnon','Login-Reset-Password','Responses','pad'].join('--'),tag:'div'})
		,responses=function(txt){
			Lgn.waitOut();
			Lgn.unlockElements();
			Lgn.LSh.message('<?php echo _GGN::varn("SITENAME"); ?>',['<div class="alert-mini">',txt,'</div>'].join('') );
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
		,prev=true
		,next=false
		,redir=false;

		var h0 = ''
			,p=((prev!==false)?{label:'Allez à l\'accueil',click:function(){ GDocument().href("<?php echo HTTP_HOST; ?>"); }}:false)
			,n=((next!==false)?{label:'Continuer',click:function(){GDocument().href(next.value); }}:false)
			;

			h0+='<div class="alert-mini">Nous vous avons envoyé un message à votre adresse mail pour compléter votre demande de reinitialisation de mot de passe</div>';

			Lgn.LSh.message('<?php echo _GGN::varn("SITENAME"); ?>',h0,{
				prev:p
				,redir:{label:'Connectez-vous à votre email',click:function(){
					var s=false;
					if((function(){
						if(typeof o['email']!='object'){return false;}
						if(typeof o.email['value']!='string'){return false;}
						s = o.email.value.split("@");

						if(typeof s[1]!='string'){return false;}

						return true;
					})()){
						GDocument().href(["http://", s[1]].join(''));
					}
					else{GDocument().href("<?php echo HTTP_HOST; ?>"); }


				}, focus:true }
				,next:n
			});

	};

	/* Détection : Erreur */
	Lgn.onError=function(id){
		var o=this,$id=id.trim()
		,txt=false;


		try{

			G.foreach(['email'], function(v,n){
				if(txt!==false){return false;}
				var err=GLogin.error[v]||false,ns=v.substr(0,4);

				if(typeof err=='object'){
					if($id==err.objectFailed){txt=['Impossible de retrouver l\'object de l\'adresse mail.'].join('');return false;}
					if($id==err.empty){txt=['L\'adresse mail ne doit pas être vide.'].join('');}
					if($id==err.failed){txt=['L\'adresse mail n\'est pas valide.'].join('');}
				}
				else{
					txt='Erreur : variable "ERROR" introuvable';
				}


			});

			if($id=='attempt.rup.request.mail.param.not.found'){
				txt='Paramaètre de l\'encoie de mail manaquants';
			}

			if($id=='attempt.rup.request.mail.send.failed'){
				txt='Echec lors de l\'envoie du message de reinitialisation à votre email';
			}

			if($id=='attempt.rup.request.session.create.failed'){
				txt='Impossible de crée la session';
			}

			if($id=='attempt.rup.session.failed'){
				txt='Echec de la session';
			}

			if($id=='attempt.rup.request.session.create.param.not.found'){
				txt='Paramètre de création de la session manaquants';
			}

			if($id=='attempt.email.undefined'){
				txt='email non definie';
			}

			if($id=='attempt.email.not.found'){
				txt='Impossible de retrouver cette adresse mail';
			}

			if($id=='-data.unavailable'){
				txt='Les informations que vous avez postées sont invalides';
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




