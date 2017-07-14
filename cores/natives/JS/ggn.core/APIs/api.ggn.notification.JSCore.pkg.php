/* GougnonJS.Notification, version : 0.1, update : 151215#1307, Copyright GOBOU Y. Yannick 2015 */ 

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GNotification 0.1 ');return false;}


	API=G.API({
		name:'Notification'
		,static:{
			version:'0.1 nightly 151215.1307'
			,Status:false
			,Box:{}
			,Items:[]
			,WObj:[]
			,Ev:'click error show close'
			,allowed:false
			,SoundStatus:false
			,Sound:[]
			,SoundPlayer:function(k,f){
				var o=this,id=['ggn','notification','sound',k,'box'].join('-'),did='#',p,s,ex,v;

				did+=id; ex=G(did);
				v=(!isObject(ex['element']||''));

				if(v){
					p=G('body').create({tag:'audio',id:id});
					s=G('body').create({tag:'source'});

					p.attrib('autoplay', '');p.removeAttrib('controls');
				}

				if(!v){
					var ob=o.Sound[k]||false;
					if(isObject(ob||'')){
						p=ob.P;s=ob.S;
					}

				}

				if(isObject(p||'') && isObject(s||'')){
					var Pe=p.element;

					s.attrib('type', 'audio/mpeg');
					Pe.src=f; Pe.play();

					if(o.SoundStatus==true){Pe.muted=true;}
					if(o.SoundStatus==false){Pe.muted=false;}

					o.Sound[k]={P:p,S:s};
				}

			}

		}

		,constructor:function(){
			var o=this;

			o.static = G.Notification;
			o.args = arguments[0]||[];
			o.C = (isObject(o.args[2]||''))?o.args[2]:{};
			o.C.title = o.args[0]||false;
			o.C.html = o.args[1]||false;

			o.key = o.static.State(o.C);

			o.static.event = G.Event(o);
		}

	}).create();


	API.static('Init', function(){
		var o=this;
		o.Box.General = G('body').create({id:'ggn-notification-api',cn:'gui notification flex column pos-fixed-i hide'});

		o.Box.Header = o.Box.General.create({cn:'header shadow fx align-center gui flex row'});
			o.Box.Title = o.Box.Header.create({cn:'title', html:'Notifications'});
			o.Box.Tools = o.Box.Header.create({cn:'tools align-right gui flex row'});
				o.Box.Clean = o.Box.Tools.create({cn:'tool gui iconx color min-size align-center background-abs-center cursor-pointer'}).append('delete_sweep');
				o.Box.Hide = o.Box.Tools.create({cn:'tool gui iconx color min-size align-center background-abs-center cursor-pointer'}).append('expand_more');
				o.Box.Sound = o.Box.Tools.create({cn:'tool gui iconx color min-size align-center background-abs-center cursor-pointer'}).append('volume_up');

		o.Box.Container = o.Box.General.create({cn:'container align-center'});
			o.Box.Items = o.Box.Container.create({cn:'items'});
			o.Box.Item=[];

		o.Box.Footer = o.Box.General.create({cn:'footer cursor-pointer'});
			o.Box.FooterLabel = o.Box.Footer.create({cn:'label',html:'&nbsp;'});


		o.Sto = (isUndefined(Storage||''))?false: sessionStorage;

		o.WNObj = A.Notification || A.mozNotification || A.webkitNotification;

		o.WNObj.requestPermission(function(p){o.allowed=p;});

		o.RemoveFx(o.Box.Header);


		o.Box.Footer.click(function(){o.Show();});
		
		o.Box.Clean.click(function(){o.Clean();});

		o.Box.Hide.click(function(){o.Hide();});

		o.Box.Sound.click(function(){o.SoundToggle();});


		o.SoundStatus = (o.Sto) ? (isString(o.Sto['SoundStatus']||false)? ((o.Sto.SoundStatus=='true')?true:false): o.SoundStatus): o.SoundStatus;
		o.SoundStatus = !o.SoundStatus;
		o.SoundToggle();


		GEvent(A).listen('resize',function(){o.Layout();});
		
		return o.Layout();

	})


	.static('SoundToggle', function(){
		var o=this,snd=o.Box.Sound,a=arguments,m=a[0]||false, v= (o.SoundStatus==m);


		if(v){
			snd.removeClass('audio-on');
			snd.addClass('audio-off');
		}
		if(!v){
			snd.removeClass('audio-off');
			snd.addClass('audio-on');
		}
			
		o.SoundStatus=!o.SoundStatus;
		if(o.Sto){o.Sto.SoundStatus = o.SoundStatus;}

		return o;
	})


	.static('Clean', function(){
		var o=this,its=o.Items;
		G.foreach(its,function(it,k){if(isObject(it||'')){o.Remove(k);}});
		return o;
	})



	.static('Show', function(){
		var o=this,Gn=o.Box.General;

		if(Gn){
			var off=Gn.Offset(),gs=GScreen.Offset(),x=gs.width.nuspacer(off.width);
			x+='px';
			
			Gn.css({height:'100vh', left:x});
			Gn.removeClass('hide');
			Gn.addClass('show');
			o.Layout();
			o.Status=true;
		}
		
		return o;
	})



	.static('Hide', function(){
		var o=this,Gn=o.Box.General;

		if(Gn){
			Gn.removeClass('show');
			Gn.addClass('hide');
			o.Layout();
			o.Status=false;
		}
		
		return o;
	})



	.static('Layout', function(){
		var o=this,Gn=o.Box.General;

		if(Gn){
			var off=Gn.Offset(),gs=GScreen.Offset(),x=gs.width.nuspacer(off.width);
				x+='px';
			Gn.css({left:x});
		}
		
		return o;
	})



	.static('Len', function(){
		var o=this,its=o.Items,n=0
			;

		G.foreach(its,function(it,k){
			if(isObject(it||'')){n++;}
		});

		return n;
	})



	.static('DisplayCleaner', function(){
		var o=this, l=o.Len();

		if(l>0){
			o.Box.Clean.removeClass('disable').addClass('enable');
			o.Box.General.addClass('show');
		}
		else{
			o.Box.Clean.removeClass('enable').addClass('disable');
			o.Hide();
		}
		return o;
	})


	.static('RemoveFx', function(ob){
		var a=arguments
			,cn=a[1]||'fx'
			,f=a[2]||'fx'
			,t=a[3]||300
			;

		if(isObject(ob||'')){
			if(isFunction(ob.removeClass||'')){
				G(function(){ob.removeClass(cn); if(isFunction(f||'')){f();} }).timeout(t);
			}
		}

		return this;
	})


	.static('State', function(cfg){

		if(isObject(cfg||'')){
			var o=this,k=o.Items.length,Ev=o.Ev.split(' ');
			o.Items[k] = cfg;
			return k;
		}

		return false;
	})


	.static('GetEventsActions', function(Opt){
		var o=this,Op=[];

		Op['click'] = function(e){ if(isFunction(Opt.click||'')){Opt.click(e);} };
		Op['error'] = function(e){if(isFunction(Opt.error||'')){Opt.error(e);} };
		Op['show'] = function(e){if(isFunction(Opt.show||'')){Opt.show(e);} };
		Op['close'] = function(e){if(isFunction(Opt.close||'')){Opt.close(e);} };

		return Op;
	})


	.static('nBuild', function(cfg){
		var o=this, k=isNaN(cfg.key)?o.WObj.length:cfg.key,ins,Evt=o.GetEventsActions(cfg);

		ins = new o.WNObj(cfg.title, cfg);
			ins.onclick = Evt.click;
			ins.onerror = Evt.error;
			ins.onshow = Evt.show;
			ins.onclose = Evt.close;
		o.WObj[k] = ins;
		return o;
	})


	.static('Remove', function(k){
		var o=this, k=isNaN(k) ? false: k,itm, ex=o.Box.Item[k]||false,Evt,cfg=o.Items[k]||false;

		if(ex&&cfg){
			itm=o.Box.Item[k];
			Evt=o.GetEventsActions(cfg);

			itm.addClass('closing');
			o.RemoveFx(itm,'closing', function(){

				o.Items[k] = false;
				itm.remove();

				if(o.Sound[k]||false){
					var s=o.Sound[k];
					if(s['P']||false){s.P.remove();}
					if(s['S']||false){s.S.remove();}
				}

				o.DisplayCleaner();

				if(isFunction(Evt.close||'')){Evt.close();}
			},150);
		}


		return o;
	})


	.static('Build', function(cfg){
		var o=this, k=isNaN(cfg.key) ? false: cfg.key,itm,mi,tx,tls,z=k+1, ttl,ctn,cls, ex=o.Box.Item[k]||false,Evt=o.GetEventsActions(cfg);

		if(!ex){
			itm=o.Box.Items.create({cn:'item shadow gui flex row'});
		}

		if(ex){
			itm=ex;
			itm.html('');
		}

		if(isString(cfg.icon||false)){
			var uic='url(';uic+=cfg.icon;uic+=')';

			mi=itm.create({cn:'background-abs-center'});
			mi.css({'background-image':uic});
			mi.click(Evt.click);

		}

		tx=itm.create({cn:'text'});
			ttl=tx.create({cn:'title text-ellipsis'});
			ctn=tx.create({cn:'content'});

		tls=itm.create({cn:'tools align-right gui flex row'});
			cls=tls.create({cn:'tool gui iconx background-abs-center color min-size align-center cursor-pointer'}).append('close');

		itm.css({zIndex:k});

		tx.click(Evt.click);
		cls.click(function(){
			o.Remove(k);
			return false;
		});

		ttl.append(cfg.title||'');
		ctn.html(cfg.html||cfg.body||'');

		G(function(){
			itm.addClass('fx');
			o.RemoveFx(itm,false, function(){itm.addClass('show');});
		}).timeout(100);

		o.Box.Items.insertBefore(itm.element, o.Box.Items.prop('firstChild') );

		if(isFunction(Evt.show||'')){Evt.show(o);}

		o.Box.Item[k]=itm;	
		return o;
	})



	.dynamic('Show', function(){
		var o=this,o_=o.static,k=isNaN(o.key)?false:o.key;
			
		if(isObject(o_.Items[k]||'') ){
			var cfg = o_.Items[k],hf=P.hasFocus(), gn=o_.Box.General
				, iCn=gn.hasClass('show')
				;

			cfg.key=k;

			if(!iCn){
				o_.Show();
			}

			o_.SoundPlayer(k,cfg.sound||null);

			if(!hf){
				if(o_.allowed=='granted'){o_.nBuild(cfg);}
			}

			o_.Build(cfg);

			o_.DisplayCleaner();

		}

		else{return false;}

	})

	.dynamic('Config', function(){
		var o=this,o_=o.static,k=isNaN(o.key)?-1:o.key;
		return o_.Items[k]||false;
	})

	;


	return GNotification;

})(window,document,navigator).Init();

