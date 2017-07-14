/* GougnonJS.ScrollBar, version : 0.1, update : 160210.1636, Copyright GOBOU Y. Yannick 2015 */ <?php global $_DPO_DEVICE; ?>

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GScrollBar 0.1 ');return false;}

	API=G.API({
		name:'ScrollBar'
		,static:{
			version:'0.1 nightly, Feb 2016, 160219.0802'
			,Status:false
			,LetWheelNow:false
			,C:0
			,isMobile:<?php echo $_DPO_DEVICE->current=='-c' ? 'false': 'true'; ?>
			,Built:[]
			,Els:[]
			,CallBack:[]
			,Wheel:{
				Action:'GGN.ScrollBar.Wheel.Action'
				,Delta:15.5
			}
			,Track:{
				Drag:{
					Y:'GGN.ScrollBar.Track.Drag.Y'
					,X:'GGN.ScrollBar.Track.Drag.X'
				}
			}
			,Scroll:{
				X:'GGN.ScrollBar.Scroll.X'
				,Y:'GGN.ScrollBar.Scroll.Y'
			}
		}

		,constructor:function(){
			var o=this;
				o.args = arguments[0]||[];
				o.Box = o.args[0]||[];
				o.event = G.Event(o);
		}

	}).create();


	API.static('AutoDetect', function(){
		var o=this,d;
			o.dyn = G.ScrollBar;
			d,get = G('[ggn-scrollbar]');


		if(!isObj(get)){return false;}
		
		d = get.nodes();

		if(o.isMobile===true){return o;}

		G.foreach(d,function(v,k){

			var e=v,idx=o.IndexOf(e);

			o.Els[k] = o.Els[idx]||e;

			if(!isObject(v)){return false;}

			o.Built[k] = o.Built[idx]||o.Build(v);

		},false,false,{});

		G.foreach(o.Built,function(oc,k){

			if(!isObject(oc)){return false;}

			var v=o.HasBeenResized(oc,k);


			if(v){

				oc.Build();

				var bx=oc.Box, bxc=oc.Container ,x=oc.scrollLeft||1,y=oc.scrollTop||1 ,ofi=bx.offset(),of=bxc.offset()

					,tw=(of.scrollWidth-ofi.width).abs()
					,th=(of.scrollHeight-ofi.height).abs()

					,px=x.percent(tw).floor()||1
					,py=y.percent(th).floor()||1

				;

				var ofi=bxc.offset(),nx=(px.cpercent(ofi.width)||0).floor(),ny=(py.cpercent(ofi.height)||0).floor();

					nx = px;
					ny = py;

					nx=isFinite(nx)?nx:0;
					ny=isFinite(ny)?ny:0; 

				if(oc.Axe=='x'||oc.Axe=='x:y'){oc.ScrollLeft(nx);}

				if(oc.Axe=='y'||oc.Axe=='x:y'){oc.ScrollTop(ny);}

			}

		});

		G(function(){o.AutoDetect();}).timeout(100);

		return o;
	})

	.static('IndexOf', function(e){var o=this,r=-1,a=o.Els; if(isObject(e||'')){for(var k in a){if(e===a[k]){r=k;break;}}; }return r;})

	.static('HasBeenResized', function(oc,k){
		var o=this,clbk={},c=o.CallBack[k]||{},bx=oc.Container.offset(),chg=false,plt=('width height scrollWidth scrollHeight').split(' ');

		G.foreach(plt, function(p){

			if(c[p]!=bx[p] && c[p] && chg===false){

				chg=true;

			}

			else{

				clbk[p]=bx[p];

			}

		},false,false,'.');

		o.CallBack[k]=clbk;
		return chg;
	})

	.static('Build', function(el){
		return this.dyn(el).Init();
	})


	.dynamic('Init', function(el){
		var o=this,o_=o.STATIC,c0,c1,c2;
			o_.C++;

			o.Key=o_.C;

			o.Build();

			o.Box.attrib('scrollbar-self-key', o.Key.toString());

			GEvent(o.Box).listen('mouseenter',function(evt){

				o_.LetWheelNow=o.Key;

			});

			GMouse(o.Box).wheel(function(evt){
				var k=this.hote.attrib('scrollbar-self-key');

				if(o_.LetWheelNow==k){
					o.Move(((this._delta>0)?1:-1) * o.Delta, o_.Wheel.Action);
					GEvent(evt).prevent(true).stop();
				}

			});

		return o;
	})

	.dynamic('Build', function(el){
		var o=this,o_=o.STATIC,c0,c1,c2;


		o.x=o.x||{nm:'x', dir:'left', sz:'width', scr:'scrollWidth', cprt:false};
		o.y=o.y||{nm:'y', dir:'top', sz:'height', scr:'scrollHeight', cprt:false};
		o.Delta = o.Box.attrib('scrollbar-wheel-delta')||o_.Wheel.Delta||10;

		c0 = o.Box.child('div[scrollbar-content]',false,true);

		o.Container = c0[0]||o.Box.create({tag:'div'});
			o.Container.attrib('scrollbar-content','true');

		o.Axe = (o.Box.attrib('scrollbar-axe')||'y').lower();

		o.adi = (o.Axe=='x')?'left':'top';
		o.ada = (o.Axe=='x')?'width':'height';
		o.adr = (o.Axe=='x')?'scrollWidth':'scrollHeight';

		o.Delta = (o.Delta=='auto') ? o.Box.offset()[o.ada]/10: o.Delta;

			if(o.Axe=='y' || o.Axe=='x:y'){o._Track('y');}
			if(o.Axe=='x' || o.Axe=='x:y'){o._Track('x');}

		// G(function(){
			o._Adjust('x')._Adjust('y');
		// }).timeout(150);

		o.Box.attrib('scrolling-now','out');

		return o;
	})

	.dynamic('_Adjust', function(){
		var o=this,o_=o.STATIC,a=arguments,p=a[0]||'y'
			,bar,track,pro=o[p],sz=o[p].sz,scr=o[p].scr,dir=o[p].dir, cp=(p=='x')?'y':'x'
			,cpo=o[cp],cbr=o[cp].track||false
			;

		bar=o[p].bar;
		track=o[p].track;


		if(o.Axe=='x:y' && isObject(cbr) ){
			var cpr=cbr.offset()[cp=='x'?'height':'width']
				,bh=bar.offset()[sz]
				,th=track.offset()[sz]
				,cprt=o[p].cprt||(cpr.percent(bh).ceil()+1)
				,vbth=bh==th
				,iyh=100
				,bc={}
				,d=(dir=='left')?'right': 'bottom';
				;

			bc[sz]=(iyh-cprt);



			if(vbth){
				bc['display']='none';
			}

			if(!vbth){
				var cc={},ccm='padding';
				ccm+=d.ucFirst();
				cc[ccm]=cpr;
				cc[ccm]+='px';
				o.Container.css(cc);
				bc['display']='block';
			}

			bc[sz]+='%';
			bar.css(bc);
			
			o[p].cprt=cprt;
			// console.log(sz, iyh, cprt, bc[sz]);
		}


		return o;
	})

	.dynamic('_Track', function(){
		var o=this,o_=o.STATIC,a=arguments,p=a[0]||'y',att=p,c,cn='[';

		if(!o[p]||false){return false;}

		var bar,track,pro=o[p],sz=o[p].sz,scr=o[p].scr,dir=o[p].dir, cp=(p=='x')?'y':'x',cpo=o[cp],cbr=o[cp].track||false;

		att+='-scroll';
		cn+=att;
		cn+=']';
		
		c = o.Box.child(cn,false,true);

		bar = c[0]||o.Box.create({tag:'div', cn:'gui pos-absolute-i'});bar.html('');
			track = bar.create({tag:'div', cn:'gui pos-absolute-i track',html:'&nbsp;'});
		bar.attrib(att,'true');

		var ofi=o.Box.offset(),coff=o.Container.offset() ,bob=bar.offset() ,tod=track.offset()
			,yh=ofi[sz].percent(coff[scr])
			,coo=GScreen(o.Box).coordinate()
			,iyh
			,c={}
			;

			iyh = yh;
			o[p].size = yh;
			yh+='%';

			c[sz]=yh;

		track.css(c);

		o[p].kl = o;
		o[p].axe = p;
		o[p].bar = bar;
		o[p].track = track;
		o[p].purcent = false;
		o[p].procanim = false;
			
		o[p].Move = function(n){
			var y0,co=this, o=co.kl, a=arguments,f=a[1]||false,off=o.Container.offset(), ofi=o.Box.offset(), h=ofi[o.ada], lim=off[o.adr]-h
			,hby=co.bar.offset()
				,yf=hby[sz]
			,hy=co.track.offset()
				,y0f=hy[sz]

			,yhe=yf - y0f
			,yp
			,y,yo,yi=hby[sz]
			;

			if(hby[scr]==hy[scr]){return false;}

			y0=(n.abs()).percent(lim);

			yp=y0.cpercent(yhe);
			y=yp.percent(yf);

			y=y<0?0:y;
			y=y>100?100:y;
			yo=y;
			y+='%';

			if(f==false||f==o_.Scroll[p.upper()]){
				var c={};
					c[dir] = y;
					co.track.css(c);
				co.purcent=yo;
			}
			if(f!=false){
				
			}

			// alert(yi.cpercent(yf))

			// co.procanim = GAnimProcess({from:, to:
			// 	, hit:function(){
			// 		var s=this.level;s+='px';
			// 		co.track.css(c);
			// 	}
			// }).Init();

		};

		var mvr = GMove(track).init({moving:false,droppable:false,axe:p, backPosition:false });
			//

			// o[p]._x=false;
			// o[p]._y=false;

			mvr.onStart=function(){
				// var mr=this
				// 	, co=o[p]
				// 	, hy=co.track.offset()
				// 	;

				// co._x=hy.left;
				// co._y=hy.top;

				o.Box.removeAttrib('scrolling-now');
				// console.log('Debut du Move :: ');
			};

			mvr.onMove=function(evt){
				var mr=this
					, co=o[p]
					, hy=co.track.offset()
					, by=co.bar.offset()
					, lim=by[co.sz]-hy[co.sz]
					, coo=GScreen(o.Box).coordinate()
					, y
					, y0
					, c={}
					, cff=o.Container.offset()
					, cy
					;

				y=mr[p];
				y-=coo[p];

				y=y<0?0:y;
				y=(y>lim?lim:y);

				y0=y.percent(by[co.sz]);
				cy=y0.cpercent(cff[co.scr]);


				if(y<=lim){
					c[co.dir] = y;
					c[co.dir] += 'px';
					track.css(c);
					co.purcent=y0;
					o.MoveTo(-1*cy, o_.Track.Drag[p.upper()] );
				}


			};

			mvr.onStop=function(){
				o.Box.attrib('scrolling-now','out');
				// console.log('Arret');
			};

			// alert(mvr);

		return true;
	})

	.dynamic('Content', function(){
		var o=this,o_=o.STATIC,a=arguments,c=a[0]||false;
		return o.Container.html(c||false);
	})

	.dynamic('Move', function(n){
		var o=this,o_=o.STATIC,n=n||0,off=o.Container.offset(),l=off[o.adi]||off.top,a=arguments;
			if(isNumber(n)){l+=n;o.MoveTo(l, a[1]||false, a[2]||false);}
		return n;
	})

	.dynamic('SetScrollSize', function(){
		var o=this,sc=o.Container.offset(),x=sc.left.abs(),y=sc.top.abs();
			o['scrollLeft']=x;
			o['scrollTop']=y;
			o.Box.attrib('scroll-left', x);
			o.Box.attrib('scroll-top', y);
		return o;
	})

	.dynamic('ScrollTop', function(n){
		var o=this,o_=o.STATIC;n=n||1;
			o.MoveTo(-1*n.abs(), o_.Scroll.Y);
		return o;
	})

	.dynamic('ScrollLeft', function(n){
		var o=this,o_=o.STATIC;n=n||1;
			o.MoveTo(-1*n.abs(), o_.Scroll.X);
		return o;
	})


	.dynamic('_MoveContainer', function(f,n){
		var o=this,c={},m=o.adi,o_=o.STATIC;

		if(f==o_.Scroll.Y||f==o_.Track.Drag.Y){m='top';}
		if(f==o_.Scroll.X||f==o_.Track.Drag.X){m='left';}

		c[m] = n;
		c[m] += 'px';

		o.Container.css(c);
		o.SetScrollSize();

		// console.log(o.scrollLeft, o.scrollTop);

		return o;
	})


	.dynamic('MoveTo', function(n){
		var o=this,a=arguments,f=a[1]||false,o_=o.STATIC,n=n||0, off=o.Container.offset(), ofi=o.Box.offset(), h=ofi[o.ada], lim=off[o.adr]-h,nc=Math.abs(n);



		// alert([JSON.stringify(off), JSON.stringify(hby), scr, hby[scr], off[scr], (off[scr] == hby[scr]) ].join('\n'));

		if(isNumber(n)){

			n=(nc>lim)?-1*lim:((n>0)?0:n);
			n=n>0?0:n;

			var axe=(o.Axe=='x')?'x':'y',oaxe=o[axe]
				// ,scr=oaxe.scr
				// ,hby=oaxe.bar.offset()
				// ,hy=oaxe.track.offset()
				;

			o._MoveContainer(f,n);

			oaxe.Move = (isFunction(oaxe.Move))?oaxe.Move:G.F();

			if(f!=false){
				if(f==o_.Wheel.Action){oaxe.Move(n,false);return false;}
				if(f==o_.Track.Drag.Y||f==o_.Track.Drag.X){oaxe.Move(n,f);return false;}
			}

			oaxe.Move(n,f);
		}

		return n;
	})


	;


	return GScrollBar;

})(window,document,navigator).AutoDetect();
