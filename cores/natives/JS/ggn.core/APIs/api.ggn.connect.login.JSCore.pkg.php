/* GougnonJS.Login, version : 0.1, update : 141030#1611, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){
		GToast('La version de GougnonJS n\'est pas compatible avec GGN Connect Login 0.1 ').bubble();
		return false;
	}


	API=G.API({
		name:'Login'
		,static:{
			version:'0.1'
			,events:'submit wait done success load loadend fail error'
			,varsinit:'host redirect user pass'
			,services:{
				name:'ggn.connect'
				,title:'GGN Connect'
				,object:false
				,login:{name:'login',handler:false,submit:G.F()}
				,resetPassword:{name:'reset.password',handler:false,submit:G.F()}
				,resetPasswordFactory:{name:'reset.password.factory',handler:false,submit:G.F()}
				,instance:function(){return this.object||G.COM.Service(this.name).Init({Title:this.title});}
				,statement:function(o,so,su){

					so.handler=this.instance();
					so.handler.Open(so.name,{
						data:[o.hote.strToSend(), '&action=login'].join('')
						,wait:function(gjx){
							o.event.detect('wait',[o,gjx]);
							if(typeof o.onWait=='function'){o.onWait(gjx);}
						}
						,success:function(obj,ev){var res=(obj.response||'').lower(),r='';
							if(res==su){
								o.event.detect('success',[o,ev]);
								if(typeof o.onSuccess=='function'){o.onSuccess(ev);}
								return false;
							}
							
							else{
								if(res=='attempt.failed'){
									r=(obj.because||false)?((isString(obj.because.response||false))?obj.because.response:res):res;
								}
								else{
									r=res;
								}
							}


							o.event.detect('error',[o,r,ev]);
							if(typeof o.onError=='function'){o.onError(r,ev);}

						}
						,fail:function(ev){
							o.event.detect('fail',[o,ev]);
							if(typeof o.onFail=='function'){o.onFail(ev);}
						}
						,load:function(ev){
							o.event.detect('load',[o,ev]);
							if(typeof o.onLoad=='function'){o.onLoad(ev);}
						}
						,loadend:function(ev){
							o.event.detect('loadend',[o,ev]);
							if(typeof o.onLoadend=='function'){o.onLoadend(ev);}
						}
						,error:function(ev){var r='-ajax.error';
							o.event.detect('error',[o,r,ev]);
							if(typeof o.onError=='function'){o.onError(r,ev);}
						}

					});

				}
			}

			,error:{version:'0.1'
				,username:{version:'0.1'
					,objectFailed:'-username.object.failed'
					,empty:'-username.empty'
					,min:'-username.length.min.failed'
					,max:'-username.length.max.failed'
				}
				,password:{version:'0.1'
					,objectFailed:'-password.object.failed'
					,empty:'-password.empty'
					,min:'-password.length.min.failed'
					,max:'-password.length.max.failed'
				}
				,email:{version:'0.1'
					,objectFailed:'-email.object.failed'
					,failed:'-email.failed'
					,empty:'-email.empty'
					,min:'-email.length.min.failed'
					,max:'-email.length.max.failed'
				}
				,resetPassword:{version:'0.1'
					,objectFailed:'-reset.password.object.failed'
					,failed:'-reset.password.failed'
					,empty:'-reset.password.empty'
					,min:'-reset.password.length.min.failed'
					,max:'-reset.password.length.max.failed'
					,confirmFailed:'-reset.password.confirm.failed'
				}
				,resetPasswordConfirm:{version:'0.1'
					,objectFailed:'-reset.password.confirm.object.failed'
					,failed:'-reset.password.confirm.failed'
					,empty:'-reset.password.confirm.empty'
					,min:'-reset.password.confirm.length.min.failed'
					,max:'-reset.password.confirm.length.max.failed'
				}
			}
		}
		,constructor:function(){
			var o=this;
			o.static=G.Login;
			o.args=arguments[0]||[];
			o.instance=o.args[0]||false;
			o.hote=G(o.instance)||false;
			o.event=G.Event(o);
			o.callBack={};
			o.username='';
			o.password='';
		}
	}).create();


	API.dynamic('setup', function(){var o=this;
		if(typeof o.hote!='object'){return false;}
		var varsinit=o.static.varsinit.split(' '),events=o.static.events.split(' ');
		o.cfg=arguments[0]||{};

		o.form=o.hote;
		G.foreach(events,function(v){var _n='on';_n+=v.ucfirst();o[_n]=o[_n]||o.cfg[v]||G.F();},false,false,'.');
		G.foreach(varsinit,function(v){o[v]=o[v]||o.cfg[v]||false;},false,false,'.');
		o.host=(typeof o.host=='string')?o.host: '<?php echo HTTP_HOST; ?>';

		o.username=o.form.username;
		o.password=o.form.password;
		o.remember=(typeof o.form.remember=='object')?o.form.remember:false;
		o.next=(typeof o.form.next=='object')?o.form.next:false;
		o.previous=(typeof o.form.previous=='object')?o.form.previous:false;
		o.redirectName=(typeof o.form.redirectName=='object')?o.form.redirectName:false;
		o.redirectURL=(typeof o.form.redirectURL=='object')?o.form.redirectURL:false;

		o.callBack.username=o.username.value;
		o.callBack.password=o.password.value;
		o.callBack.next=(typeof o.next=='object')?o.next.value:false;
		o.callBack.previous=(typeof o.previous=='object')?o.previous.value:false;
		o.callBack.redirectName=(typeof o.redirectName=='object')?o.redirectName.value:false;
		o.callBack.redirectURL=(typeof o.redirectURL=='object')?o.redirectURL.value:false;


		if(typeof o.username=='object'){
			if(o.username.type=='text'){
				o.username.focus();
			}
			if(o.username.type=='hidden'&&o.password.type=='password'){
				o.password.focus();
			}
			
			if(typeof o.username.value=='string'){
				if(!o.username.value.empty()){o.password.focus();}
			}

		}


		o.hote.on('submit',function(){

			o.event.detect('submit',[o]);

			if(typeof o.onSubmit=='function'){o.onSubmit();}

			$errorDetect=true;

			G.foreach(['username','password'],function(n){
				var ns=n.substr(0,4);

				if($errorDetect===false){return false;}

				if(typeof o[n]!='object'){
					o.event.detect('error',[o,o.static.error[n].objectFailed]);
					if(typeof o.onError=='function'){o.onError(o.static.error[n].objectFailed);}
					$errorDetect=false;
					return $errorDetect;
				}
				if(typeof o[n]=='object'){
					if(o[n].value.empty()){
						o.event.detect('error',[o,o.static.error[n].empty]);
						if(typeof o.onError=='function'){o.onError(o.static.error[n].empty);}
						$errorDetect=false;
						return $errorDetect;
					}
				}

				if(typeof o[ns]=='object'){
					if(typeof (o[ns].min*1)=='number'){
						o[ns].min*=1;
						if(o[n].value.length<o[ns].min){
							o.event.detect('error',[o,o.static.error[n].min]);
							if(typeof o.onError=='function'){o.onError(o.static.error[n].min);}
							$errorDetect=false;
							return $errorDetect;
						}
					}
					
					if(typeof (o[ns].max*1)=='number'){
						o[ns].max*=1;
						if(o[n].value.length>o[ns].max){
							o.event.detect('error',[o,o.static.error[n].max]);
							if(typeof o.onError=='function'){o.onError(o.static.error[n].max);}
							$errorDetect=false;
							return $errorDetect;
						}
					}
				}

			},false,false,'.');
			
			if($errorDetect===false){return false;}

			var isub = isFunction(o.static.services.login.submit||'');
			if(isub){o.static.services.login.submit(o); }
			if(!isub){GToast('Veuillez patienter un instant...').bubble(); }

			return false;
		});

		return o;
	});
	
	




	API.dynamic('resetPassword', function(){var o=this;
		if(typeof o.hote!='object'){return false;}
		o.form=o.hote.element;

		o.host=(typeof o.host=='string')?o.host: '<?php echo HTTP_HOST; ?>';

		o.hote.on('submit',function(){var f=this;

			o.event.detect('submit',[o]);
			if(typeof o['onSubmit']=='function'){o.onSubmit();}

			o.email = f.email||false;

			if(typeof o['email']!='object'){ 
				o.event.detect('error',[o,o.static.error['email'].objectFailed]);
				if(typeof o.onError=='function'){o.onError(o.static.error['email'].objectFailed);}
				return false;
			}
				
			if(o['email'].value.empty()){
				o.event.detect('error',[o,o.static.error['email'].empty]);
				if(typeof o.onError=='function'){o.onError(o.static.error['email'].empty);}
				return false;
			}
			
			if(!o.email.value.email()){
				o.event.detect('error',[o,o.static.error['email'].empty]);
				if(typeof o.onError=='function'){o.onError(o.static.error['email'].failed);}
				return false;
			}

			var isub = isFunction(o.static.services.resetPassword.submit||'');
			if(isub){o.static.services.resetPassword.submit(o); }
			if(!isub){GToast('Veuillez patienter un instant...').bubble(); }


			return false;
		});



		return o;
	});






	API.dynamic('resetPasswordFactory', function(cfg){var o=this;
		if(typeof o.hote!='object'){return false;}
		o.form=o.hote.element;


		o.host=(typeof o.host=='string')?o.host: '<?php echo HTTP_HOST; ?>';
		o.cfg = arguments[0]||false;


		o.hote.on('submit',function(){var f=this;

			o.event.detect('submit',[o]);
			if(typeof o['onSubmit']=='function'){o.onSubmit();}
			if(typeof o['cfg']!='object'){GToast('Variable de configuration introuvable').bubble();return false;}

			o.resetPassword = f.reset_password||false;
			o.resetPasswordConfirm = f.reset_password_confirm||false;
			$errorDetect = true;


			G.foreach(['resetPassword','resetPasswordConfirm'],function(n){

				if($errorDetect===false){return false;}

				if(typeof o[n]!='object'){
					o.event.detect('error',[o,o.static.error[n].objectFailed]);
					if(typeof o.onError=='function'){o.onError(o.static.error[n].objectFailed);}
					$errorDetect=false;
					return $errorDetect;
				}
				if(typeof o[n]=='object'){
					if(o[n].value.empty()){
						o.event.detect('error',[o,o.static.error[n].empty]);
						if(typeof o.onError=='function'){o.onError(o.static.error[n].empty);}
						$errorDetect=false;
						return $errorDetect;
					}
				}

				if(typeof o.cfg=='object'){
					if(typeof (o.cfg.min*1)=='number'){
						o.cfg.min*=1;
						if(o[n].value.length<o.cfg.min){
							o.event.detect('error',[o,o.static.error[n].min]);
							if(typeof o.onError=='function'){o.onError(o.static.error[n].min);}
							$errorDetect=false;
							return $errorDetect;
						}
					}
					if(typeof (o.cfg.max*1)=='number'){
						o.cfg.max*=1;
						if(o[n].value.length>o.cfg.max){
							o.event.detect('error',[o,o.static.error[n].max]);
							if(typeof o.onError=='function'){o.onError(o.static.error[n].max);}
							$errorDetect=false;
							return $errorDetect;
						}
					}
				}


			},false,false,'.');
			
			
			if($errorDetect===false){return false;}
			
			if(o.resetPassword.value!=o.resetPasswordConfirm.value){
				o.event.detect('error',[o,o.static.error['resetPassword'].confirmFailed]);
				if(typeof o.onError=='function'){o.onError(o.static.error['resetPassword'].confirmFailed);}
				return false;
			}


			var isub = isFunction(o.static.services.resetPasswordFactory.submit||'');
			if(isub){o.static.services.resetPasswordFactory.submit(o); }
			if(!isub){GToast('Veuillez patienter un instant...').bubble(); }


			return false;
		});



		return o;
	});



GScript.check("GCOMService", function(){

	G.Login.services.login.submit = function(o){
		G.Login.services.statement(o, this, 'login.success');
	};

	G.Login.services.resetPassword.submit = function(o){
		G.Login.services.statement(o, this, 'reset.query.success');
	};
	
	G.Login.services.resetPasswordFactory.submit = function(o){
		G.Login.services.statement(o, this, 'reset.success');
	};


});


})(window,screen,navigator);