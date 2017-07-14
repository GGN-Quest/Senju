/* GougnonJS.Application.Mount, version : 0.1, update : 150803#1217, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GApps.Mount 0.1 '); return false; }

	if(typeof GApps!='function'){alert('Cette API a besoin de son API parente "GApps" '); return false; }

	API=G.API({
		name:'AppsMount'
		,static:{
			version:'0.1'
			,updateVersion:'150803.1217'
			,events:''
			,varsinit:''
			,Params:{}
		}
		,constructor:function(){
			
		var o=this;
			o.staticParent=G.Apps;
			o.static=G.AppsMount;
			o.Args=arguments[0]||[];
			o.Name=o.Args[0]||false;
			o.event=G.Event(o);
			o.CallBack={};
			o.Params={};
			o.MockUp={CSS:{Files:[]}};
			o.DOC = G.Document;
			// o.COM = {RequestInjection:{}};

			if(typeof o.Name=='string'){GApps.Mounted[o.Name] = o;}
		}
	}).create();

	


	API.dynamic('LiveReceived', function(arg){
		var o=this, rec=arg[0], res=rec[0], obj=rec[1]

			, con=res['Connect']||false
			, ctrl=res['Controller']||false

			, isCon=!isObject(con)
			, isCtrl=!isObject(ctrl)
			;

		if(isCon){o.Lock(':session.out');}
		if(!isCon){
			// console.log('Connect.IS', con['Is']||'no', con['App']||'no app');

			if(con['Is'] && con['App']){
				// console.log('is Connected');
				if(isFunction(o.AppLocker['close']||'')){
					// o.AppLocker.close();
				}
			}
			else{
				o.Lock(':session.out');
			}

		}


		if(!isCtrl){
			var Play=ctrl.Play||{Status:null}
				,PStat=Play.Status;
				;

			// if(PStat===true){
			// 	// console.log('Behaviors : Play')
			// 	o.AppLocker.close();
			// }

			if(PStat===false){
				// console.log('Behaviors : Pause')
				o.Lock(':behavior.pause');
			}

			else{
				// console.log('Behaviors : Customize for User')
				if(o['AppLocker']||false){o.AppLocker.close();}
				
			}

			console.log('Behaviors.GET // ', PStat)

		}

		if(isCtrl){
			console.log('No Controlleur ');
		}

	
		return o;
	});
	
	


	API.dynamic('AppLocker', false);
	API.dynamic('IsLock', false);

	API.dynamic('Lock', function(){
		var o=this, isl=false,cisl=o['IsLock']||false,lock,a=arguments,code=a[0]||false,Pa=o.Params;

		if(o['AppLocker']||false){
			var l=o['AppLocker'],lck=l.container().css('display');
			o.IsLock = lck=='block'?true:false;
			isl=o.IsLock;
			// if(cisl!=isl){o.AppLocker.close();}
		}

		if(isl==false){
			var m=o.LockMessages(code);
			lock=(isObject(o['AppLocker']||''))?o['AppLocker']:GAwake(G('body')).init({width:320,height:256,locked:true, cssSelectorName:'gapps-locker'});
			lock.content().html(['<div class="title">',(m.title||Pa.AppTitle),'</div><div class="message">',(m.message||'Cette application est temporairement Vérrouillé'),'</div>'].join(''));
			lock.show();
			o.AppLocker=lock;
		}

		return o;
	});
	

	API.dynamic('LockMessages', function(){
		var o=this,a=arguments, code=a[0]||false,txt={title:false,message:false}, Pa=o.Params;

		if(code==':session.out'){
			txt={title:false,message:'Vous êtes actuellement déconnecté...'}
		}

		if(code==':behavior.pause'){
			txt={title:'Pause',message:[Pa.AppTitle,' est temporairement indisponible'].join('')}
		}

		return txt;
	});
	
	


	API.dynamic('Param', function(n,v){
		var o=this, a=arguments, k=a.length-1, m=a[k]||false;
		o.Params[n] = (m===true)?JSON.parse(v):v; 
		return o;
	});
	


	API.dynamic('InitParams', function(){
		var o=this, Pa=o.Params, Elt=o.staticParent.Element, bx=Elt.SplashScreen;
		o.SetTitle(Pa.Title||false);
		o.event.detect('InitParams',o);

		if(isBoolean(Pa.ActiveSplashScreen||false)){
			if(Pa.ActiveSplashScreen===true){o.SetSplashScreen(Pa.SplashScreen||false);}
			else{o.SplashScreen.Box.replaceClass('enable', 'disable');}
		}

		o.event.detect('ParamInitialized',o);
		GEvent(A).listen('load', function(){
			o.event.detect('MountLoaded',o);

			if(Pa.ActiveNavBar===true){o.SetNavBar(Pa.NavBarMenu||false, Pa.NavBarTray||false);}

			var isSplsh=isObject(o.SplashScreen.Box||null);
			if(isSplsh){

				// o.Main.Box.css({overflow:'hidden'});
				o.PageBody.css({overflowY:'auto'});
				// o.Main.Box.css({overflow:'auto'});

				G(function(){
					o.PageBody.css({position:'static'});
					// o.Sheet.Box.attrib('ggn-effect', 'blur-motion-in');
					o.event.detect('ShowInterface', o);

						// alert('close splash')
					o.SplashScreen.Box.animation({opacity:{value:'0.999->0.001',timeline:250 ,done:function(){
						o.SplashScreen.Box.replaceClass('enable', 'disable');
						o.SplashScreen.Status=false;
						// o.Sheet.Box.attrib('ggn-effect', 'blur-motion-out');
					}}});
				}).timeout(1000);
			}

			if(!isSplsh){
				o.event.detect('ShowInterface');
			}



		});

		return o;
	});




	API.dynamic('SetTitle', function(v){
		var o=this, Pa=o.Params; if(typeof v=='string'){o.DOC.title = v;Pa.Title=v;o.event.detect('TitleChanged',o);} return o;});




	API.dynamic('SetSplashScreen', function(PSS){
		var o=this, Pa=o.Params, Elt=o.staticParent.Element, bx=Elt.SplashScreen, ss = PSS;
		// o.PageBody.css({overflow:'hidden'});

		if(isObject(PSS||null)){
			o.SplashScreen.Status=true;

			ss.type = ss.type||false;
			ss.label = ss.label||'Chargement...';
			ss.url = ss.url||false;
			ss.html = ss.html||false;


			if(ss.type=='image/url' && isString(ss.url)){
				bx.fullSpace(['<center><div class="image"><img src="',ss.url,'" alt="',ss.label,'"></div><div class="label">',ss.label,'</div></center>'].join(''));
			}

			else if(ss.type=='text/html' && isString(ss.html)){bx.fullSpace(['<center>',ss.html,'</center>'].join(''));}

			else{bx.fullSpace(['<center><div class="gui loading circle x48"></div></center>'].join(''));}

			Pa.SplashScreen = PSS;
			o.event.detect('ScreenSplashingMade');
		}

		return o;
	});




	API.dynamic('SetNavBarLogo', function(){
		var o=this, Pa=o.Params, bx=o.NavBar.Box;

		o.NavBar.Back = {};
		o.NavBar.Back.Box = bx.createElement({id:'gapps-nav-bar-back-returner-box', tag:'div', cn:'back-pad disable'});

		o.NavBar.Icon = {};
		o.NavBar.IconBox = bx.createElement({id:'gapps-nav-bar-icon-box', tag:'div', cn:'icon disable'});
		o.event.detect('SetNavBarLogo');

		o.NavBar.Wait = {};
		o.NavBar.Wait.Box = bx.createElement({id:'gapps-nav-bar-back-returner-box', tag:'div', cn:'wait-pad disable'});

		// o.NavBar.MenuPad = {};
		// o.NavBar.MenuPad.Box = bx.createElement({id:'gapps-nav-bar-menu-pad-box', tag:'div', cn:'menu-pad disable'});

		o.NavBar.Icon.LogoBox = o.NavBar.IconBox.createElement({id:'gapps-nav-bar-icon-logo-box', tag:'div', cn:'logo'});
		o.NavBar.Icon.Logo = o.NavBar.Icon.LogoBox.createElement({id:'gapps-nav-bar-icon-logo-icn', tag:'img'});

		if(isObject(Pa.Icon||null)){
			var icstr = isString(Pa.Icon.normal||false);
			if(icstr){
				o.NavBar.Icon.Logo.element.src = Pa.Icon.normal;
			}

			if(!icstr){
				o.NavBar.Icon.Logo.css({display:'none'});
			}

			o.NavBar.IconBox
				.listen('mouseenter', function(){if(isString( Pa.Icon.hover||false)){o.NavBar.Icon.Logo.element.src = Pa.Icon.hover;} })
				.listen('mouseleave', function(){o.NavBar.Icon.Logo.element.src = Pa.Icon.normal; });

			o.NavBar.IconBox.replaceClass('disable', 'enable');

			if(isBoolean(Pa.Icon.clickable||'')){
				if(Pa.Icon.clickable===true){o.NavBar.IconBox.css({cursor:'pointer'});}
				else{o.NavBar.IconBox.css({cursor:'default'});}
			}

			if(isObject(Pa.Icon.on||'')){
				G.foreach(Pa.Icon.on, function(v,n){
					var f=o.NavBar.IconBox[n]||false;
					if(isFunction(f||false)){
						o.NavBar.IconBox[n](function(){window.eval(['(',v,')();'].join(''));});
					}
				});
			}

		}
		
		o.NavBar.Icon.Label = o.NavBar.IconBox.createElement({id:'gapps-nav-bar-icon-label', tag:'div', cn:'label disable'});
		if(isString(Pa.AppTitle||null)){if(!(Pa.AppTitle).isEmpty()){o.NavBar.Icon.Label.html(Pa.AppTitle).replaceClass('disable', 'enable');} }

		o.event.detect('NavBarLogoBuilt');
		return o;
	});




	API.dynamic('SetNavBarMenu', function(TB){
		var o=this, bx=o.NavBar.Box, Pa=o.Params;
		
		o.NavBar.Menu = {};
		o.NavBar.Menu.Items = [];
		o.NavBar.Menu.Box = bx.createElement({id:'gapps-nav-bar-menu', tag:'div', cn:'menu'});

		if(TB.length<=0){o.NavBar.Menu.Box.replaceClass('enable','disable');}
		
		if(TB.length>0){
			G.foreach(TB, function(v,n){
				var ob = {}; 

				G.merge(ob,v);
				ob.name=ob.name||n;
				ob.title = ob.title||'';
				ob.label = ob.label||'';
				ob.link = ob.link||null;
				ob.target = ob.target||'_self';
				ob.click = ob.click||null;
				ob.appLink = (typeof ob.appLink=='undefined')?true: ob.appLink||false;
				ob.cssSelector = ob.cssSelector||'';

				ob.id=['gapps-nav-menu-item',n,'box'].join('-');
				o.NavBar.Menu.Items[ob.name] = ob;
			});

			Pa.NavBarMenu=TB;
		}

		return o;
	});

	API.dynamic('SetNavBarTray', function(TR){
		var o=this, bx=o.NavBar.Box, Pa=o.Params;

		o.NavBar.Tray = {};
		o.NavBar.Tray.Items = [];
		o.NavBar.Tray.Box = bx.createElement({id:'gapps-nav-bar-tray', tag:'div', cn:'tray'});

		if(TR.length<=0){
			o.NavBar.Tray.Box.replaceClass('enable','disable');
		}

		if(TR.length>0){
			G.foreach(TR, function(v,n){
				var ob= {}; 

					G.merge(ob,v);
					ob.name=ob.name||n;
					ob.type = (ob.type||'').lower();
					ob.title = ob.title||'';
					ob.text = ob.text||'';
					ob.html = ob.html||'';
					ob.url = ob.url||'<?php echo HTTP_HOST . "ggn.apps/ggn-app-icon.png"; ?>';
					ob.colorize = ob.colorize||false;
					ob.color = ob.color||GLib.Style.CSS['font-color-rgb'];
					ob.click = ob.click||false;
					ob.cssSelector = ob.cssSelector||'';

					ob.id=['gapps-nav-tray-item',n,'box'].join('-');
					ob.idi=['gapps-nav-tray-item',n,'icon'].join('-');

					o.NavBar.Tray.Items[ob.name] = ob;
			});
			
			Pa.NavBarTray=TR;
		}

		return o;
	});

	API.dynamic('SetNavBar', function(TB,TR){
		var o=this, Pa=o.Params, Elt=o.ParentElement;

		if(isFunction(GAppsNavBar||null)){
			if(isObject(TB||null) && isObject(TR||null)){
				o.SetNavBarLogo();
				o.SetNavBarMenu(TB||null);
				o.SetNavBarTray(TR||null);

				o.NavBar.Ability = GAppsNavBar(o.NavBar).Init({Mounting:o});
				o.NavBar.Ability.Show();
			}
			else{
				GToast('Donnée nom-conformes');	
			}
		}
		else{
			GToast('API introuvable : < ggn.application.navbar >');
		}

		return o;
	});




	API.dynamic('Init', function(){
		var o=this;
		o.event.detect('Init');

		o.ParentElement = o.staticParent.Element;
		o.PageBody = G('body');

		o.Sheet = {};
		o.Sheet.Box = o.ParentElement.Sheet;

		o.SplashScreen={};
		o.SplashScreen.Box = o.ParentElement.SplashScreen;
		o.SplashScreen.Status = false;

		o.NavBar={};
		o.NavBar.Box = o.ParentElement.NavBar;
		o.NavBar.Status = false;

		o.Main = {};
		o.Main.Box = o.ParentElement.Main;

		o.StatusBar = {};
		o.StatusBar.Box = o.ParentElement.StatusBar;
		o.StatusBar.Status = false;

		G(function(){o.UpdateLayout();}).interval(360);

		return o.InitParams();
	});





	API.dynamic('gURL', function(u){
		var o=this,Pa=o.Params;
		return [Pa.COM['pattern'],u].join('');
	});


	API.dynamic('OpenerCOM', {
		Allow:{
			Attempt:true
		}
	});

	API.dynamic('RemoteFn', function(fct){
		var f=false,p=false,nm=false,pnm=false,ex=fct.split('.'),li=ex.length-1;
		G.foreach(ex,function(v,n){
			if(n==0){
				f=G;
			} 
			else{
				f=f[v];
				nm=v;

				if(n==(li-1)){
					p=f;
					pnm=v;
				}
			} 
		});
		return {parent:p,parentName:pnm,fn:f,name:nm};
	});

	API.dynamic('OpenCOM', function(c){
		var o=this,a=arguments,Pa=o.Params, com=Pa.COM, a=arguments, r=a[1]||false;

		if(c){

			c.URI=c.URI||false;

			if(!isString(c.URI)){
				o.event.detect('OnURIUninvailable', o, c);
				GToast('GAPPS Erreur : Lien invalide').bubble();
			}

			else{ 
				var urm=Pa.URL;
				c.mode='POST';
				c.URIAttempt = (c.URI.substr(0, urm.length)==urm)?c.URI.substr(urm.length):c.URI;
				c.data=['gapp-instance=1&gapp-link-internal=1&',(isObject(com.RequestInjection||false)?[com.RequestInjection.join('&'),'&'].join('') :''),'',(c.data||''),''].join('');

				c.headers={'X-Requested-Width':'XMLHttpRequest' };

				c.useTrace = isObject(c['trace']||false);
				c.trace = c.trace||{};

				// alert(c['OnPopStateEventName']||' no OnPopStateEventName');
				// alert(c['PopStateEvent']||' no PopStateEvent');

				var jx=GAjax(c).XHR(); 

				// if(isBoolean(c['PopStateEvent']||'') && c.PopStateEvent===true && isString(c['OnPopStateEventName']||'') && !(c['OnPopStateEventName']||'').isEmpty() ){
				// 	var f=o.RemoteFn(c.OnPopStateEventName);
				// 	f.parent[f.name](JSON.parse(c['OnPopStateEventArg']||'{}'));
				// }


				jx.onSuccess=function(){
					if(c.useTrace && isFunction(c.trace['Success']||'')){
						c.trace['Success'](this, o, c);
					}
					else{
						if(isObject(o.NavBar.Ability||'')){o.NavBar.Ability.ActiveMenuItem(Pa.CurrentPage);}
						G.DOC.title = (c.title||Pa.Title||G.DOC.title).replace(/<(?:.|\n)*?>/gm, '');
						o.event.detect('OnLoadPage', this, o, c);
						if(c.useTrace && isFunction(c.trace['ForceSuccess']||'')){c.trace['ForceSuccess'](this, o, c); }
					}
				};
				jx.onError=function(){
					if(c.useTrace && isFunction(c.trace['Error']||'')){
						c.trace['Error'](this, o, c);
					}
					else{
						o.event.detect('OnErrorPage', this, o, c);
						if(c.useTrace && isFunction(c.trace['ForceError']||'')){c.trace['ForceError'](this, o, c); }
					}
				};
				jx.onFail=function(){
					if(c.useTrace && isFunction(c.trace['Fail']||'')){
						c.trace['Fail'](this, o, c);
					}
					else{
						o.event.detect('OnFailPage', this, o, c);
						if(c.useTrace && isFunction(c.trace['ForceFail']||'')){c.trace['ForceFail'](this, o, c); }
					}
				};

				o.event.detect('OnBeforeLoadPage', this, o, c);

				if(o.OpenerCOM.Allow.Attempt===false){return jx;}

				Pa.CurrentPage = c.URIAttempt;
				o.event.detect('OnWaitPage', o, c);
				
				if(r==false){
					jx.send();
				}
				if(r==true){
					return jx;
				}

			}

		}

	});


	API.dynamic('xOpenCOMHistory', []);
	API.dynamic('xOpenCOM', function(c){
		var o=this,a=arguments,Pa=o.Params;

			c.noHistory = c.noHistory||false;

			c = c||{};
			c.title=c.title||Pa.Title||G.DOC.title;
			c.URI=c.URI||false;
			c.data=c.data||null;
			c.type=c.type||':popstate';

		if(isString(c.URI) && c.type==':popstate'){
			// {URI:c.URI,data:c.data,title:c.title}

			var jx = o.OpenCOM(c, true);

				jx.event.add('success', function(){
					if(c.noHistory==false){
						var cc = {}; G.merge(cc,c);
						cc.trace=null;
						// c.OnPopStateEvent=null;
						history.pushState(cc, c.title, c.URI);
					}
				});

				jx.send();
		}

	});


	API.dynamic('COMs', function(c){
		var o=this, a=arguments,Pa=o.Params, l=G.DOC.location;

		if(c){
			c.title=c.title||Pa.Title||G.DOC.title;
			c.URI=c.URI||false;
			c.data=c.data||null;
			c.type=c.type||':popstate';

			if(isString(c.URI) && c.type==':popstate'){
				o.xOpenCOM(c);
			}
			else{
				if(c.type==':hash'){
					c.URI=(isString(c.URI))?c.URI:'';
					if(!c.URI.isEmpty()){
						o.OpenCOM({URI:c.URI,data:c.data});
					}
				}
			}

		}
		else{}

		return false;
	});


	API.dynamic('InitCOM', function(){
		var o=this,Pa=o.Params, b=Pa.BootOn||false,l=G.DOC.location.href,cP,appu=GApps.GetAppURL(), com=Pa.COM;

		cP=Pa.COM['pattern'];

		if('onhashchange' in window && 'onpopstate' in window){

			GEvent(A).listen('popstate',function(e){
				var obj=e.state;
					if(isObject(obj||'')){
						obj.PopStateEvent = true;
						obj.noHistory = true;
						o.xOpenCOM(obj);
					}
					else{history.go(0);}


			});

			GEvent(A).listen('hashchange',function(e){
				o.COMs({title:G.DOC.title, URI:(location.hash||'').substr(1), data:null, type:':hash' }); 
			});

			// GEvent(o.Sheet.Box.element).listen('mouseup',function(e){
			GEvent(document).listen('mouseup',function(e){
				var t=G(e).source(), bx=G(t),ext,isLnk,lk,lnk,ghsh,d,ctp=G(e).clickType();


				if(ctp=='mouse.click.left'&&isFunction(bx['attrib'])){
					if(isString(t.tagName||null)){
						isLnk=(t.tagName.lower()=='a')?true:false;
						lk=bx.attrib('gapp-link');
						d=bx.attrib('gapp-data');
						lnk=bx.attrib((isLnk)?'href':'gapp-href');

						// alert([lnk,lk].join('\n'))

						if(isString(lnk||undefined)&&lk=='1'){
							ext=lnk.indexOf(appu);
							ghsh = lnk.substr(0,1);

							if(ghsh=='#'){window.location.hash = lnk.substr(1) || '';}
							else{o.COMs({title:Pa.Title, URI:lnk ,data:d||null});}
							return false;
						}
						else{
							if(isString(lnk||undefined)){GDocument().href(lnk);}
						}
					}

				}

			});

			if(isString(b)){
				if(!isString(Pa.CurrentPage||null)){
					G(function(){o.COMs({title:Pa.title, URI:b ,data:null});}).timeout(1000);
				}
			}
			

		}
		
		GEvent(A).listen('load', function(){
			if(isObject(o.NavBar.Ability||'')){
				o.NavBar.Ability.ActiveMenuItem(Pa.CurrentPage);
			}
		});

		return o;
	});





	API.dynamic('Layout', {NavBar:{},Main:{},StatusBar:{}});
	API.dynamic('UpdateLayoutState', true);
	API.dynamic('UpdateLayout', function(){var o=this;

		if(o.UpdateLayoutState===false){
			return o;
		}
		else{

			var h=0,th=0,bh=0
				, nav=o.NavBar.Box
				, t=nav.Offset()

				, sta=o.StatusBar.Box
				, b=sta.Offset()

				, s=GScreen.Offset()
				;

				if(nav.css('display')!='none'){
					th=t.height;
				}

				if(sta.css('display')!='none'){
					bh=b.height;
				}

				h=s.height-(th+bh);


			th+='px';
			h+='px';
			o.Main.Box.css({top:th,height:h});
			// console.log(['new height : Main = ',h,' / nav : ', nav.css('display'),' / th : ', th,' / bh : ', bh].join(''));

			o.Layout.NavBar=t;
			o.Layout.Main=o.Main.Box.offset();
			o.Layout.StatusBar=b;
			return o;
		}

	});


	API.dynamic('Embed', function(){
		var o=this;
		o.event.detect('Embed');
		return o.Init().InitCOM();
	});


	GApps.Mount = GAppsMount;
})(window,screen,navigator);