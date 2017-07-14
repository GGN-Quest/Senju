/*
	GougnonJS.Progress.Arc,
	version : 0.1 	
	update : 150323.1618
	Copyright 2014 GOBOU Y. Yannick
*/
(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1,update 141211.1448')){alert('La version de GougnonJS n\'est pas compatible avec Progress.Arc 0.1 <Gougnon.JS.Framework/0.1,update 141211.1448>');return false;}

	API=G.API({
		name:'ProgressArc'
		,static:{
			version:'0.1'
			,update:'150323.1618'
			,events:'play inc dec pause stop done'
			,varsinit:'arc animation style'

			,El:{
				init:function(co,s,e,style){
					var o=this;
					// o.size = co.size;
					o.ctx = co.context;
					o.arc = co.arc;
					o.style = style;
					o.start = s;
					o.end = e;

					o.set=function(){
						var o=this, a, c=o.ctx, ar=arguments,nv=ar[0]||false;
							o.end = (isNumber(nv))?nv:o.end;
							a=o.arc;

						c.beginPath();
							c.arc(a.x, a.y, a.radius, o.start*Math.PI, o.end*Math.PI, a.clockwise);
						o.applyStyle();
						return o;
					};

					o.applyStyle=function(){
						var o=this, a=o.arc, c=o.ctx, p=o.style||false;
						if(isObject(p)){
							G.foreach(p, function(v,n){
								var vp=c[n]||false;
								if(isFunction(vp)){c[n]();}
								else if(isFunction(v)&&n=='apply'){c[n]=v;c[n]();}
								else{c[n]=v;}
							});
						}
						return o;
					};


					o.set();
					return o;
				}


			}


		}
		,constructor:function(){
			var o=this;
			o.static=G.ProgressArc;
			o.args=arguments[0]||[];
			o.canvas=o.args[0]||false;
			o.hote=G(o.canvas)||false;
			o.event=G.Event();
			o.callBack={};
		}
	}).create();


	API.dynamic('setup',function(){var o=this;
		var ini=o.static.varsinit.split(' '), evts=o.static.events.split(' '),a=arguments;

		o.cfg=a[0]||{};
		
		G.foreach(evts,function(v){var _n='on';_n+=v.ucfirst();o[_n]=o[_n]||o.cfg[v]||G.F();});
		G.foreach(ini,function(v){o[v]=o[v]||o.cfg[v]||false;});

		o.context = o.canvas.element.getContext('2d');
		o.size = o.canvas.offset();
		o.arc=o.arc||{};
		o.style=o.style||{};

		return o.init();
	});

	API.dynamic('init',function(){var o=this,ctx=o.context,ngl=o.arc;

		o.value=0;
		o.current=0;

		o.arc.start=o.arc.start||0;
		o.arc.end=o.arc.end||0;
		o.arc.radius=o.arc.radius||false;
		o.arc.clockwise=o.arc.clockwise||false;
		o.arc.x = o.size.width / 2;
		o.arc.y = o.size.height / 2;

		o.dis = (o.arc.clockwise===true)? ((2-o.arc.end)+o.arc.start): Math.abs(o.arc.end-o.arc.start);

		o.style.bg=o.style.bg||{};
		o.style.track=o.style.track||{};


		o.shape = new o.static.El.init(o, o.arc.start, o.arc.end, o.style.bg);
		o.track = new o.static.El.init(o, o.arc.start, o.arc.end, o.style.track);
		o.set(0);

		return o;
	});

	API.dynamic('clear',function(p){var o=this, c=o.context,s=o.size;
		c.clearRect(0,0,s.width*2,s.height*2);
		return o;
	});

	API.dynamic('applyUnit',function(l){var o=this;
		o.value=l;
		o.clear();
		o.shape.set();
		o.track.set(l);
		return o;
	});

	API.dynamic('cpercent',function(p){var o=this, d=o.dis, n=d.cpercent(p),a=o.arc;
		n=(a.clockwise===true)?-1*n:n;
		n+=a.start;
		return n;
	});

	API.dynamic('gpercent',function(p){var o=this, d=o.dis,a=o.arc, n=Math.abs(p-a.start).percent(d);return n;});

	API.dynamic('set',function(p){
		p=p>100?100:p; p=p<0?0:p;
		var o=this, d=o.dis, n=o.cpercent(p),anm=o.animation,a=o.arc;
		o.percent=p;
		o.current=p;

		if(anm===true){o.proc=GAMP({from:a.start,to:n,timeline:250,hit:function(){o.current=o.gpercent(this.level); o.applyUnit(this.level); }}).init().start();}
		else{o.applyUnit(n);}
		return o;
	});

	API.dynamic('inc',function(){var o=this,n=o.percent+1;
		o.set(n>100?100:n);
		return o;
	});

	API.dynamic('dec',function(){var o=this,n=o.percent-1;
		o.set(n<0?0:n);
		return o;
	}); 


})(window,screen,navigator);