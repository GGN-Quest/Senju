/* GougnonJS.OInterface, version : 0.1, update : 151011#0352, Copyright GOBOU Y. Yannick 2015 */
GScript.check('GApp', function(){
	GApp.event.add("ShowInterface", function(){

		(function(A,P,I){var API;

			if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec COM 0.1 '); return false; }

			API=G.API({
				name:'OInterface'
				,static:{
					version:'0.1'
					,NavBar:{
						Ob:function(){return GApp.NavBar.Ability;}
						,Show:function(){return this.Ob().Show();}
						,Hide:function(){return this.Ob().Hide();}
					}
				}
				,constructor:function(){
					var o=this;
					o.static=G.OInterface;
					o.args=arguments[0]||[];
					o.instance=o.args[0]||false;
					o.event=G.Event(o);
				}
			}).create();


			API.static('Initialize', function(){
				var o=this,app=GApp,navbar=app.NavBar.Ability;

				o.Shortcuts = {};

				navbar.event
					.add('SmartMenuDisplay', function(){
						o.SmartMenu.Build();
					})
					.add('NavBarDisplay', function(){
						o.StartMenu.ShowBack();
					})
					;

				app.event
					.add('OnLoadPage', G.OInterface.Page.Load)
					.add('OnWaitPage', G.OInterface.Page.Wait)
					.add('OnErrorPage', G.OInterface.Page.Error)
					.add('OnFailPage', G.OInterface.Page.Fail)
					.add('OnBeforeLoadPage', G.OInterface.Page.BeforeLoad)
				;


				if(isFunction(G['KeyShot']||false)){
					var F5 = GKeyShot(function(){GApp.NavBar.Ability.Waiting();}).key('F5');
					o.Shortcuts.F5=GEvent(G.DOC).listen('keypress', function(ev){F5.detect(ev, false);});
					o.Shortcuts.SMTLeft=G.KeyShot(G.DOC,function(){o.StartMenu.Toggle();},false).shortcuts('CTRL','LEFT.WINDOW.KEY');
					o.StartMenu.SMTRight=G.KeyShot(G.DOC,function(){o.StartMenu.Toggle();},false).shortcuts('CTRL','RIGHT.WINDOW.KEY');
				}

				GAction('handler:Ascending.App.Detail.Back').listen('click', function(e){
					var ge=G(e), cat=ge.attrib('ascending-detail-back-category')||false;
					o.Ascending.Apps.Detail.Back(cat);
				});

				GAction('handler:Ascending.App.Open').listen('click', function(e){
					var ge=G(e)
						, u=ge.attrib('ascending-app-url')||false
						, n=ge.attrib('ascending-app-name')||false
						;
					if(isString(u)){n.aboutBlank(u);}
				});

				GAction('handler:Ascending.App.Pause').listen('click', function(e){
					var ge=G(e)
						, k=ge.attrib('ascending-app-key')||false
						;
					if(isString(k)){
						var cmd='pause:';
							cmd+=k;
						GApp.Live.Request('command',cmd);
					}
				});

				GAction('handler:Ascending.App.Play').listen('click', function(e){
					var ge=G(e)
						, k=ge.attrib('ascending-app-key')||false
						;
					if(isString(k)){
						var cmd='play:';
							cmd+=k;
						GApp.Live.Request('command',cmd);
					}
				});


				G('body').addClass('ims-background-page');
				// G('body > .nav-bar').addClass('ims-background-page');

				o.StartMenu.Init();
				o.Page.Init();

				GEvent(window).listen('resize', function(){
					G(function(){o.UpdateLayout();}).timeout(100);
				});

				return o.UpdateLayout();
			})

			.static('UpdateLayout', function(){
				var o=this,app=GApp,bH=app.Main.Box.offset().height
					,mer=G('.ims-setter-main-height'),ttl=G('.gui.system.interface.immersion.page > .title');

				bH-=10;

				if(isObject(ttl.element||false)){
					bH-=ttl.offset().height;
				}

				if(isObject(mer.element||'')){
					bH+='px';
					mer.css({height:bH});
				}

				return o;
			})

			.static('Page', {
				Selector:'.gui.system.interface.immersion.page#sys-page'
				,WaitingLocker:false

				,Init:function(){
					var o=this,wl=GAwake(G(o.Selector)).init({cssSelectorName:'transparent', locked:true, width:1, height:1});

					wl.content().css({display:'none'});

					o.WaitingLocker=wl;
				}
				,BeforeLoad:function(args){
					// var o=G.OInterface.Page,jx = args[0]||false,mount=args[1]||false,c=args[2]||false,page=G(o.Selector)
					// 	,cp=mount.Params.CurrentPage,ua=c.URIAttempt;

					// if(cp==ua){mount.OpenerCOM.Allow.Attempt=false;}
					// else{mount.OpenerCOM.Allow.Attempt=true;}

				}
				,Load:function(args){
					var o=G.OInterface.Page,jx = args[0]||false,page=G(o.Selector);

					if(isObject(jx)){
						var xhr = jx.xhr;
						if(isString(xhr.responseText||false)){
							// alert(xhr.responseText);
							page.html(xhr.responseText);
							page.execScript();
							G.OInterface.UpdateLayout();
						}
					}
					
					o.LoadEnd();
				}
				,Wait:function(){
					var o=G.OInterface.Page;
						GApp.NavBar.Ability.Waiting();
						o.WaitingLocker.show();
				}
				,Error:function(){var o=G.OInterface.Page;
					GToast('Erreur, page non-chargé').bubble();
					GApp.NavBar.Ability.ErrorWaiting();
					G.OInterface.Page.End();
				}
				,Fail:function(){var o=G.OInterface.Page;
					GToast('Echec lors lors du chargement').bubble();
					GApp.NavBar.Ability.WarningWaiting();
					G.OInterface.Page.End();
				}
				,LoadEnd:function(){
					var o=G.OInterface.Page;
						GApp.NavBar.Ability.StopWaiting();
						o.WaitingLocker.close();
				}
				,End:function(){
					var o=G.OInterface.Page, d= new Date(),t=d.getTime();
					G(function(){
						GApp.NavBar.Ability.StopWaiting();
					}).timeout(5000);

					o.WaitingLocker.close();
				}
			})

			.static('Ascending', {
				
				Apps:{
					Status:false

					,Init:function(){
						var o=this, app=GApp, nav=app.NavBar.Ability, Pa=app.Params;

						nav.DestroyMenu();

						nav.AddMenu({
							name:'Opt.Install'
							,type:'icon'
							,title:'Commencez une nouvelle application'
							,label:'Nouvelle Installation'
							,cssSelector:'gui icon static-color install-pkg min-size'
							,link:[Pa.URL, 'apps/install'].join('')
							,appLink:true
						});

						o.Browse.Init();

						o.Detail.Init();


						if(o.Status==false){

							GAction('handler:Ascending.Item.Overview.Toggle').listen('click', function(e){
								var cur=G(e)
									,k=cur.attrib('ascending-item-key')||'';

								if(!(k).isEmpty()){
									o.OverviewToggle(k);
								}
									
							});

							GAction('handler:Ascending.App.Detail').listen('click', function(e){
								var ge=G(e)
									, ak=ge.attrib('ascending-detail-appkey')
									, t=ge.attrib('ascending-detail-title')
									, k=ge.attrib('ascending-item-key')
									;

								if(ak!==false){
									o.Detail.Show({key:ak, title:t});
								}
								
								if(k!==false){
									o.OverviewToggle(k);
								}

							});

							GAction('handler:Ascending.Apps.Browse.Next').listen('mouseenter', function(e){
								o.Browse.Next(3/10, G(e));
							});

							GAction('handler:Ascending.Apps.Browse.Next').listen('click', function(e){
								o.Browse.Next(3/4);
							});

							GAction('handler:Ascending.Apps.Browse.Previous').listen('mouseenter', function(e){
								o.Browse.Previous(3/10, G(e));
							});

							GAction('handler:Ascending.Apps.Browse.Previous').listen('click', function(e){
								o.Browse.Previous(3/4);
							});

							G('body').css({overflow:'hidden !important'});

						}

						o.Status = true;

					}

					, OverviewToggle: function(k){
						var ge=G(['#ims-ascending-element-',k,''].join(''))
							,sus=ge.attrib("ims-ascending-element-status")||'c'
							;

						if(sus=="c"){ge.removeClass("close").addClass("open");ge.attrib("ims-ascending-element-status","o");}
						if(sus=="o"){ge.removeClass("open").addClass("close");ge.attrib("ims-ascending-element-status","c");}
						
					}


					, Stat : {
						Progress:{
							Bar:function(c){
								var p = G.ProgressBar(c).Setup({
									row:100
									,animation:true
								});



								return p;
							}

						}
					}

					
					,Detail:{
						Box:false
						,LockerBox:false
						,Already:false

						,Init:function(){
							var o=this;
							o.Box = G('body').createElement({id:'ascending-detail',cn:'ims-ascending-detail'});
								o.Head = o.Box.createElement({cn:'head gui flex'});
									o.Closer = o.Head.createElement({cn:'btn close cursor-pointer'});
									o.Title = o.Head.createElement({cn:'title text-ellipsis'});
								o.Body = o.Box.createElement({cn:'body'});

							o.LockerBox = G('body').createElement({id:'ascending-detail-locker',cn:'ims-ascending-detail-locker'});

							o.Title.append('Detail de l\'application');
							o.CloserActions();
							return o;
						}

						, Updater:{Bar:[]}
						, Update:function(rec,key){
							var o=this;
							// console.log(JSON.stringify(rec));

							if(isObject(rec['activity']||'')){
								var acts = rec.activity, bx=G('#ascending-app-detail-list.detail-list');

								if(bx['element'] && isObject(acts['Users']||'')){

									bx.html(' ');

									G.foreach(acts.Users, function(it,k){

										var itm = bx.createElement({cn:'item i1 gui flex row'})
												,txt = itm.createElement({cn:'txt'})
													,title = txt.createElement({cn:'big-title'})
													,about = txt.createElement({cn:'about'})
												,lnk = itm.createElement({cn:'lnk background-abs-center cursor-pointer'})
											, d = new Date(1970,0,1)
											,at=''
											,ab=''
											;


											at+='Utilisateur : <b>';
											at+=(it.UserName||it.IP).ucfirst();
											at+='</b>';

											d.setSeconds(it.Time);
											ab+='Page : <b>';
											ab+=it.URL;
											ab+='</b>, Date : <b>';
											ab+=d.getDay().zeroBefore(2);
											ab+='/';
											ab+=(d.getMonth()+1).zeroBefore(2);
											ab+='/';
											ab+=d.getFullYear();
											ab+='</b> à <b>';
											ab+=d.getHours().zeroBefore(2);
											ab+=':';
											ab+=d.getMinutes().zeroBefore(2);
											ab+=':';
											ab+=d.getSeconds().zeroBefore(2);
											ab+='</b>, IP : <b>';
											ab+=it.IP;
											ab+='</b>';

										title.html(at);
										about.html(ab);

										lnk.click(function(){
											var u='<?php echo HTTP_HOST; ?>';
												u+=it.URL;
												d.toString().aboutBlank(u);
										});

									});
								}


								var sbx=G('#ascending-app-detail-size');
								if(sbx['element'] && isNumber(acts['Size']||'') && isObject(acts['SizeLabel']||'')){
									var sb=acts.SizeLabel,sbh='', as=acts['Size'];
										sbh+=sb.Value;
										sbh+=' ';
										sbh+=sb.Unity;
									sbx.html(sbh);
								}


								var tbx=G('#ascending-app-detail-total-space');
								if(tbx['element'] && isNumber(acts['TotalSpace']||'') && isObject(acts['TotalSpaceLabel']||'')){
									var tb=acts.TotalSpaceLabel,tbh='', ts=acts['TotalSpace'];
										tbh+=tb.Value;
										tbh+=' ';
										tbh+=tb.Unity;
									tbx.html(tbh);
								}

								var nt=G('#ascending-app-detail-note');
								if(nt['element'] && isObject(o.Updater.Bar[key]||'') && as && ts){
									var b=o.Updater.Bar[key], psz=((as/ts)*100).round(),pszi=psz;
										b.seek(psz);
									pszi+='%';
									nt.html( (psz<=1 && as>0) ? '< 1%': pszi  );
								}


							}

						}

						,ActiveScrollBar:function(){
							var o=this;
								o.Body.attrib('ggn-scrollbar','true');
								o.Body.attrib('scrollbar-axe','y');
							return o;
						}

						,DestroyScrollBar:function(){
							var o=this;
								o.Body.removeAttrib('ggn-scrollbar');
								o.Body.removeAttrib('scrollbar-axe');
							return o;
						}

						,CloserActions:function(){
							var o=this,a=arguments,m=a[0]||false;

							o.Closer.click(function(){
								o.Close();
							});
						}

						,Back:function(cat){
							var o=this,app=GApp,Pa=app.Params,uri=Pa.URL;
								uri+='apps';

							if(isString(cat||false)){
								uri+='?category=';
								uri+=cat;
							}

							GApp.COMs({URI:uri});
						}

						,Show:function(app){
							var o=this,Po=G.OInterface,body=G('.gui.sheet.gapps'), Pa=GApp.Params, uri=Pa.URL
								,pt=(app['title']||false)?[app.title,' - '].join('') : '', live=GApp.Live;

							if(isString(app.key||false)){

								pt+='Detail de l\'application';

								o.Box.css({display:'flex'});
								o.LockerBox.css({display:'block'});

								if(isString(app.title||false)){
									o.Title.html(app.title);
								}


								if(isFunction(G['KeyShot']||false)){
									var escky = GKeyShot(function(){o.Close();}).key('ESCAPE');G(document).keypress(function(evt){escky.detect(evt, false);});
								}

								o.Body.fullSpace('<center><div class="gui loading circle x32"></div><div class="alert">Patientez...</div></center>');
								
									uri+='apps/detail?k=';
									uri+=app.key;

								var c = {title:pt, URI:uri, data:null, trace:{} };

									c.trace.Success = function(ajax, appo, c){
										G.DOC.title = pt;
										G.OInterface.Page.LoadEnd();
										o.CloserActions(true);
										o.Body.html(ajax.xhr.responseText);
										o.Body.execScript();
										o.Body.attrib('ggn-effect','blur-motion-out');

										G(function(){
											o.ActiveScrollBar();
										}).timeout(100);

									};

									c.trace.ForceError = function(ajax, appo, c){
										o.Body.fullSpace('<div class="alert-mini">Erreur, Impossible d\'executer XHR</div>');
									};

									c.trace.ForceFail = function(ajax, appo, c){
										o.Body.fullSpace('<div class="alert-mini">Erreur, Impossible d\'atteindre les details</div> ');
									};

									c.noHistory = true;

								GApp.COMs(c);


								if(isObject(Po.Shortcuts['SMTLeft'])&&o.Already===false){
									Po.Shortcuts.SMTLeft.event.add('execute',function(){o.Close();});
								}

								if(isObject(Po.Shortcuts['SMTRight'])&&o.Already===false){
									Po.Shortcuts.SMTRight.event.add('execute',function(){o.Close();});
								}

								window.onpopstate = function(){
									o.Close();A.onpopstate=null;
								};

								o.Already=true;
							}

							G(function(){
								o.Box.removeClass('close').addClass('open');
								body.attrib('ggn-effect', 'blur-motion-in');
							}).timeout(1);

							return false;

						}

						,Close:function(){
							var o=this,body=G('.gui.sheet.gapps');

							o.Box.removeClass('open').addClass('close');
							body.attrib('ggn-effect', 'blur-motion-out');

							G(function(){var live=GApp.Live;
								o.Box.css({display:'none'});
								o.LockerBox.css({display:'none'});
								o.DestroyScrollBar();
								live.ResetIRequests();
								// live.Config.ResetRequest = true;
								live.ResetAttempt();
							}).timeout(300);

						}

					}

					,Browse:{

						Selector:{
							content:'.ims-ascending > .container > .body > .content'
							,list:'.ims-ascending > .container > .body > .content > .list'
							,next:'.ims-ascending > .container > .body > .browse.next'
							,previous:'.ims-ascending > .container > .body > .browse.previous'
						}

						,Init:function(){
							var o=this,s=o.Selector,ctn=G(s.content),list=G(s.list);
							if(!list['element']){return false;}
							var proc,lo=list.offset() ,scr=GScreen.Offset(),sllw=lo.width,sw=scr.width ,su=-1*(sllw-sw)/2
								, n=G(o.Selector.next), p=G(o.Selector.previous);


							proc = GAMP({from:lo.left, to:su, timeline:250, hit:function(){var u = this.level; u+='px'; list.css({left:u});}}).init().start();

							if(lo.width<=sw){
								n.css({display:'none'});
								p.css({display:'none'});
							}
							if(lo.width>sw){
								n.css({display:'block'});
								p.css({display:'block'});
							}

						}
						
						,Next:function(coef){
							var o=this,a=arguments,s=o.Selector,ctn=G(s.content),list=G(s.list);
							if(!list['element']){return false;}
							var proc,lo=list.offset() ,scr=GScreen.Offset(),sllw=ctn.prop('scrollWidth'),sw=scr.width ,su=lo.left-(sw*coef);
								su= ((sllw-sw)>sw)?su:-1*(lo.width-sw);

							proc = GAMP({from:lo.left, to:su, timeline:250, hit:function(){var u = this.level; u+='px'; list.css({left:u});}}).init().start();

							if(isObject(a[1]||false) && isFunction(a[1].mouseleave||false)){
								a[1].mouseleave(function(){proc.stop();});
							}

						}
						
						,Previous:function(coef){
							var o=this,a=arguments,s=o.Selector,list=G(s.list);
							if(!list['element']){return false;}
							var proc,lo=list.offset() ,scr=GScreen.Offset(),sw=scr.width ,su=lo.left+(sw*coef);
								su= (su<0)?su:0;

							proc = GAMP({from:lo.left, to:su, timeline:250, hit:function(){var u = this.level; u+='px';list.css({left:u});}}).init().start();

							if(isObject(a[1]||false) && isFunction(a[1].mouseleave||false)){
								a[1].mouseleave(function(){proc.stop();});
							}

						}


					}
				}
				
			})

			.static('SmartMenu', {
				Status:false
				,Search:{
					Box:false
					,Input:false
					,FormBox:false
					,Init:function(){
						var o=this,Pa=GApp.Params;

					}
				}

				,Show:function(){GApp.NavBar.Ability.SmartMenuShow();}
				,Hide:function(){GApp.NavBar.Ability.SmartMenuHide();}
				,Toggle:function(){GApp.NavBar.Ability.SmartMenuToggle();}

				,Build:function(){
					var o=this,smb=GApp.NavBar.Ability.SmartMenu,bx=smb.Box,smbi=smb.Items.Box;

					if(!o.Search.Box){
						o.Search.Box = smbi.createElement({cn:'item search-bar'});
						o.Search.Init();
					}

				}
				
			})

			.static('StartMenu', {

				Selector:{
					menu:'.gui.system.interface.immersion.menu'
					,page:'.gui.system.interface.immersion.page'
					,index:'.ims-start-menu'
					,close:'#imr-start-menu-close'
				}
				,Status:false
				,Init:function(){
					var o=this,nav=GApp.NavBar;

					o.Status = true;
					o.ShowBack();

					G(o.Selector.close).click(function(){
						o.Minimize();
					});

				}

				,ShowBack:function(){
					var o=this,nav=GApp.NavBar;
					nav.Back.Box.replaceClass('disable','enable');
					nav.Back.Box.click(function(){
						o.Maximize();
					});
				}

				,Toggle:function(){
					var o=this;
					if(o.Status==false){
						o.Maximize();
					}
					else{
						o.Minimize();
					}
				}

				, Minimize:function(){
					var o=this,si=G(o.Selector.index),sm=G(o.Selector.menu),sp=G(o.Selector.page);

					si.removeClass('fx maximize');
					si.addClass('fx minimize');
					sp.attrib('ims-effect', 'maximize');


					G(function(){
						var nav=G.OInterface.NavBar.Show();
						sm.css({display:'none'});
						G('body > .nav-bar').attrib('ggn-effect', 'blur-motion-out');
						G('body').addClass('ims-start-menu-opened');
					}).timeout(360);

					o.Status=false;
				}

				, Maximize:function(){
					var o=this,si=G(o.Selector.index),sm=G(o.Selector.menu),sp=G(o.Selector.page),nav=G.OInterface.NavBar.Show();
						nav.Hide();

					G('body').removeClass('ims-start-menu-opened');
					
					G(function(){
						sm.css({display:'block'});
						si.removeClass('fx minimize');
						si.addClass('fx maximize');
						sp.attrib('ims-effect', 'minimize');
					}).timeout(1);

					G(function(){
						si.removeClass('fx maximize');
						si.attrib('ggn-effect', 'blur-motion-out');
					}).timeout(360);

					o.Status=true;

				}

			})

			.static('LogOut', {
				Locker:false
				,Option:function(){
					var o=this;

					var l=o.Locker||GAwake(G('body')).init({width:320, height:256, locked:true, cssSelectorName:'ims-locker'})
						,t,c,ctn,lv,lo,lb,btn,inf,lvlb,lolb,lblb, cfrm=GAwakeConfirm(G('body')).init({width:320, height:196});

					ctn=l.content(); ctn.html('');

					t=ctn.createElement({cn:'title', html:'Déconnexion'});
					c=ctn.createElement({cn:'content'});
						inf=c.createElement({cn:'nfo'});
						btn=c.createElement({cn:'btns gui space center'});
							lb=btn.createElement({cn:'btn cancel'});
								lblb=lb.createElement({cn:'label'});
							lv=btn.createElement({cn:'btn locker'});
								lvlb=lv.createElement({cn:'label'});
							lo=btn.createElement({cn:'btn out'});
								lolb=lo.createElement({cn:'label'});

					lblb.append('Annuler');
					lvlb.append('Vérrouiller');
					lolb.append('Déconnecter');

					lb.click(function(){l.close();});

					lv.click(function(){
						cfrm.message(
							'Vérouillage d\'application'
							, 'Cliquez sur "Continuer" pour vérrouiller cette application'
							,{
								Ok:{label:'Continuer',focus:true ,click:function(){GDocument().href(['<?php echo HTTP_HOST."logout?app=',GApp.Params.AppKey,'&next=',escape(location.href),'"; ?>'].join('')); } }
								,Cancel:{label:'Annuler'}
							}
						);

					});

					lo.click(function(){
						cfrm.message(
							'Déconnexion'
							, 'Cliquez sur "Continuer" pour vous déconnecter'
							,{
								Ok:{label:'Continuer',focus:true ,click:function(){GDocument().href('<?php echo HTTP_HOST . "logout?general"; ?>');} }
								,Cancel:{label:'Annuler'}
							}
						);
					});

					inf.html('Que voulez-vous faire?');

					l.onClose=function(){G('.gui.sheet').attrib('ggn-effect', 'blur-motion-out');};

					l.show();
					G('.gui.sheet').attrib('ggn-effect', 'blur-motion-in');

					o.Locker=l;
					return o;
				}

			})

			.static('StartMenuOpener', function(cmd){
				var o=this,app=GApp,Pa=app.Params,u=Pa.URL,ti=Pa.Title, a=arguments,t=a[1]||false;

				if(isString(t||false)){
					t+=' - ';
					t+=ti;
				}

				if(cmd=='minimize.menu'){}

				if(cmd=='apps.all'){
					u+='apps';
					app.COMs({URI:u,data:null,title:t||'Applications'});
				}

				if(cmd=='home.show'){
					if((Pa.DefaultPage != Pa.CurrentPage) && (isString(Pa.CurrentPage||false)) ){
						u+='home';
						app.COMs({URI:u,data:null,title:t||Pa.Title});
					}
				}

				if(cmd=='log.out'){
					o.LogOut.Option();
					return false;
				}

				o.StartMenu.Minimize();
				return o;
			});



			return G.OInterface;

		})(window,screen,navigator).Initialize();


	});
});
