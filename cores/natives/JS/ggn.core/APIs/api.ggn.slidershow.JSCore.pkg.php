(function(A,P,I,gAPI){var api;



	api=gAPI({

		name:'SliderShow'

		,static:{
			Version:'0.1'
			,Attrib:{Key:'ggn-slidershow-key'}
			,Obj:function(k){var o=this; return o.Object.Item[k]; }
			,Get:function(e){var ge=G(e),k=ge.data(this.Attrib.Key)||false, o=this.Obj(k); return o;}
			,Object:{
				Item:[]
				,Add:function(ob){this.Item.push(ob);}
			}
		}
		,constructor:function(inst){
			var o=this;
			o.stc=o.STATIC;
			// o.args=inst||[];

			o.instance=o.ARGS[0]||false;
			o.event=G.Event(o);
			o.key='';
			o.key+=o.stc.Object.Item.length;
			o.stc.Object.Add(o);
			o.instance.data(o.stc.Attrib.Key, o.key);
		}
	}).create();

	api.dynamic('Init', function(cfg){
		var o=this;
		o.status=true;
		o.aProcess=false;
		o.counter=0;
		o.browser={};
		o.items=[];
		o.cfg=cfg||{};
		o.cfg.browser = o.cfg.browser||{};
		o.autoplay = o.cfg.autoplay||false;
		o.timer = o.cfg.timer||5000;
		o.loop = o.cfg.loop||false;
		// o.inheritSize = (isBoolean(o.cfg.inheritSize||'')) ? o.cfg.inheritSize : true;
		o.panel = o.cfg.panel||false;
		o.progress = o.cfg.progress||false;
		o.lstatus = o.cfg.lstatus||false;
		o.gitems = o.cfg.items||false;
		o.browser.next = o.cfg.browser.next||false;
		o.browser.previous = o.cfg.browser.previous||false;

		o.hideProgressBar = o.cfg.hideProgressBar||false;
		o.notUseDefaultTransition = o.cfg.notUseDefaultTransition||false;

		o.ofs=o.instance.parentNode.offset();

		o.container = o.instance.child('.content', true)[0];


		return o._actions()._items()._xinit();
	})

	.dynamic('_xinit', function(){var o=this;
		o.event.detect('init',o);
		return o;
	})

	.dynamic('_actions', function(){var o=this;

		if(isObject(o.browser.next||false)){o.browser.next.on('click',function(){o.next();});}

		if(isObject(o.browser.previous||false)){o.browser.previous.on('click',function(){o.previous();});}

		return o;
	})

	.dynamic('_items', function(){var o=this;

		// o.ofs=o.instance.offset();

		// var w=o.ofs.width,_w=w,h=o.ofs.height,_h=h;
		// _w+='px'; _h+='px';

		if(isObject(o.gitems||false) && isFunction(o.gitems['node']||false)){

			o.event.detect('beforeDeploy',o);

			G.foreach(o.gitems.nodes(), function(i,k){

				i.attrib(o.stc.Attrib.Key, o.key);

				o.items[k]=i;

			},false,false,{});

			o.event.detect('deploy',o);

		}
		if(o.autoplay===true){
			o.instance.on('mouseenter',function(evt){o.status=false;o.pause(evt);});
			o.instance.on('mouseleave',function(evt){o.status=true;o.play(evt);});
			G(function(){o.go(0);}).timeout(100);
		}
		return o;
	})

	.dynamic('next', function(){var o=this; o.event.detect('next',o); G(function(){o.go(o.counter+1);}).timeout(100); return o;})
	.dynamic('previous', function(){var o=this; o.event.detect('previous',o); G(function(){o.go(o.counter-1);}).timeout(100);return o;})


	.dynamic('pause', function(evt){
		var e=GEvent(evt).source(),o=GSliderShow.Get(e);
		if(!isObject(o.aProcess||'')){return false;}
		o.aProcess.pause();
		if(o.autoplay===true){
			o.event.detect('pause',o);
		}
	})
	.dynamic('play', function(evt){
		var e=GEvent(evt).source(),o=GSliderShow.Get(e); 
		if(!isObject(o.aProcess||'')){return false;}
		o.event.detect('play',o);
		if(o.autoplay===true){
			o.aProcess.play();
		}
	})

	.dynamic('ProgressDisplay', function(m){var o=this,m=m||false,ep=G(o.progress.prop('parentNode'));

		if(m==true){o.event.detect('showProgressBar',o); }
		else{o.event.detect('hideProgressBar',o); }

		return o._showPart(m||false, ep);
	})

	.dynamic('_showPart', function(){var o=this,a=arguments,e=a[1]||false,m=(isBoolean(a[0]) ? a[0] : true);

		if(m===true&&isObject(o.progress||'')){
			o.event.detect('showPart',e);
			e.addClass('enable');
		}

		if(m===false&&isObject(o.progress||'')){
			o.event.detect('hidePart',e);
			e.addClass('disable');
		}

		return o;
	})

	.dynamic('_autoplay', function(){var o=this,a=arguments,m=a[0]||false,ls=o.lstatus||false;

		if(o.autoplay===true){

			o.event.detect('autoplay',o); 

			if(m===true){o.next();}

			else{

				if(isObject(o.aProcess||'')){o.aProcess.stop();}

				o.progress.css({width:'0%'});

				o.aProcess=GAMP({
					form:0.1,to:99.9,timeline:o.timer*1
					,start:function(){ }
					,pause:function(){if(isObject(ls)){ls.html('pause');} }
					,play:function(){if(isObject(ls)){ls.html('play_arrow');} }
					,hit:function(){var l=this.level; if(isObject(o.progress||false)){l+='%'; o.progress.css({width:l});} }
					,done:function(){o.next();}
				}).init();

				o.ProgressDisplay(!o.hideProgressBar);

				if(o.status===true){o.aProcess.start();}
			}
		}

		return o;
	})

	.dynamic('go', function(k){
		var o=this
			,el=o.items[k]||false
			,lvl=o.counter
			,sns=(k>lvl)?true:false
			,lim=o.items.length-1
		;
		
		if(isObject(o.panel||false)){
			if(isObject(el)){
				var off=el.offset(),ff=o.panel.offset(),x=off.left,x0=ff.left,proc, notu=o.notUseDefaultTransition||false;

					x*=-1;
					o.current = el;

				if(notu===false){

					G(function(){
						proc=GAMP({from:x0, to:x, timeline:200
							,start:function(){o.event.detect('change',o,k,x0,x); el.attrib('ggn-effect', 'blur-motion-in');}
							,hit:function(){var v=this.level; v+='px'; o.panel.css({left:v});}
							,done:function(){
								el.attrib('ggn-effect', 'blur-motion-out'); o.counter=k;
								G(function(){o._autoplay();}).timeout(1);
							}
						}).init().start();
						
					}).timeout(100);
						
				}

				if(notu===true){
					var l=x;l+='px';

					o.event.detect('change',o,k,x0,x);
					o.counter=k;
					o.panel.css({left:l});
					o._autoplay();

				}



			}
			else{
				if(o.loop===true){
					if(sns===true){G(function(){o.go(0);}).timeout(100);} 
					else{G(function(){o.go(lim);}).timeout(100);} 
				}
				else{}
			}
		}
		return o;
	})

	;

})(window, document, navigator, GAPI);