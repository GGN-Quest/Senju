/* GGN.Messenger, Copyright GOBOU Y. Yannick 2016 */
<?php global $GRegister; if(is_array($GRegister->USER)){ ?>

(function(W,D,gAPI){

	GScript.package('ggn.live').check('GLive', function(){

		var api = gAPI({

			name : 'Messenger'

			, static : {

				version : '0.1'

				, Storages : null

				, Uk : "<?php echo $GRegister->USER['UKEY'];  ?>"

				, params : {

					events : 'show close minimize maximize'

				}

				, Float : {

					ID : 'ggn-messenger-float-editor'

				}

				, Toast : false

				, Init : function(){

					var o = this;

					if(o.Toast){

						o.Toast.close();

					}

					GLive({
				
						key:'ggn.messenger/exchanges'
				
						,timer:3000
				
						,data:''
				
						,wait:function(){}
				
						,fail:function(){}
				
						,error:function(){}
				
					});


					GLive.Ready(function(_o){

						_o.Receive = function(rec){

							this.REC = rec;

							this.ResetRequests();

						};

					});


				}


				,Storages : false



			}

			, constructor : function(){

				var o=this;

				o.Stc = o.STATIC;

				o.CallBack = {};

				o.Type,o.ID,o.Scope;

				o.hote = G('body');

			}

		})

			.create()

		;

		api

			.dynamic('Composer', function(tpe){

				var o=this, tpe = tpe || ':float';

				o.ID = o.ARGS[0];

				o.Name = o.ARGS[1]||false;

				o.From = o.ARGS[2]||false;

				o.Entity = o.ARGS[3]||'all';

				o.Type = tpe;

				if(tpe == ':float'){

					o.CallBack.Overflow = o.hote.css('overflow-y');

					o.Scope = GAwake(

						o._CMPFl()

						,{
	
							fixed:true

							,hote:o.hote
						
							,locked:false

							,opacity:0.75
						
							,depth:'no-content gray-blur gray black-bg'
						
						}

					);

					o.Scope.bx.ctn.addClass('x480-w-max col-6 mi-col-15 li-col-15 s-col-15 x256-h-min x320-h-max gui flex column');

					o.Scope.event.add('show', function(a){

						o.hote.css({'overflow-y':'hidden'});
						
					});

					o.Scope.event.add('close', function(){

						o.hote.css({'overflow-y':o.CallBack.Overflow||'auto'});
						
					});



				}

				return o;

			})

			.dynamic('_CMPFl', function(tpe){

				var o=this,bx={};

				bx.p = o.hote.create({cn:'ggn-messenger float-composer col-0 gui flex column box-rounded '});

				bx.ttlx = bx.p.create({cn:'title gui flex row'});

					bx.ttl = bx.ttlx.create({cn:'text-x22 padding-tb-x8 padding-lr-x16 text-ellipsis', html:['Envoyer un message ', (isStr(o.Name) ?( ['à <span class="color-primary">', o.Name.stripSlashes(), '</span>'].join('') ): '') ].join('')});

					bx.cls = bx.ttlx.create({cn:'text-x16 padding-tb-x8 padding-lr-x16 gui iconx color-text align-right flex center cursor-pointer'}).append('close');

				bx.cnt = bx.p.create({cn:'container col-0 gui flex column'});

					bx.edit = bx.cnt.create({tag:'textarea', id:o.Stc.Float.ID, cn:'editor col-0 text-x16'});

						bx.edit.attrib('placeholder', 'Rédiger votre message');


					bx.btns = bx.cnt.create({cn:'buttons gui flex row'});

						bx.tls = bx.btns.create({cn:'tools col-0'});

						bx.cnl = bx.btns.create({tag:'button',cn:'button align-right text-x14'}).html('Annuler');

						bx.snd = bx.btns.create({tag:'button',cn:'button align-right text-x14 active'}).html('<span class="iconx margin-r-x8">send</span>Envoyer');


				bx.cnl.on('click', function(){o.Scope.close();});

				bx.cls.on('click', function(){o.Scope.close();});

				bx.snd.on('click', function(){

					var id = '#', inp,txt;

					id+=o.Stc.Float.ID;

					inp = G(id);

					txt = inp.value;

					if(!txt.isEmpty()){

						o.Scope.close();

						var SendToast = GToast('Envoie du message en cours...').wait();

						o.Stc.Send(
							
							o.ID
							
							, o.From

							, o.Entity
							
							, txt
							
							, function(){SendToast.close(); SendToast = GToast('Transfert...').wait();}

							, function(){SendToast.close(); GToast('Message Envoyé avec success').success();}

							, false

							, false

							, function(){bx.p.remove(bx.p);}
						);

						// GLive.Request('messenger-sent-to', o.ID);

						// GLive.Request('messenger-entity-to', o.Entity);
						
						// GLive.Request(
						
						// 	'messenger-sent-msg'
						
						// 	, txt
						
						// 	, function(){SendToast.close(); SendToast = GToast('Transfert...').wait();}
						
						// 	, function(){SendToast.close(); GToast('Message Envoyé avec success').success();}

						// 	, false

						// 	, false

						// 	, function(){bx.p.remove(bx.p);}
							
						// );

					}

					else{

						GToast('Veuillez rediger un message!').error();

					}

				});

				return bx.p;
				
			})

			.static('Send', function(To,From,En,M,W,S,F,E,L){

				var o=this;

				GLive.Request('messenger-sent-to', To);

				GLive.Request('messenger-sent-from', From);

				GLive.Request('messenger-sent-entity', En);
				
				GLive.Request(
				
					'messenger-sent-msg'
				
					, M
				
					, W||false
				
					, S||false

					, F||false

					, E||false

					, L||false
					
				);

				return o;
				
			})

			.dynamic('Show', function(tpe){

				var o=this;

				if(isObj(o.Scope)){

					if(isFunc(o.Scope.show||'')){

						o.Scope.show();

					}

				}

				return o;
				
			})

			.dynamic('UI', function(tpe){

				var o=this;

				o.Builder = false;

				if(tpe=='Composer/Dial/Exchanges'){

					o.Builder = o._DialEase(o.ARGS[0]).Handler;

				}

				return o;
				
			})

			.dynamic('_ScrollBarToBottom', function(ctnr){

				var o=this, H = ctnr.offset().scrollHeight;

				ctnr.scrollTop = H;

				return o;
				
			})

			.dynamic('_DialEase', function(iD){

				var o=this,ob = {}, Me = o.ARGS[1]||o.Stc.Uk||false, MyName=false, En=iD;

				ob.event = GEvent(ob);

				ob.CTRLEnter = false;

				ob.Main = G('body').create({cn:'ggn-messenger dial-ease gui flex column wrap center w-inherit h-inherit'})

					.html('<h1 class="gui iconx more-alt text-x7-vw cursor-default">more_horiz</h1>')

				;


				// alert(iD)

				GLive.Request(

					'get-dial-messages'

					, iD

					,function(){}

					,function(rec){


						if(isObj(rec.DialMessages||false)){

							ob.Main.removeClass('center').addClass('start').html('');

							ob.KeyCTRLEnter = false;

							ob.KeyEnterActived = false;

							ob.mToast = false;


							ob.mSubmit = function(f,ev){

								var cm = f.composer, val = cm.value||'';

								if(ob.mToast.status){

									ob.mToast.close();

								}

								// ob.mToast.wait()._text('Envoie...');

								// alert(iD)


								if(!val.isEmpty()){

									var SiD = iD.split('/')

										,to = SiD[0]||false

										,blg = SiD[1]||false

										,nw = (to && blg) ? o._DialEaseSpeecher(scrn, Me, {

											me : true

											,usr : MyName

											,msg : val

											,Dt : false

										}) : false

									;

									if(isObj(nw)){

										o.Stc.Send(
											
											to
											
											, Me

											, blg
											
											, val
											
											, function(){GToast('Transfert...').wait();console.log('Un instant...');}

											,function(rec){
												console.log('Envoyé // ', JSON.stringify(rec));
												GToast('Message Envoyé avec success').success();
											}

											, false

											, false

											// , function(){console.log('Chargement terminé');}
										);

									}



								}


								o._ScrollBarToBottom(ctnr);


								cm.value = '';

								GEvent(ev).prevent(true);

							};



							var ctnr = ob.Main.create({cn:'container disable-x-scrollbar enable-y-auto-scrollbar _w10'})

									,scrn = ctnr.create({cn:'screen _w10 align-bottom gui flex column wrap pos-relative'})

									// ,tmaster = ctnr.create({cn:'pos-absolute _w10 bg-primary'}).css({left:'0px',bottom:'0px'})

								,form = ob.Main.create({tag:'form', cn:'form gui flex row x96-h-min pos-relative'})

										.on('submit', function(ev){

											ob.mSubmit(this,ev);

											return false;

										})

									,edbx = form.create({cn:'editor col-0 gui flex column'})

										,area = edbx.create({tag:'textarea',cn:'input x64-h-min x192-h-max disable-scrollbar'})
											
											.attrib('name', 'composer')

											.attrib('placeholder', 'Rédiger votre message')
											
											.attrib('ggn-handler-keyup', 'Gabarit.Form.TextArea.Flexible')
											
											.attrib('ggn-handler-focus', 'Gabarit.Input.Focus')
											
											.attrib('gabarit-focus', '.ggn-messenger.dial-ease > .form')

											.on('focus', function(){

												var f = this.form;

												if(!ob.KeyEnterActived){

													ob.KeyEnter = GKeyShot(function(ev){

														if(f.EnterKeyType.checked){

															ob.mSubmit(f,ev);

														}

														else{

															console.log('Retour a la ligne native')

														}

													}).key('ENTER');

													GEvent(this).listen('keypress', function(ev){ob.KeyEnter.detect(ev, true);});

													ob.KeyEnterActived = true;

												}
													
												ob.KeyCTRLEnter = G.KeyShot(this,function(ev){

													if(!f.EnterKeyType.checked){
														
														ob.mSubmit(f,ev);

													}

													else{

														f.composer.value += '\n';

													}

												},false).shortcuts('CTRL','ENTER');



											})

											.on('blur', function(){

												if(ob.KeyCTRLEnter){

													ob.KeyCTRLEnter.destroyShortcuts();

												}

											})



										,tools = edbx.create({cn:'tools x32-h-max padding-lr-x16 padding-tb-x8 text-x12 gui flex row center wrap'})


											,tmga = tools.create({tag:'a',cn:'align-left'})

													.attrib('href','#')

													.on('click',function(){return false;})

												,tmg = tmga.create({cn:'tool gui iconx text-x18'}).append('attach_file')


											, tTpEnt = tools.create({cn:'align-right'})

												,tpEnt = tTpEnt.create({cn:'tool text-x12 padding-tb-x8 padding-lr-x16 box-rounded gui flex row'})

													,tpEntInpID = 'ggn-messenger-dial-ease-form-send-enter-type'

													,tpEntInp = tpEnt.create({tag:'input',cn:'margin-r-x8',id:tpEntInpID}).attrib('type', 'checkbox').attrib('name','EnterKeyType').attrib('checked','true')

														.on('click',function(){

															form.composer.blur();

															G(function(){

																form.composer.focus();

															}).timeout(100);

														})

													,tpEntTxt = tpEnt.create({tag:'label',cn:'cursor-pointer'}).attrib('for', tpEntInpID).append('La touche "ENTER" pour envoyer')


									, sendbx = form.create({tag:'button',cn:'send x96-w gui flex center button link '})

										, send = sendbx.create({cn:'iconx color-light text-x32 x64 bg-primary box-circle padding-x16 cursor-pointer'}).append('send')


								,M = rec.DialMessages.Return

								,bid = M[0]||[]

								,uk = M[1]||[]

								,msg = M[2]||[]

								,rate = M[3]||[]

								,time = M[4]||[]

								,avail = M[5]||[]

								,usr = M['username']||[]

							;



							ob.mToast = GToast({

								hote : scrn

								, text : 'Chargement...'

								,delay : 1000

							})

								.wait()

								.close()

							;


							ob.bx = {ctnr:ctnr, scrn:scrn, form:form, edbx:edbx, area:area, tools:tools, tmga:tmga, tmg:tmg, sendbx:sendbx, send:send};

							ob.event.detect('build', ob);

							G.foreach(msg, function(mg, k){

								MyName = (!MyName && uk[k]==Me) ? usr[k] : MyName;

								console.log(MyName);

								var it = o._DialEaseSpeecher(scrn, usr[k], {

									me : uk[k]==Me ? true : false

									,usr : usr[k]||false

									,msg : msg[k]||false

									,Dt : G.Gabarit.Date.Label(time[k]*1000)||false

								});


							},false,false,'.');

							o._ScrollBarToBottom(ctnr);

						}

						else{

							ob.Main.html('<h1 class="text-x3-vw">Erreur Ressayez encore</h1>');
							
						}


					}

					, false

					, false

					, function(){}

				);
				

				o.Handler = ob;

				return o;
				
			})



			.dynamic('_DialEaseSpeecher',function(scrn, uk, c){

				var o=this

					, c=c||{}

						, amr = (c.me) ? 'me' : 'you'

						, umr = (c.me) ? 'align-right' : 'align-left'

						, tmr = (c.me) ? 'text-right' : 'text-left'

						, usr = c.usr || 'NaN'

						, msg = c.msg || 'NaN'

						, Dt = c.Dt || G.Gabarit.Date.Label(new Date())


					, it = scrn.create({cn:'speecher gui box-rounded-normal col-11 x320-w-min x64-h-min margin-tb-x8 gui flex row wrap pos-relative'})

						.addClass(umr)

						.addClass(amr)

						, ph = it.create({cn:'thumb bg-primary color-light gui box-circle x48 pos-absolute gui flex center text-x18'}).append(usr.firstLetters(2).upper())

						, stn = it.create({cn:'container col-0 gui flex column padding-tb-x8 padding-lr-x32'}).addClass(tmr)

							, ttl = stn.create({cn:'title text-x18 padding-b-x8'}).html(usr.ucfirst())

							, txt = stn.create({cn:'message text-x14 padding-lr-x16'})

							, dt = stn.create({cn:'datetime text-x12 padding-t-x8'}).html(Dt.ucfirst())

					, msgs = msg.split('\n')

				;


				G.foreach(msgs, function(mtx,k){

					var m = txt.create({cn:'line'}).append(mtx);

				});

				return it;			

			})



		;


		G.Messenger.Init();


	});

})(window,document, GAPI);
<?php } ?>