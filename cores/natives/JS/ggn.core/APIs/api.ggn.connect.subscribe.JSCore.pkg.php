<?php global $_Gougnon; ?> /* GougnonJS.Subscribe, version : 0.1, update : 140624#1153, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){
		alert('La version de GougnonJS n\'est pas compatible avec Subscribe 0.1 ');
		return false;
	}


	GScript.check("GCOMService", function(){

		API=G.API({
			name:'Subscribe'
			,static:{
				version:'0.1'
				,events:'submit wait done success load loadend fail error fieldError'
				,varsinit:'host redirect captcha captchaCtrl'
				,init:{version:'0.1'}
				,services:{
					name:'ggn.connect'
					,title:'GGN Connect Subscribe'
					,object:false
					,mod:'subscribe'
					,su:'subscribe.success'
					,instance:function(){return this.object||G.COMService(this.name).Init({Title:this.title});}
					,statement:function(o){
						
						var su = this.su;

						o.handler=this.instance();
						o.handler.Open(this.mod,{
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
										r=isObj(obj.because||false) ? (isStr(obj.because.response) ? obj.because.response : res ) : res;
									}
									else{
										r=res;
									}

									o.captchaRefresh();
								}


								o.On('error',[r,ev]);

							}
							,fail:function(ev){
								o.On('error',[ev]);
							}
							,load:function(ev){
								o.On('load',[ev]);
							}
							,loadend:function(ev){
								o.unlockElements();
								o.On('loadend',[ev]);
							}
							,error:function(ev){
								o.captchaRefresh();
								o.On('error',['ajax.error',ev]);
							}

						});

					}
				}
			}
			,constructor:function(){
				var o=this;
				o.STC=o.STATIC;
				o.instance=o.ARGS[0]||false;
				o.hote=G(o.instance)||false;
				o.event=G.Event(o);
				// o.callBack={};
				// o.validates={};
			}
		}).create();



		API.dynamic('fieldError', function(){var o=this;
			o.captchaRefresh();
			o.onFieldError();
			o.event.detect('fieldError',[o]);
		});




		// API.dynamic('errorManagerNoticeRemoveError', function(n){var o=this;
		// 	if(typeof o.elements[n]=='object'){
		// 		var e=G(o.elements[n]),ntc=G(['#notice',n].join('-'));
		// 		if(typeof e.removeClass=='function'){e.removeClass('error');}
		// 		if(typeof ntc=='object'){ntc.removeClass('error');}
		// 	}
		// });





		API.dynamic('CaptchaKey', 0);

		API.dynamic('captchaRefresh', function(){var o=this;

			var s=o.host;
				
				s+="captcha?name=";
				
				s+=o._captcha.name;
				
				s+="&textcolor=";
				
				s+=escape(o._captcha.textcolor);
				
				s+="&bgcolor=";
				
				s+=escape(o._captcha.bgcolor);
				
				s+="&refeshKey=";
				
				s+=o.CaptchaKey;

			o.captcha.src=s;

			o.captcha.replaceClass('disable','enable');

			GToast('<div class="gui iconx loading circle x16">sync</div>&nbsp;&nbsp;&nbsp;Rafraichissement du code de sécurité...').info();

			o.CaptchaKey++;

		});

		API.dynamic('initCaptcha', function(){var o=this;

			o._captcha = o._captcha||{};
			
			o._captcha.Ctrl = o.captchaCtrl||false;

			o._captcha.name = o.form.attrib('captcha-name')||'ggn.user.subscribe';
			
			o._captcha.textcolor = o.form.attrib('captcha-text-color')||'#ffffff';
			
			o._captcha.bgcolor = o.form.attrib('captcha-bg-color')||'#ff4800';

			if(isObj(o.captcha)){
			
				o.captchaRefresh();
			
			}

			if(isObj(o.captchaCtrl)){
			
				o.captchaCtrl.on('click', function(){
			
					o.captchaRefresh();
			
				});
			
			}

		});




		// API.dynamic('errorManagerNotice', function(n,txt){var o=this;

		// 	if(typeof o.elements[n]=='object'){
		// 		var e=G(o.elements[n]),ntc=G(['#notice',n].join('-'));
		// 		o.errorManagerNoticeRemoveError(n);
				

		// 		if(typeof e.addClass=='function'){
		// 			e.addClass('error');
		// 		}

		// 		if(typeof ntc=='object'){ntc.addClass('error');ntc.html(txt);}
		// 		if(typeof e.focus=='function'){
		// 			e.focus(function(){
		// 				o.errorManagerNoticeRemoveError(n);
		// 			});
		// 		}

		// 	}
		// });



		// API.dynamic('subscribeNotice', function(txt){var o=this,a=arguments,note=G([o.instance,'submit-notice'].join('-'))||false,cls=a[1]||false;
		// 	if(typeof note=='object'){
		// 		note.cn('notice');
		// 		if(typeof cls=='string'){note.addClass(cls);}
		// 		note.html(txt);
		// 	}
		// });



		API.dynamic('lockElements', function(){var o=this,a=arguments,els=o.elements;
			G.foreach(els,function(v){v.setAttribute('disabled','true');},false,false,{});
		});


		API.dynamic('unlockElements', function(){var o=this,a=arguments,els=o.elements;
			G.foreach(els,function(v){v.removeAttribute('disabled');},false,false,{});
		});



		API.dynamic('On', function(n,ar){var o=this,n0='on';
			n0+=(isStr(n)?n:'').ucfirst();
			if(isFunc(o[n0]||'')){o[n0](ar);}
			o.event.detect(n,ar);
		});




		API.dynamic('Setup', function(){var o=this;
			
			if(typeof o.hote!='object'){GToast("Impossible de retrouver le formulaire").bubble();return false;}

			o.elements=[];

			


			G.foreach(o.hote.elements, function(v){
				if(typeof v!='object'){return false;}
				if(typeof v['name']!='string'){return false;}
				if(typeof v['type']!='string'){return false;}
				o.elements[v.name] = v;
			});

			var varsinit=o.STC.varsinit.split(' '),events=o.STC.events.split(' ');
			o.cfg=arguments[0]||{};

			o.form=o.hote;
			
			G.foreach(events,function(v){var _n='on';_n+=v.ucfirst();o[_n]=o[_n]||o.cfg[v]||G.F();},false,false,'.');
			
			G.foreach(varsinit,function(v){o[v]=o[v]||o.cfg[v]||false;},false,false,'.');

			G.foreach(o.elements,function(v){
				var n=v.name,vt=v.type.toString().lower(),vn=v.tagName.lower();
				if(vt=='text'||vt=='password'){
					// v.onblur=function(){o.errorManager(this,n);};
				}
				else{
					if(vn=='select'){
						// v.onchange=function(){o.errorManagerNoticeRemoveError(n);o.errorManager(this,n);};
					}
				}
			},false,false,{});

			o.host=(typeof o.host=='string')?o.host: '<?php echo HTTP_HOST; ?>';

			o.initCaptcha();
			
			o.unlockElements();
			
			o.hote.on('submit',function(ev){var f=this,els=f.elements,ov=0,ovi=0;


				// G.foreach(els,function(v){
				// 	var n=v['name']||false,typ=v['type']||false,vald;

				// 	if(n!=false&&typ!=false){
				// 		// o.errorManager(v,n);
				// 		ov++;
	 		// 			vald=o.validates[n]||false;
				// 		if(vald===true){ovi++;}
				// 	}
					
				// },false,false,{});


				// if(ovi!=ov){
				// 	o.subscribeNotice('Formulaire incomplet','error');
				// 	return false;
				// }

				if(!els.username.value.isUserName()){
					o.On('error',['username.failed',ev]);
					return false;
				}

				if(els.password.value.isEmpty()){
					o.On('error',['pwd.empty',ev]);
					return false;
				}

				if(els.password.value!=els.password2.value){
					o.On('error',['pwd.confirm.failed',ev]);
					return false;
				}

				if(!els.email.value.isEmpty()){

					if(!els.email.value.isEmail()){
						o.On('error',['email.failed',ev]);
						return false;
					}

				}


				o.lockElements();

				o.ToastWait = GToast('<div class="gui iconx loading circle x16">sync</div>&nbsp;&nbsp;&nbsp;Traitement...').wait();

				o.STC.services.statement(o);

				// alert('here : ' + __LINE__);


				
				// o.URLTrader = [o.host,o.STC.getter.userstrader].join('');
				// o.ajax=GAjax({URI:o.URLTrader,crossDomaine:false,mode:'POST'}).XHR();

				// if(o.ajax==false){
				// 	o.event.detect('error',[o,'-ajax.object.failed']);
				// 	if(typeof o.onError=='function'){o.onError('-ajax.object.failed');}
				// 	return false;
				// }


				// if(o.ajax!=false){
				// 	o.event.detect('wait',[o]);
				// 	if(typeof o.onWait=='function'){o.onWait();}

				// 	// alert('stop'); return false;

				// 	o.ajax.onSuccess=function(ev){ var res=this.xhr.responseText.lower().trim().split(':'),r=res[0]||false,at=res[1]||false;

				// 		// alert(['result : ',this.xhr.responseText].join('\n=====================\n'));

				// 		if(r=='-add.success'){
				// 			o.lockElements();
				// 			o.userLevel=at;
				// 			o.event.detect('success',[o,ev]);
				// 			if(typeof o.onSuccess=='function'){o.onSuccess(ev);}
				// 		}
				// 		else{
				// 			o.captchaRefresh();
				// 			o.event.detect('error',[o,r,ev]);
				// 			if(typeof o.onError=='function'){o.onError(r,ev);}
				// 		}

				// 	};

				// 	o.ajax.onFail=function(ev){
				// 		o.event.detect('fail',[o,ev]);
				// 		if(typeof o.onFail=='function'){o.onFail(ev);}
				// 	};

				// 	o.ajax.onLoad=function(ev){
				// 		o.subscribeNotice('');
				// 		o.unlockElements();
				// 		o.event.detect('load',[o,ev]);
				// 		if(typeof o.onLoad=='function'){o.onLoad(ev);}
				// 	};

				// 	o.ajax.onLoadend=function(ev){
				// 		o.event.detect('loadend',[o,ev]);
				// 		if(typeof o.onLoadend=='function'){o.onLoadend(ev);}
				// 	};

				// 	o.ajax.onError=function(ev){
				// 		var r='-ajax.error';
				// 		o.event.detect('error',[o,r,ev]);
				// 		if(typeof o.onError=='function'){o.onError(r,ev);}
				// 	};

				// 	o.ajax.data=o.hote.stringToSend();

				// 	o.ajax.send();
				// }



				return false;
			});

		
			return o;
		});

		

	});


})(window,screen,navigator);