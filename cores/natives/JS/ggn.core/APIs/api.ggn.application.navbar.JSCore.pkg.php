/* GougnonJS.Application.NavBar, version : 0.1, update : 15050902#1459, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GApps.NavBar 0.1 '); return false; }

	if(typeof GApps!='function'){alert('Cette API a besoin de son API parente "GApps" '); return false; }

	API=G.API({
		name:'AppsNavBar'
		,static:{
			version:'0.1'
			,events:''
			,varsinit:''
		}
		,constructor:function(){
			var o=this;
			o.staticParent=G.Apps;
			o.static=G.AppsNavBar;
			o.Args=arguments[0]||[];
			o.NavBar=o.Args[0]||[];
			o.event=G.Event(o);
			o.CallBack={};
		}
	}).create();




	API.dynamic('Init', function(){
		var o=this,a=arguments;

		o.ini=a[0]||{};
		o.Mounting=o.ini.Mounting||{};

		o.Menu=o.NavBar.Menu||{};
			o.Menu.lengthEntries=0;
		o.Tray=o.NavBar.Tray||{};
			o.Tray.lengthEntries=0;
		// o.MenuPad=o.NavBar.MenuPad||{};
		
		// if(isObject(o.MenuPad||undefined)){
		// 	o.MenuPad.Box.on('click',function(){o.OpenFloatMenu();});
		// }

		return o.MenuCapacity().TrayCapacity().SmartMenuInit();
	});



	API.dynamic('Waiting', function(){var o=this,r;
		if(isObject(o.NavBar.Wait||'') && isObject(o.NavBar.Wait.Box||'')){
			var w=o.NavBar.Wait.Box;
				w.removeClass('disable').addClass('enable').removeClass('warning').removeClass('error').addClass('animate').addClass('normal');
		}
		return r;
	});

	API.dynamic('ErrorWaiting', function(){var o=this,r;
		if(isObject(o.NavBar.Wait||'') && isObject(o.NavBar.Wait.Box||'')){
			var w=o.NavBar.Wait.Box;
				w.removeClass('disable').addClass('enable').removeClass('animate').removeClass('warning').addClass('error');
		}
		return r;
	});

	API.dynamic('WarningWaiting', function(){var o=this,r;
		if(isObject(o.NavBar.Wait||'') && isObject(o.NavBar.Wait.Box||'')){
			var w=o.NavBar.Wait.Box;
				w.removeClass('disable').addClass('enable').removeClass('animate').removeClass('error').addClass('warning');
		}
		return r;
	});

	API.dynamic('StopWaiting', function(){var o=this,r;
		if(isObject(o.NavBar.Wait||'') && isObject(o.NavBar.Wait.Box||'')){
			var w=o.NavBar.Wait.Box;
				w.removeClass('enable').addClass('disable').removeClass('animate').removeClass('error').removeClass('warning').addClass('normal');
		}
		return r;
	});



	API.dynamic('OpenSmartMenuStatus', false);
	API.dynamic('SmartMenuToggle', function(){var o=this,r;
		
		if(o.OpenSmartMenuStatus===false){r=o.SmartMenuShow();}
		else{r=o.SmartMenuHide(); }

		o.event.detect('SmartMenuToggle',o);
		return r;
	});

	API.dynamic('SmartMenuInit', function(){var o=this;

		if(!isObject(o.SmartMenu||false)){
			o.SmartMenu = {};
			o.SmartMenu.Box = o.NavBar.Box.createElement({id:'gapps-nav-bar-smartmenu-box', tag:'div', cn:'smartmenu'});
			o.SmartMenu.Box.css({display:'none'});
			o.SmartMenu.Items = {};
			o.SmartMenu.Items.Box = o.SmartMenu.Box.createElement({id:'gapps-nav-bar-smartmenu-items-box', tag:'div', cn:'items gui space'});
		}
		
		return o;
	});

	API.dynamic('SmartMenuShow', function(){var o=this,m=o.NavBar.Box;
		var bx=o.SmartMenu.Box,h;
			h=m.offset().height; h+='px';
			bx.css({top:h,display:'block'});

		o.OpenSmartMenuStatus=true;
		G(function(){
			bx.removeClass('hide').addClass('show');
		}).timeout(1);
		o.event.detect('SmartMenuDisplay',o);
		return o.SmartMenu||false;
	});

	API.dynamic('SmartMenuHide', function(){var o=this;
		var bx=o.SmartMenu.Box;
			
		o.OpenSmartMenuStatus=false;
		G(function(){
			bx.removeClass('show').addClass('hide');
			G(function(){bx.css({display:'none'}); }).timeout(150);
		}).timeout(1);
		o.event.detect('SmartMenuHidden',o);
		return o.SmartMenu||false;
	});



	API.dynamic('OpenFloatMenu', function(){var o=this;
		o.FloatMenu = o.FloatMenu||{};

		o.FloatMenu.Box = o.FloatMenu.Box||G('body').createElement({id:[o.Mounting.Sheet.Box.prop('id'),'float-menu-box'].join('-'), tag:'div', cn:'ggn-app-float-menu-normal'});
		o.FloatMenu.AC = o.FloatMenu.ACloser||o.FloatMenu.Box.createElement({tag:'a', cn:'closer'});
		o.FloatMenu.Closer = o.FloatMenu.Closer||o.FloatMenu.AC.createElement({tag:'div', cn:'closer', html:'Fermer'});
		o.FloatMenu.Content = o.FloatMenu.Content||o.FloatMenu.Box.createElement({tag:'div', cn:'content gui flex'});
			o.FloatMenu.Title = o.FloatMenu.Title||o.FloatMenu.Content.createElement({tag:'div', cn:'title'});
			o.FloatMenu.Items = o.FloatMenu.Items||o.FloatMenu.Content.createElement({tag:'div', cn:'items gui flex row'});
			o.FloatMenu.Tray = o.FloatMenu.Tray||o.FloatMenu.Content.createElement({tag:'div', cn:'tools align-bottom gui flex'});

		o.FloatMenu.Closer.on('click',function(){o.CloseFloatMenu();});
		o.FloatMenu.AC.attrib('href','javascript:').on('click',function(){return false;});

		o.FloatMenu.Items.html('');
		o.FloatMenu.Tray.html('');
		o.FloatMenu.Box.css({display:'block !important'});

		G(function(){
			o.FloatMenu.Box.replaceClass('close', 'open');
			o.FloatMenu.Items.append(G('#gapps-nav-bar-menu').element);
			o.FloatMenu.Tray.append(G('#gapps-nav-bar-tray').element);
			G('body > .gapps').attrib('ggn-effect', 'blur-motion-in');
		}).timeout(1);


		if(isFunction(G['KeyShot']||false)){
			var escky = GKeyShot(function(){o.CloseFloatMenu();}).key('ESCAPE');
			G(document).keypress(function(evt){escky.detect(evt,false);});
		}



	});

	API.dynamic('CloseFloatMenu', function(){var o=this;
		if(!isObject(o.FloatMenu)){return o;}
		if(isObject(o.FloatMenu.Box||undefined)){
			var menu=G('#gapps-nav-bar-menu'), tray=G('#gapps-nav-bar-tray');

			o.FloatMenu.Box.replaceClass('open', 'close');
			G('body > .gapps').attrib('ggn-effect', 'blur-motion-out');


			o.NavBar.Box.insertBefore(menu.element, o.NavBar.Wait.Box.prop('firstChild').nextSibling);

			G(function(){
				o.NavBar.Box.insertBefore(tray.element, G('#gapps-nav-bar-menu').prop('nextSibling'));
				o.FloatMenu.Box.css({display:'none'});
			}).timeout(100);

		}
	});

	API.dynamic('AddMenu', function(m){
		var o=this,mi=o.Menu.Items,k=m.name||['undefined','menu','item',o.Menu.lengthEntries].join('.');
		o.Menu.Items[k]=m;
		o.MenuCapacity(k);
	});

	API.dynamic('RebuildMenu', function(){
		var o=this,a=arguments;
		o.Menu.Items=[];
		o.DestroyMenu();
		for(var k in a){var v=a[k];o.AddMenu(v);};
	});

	API.dynamic('DestroyMenu', function(m){
		var o=this;
		o.Menu.Items=[];
		o.Menu.Box.html(' ');
	});

	API.dynamic('MenuCapacity', function(){
		var o=this, bx=o.NavBar.Box, mi=o.Menu.Items,count=0,M=o.Mounting,Pa=M.Params,a=arguments,k=a[0]||false,pont=a[1]||o.Menu.Box;

		G.foreach(mi, function(ob,n0){
			count++;

			if(k!==false){
				if(n0==k){}
				else{return false;}
			}

			ob.appLink = (typeof ob.appLink=='undefined')?true: ob.appLink||false;

			if(isString(ob.link)){
				ob.LinkBox = pont.createElement({id:[ob.id,'lnkBox'].join('-'), tag:'a', cn:'atem'});
				ob.Box = ob.LinkBox.createElement({id:ob.id, tag:'div', cn:'item'});
				ob.LinkBox.attrib('href', ob.link||'javascript:return false;');
				ob.LinkBox.attrib('target', ob.target||'_self');
			}

			if(!isString(ob.link)){
				ob.Box = pont.createElement({id:ob.id, tag:'div', cn:'item'});
			}

			if(isString(ob.link||null)){ob.Box.attrib('gapp-href', ob.link);}
			if(ob.appLink===true){ob.Box.attrib('gapp-link', '1');}
			
			ob.Box.html(ob.label||'');
			ob.Box.attrib('title', ob.title||'');
			// ob.Box.append(ob.title||'');


			if(isString(ob.linkData||null)){ob.Box.attrib('gapp-link-data', ob.linkData);}

			if(ob.appLink===true && isObject(ob.LinkBox||false)){ob.LinkBox.on('click',function(){return false;});}



			if(typeof ob.click != 'undefined'){

				if(isFunction(ob.click||'')){
					ob.Box.css({cursor:'pointer'});
					ob.Box.on('click',function(ev){ob.on('click',ev);}); 
				}

				else if(isString(ob.click||false)){
					ob.Box.css({cursor:'pointer'});
					ob.Box.on('click',function(){
						window.eval(['(', ob.click,')("',(M.Name||false),'","',n0,'")'].join(''));
					}); 
				}
			}

			if(isString(ob.cssSelector||undefined)){
				var cn=(ob.cssSelector||'').split(' ');
				for(var kcn in cn){var cnn=cn[kcn]||''; if(!cnn.isEmpty()){ob.Box.addClass(cnn);}}
			}

		});


		o.Menu.lengthEntries=count;
		o.AutoDisplayMenu();
		return o;
	});





	API.dynamic('TrayPadBox', false);

	API.dynamic('TrayCapacity', function(){
		var o=this, bx=o.NavBar.Box, mi=o.Tray.Items,count=0,a=arguments,pont=a[0]||o.NavBar.Tray.Box,M=o.Mounting,Pa=M.Params;

		if(!isObject(o.TrayPadBox)){
			o.TrayPadBox = o.NavBar.Tray.Box.createElement({id:[o.NavBar.Tray.Box.prop('id'),'menu-pad-mini'].join('-'), tag:'div', cn:'menu-pad-mini'});
			o.TrayPadBox.on('click',function(){o.OpenFloatMenu();});
		}

			
		G.foreach(mi, function(ob,n0){

			ob.Box = pont.createElement({id:ob.id, tag:'div', cn:'item'});
			ob.type = (ob.type||'').lower();
			ob.colorize = ob.colorize||false;

			if(ob.type=='icon'){
				ob.Box.addClass('icn');
				ob.Icon = ob.Box.createElement({id:ob.idi, tag:'img', cn:'icon'});
				ob.Icon.element.src = [(ob.url||'<?php echo HTTP_HOST . "ggn.apps/ggn-app-icon.png"; ?>')
					, '?mode=-gd&width=20&height=20'
					, '&quality='
					, Pa.ImageQuality||'-medium'
					, '&'
					, (ob.colorize===true)?GLib.Style.Filter({'colorize':ob.color||GLib.Style.CSS['font-color-rgb']}):''
					].join('');
				ob.Box.attrib('title', ob.title||'');
			}

			if(isString(ob.link||undefined)){
				ob.Box.attrib('gapp-href', ob.link);
				if(isObject(ob.Icon||'')){ob.Icon.attrib('gapp-href', ob.link);}
			}
			if(ob.appLink===true){
				ob.Box.attrib('gapp-link', '1');
				if(isObject(ob.Icon||'')){ob.Icon.attrib('gapp-link', '1');}
			}
			if(ob.appLink!==true){
				ob.Box.attrib('gapp-link', '0');
				if(isObject(ob.Icon||'')){ob.Icon.attrib('gapp-link', '0');}
			}
			
			if(ob.type=='text' || ob.type=='text/plain'){ob.Box.append(ob.text||''); ob.Box.addClass('text');}
			if(ob.type=='html' || ob.type=='text/html'){ob.Box.html((ob.html||'').stripSlashes()); ob.Box.addClass('html');}

			if(isString(ob.click)){
				ob.Box.css({cursor:'pointer'});
				ob.Box.on('click',function(){
					window.eval(['(', ob.click,')("',o.Mounting.Name,'","',n0,'")'].join('')); 
				}); 
				if(isObject(ob.Icon||'')){
					ob.Icon.on('click',function(){
						window.eval(['(', ob.click,')("',o.Mounting.Name,'","',n0,'")'].join('')); 
					}); 
				}
			}

			if(isString(ob.cssSelector||undefined)){
				var cn=(ob.cssSelector||'').split(' ');
				for(var kcn in cn){var cnn=cn[kcn]||''; if(!cnn.isEmpty()){ob.Box.addClass(cnn);}}
			}

			count++;
		});

		o.Tray.lengthEntries=count;

		o.AutoDisplayTray();
		return o;
	});







	API.dynamic('Show', function(){
		var o=this,Elt=o.staticParent.Element, bx=Elt.NavBar , bm=o.Mounting.Main.Box , mo, h;
		o.event.detect('ShowNavBar',o);
			bx.addClass('enable-flex');
			// bx.css({display:'flex !important'});
			mo = bx.Offset();
			h=mo.height;
			h+='px';
			bm.css({top:h});
			o.NavBar.Status = true;
		o.event.detect('NavBarDisplay',o);


		GEvent(A).listen('resize', function(){o.AutoDisplayMenu().AutoDisplayTray();});

		return o;
	});




	API.dynamic('AutoDisplayMenu', function(){
		var o=this;
		// if(o.Menu.lengthEntries<=0){o.MenuPad.Box.removeClass('enable').addClass('disable');}
		// else{o.MenuPad.Box.removeClass('disable').addClass('enable');}
		return o;
	});




	API.dynamic('AutoDisplayTray', function(){
		var o=this;
		// if(o.Tray.lengthEntries<=0){o.TrayPadBox.removeClass('enable').addClass('disable');}
		// else{o.TrayPadBox.removeClass('disable').addClass('enable');}
		return o;
	});




	API.dynamic('Hide', function(){
		var o=this,Elt=o.ParentElement, bx=o.NavBar.Box , bm=o.Mounting.Main.Box;
		o.event.detect('HideNavBar');
			bx.removeClass('enable-flex').addClass('disable');
			// bx.css({display:'none'});
			bm.css({top:'0px'});
			o.NavBar.Status = false;
		o.event.detect('NavBarHidden');
		return o;
	});




	API.dynamic('GetMenuItemsBy', function(n){
		var o=this, mi=o.Menu.Items,z=[];
		
		for(var k in mi){
			if(typeof mi[k][n]!='undefined'){
				z[k]=mi[k];
			}
		}

		return z;
	});



	API.dynamic('Insert', function(itm,pos){
		var o=this;
		o.NavBar.Box.insertBefore(itm, pos);
		// o.NavBar.Box.insertBefore(menu.element, o.NavBar.Wait.Box.prop('firstChild').nextSibling);

	});



	API.dynamic('ActiveMenuItem', function(m){var o=this;
		if(!isString(m)){return o;}
		var  M=o.Mounting,Pa=M.Params,pat=Pa.COM['pattern'], me=m.split(pat), fme=o.GetMenuItemsBy('link'),urm=Pa.URL;

		for(var k in fme){
			if(typeof fme[k]=='object'){
				var f=fme[k],ur=f.link, u=(ur.substr(0, urm.length)==urm)?ur.substr(urm.length):ur,m0=u.split(pat);

				if(isObject(f.Box||undefined)){
					if(me[0]==m0[0]){f.Box.addClass('active');}
					else{f.Box.removeClass('active'); continue;}
				}
			}
		}

		return o;
	});





	GApps.NavBar = GAppsNavBar;
})(window,screen,navigator);