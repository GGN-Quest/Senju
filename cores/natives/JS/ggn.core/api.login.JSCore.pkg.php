/* GougnonJS.Login, version : 0.1, update : 141030#1611, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){
		alert('La version de GougnonJS n\'est pas compatible avec Login 0.1 ');
		return false;
	}



	API=G.API({
		name:'Login'
		,static:{
			version:'0.1'
			,events:'submit wait done success load loadend fail error'
			,varsinit:'host redirect user pass'
			,getter:{version:'0.1'
				,rp:'resetUserPassword?send'
				,rpf:'resetUserPasswordFactory?made'
				,session:'activeUserSession?activate'
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

		o.form=o.hote.element;
		G.foreach(events,function(v){var _n='on';_n+=v.ucfirst();o[_n]=o[_n]||o.cfg[v]||G.F();});
		G(varsinit).foreach(function(v){o[v]=o[v]||o.cfg[v]||false;});
		o.host=(typeof o.host=='string')?o.host: '<?php echo HTTP_HOST; ?>';

		o.URLSession=o.host;
		o.URLSession+=o.static.getter.session;

		o.form.action=o.URLSession;
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



		o.hote.submit(function(){

			o.event.detect('submit',[o]);
			if(typeof o.onSubmit=='function'){o.onSubmit();}

			$errorDetect=true;

			G(['username','password']).foreach(function(n){
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


			});
			


			if($errorDetect===false){return false;}

			o.ajax=GAjax({URI:o.URLSession,crossDomaine:false,mode:'POST'}).XHR();
				
			if(o.ajax==false){
				o.event.detect('error',[o,'-ajax.object.failed']);
				if(typeof o.onError=='function'){o.onError('-ajax.failed');}
				return false;
			}

			if(o.ajax!=false){
				o.event.detect('wait',[o]);
				if(typeof o.onWait=='function'){o.onWait();}

				o.ajax.onSuccess=function(ev){ var res=this.xhr.responseText.lower().trim().split(':'),r=res[0]||false,at=res[1]||false;

					alert(this.xhr.responseText);

					if(r=='-user.found'){
						o.userLevel=at;
						o.event.detect('success',[o,ev]);
						if(typeof o.onSuccess=='function'){o.onSuccess(ev);}
					}
					else{
						o.event.detect('error',[o,r,ev]);
						if(typeof o.onError=='function'){o.onError(r,ev);}
					}

				};

				o.ajax.onFail=function(ev){
					o.event.detect('fail',[o,ev]);
					if(typeof o.onFail=='function'){o.onFail(ev);}
				};

				o.ajax.onLoad=function(ev){
					o.event.detect('load',[o,ev]);
					if(typeof o.onLoad=='function'){o.onLoad(ev);}
				};

				o.ajax.onLoadend=function(ev){
					o.event.detect('loadend',[o,ev]);
					if(typeof o.onLoadend=='function'){o.onLoadend(ev);}
				};

				o.ajax.onError=function(ev){
					var r='-ajax.error';
					o.event.detect('error',[o,r,ev]);
					if(typeof o.onError=='function'){o.onError(r,ev);}
				};

				o.username=this.username||false;
				o.password=this.password||false;

				o.ajax.data=o.hote.stringToSend();

				o.ajax.send();
			}

			return false;
		});

		return o;
	});
	
	




	API.dynamic('resetPassword', function(){var o=this;
		if(typeof o.hote!='object'){return false;}
		o.form=o.hote.element;


		o.host=(typeof o.host=='string')?o.host: '<?php echo HTTP_HOST; ?>';
		o.URLRP=o.host;
		o.URLRP+=o.static.getter.rp;



		o.hote.submit(function(){var f=this;

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




			o.ajax=GAjax({URI:o.URLRP,crossDomaine:false,mode:'POST'}).XHR();
				
			if(o.ajax==false){
				o.event.detect('error',[o,'-ajax.object.failed']);
				if(typeof o.onError=='function'){o.onError('-ajax.failed');}
				return false;
			}

			if(o.ajax!=false){
				o.event.detect('wait',[o]);
				if(typeof o.onWait=='function'){o.onWait();}

				o.ajax.onSuccess=function(ev){var res=this.xhr.responseText.lower().trim().split(':'),r=res[0]||false,at=res[1]||false;
					
					// alert(res);

					if(r=='-request.password.success'){
						o.userLevel=at;
						o.event.detect('success',[o,ev]);
						if(typeof o.onSuccess=='function'){o.onSuccess(ev);}
					}
					else{
						o.event.detect('error',[o,r,ev]);
						if(typeof o.onError=='function'){o.onError(r,ev);}
					}

				};

				o.ajax.onFail=function(ev){
					o.event.detect('fail',[o,ev]);
					if(typeof o.onFail=='function'){o.onFail(ev);}
				};

				o.ajax.onLoad=function(ev){
					o.event.detect('load',[o,ev]);
					if(typeof o.onLoad=='function'){o.onLoad(ev);}
				};

				o.ajax.onLoadend=function(ev){
					o.event.detect('loadend',[o,ev]);
					if(typeof o.onLoadend=='function'){o.onLoadend(ev);}
				};

				o.ajax.onError=function(ev){
					var r='-ajax.error';
					o.event.detect('error',[o,r,ev]);
					if(typeof o.onError=='function'){o.onError(r,ev);}
				};

				o.username=this.username||false;
				o.password=this.password||false;

				o.ajax.data=o.hote.stringToSend();

				o.ajax.send();
			}


			return false;
		});



		return o;
	});






	API.dynamic('resetPasswordFactory', function(cfg){var o=this;
		if(typeof o.hote!='object'){return false;}
		o.form=o.hote.element;


		o.host=(typeof o.host=='string')?o.host: '<?php echo HTTP_HOST; ?>';
		o.URLRPF=o.host;
		o.URLRPF+=o.static.getter.rpf;
		o.cfg = arguments[0]||false;


		o.hote.submit(function(){var f=this;

			o.event.detect('submit',[o]);
			if(typeof o['onSubmit']=='function'){o.onSubmit();}
			if(typeof o['cfg']!='object'){GToast('Variable de configuration introuvable').bubble();return false;}

			o.resetPassword = f.reset_password||false;
			o.resetPasswordConfirm = f.reset_password_confirm||false;
			$errorDetect = true;


			G(['resetPassword','resetPasswordConfirm']).foreach(function(n){

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


			});
			
			
			if($errorDetect===false){return false;}
			
			if(o.resetPassword.value!=o.resetPasswordConfirm.value){
				o.event.detect('error',[o,o.static.error['resetPassword'].confirmFailed]);
				if(typeof o.onError=='function'){o.onError(o.static.error['resetPassword'].confirmFailed);}
				return false;
			}


			o.ajax=GAjax({URI:o.URLRPF,crossDomaine:false,mode:'POST'}).XHR();
				
			if(o.ajax==false){
				o.event.detect('error',[o,'-ajax.object.failed']);
				if(typeof o.onError=='function'){o.onError('-ajax.failed');}
				return false;
			}

			if(o.ajax!=false){
				o.event.detect('wait',[o]);
				if(typeof o.onWait=='function'){o.onWait();}

				o.ajax.onSuccess=function(ev){ var res=this.xhr.responseText.lower().trim().split(':'),r=res[0]||false,at=res[1]||false;

					alert(res);

					if(r=='-password.reset.success'){
						o.userLevel=at;
						o.event.detect('success',[o,ev]);
						if(typeof o.onSuccess=='function'){o.onSuccess(ev);}
					}
					else{
						o.event.detect('error',[o,r,ev]);
						if(typeof o.onError=='function'){o.onError(r,ev);}
					}

				};

				o.ajax.onFail=function(ev){
					o.event.detect('fail',[o,ev]);
					if(typeof o.onFail=='function'){o.onFail(ev);}
				};

				o.ajax.onLoad=function(ev){
					o.event.detect('load',[o,ev]);
					if(typeof o.onLoad=='function'){o.onLoad(ev);}
				};

				o.ajax.onLoadend=function(ev){
					o.event.detect('loadend',[o,ev]);
					if(typeof o.onLoadend=='function'){o.onLoadend(ev);}
				};

				o.ajax.onError=function(ev){
					var r='-ajax.error';
					o.event.detect('error',[o,r,ev]);
					if(typeof o.onError=='function'){o.onError(r,ev);}
				};

				o.username=this.username||false;
				o.password=this.password||false;

				o.ajax.data=o.hote.stringToSend();

				o.ajax.send();
			}


			return false;
		});



		return o;
	});





})(window,screen,navigator);