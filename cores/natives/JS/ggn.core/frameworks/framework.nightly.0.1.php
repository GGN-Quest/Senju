/* GougnonJS Build #1701, version : 0.1 Nightly, update : 170210.0830, Copyright GOBOU Y. Yannick 2016 */
(function(W,D,S,N){

	"use strict";



	/* Initialisation */
	W.Gougnon,W.G;


	/* Gougnon : Ombre */
	var GC={

		version:'nightly 0.1, update 170530.1240'

		, domain : "<?php echo HTTP_HOST; ?>"

		,support:function(ver){

			var g0=this.version
			
				,_g=g0.stripSpace().stripSpecialChar().stripAlphaChar()
			
				,v0=[ver].join('')
			
				,v=v0.stripSpace().stripSpecialChar().stripAlphaChar()
			
				,i=G(_g).compare(v)
			
				,ga=false
			
				,fg=(i===true||i===null)
			;

			if(fg===true){
				
				if((/nightly/gi).test(v0)&&(/nightly/).test(g0)){
				
					ga=true;
				
				}
				
				if((/nightly/gi).test(v0)&&(/stable/).test(g0)){
				
					ga=true;
				
				}
				
				if((/stable/gi).test(v0)&&(/stable/).test(g0)){
				
					ga=true;
				
				}
				
				if((/stable/gi).test(v0)&&(/nightly/).test(g0)){
				
					ga=false;
				
				}
				
				else{
				
					ga=fg;
				
				}

			}

			return ga;

		}

		,Core:{}

		,ElaNiM:[]

		,CATs:300

		,W:W

		,D:D

		,DocElement:document.documentElement

		,iFrameDoc : function(iframe){

			return iframe.contentWindow.document||iframe.contentDocument;

		}

		,Doctype : function(doctype, doc){

			var dc = (doc||this.D);

			return (dc.doctype) ? dc.doctype.parentNode.replaceChild(doctype, dc.doctype) : null;

		}

		,getDocElement:function(){

			return (GBrowser().get('applewebkit')===true)
				?
					G.D.body
				:
					G.D.documentElement
			;
		}

		,F:function(){

			return new Function();

		}

		,N:function(){

			return new Number();
		}

		,merge:function(b,a,ty){

			this.foreach(a,function(v,n){b[n]=v;},false,false,ty||undefined);

			return b;

		}

		,merges:function(a,b,ty){

			GC.merge(a,b,ty||undefined);

			return GC.merge;

		}

		,FPV : function(ob){

			var s='';
			s+=ob.name||'undefined';
			s+='=';
			s+=escape(ob.value||'');

			return s;

		}

		,foreach:function(a,f,s,e,ty){
		
			var o=this
		
				,_a=arguments||false
		
				,a=a||{}
		
				,f=f||o.F()
		
				,s=s||0
		
				,e=e||a.length||0

				,ty=ty||false
		
				,l=0

				,prObj = Object.prototype

				,arObj = Array.prototype
		
			;

		
			e=e||false;


			for(var n in a){

				if(prObj[n] || arObj[n]){continue;}

				if(ty!=false){

					if(typeof a[n] != typeof ty){continue;}

				}

				var ss=l>=s

					,se=e===false?true:l<=e

				;

				if(ss&&se){

					f(a[n],n,a);

				}

				l++;

			};

			return a;
		}


		,HTMLEventsName:'dragdrop move readystatechange'

		,HTMLElementPath:function(ob){

			var r=this.browseHTMLElementPath(ob,function(e){return e.tagName;}).reverse();

			return r;

		}

		,browseHTMLElementPath:function(ob,func){

			var o=this,r=[],f=(typeof func=='function')?func:o.F();

			while(ob){
			
				r[r.length]=f(ob);
			
				if((ob.parentElement||'')){
			
					if(isString(ob.parentElement.tagName||null)){
			
						ob=ob.parentElement;
			
					}
			
				}
			
				else{ob=false;break;}
			
			}
			
			return r;

		}




		,getObjectType:function(tf1){
			
			var tf=[tf1].join('').toLowerCase()
			
				,it=typeof tf1
			
			;
			
			if(tf.match(/object(.*)event/gi)||tf.match(/gougnon eventobject/gi)){
			
				it='-eventobject';
			
			}
			
			else if(tf.match(/object object/gi)||tf.match(/gougnon pureobject/gi)){
			
				it='-pureobject';
			
			}
			
			else if(tf=='[object]'){
			
				if(_(ou.top).is('object')&&_(ou.frames).is('object')&&_(ou.location).is('object')&&ou===G.Window){
			
					it='-windowobject';
			
				}
			
				if(('nodeName'in ou)&&('nodeValue'in ou)&&('lastChild'in ou)&&('dir'in ou)){
			
					it='-htmlelement';
			
				}
			
				if(('fromElement'in ou)&&('toElement'in ou)&&('dataTransfer'in ou)&&('srcElement'in ou)){
			
					it='-eventobject';
			
				}
			
				if(('location'in ou)&&('parentNode'in ou)&&ou===G.DOC){
			
					it='-documentobject';
			
				}
			
			}
			
			else if(tf.match(/gougnon browserobject/gi)){
			
				it='-browserobject';
			
			}
			
			else if(tf.match(/gougnon html(.*)element/gi)){
			
				it='-htmlelement';
			
			}
			
			else if(tf.match(/object window/gi)||tf.match(/gougnon windowobject/gi)){
			
				it='-windowobject';
			
			}
			
			else if(tf.match(/object htmldocument/gi)||tf.match(/gougnon documentobject/gi)){
			
				it='-documentobject';
			
			}
			
			return it;
		}


	};




	/* Window : Request Anime Frame */	
	W.requestAnimationFrame = W['requestAnimationFrame']

		||W['webkitRequestAnimationFrame']

		||W['mozRequestAnimationFrame']

		||W['oRequestAnimationFrame']

		||W['msRequestAnimationFrame']

		||function(f){W.setTimeout(f,60/1000);};



	/* Gougnon Variables : Verification des types de variables */
	GC.foreach(('string number object boolean function undefined').split(' '), function(v){
		
		var nv = ['is', v.substr(0,1).toUpperCase(), v.substr(1).toLowerCase()].join('');
		
		W[nv] = function(r){
		
			return typeof r==v;
		
		};

	});


	W.isStr=isString;
	
	W.isFunc=isFunction;
	
	W.isObj=isObject;
	
	W.isBool=isBoolean;
	
	W.isUnd=isUndefined;




	/* Gougnon : LINE */
	// if(typeof W.__defineGetter__!='undefined'){

	// 	W.__defineGetter__('__LINE__',function(){
		
	// 		var e=new Error()
		
	// 			,s=(e.stack||'').split('\n')
		
	// 			,l=(s[1]||'')
		
	// 			,b=GBrowser()
		
	// 		;
		
	// 		if(b.appleWebkit){
		
	// 			l=(s[2]||'');
		
	// 		}
		
	// 		return l.split(':')[2]||false;
		
	// 	});

	// }



	/* Gougnon : Directeur */
	W.G=function(){
		
		var A=arguments,R,U=A[0]||false;

		/* Chaine de caratères */
		if(isString(U)){

			/* Element HTML */
			try{

				R=D.querySelectorAll(U);

				var eL=R[0]; 

				eL.__NODE_LIST__ = R;

				eL.__NODE_SELECTOR_QUERIED__ = U;

				return eL;

			}

			/* Chaine de caractère simple */
			catch(e){

				return U;
				
			}

		}

		/* Sinon */
		else{

			R=U;

		}

		return R;

	};




	/* Assimilation de Propriété et méthodes */
	W.Gougnon=G;


	/* Gougnon : Fusion */
	GC.merge(G,GC);



	/* Gougnon : Injecteur */
	var __,_inj={},inj,inject;

		__ = function(kl){return kl['prototype'];};

		inj = function(Cl,m){
			
			var o=this;

			o.Cl=Cl;

			o.M=m;

			o._ = function(n,f){
			
				var o=this,ns=n.split(' ');

				if(o.M===true){

					GC.foreach(o.Cl, function(cL){

						GC.foreach(ns, function(nm,k){

							__(cL)[nm]=f;

						});

					});
					
				}

				else{

					GC.foreach(ns, function(nm,k){

						__(o.Cl)[nm]=f;

					});

				}
			
				return o;
			
			};

			return o;

		};

		inject=function(Cl,m){ 

			return new inj(Cl,m); 

		};






/*
	Ajout de nouvelle methode à la classe 'String'
*/
_inj.String = inject(String, false)

	._('ucfirst ucFirst',function(){return [this.substr(0,1).upper(),this.substr(1)].join('');}) 

	._('firstLetters',function(k){

		var ex=this.split(' ').join(',').split('\'').join(',').split(',')

			, k=isNaN((k||1)*1) ? 1 : k

			,out=''

		;

		GC.foreach(ex,function(v,n){

			if(n<k){

				out += v.substr(0,1);

			}

		},false,false,'.');

		return out;

	})
	
	._('trim',function(){return this.replace(/ /gi,'');}) 
	
	._('empty isEmpty',function(){var str=(this.trim().length==0)?true:false;return str;}) 
	
	._('addSlashes',function(){var str=this.replace(/["]/gi,'\\"').replace(/[']/gi,"\\'");return str;}) 
	
	._('stripSlashes',function(){var str=this.replace(/[\\.]/gi,'');return str;}) 
	
	._('stripQuote',function(){var str=this.replace(/["]/gi,'').replace(/[']/gi,'');return str;}) 
	
	._('replaceURL',function(){var a=arguments,m=a[0]||false,s=this,us=s.getURL(),r=s;for(var x=0;x<us.length;x++){r=(m===false)?'':r.replace(/http/gi,'http').replace(us[x],m
		.replace(/[$]/gi,us[x]));}return r;}) 
	
	._('fullSpace',function(){var a=arguments,s; s='<div style="display:table;width:100%;height:100%;"><div style="display:table-cell;vertical-align:middle;width:100%;height:100%;">';s+=this;s+='</div></div>'; return s; }) 
	
	._('getURL',function(){var o=this,ht,st,str=o.replace(/http/gi,'http'),hta=[];ht=(str.match(/(http)/gi)||'').length;st=str;for(var x=0;x<ht;x++){var s=st.indexOf('http'),u=st.match(/(\w+):\/\/([\w.:-]+)(\/|)(\S*)/)||false;if(u!=false){var u0=u[0]||'';hta[hta.length]=u0;st=st.replace(u0,'');}}return hta;}) 
	
	._('ucwords ucWords',function(){var s=this,ss=s.split(' '),output='';for(var x=0;x<ss.length;x++){var sss=G(ss[x])||false;output+=(typeof sss=='string')?sss.ucfirst():'';output+=' ';};return output.substr(0,output.length-1);})
	
	._('isUserName',function(){return ( /^[a-zA-Z0-9.-]+$/).test(this);}) 

	._('isEmail',function(){return (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/).test(this);}) 
	
	._('lower',function(){return this.toLowerCase();}) 
	
	._('upper',function(){return this.toUpperCase();})
	
	._('aboutBlank',function(){return W.open((arguments[0]||""),this,(arguments[1]||null));})
	 
	._('escape',function(){return escape(this);})
	
	._('unescape',function(){return unescape(this);})
	
	._('stripSpecialChar',function(){return this.replace(/[&\/\\#\.,+()$~%.'":*?<>{}@áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]/gi,'');})
	
	._('stripAlphaChar',function(){return this.replace(/[a-z]/gi,'');})
	
	._('stripNumericChar',function(){return this.replace(/[0-9]/gi,'');})
	
	._('stripSpace',function(){return this.replace(/ /gi,'');})
	
	._('hasSpecialChar',function(){return (/[a-z0-9 ]/gi).test(this);})
	
	._('hasAlphaChar',function(){return (/[a-z]/gi).test(this);})
	
	._('hasNumericChar',function(){return (/[0-9]/gi).test(this);})
	
	._('hasSpace',function(){return (/ /gi).test(this);})
	
	._('compare',function(n){var n=[n].join(''),a=this.replace(/[.]/gi,''),b=n.replace(/[.]/gi,'');a=a.stripSpace().stripSpecialChar().stripAlphaChar();b=b.stripSpace().stripSpecialChar().stripAlphaChar();return (a>b)?true:((a<b)?false:null);})

;





/*
	Ajout de nouvelle methode à la classe 'Number'
*/
_inj.Number = inject(Number, false)
	
	._('math',function(nm){var _m=Math,_n=_m[nm]||false,ar=arguments[1]||[],r=ar.length;if(isFunction(_n)){if(r<=0){return _n(this);}if(r==1){return _n(this,ar[0]);}if(r>1){var arn=GC.merge([],ar);return eval(['Math["',nm,'"](',arn.join(','),');'].join(''));}}else if(!isBoolean(_n)){return _n;}})

	._('degreeInRadians',function(){return(this*Math.PI)/180;})
	
	._('percent',function(n){return(this/n)*100;})
	
	._('cpercent',function(n){return(this*n)/100;})
	
	._('pair',function(n){var c=[this].join(''),n=eval(c.charAt(c.length-1));return(n%2===0)?true:false;})
	
	._('virgule',function(n){var a=[this].join(''),s=a.split("."),va=(typeof s[1]=='undefined')?s[0]*1:[s[0],'.',s[1].substr(0,n)].join('')*1;return va;})
	
	._('clearOut',function(){return W.clearTimeout(this);})
	
	._('clearInt',function(){return W.clearInterval(this);})
	
	._('glength',function(){var o=this,s=[this].join('').split(''),ut=[],r='1';GC.foreach(s,function(v,n){ut.push('0');});r+=ut.join('');return 1*r;})
	
	._('zeroBefore',function(){
		
		var o=this,s=[this].join(''),a=arguments,l=a[0]||0,n='',ls=s.length;
		
		if(ls<l){for(var x=0;x<Math.abs(l-ls);x++){n+='0';}}

		return n+s;
	})

	._('nuspacer',function(n){return((this-((typeof n=='undefined')?NaN:n))/2);})

	._('splitInt',function(i, r, rev){

		var n = this, ns = n.toString(), sn = ns.split(''), i = i||3, x=0, nv = '', rev = rev||false, r=r||' ';

		if(rev){sn = sn.reverse();}

		G.foreach(sn, function(val){

			if(x == i){

				nv += r;

				x=0;

			}

			nv += val;

			x++;

		});


		return ((rev) ? nv.split('').reverse().join('') : nv);

	})

;


/* Assimilation des Propriété de 'Math' */
if(typeof Object.getOwnPropertyNames=='function'){
	(function(GC){
		var _m=Math
			,_p=[]
			,m=Object.getOwnPropertyNames(_m).filter(function(p){_p[p]=_m[p];});

		for(var n in _p){
			if(!isBoolean(_m[n])){ GC[n]=_m[n]; }
			if(isFunction(_m[n]) ){
				(function(nm){_inj.Number._(nm,function(){return this.math(nm,arguments);});})(n);
			}
		}

	})(GC);
}





/*
	Ajout de nouvelle methode à la classe 'Date'
*/
_inj.Date = inject(Date, false)
	
	// ._('HtS', 24*60*60*)
	._('HtS', 86400000)

	._('_dayName', <?php echo '["' .  implode('","', $GLANG['DAY']['NAME']) . '"]'; ?>)

	._('_labelThisYear', "<?php echo $GLANG['YEAR']['LABEL_CURRENT']; ?>")

	._('_labelThisMonth', "<?php echo $GLANG['MONTH']['LABEL_CURRENT']; ?>")

	._('_labelToDay', "<?php echo $GLANG['DAY']['LABEL_CURRENT']; ?>")

	._('_labelYesterDay', "<?php echo $GLANG['DAY']['LABEL_YESTERDAY']; ?>")

	._('dayOfYear', function(){

		var n =this, d = new Date(n.getFullYear(), 0, 0);

		return (n - d / (86400000) );

	})

	._('fromFormat', function(fm){

		var dt = this,frg = [], fm=fm||'', split = fm.split(''), ret=fm;

		ret = ret.replace(/d/, (dt.getDay() * 1).zeroBefore(2) );
		ret = ret.replace(/j/, dt.getDay() );
		ret = ret.replace(/m/, (dt.getMonth() * 1).zeroBefore(2) );
		ret = ret.replace(/y/, (dt.getYear() * 1).zeroBefore(2) );
		ret = ret.replace(/Y/, dt.getFullYear() );
		ret = ret.replace(/H/, (dt.getHours() * 1).zeroBefore(2) );
		ret = ret.replace(/i/, (dt.getMinutes() * 1).zeroBefore(2) );
		ret = ret.replace(/s/, (dt.getSeconds() * 1).zeroBefore(2) );
		ret = ret.replace(/D/, (dt._dayName[dt.getDay()-1] || '').ucfirst().substr(0,3) );
		ret = ret.replace(/l/, (dt._dayName[dt.getDay()-1] || '').ucfirst() );
		ret = ret.replace(/L/, (dt._dayName[dt.getDay()-1] || '').ucfirst() );

		return ret;

	})

;






/*
	Ajout de nouvelle methode aux classes 'Object' et 'Function'
*/
_inj.ObjectFunction = inject([Object,Function], true)

	._('addProperties',function(n,f){var o=this;

		if(isString(n)){

			var ClN={};

			GC.foreach(n.split(' '), function(fn){ClN[fn] = f; });
			
			GC.merge(o,ClN);

		}

	})

;







/*
	Ajout de nouvelle methode à la classe 'Object'
*/
_inj.Object = inject([Object,Array], true)

	._('purge',function(t){
		var nv=[],vv=[],t=t||'.';
		GC.foreach(this,function(v){
			if(!(v in nv)){
				if(typeof v == typeof t){
					nv[v]=v;
					vv[vv.length]=v;
				}
			}
		});
		return vv;
	})

	._('len',function(typ){

		var v=0, isy = (typeof typ == 'undefined') ? false : true;


		G.foreach(this,function(val){

			if(isy){if(typeof val == typeof typ){v++;} }

			else{v++;}

		});

		return v;

	})

;







/*
	Ajout de nouvelle methode à la classe 'Function'
*/
_inj.Function = inject(Function, false)

	._('timeout',function(t){var f=this;return setTimeout(f,t);})

	._('interval',function(t){var f=this;return setInterval(f,t);})

;






/*
	Gestionnaire des APIs
*/
GC.Core.API = function(){
	
	var o=this,sT,Nm,Sc,Cn;
	
	o.args=arguments;

	o._a=o.args[0]||{};
	
	sT=o._a[0]||{};

	Nm=sT.name||false;

	Sc=sT.static||{};

	Cn=sT.constructor||GC.F();
	
	o.state=sT;
	
	o.name=Nm;
	
	o._static=Sc;

	o.constructor=Cn;
	
	o.toString=function(){return '[Gougnon API.Manager]';};

	G.API.Available[o.name||'undefined'] = o;

	return o;

};



/*
	Ajout de nouvelle methode à l'API 'API'
*/
_inj.API = inject(GC.Core.API, false)

	._('create', function(){

		var o=this,n,BWh;

		if(isString(o.name)){

			if(!o.name.isEmpty()){

				G.Core[o.name] = function(){
					
					var _o=this;
					
					_o.toString=function(){return ['[Gougnon API.',o.name,']'].join('');};
					
					_o.ARGS=arguments[0]||false;
					
					_o.NAME=o.name;

					_o.STATIC=G[o.name];

					_o.constructor = o.constructor;
					
					_o.constructor(_o.ARGS);

					return _o;

				};

				BWh = G.Core[o.name];

				G[o.name] = function(){ return new BWh(arguments); };

				G.merge(G[o.name], o._static);

				n='G';n+=o.name;

				window[n]=G[o.name];

				o.injector = inject(G.Core[o.name],false);

			}

		}

		return o;

	})


	._('dynamic', function(n,f){

		this.injector._(n,f);

		return this;

	})

	._('static', function(n,f){

		G[this.name].addProperties(n,f);

		return this;

	})

;

G.API=function(){return new GC.Core.API(arguments);};

GC.merge(G.API, {

	version:'0.1.0.1'

	,Available:[]

	,Inj : {

		version : '0.1'

		,DOM : function(dom){

			var _o = this;

			_o.DOM = dom;

			_o.PROTO = _o.DOM['prototype']||false;

			_o.add = function(ns,f){

				var _o = this, f=f||null;

				if(typeof _o.PROTO == 'object'){

					GC.foreach(ns.split(' '), function(n){

						_o.PROTO[n] = f||null;

					});

				}

				return _o;

			};

			_o.define = function(ns,f){

				var _o = this, f=f||null;

				if(typeof _o.PROTO == 'object'){

					if('defineProperty' in Object){

						GC.foreach(ns.split(' '), function(n){

							Object.defineProperty(_o.PROTO, n, f);

						});

					}

				}

				return _o;

			};

			return _o;

		}

	}

});


window.GAPI=G.API;





/*
	Liste des évènements des éléments HTML
*/

/* Depuis : Window */
(function(){
	for(var n in W){
		var on=n.substr(0,2);
		if(on=='on'){
			var n1=n.substr(2);
			GC.HTMLEventsName+=' ';GC.HTMLEventsName+=n1;

		}
	};
})();



/* Depuis : Document */
(function(){
	for(var n in D){
		var on=n.substr(0,2);
		if(on=='on'){

			var n1=n.substr(2);

			GC.HTMLEventsName+=' ';GC.HTMLEventsName+=n1;

			// G.D[n1] = function(f){this[n1] = f; return this;};

		}
	};
})();



/* Purgeons la liste */
GC.HTMLEventsName = GC.HTMLEventsName.split(' ').purge(String()).join(' ');





/*
	Ajout de nouvelle methode à la classe 'HTMLElement'
*/
_inj.HTMLElement = inject(HTMLElement, false);

	
	// GC.HTMLEventsName.split(' ').forEach(function(n){

		// _inj.HTMLElement._(n,function(f){

		// 	var nm='on';nm+=n.lower();
			
		// 	// alert([nm,n].join('\n'))
			
		// 	this[nm] = f;

		// 	return this;

		// });

	// });

	

_inj.HTMLElement

	._('Offset offset',function(pA,lE){

		var o=this

			,b=typeof pA=='undefined'

			,n=lE||false

			,ln='width height top left scrollTop scrollLeft scrollWidth scrollHeight'

			,l='offsetWidth offsetHeight offsetTop offsetLeft scrollTop scrollLeft scrollWidth scrollHeight'

			,a={parent:o.offsetParent}

			,sln=ln.split(' ')

			,sl=l.split(' ')

		;

		for(var x=0;x<sln.length;x++){var v=(n===false?100:n).cpercent(o[sl[x]]);a[sln[x]]=v;}

		return (b===true)?a:(a[pA]||a);

	})


	._('create',function(c){

		var o=this,a=arguments,c,e,ins;

			c=c||{}
			
			// ,obb=false
			
			,e=null
			
			,ins=false
		;


		c.id=c.id||false;

		c.tag=c.tag||'div';

		c.tag=(typeof c.tag=='string')?c.tag:'div';

		c.cn=c.cn||false;

		c.html=c.html||false;

		c.css=c.css||false;



			if(typeof c.id=='string'){if(typeof G(['#',c.id].join(''))=='object'){ins=G(['#',c.id].join('')),e=ins;}}

			if(typeof ins!='object'){e=D.createElement(c.tag),ins=G(e);}

			if(o.appendChild){o.appendChild(e);}

			if(e&&ins){if(typeof c.id=='string'){e.id=c.id;}if(typeof c.html=='string'){ins.html(c.html);}if(typeof c.cn=='string'){ins.cn(c.cn);}if(typeof c.css=='object'){ins.css(c.css);}}


			return ins;

	})
	

	._('hide',function(Fx,tL,EaS){

		var o=this

			,sT=o.data('toggle-status')||'-s'

			, Fx = Fx || false

			,oH,h, oFl

		;


		if(sT=='-s'){

			// oH=o.offset().scrollHeight;
			oH=o.css('height').toString().stripAlphaChar();

			var ath = o.data('toggle-callback-height');

			if(ath!=oH){o.data('toggle-callback-height',oH);}

			oFl = o.css('overflow-y')||'none';
					
			o.data('toggle-callback-display',o.css('display'));

			o.data('toggle-callback-overflow-y',oFl);


			if(Fx===false){

				o.css({display:'none'});

				o.data('toggle-status', '-h');

			}

			else{

				if(Fx=='-slide'){

					h='';
					
					h+=oH;
					
					h+='px';

					o.css({height:'0px','overflow-y':'hidden'});

					o.animation(
				
						{
				
							from:{height:h}
				
							,to:{height:'0px'}
				
						}
				
						,tL||300

						,EaS||'ease-out'

						, function(){
				
							o.css({display : 'none !important','overflow-y':oFl});

							o.data('toggle-status', '-h');

						}

					);

				}

			}

			

		}


		return o;

	})


	._('show',function(Fx,tL,EaS){

		var o=this

			,sT=o.data('toggle-status')||'-s'

			,oH = o.data('toggle-callback-height')||o.offset().scrollHeight

			,dIs = o.data('toggle-callback-display')||'block'


			, Fx = Fx || false

			, Sty = GStyle

			, J = {}

			, bN=Sty.getKeyOfBrowser('animation',true)

			,oFl = o.data('toggle-callback-overflow-y',oFl)
		;



		if(sT=='-h'){


			if(Fx===false){

				var h=oH;

					h+='px';

				o.display(oFl);

				o.cancelStyleB('animation');

				o.data('toggle-status', '-s');

			}

			else{


				if(Fx=='-slide'){

					var h,C={}
					
					;

					oH=oH;

					h='';
					
					h+=oH;
					
					h+='px';

					C.height = J.height = h;

					C['overflow-y'] = J['overflow-y'] = 'hidden';

					C[bN] = C.animation = 'none';

					C['display'] = 'block';


					o.css(C);

					o.animation(
				
						{
				
							from:{height:'0px'}
				
							,to:{height:h}
				
						}
				
						,tL||300
				
						,EaS||'linear'
				
						, function(){
				
							o.css(C);

							o.css({'overflow-y' : oFl});
				
							o.data('toggle-status', '-s');
				
						}
				
					);


				}

			}


			

		}


		return o;

	})


	._('toggle',function(Fx,tL,EaS){

		var o=this

			,sT=o.data('toggle-status')||'-s'

			,Fx=Fx||false

			,tL=tL||false

			,EaS=EaS||false

		;

		if(sT=='-s'){o.hide(Fx,tL,EaS);}

		else{o.show(Fx,tL,EaS);}

		return o;

	})



	._('animation',function(aNi,tL,EaS,cB){

		var o=this, Sty = GStyle, aNi=aNi||false,k='__CurrentAnimationKey__',AN='';


		o[k] = ['GGNCurRANiMKeY', GC.ElaNiM.length,'El'].join('');
		
		GC.ElaNiM[GC.ElaNiM.length] = o[k];

		if(!isObject(aNi)){return false;}

		o.__CurrentKeyFrames__ = Sty(o[k]).keyFrames(aNi);

		tL = (!isNaN(tL*1) ? tL/1000 : 0.3);

		AN += o[k];
		
		AN += ' ';
		
		AN += tL;
		
		AN += 's ';
		
		AN += (isString(EaS) ? EaS : ' ease-in-out');

		var J = {}, bN=Sty.getKeyOfBrowser('animation',true);
			
			J[bN] = AN;
		
			J['animation'] = AN;

		o.css(J);

		if(isFunction(cB||false)){
			G(function(){cB(o);}).timeout(tL*1000);
		}

		return o;

	})



	._('cancelStyleB',function(p){
		
		var o=this
		
			,p=p||false

			,bN

			,Sty = GStyle

		;
		
		if(p){

			bN = Sty.getKeyOfBrowser(p,true);

			o.style[bN] = null;

			o.style[p] = null;

		}

	})



	._('cancelStyle',function(p){
		
		var o=this
		
			,p=p||false
		
		;
		
		if(p){o.style[p] = null;}

	})




	._('child',function(s,d){
		
		var eo=this
		
			,c=[]
		
			,s=s||'*'
		
			,d=d||false
		
			,cn=false
		
		;
		
		try{if(typeof eo.querySelectorAll!='undefined'){c=eo.querySelectorAll(s);}}
		
		catch(e){};

		if(c.length>0){

			cn=[];

			for(var x=0;x<c.length;x++){

				var el = c[x];

				if(d==true && el.parentNode == eo){

					cn[cn.length]=c[x];

				}

				else{

					cn[cn.length]=c[x];

				}

			};
		}
		return cn;
	})


	._('node',function(k){
		return this.__NODE_LIST__[k||false]||false;
	})
	

	._('nodes',function(){
		return this.__NODE_LIST__||false;
	})



	._('append',function(s){
		var o=this
			,s=s||false
			,ap=s
		; 
		if(typeof s=='string'){ap=D.createTextNode(s);} 
		if(typeof ap=='object'){o.appendChild(ap); } 
		return o;
	})


	._('html',function(){var o=this,s=(typeof arguments[0]=='undefined')?false:[arguments[0]].join('');if(typeof o!='object'){return o;}if(s!==false){o.innerHTML=s;}o.inner=o.innerHTML;o.outer=o.outerHTML;return o;})


	._('fullSpace',function(s){var o=this,s=s||'',b=GBrowser(); if(isString(s||null)){o.html(s.fullSpace());} return o;})


	._('data',function(nM,vL){

		var o=this,n='data-';n+=nM;return o.attrib(n,vL||undefined);

	})


	._('clone',function(nM,vL){var o=this; return o.cloneNode(true);})


	._('attrib',function(nM,vL){

		var o=this

			,g=nM||false

			,s=vL||undefined

			,m=(s!==undefined)?'-s':'-g'

		;

		if(!isFunction(o['setAttribute'])){return false;}

		if(m=='-s'&&g!==false){o.setAttribute(g,s);return o;}

		return (typeof g=='string')?(o.getAttribute(g)||false):o;

	})


	._('removeAttrib',function(nM){

		var o=this
		
			,a=nM||false
		
		;
		
		if(isString(nM||false)){o.removeAttribute(nM);}

		return o;

	})


	._('computedStyle',function(){var o=this,ro=false;if(o&&typeof W.getComputedStyle!='undefined'){ro=W.getComputedStyle(o)||false;}return ro;})


	._('css',function(){var o=this,args=arguments,a=args[0]||{},c=a||{},larg=args.length,r=o,sty=GStyle; 

		if(typeof a==='object'&&larg===1){
			sty.update(o,c);
		}

		else{
			var cs=o.computedStyle()||false; 
			if(typeof cs=='object'){
				r=[]; 
				G.foreach(args,function(v,k){
					var va=v||''; 
					if(typeof va=='object'){o.css(va);} 
					if(typeof va=='string'){r[r.length]=((cs.getPropertyValue(va))||undefined);} 
				}); 
				
				if(larg===1){r=r[0]||undefined;} 
			} 
		} 
		return r;
	})
	


	._('getShape',function(){var o=this,f=[], off=o.offset();

		f['width'] = off.width;f['width']+='px';

		f['height'] = off.height;f['height']+='px';

		G.foreach(('border-top-right-radius border-top-left-radius border-bottom-right-radius border-bottom-left-radius').split(' '), function(n){

			f[n] = o.style[n] || o.css(n) || undefined;

		});

		return f;
	})


	._('etiq',function(lb){var o=this,l=(lb||'').toString().lower().trim(),r=o;

		if(l.substr(0, 4) == 'this'){

			if(l=='this.parent'){r=o.parentNode;}

			else if(l=='this.nextsibling' || l=='this.previoussibling'){r=o[lb.substr(5)];}

			else if(l.substr(0,9)=='this.next' || l.substr(0,13)=='this.previous'){

				var cn = 0, k = l.substr(10), kn = 'nextSibling',ro=null;

				if(l.substr(0,13)=='this.previous'){k = l.substr(14); kn = 'previousSibling';}

				try{

					var np = o[kn]||null;

					k=k.substr(0,k.length-1); k=(k.isEmpty()) ? 0 : k*1;

					while(np!=null){

						if(cn==k){ro = np; np = null; break; }
						
						np = np[kn]; 

						cn++;

					}

				}

				catch(er){}

				r=ro;
			}

			else if(l=='this'){r=o;}

		}

		else{

			r = o.child(lb);

		}

		return r;
	})

	

	._('display',function(s){var o=this;o.css({display:s||false});return o;})

	._('cn',function(s){var o=this;o.className=s||'';return o;})


	._('related',function(bx,prop){

		var o=this,prp = prop.split(' '),c={};

		if(isObj(bx)){

			G.foreach(prp, function(v,n){

				var vv = bx.css(v);

				c[v] = vv;

			},false,false,'.');

			o.css(c);

		}

		return o;

	})


	._('on',function(s,f,ar){

		var o=this,ar=ar||undefined,isf = isFunc(f||'');

		G.foreach(s.split(' '),function(n){
			var nn='on',en='___ggn_on___'; 
			nn+=n;
			en+=nn;
			en+='___clone___';
			o[en] = (isf) ? f : (f||null);
			o[nn] = (isf) ? function(ev){return this[en](ev,ar);} : (f||null);
		}); 

		return o;
	})


	._('_focus',function(n){var o=this;G(function(){o.focus();}).timeout(1);return o;})

	._('_blur',function(n){var o=this;G(function(){o.blur();}).timeout(1);return o;})


	._('emptyContent',function(){

		var o=this, ch = o.childNodes;

		if(isObj(ch)){

			G.foreach(ch, function(c){

				if(isObj(c)){

					if(isFunc(c['remove'])){c.remove();}

				}

			});

		}

		return o;

	})


	._('addClass',function(c){var o=this,c=c||'',q=c.split(' ');if(o!=false&&typeof o.classList!='undefined'){
		for(var x=0;x<q.length;x++){var s=q[x];if(!isString(s) || s.isEmpty()){continue;}o.classList.add(q[x].trim());};}else{o.cn([o.className,c].join(' '));}return o;})

	._('hasClass',function(c){
		var o=this,c=c||false,cns=o['classList']||o.className||false,r=false;
		cns = isObject(cns)? cns: (isString(cns) ? isString(cns).split(' '): false);
		if(isString(c) && cns!=false){
			GC.foreach(cns, function(v,k){
				if(!isString(v)){return false;}
				if(c==v){r=true;}
			});
		}
		return r;
	})


	._('removeClass',function(c){var o=this,c=c||'',q=c.toString().split(' ');if(o!=false&&typeof o.classList!='undefined'){for(var x=0;x<q.length;x++){o.classList.remove(q[x]);};}else{o.cn(o.className.replace(eval(["/( |)",c,"( |)/gi"].join('')),''));}return o;})


	._('replaceClass',function(c0,c1){var o=this,c0=c0||'',c1=c1||'';o.removeClass(c0).addClass(c1);return o;})
	

	._('absCenterOf',function(a){var o=this,a=a||false,t,l,psz,sz,css={}; if(!isObject(a)){return o;} sz=o.offset(false,100);psz=a.offset();l=(psz.width||0).nuspacer(sz.width);t=(psz.height||0).nuspacer(sz.height);css.top=t;css.top+='px';css.left=l;css.left+='px';o.css(css);})
	

	._('ui',function(n,_v){var o=this,_n='gui',_v=_v||false;_n+='-';_n+=[n].join('');return o.attrib(_n,_v);})


	._('listen',function(ev,f,r){
		
		var o=this,r=r||false,ev=(ev||'').split('|'),f=f||G.F();

		GC.foreach(ev, function(n){
		
			GEvent(o).listen(n,f,r);
		
		});

		return o;

	})

	._('prop property',function(k){var o=this,k=k||false;return (typeof k=='string')?(o[k]||o):o;})


	._('opacity',function(s){
	
		var atn='opacity'
	
			,o=this
	
			,s=s||false
	
			,r=o.data(atn)||o.css('opacity')||null
	
			,v=s*1
	
		;
	
		if(typeof v=='number'){

			var c={},oN=GStyle.getKeyOfBrowser('opacity',true);

			c[oN] = s.toString();

			c['opacity'] = s.toString();

			o.css(c);
			
			o.data(atn,s.toString());

			r=s;
	
		}
	
		return r;
	
	})


	._('cancelOpacity',function(s){var atn='opacity',o=this,r,v=null;r=o.css({opacity:v},'opacity');o.data(atn,r);return r;})


	._('execScript',function(){var o=this,els,scr_=G.Script; els=o.getElementsByTagName('script');for(var xes=0;xes<els.length;xes++){scr_.exec(els[xes].innerHTML);};return o; })


	._('remove',function(){var o=this; try{o.parentNode.removeChild(o);}catch(e){} return o; })


	._('replace',function(nob){var o=this; if(isObject(nob||null)){o.parentNode.replaceChild(nob,o);} return o; })


	._('bind',function(n,f){var o=this;o[n]=f;return o;})

	._('unbind',function(n){var o=this;o[n]=null;return o;})


	._('getChildStyle',function(a){
	
		var o=this
	
			,a=a||false
	
			,r={0:[],1:[]}
	
		;
	
		if(typeof a=='string'){
	
			var els=o.querySelectorAll('*');
	
			for(var x=0;x<els.length;x++){
	
				var _o=G(els[x])
	
					,c=_o.css(a)
	
				;
	
				r[0][r[0].length]=_o;
	
				r[1][r[0].length]=c;
	
			}
	
		}
	
		return r;
	
	})


	._('strToSend',function(anti){

		var o=this

			, str=[]

			, anti = anti || ''

			, _anti = []

		;


		if(isStr(_anti)){

			G.foreach(anti.split(' '), function(v){

				_anti[v] = v;

			});

		}
		

		if(typeof o.elements!='object'){return false;}

		GC.foreach(o.elements,function(v){

			if(typeof v.name=='string'){

				if(!v.name.empty() && !(v.name in _anti) ){

					if((v.type).lower()=='checkbox'||(v.type).lower()=='radio'){

						if(v.checked===true){str[str.length]=GC.FPV(v);}

					}

					else{

						if(v.tagName.lower()=='select'){

							G.foreach(v.options, function(op,kp){

								if(op.selected){str[str.length]=GC.FPV({name:v.name,value:op.value}); }

							}, false, false, {});

						}

						else{str[str.length]=GC.FPV(v);}

					}

				}

			}

		},false,false,{});

		return str.join('&');
	})



;







/*
	GGN Action
*/
(function(GC,gAPI){

	var api = gAPI({
		
		name:'Action'

		, static : {

			version : '0.1'

			,Handlers:[]
			
			,HandlerEvents:false
			
			,Handler:function(f){
			
				var o=this,f=f||o.HandlerEvents,as;
				

				if(!isString(f)){return false;}

				else{

					as=f.split(' ').purge('.');
		

					GC.foreach(as,function(vss,n){
						
						GEvent(document).listen(vss,function(ev){


							var el=GEvent(ev).source(),ge=G(el),nn='ggn-handler-',nnn='handler-',ac;

							if(isFunction(ge.attrib||false)){

								GC.foreach(vss.split(' ') , function(v, ns){

									nn+=v;
									
									nnn+=v;

									ac=ge.attrib(nn)||ge.attrib(nnn)||false;

									if(isString(ac)){
										
										G.foreach(GAction.Handlers[v],function(od,nd){

											if(ac==nd){G.foreach(od, function(fnc){if(isFunction(fnc||'')){fnc(ge,ev);}});}

										});
									
									}

								});

							}

						}, true);

					},false,false,'.');
					
					return true;
				
				}
			
			}

			, Detecting : { 

				Status : false

				, Instance : null

				, Scope : []

				, Timer : 1000

				, Stop : function(){

					var o = this;

					if(o.Instance&&isNumber(o.Instance)){

						o.Status = false;

						G(o.Instance).clearOut();

					}

					return o;

				}

				, Vendor : function(){

					var o = this, scope = o.Scope;


					G.foreach(scope, function(Fns, sel){

						var elms = G(sel), attr = 'ggn-api-codex-acdec', afn = 'ggn-api-AcAss';

						if(isObj(elms)){

							var nds = elms.nodes();

							if(nds){

								G.foreach(nds, function(nd){

									if(nd.attrib(attr) == 'true'){

										nd.attrib(attr, 'already');

										if(isObj(Fns)){

											G.foreach(Fns, function(Fn){

												nd[afn] = Fn;

												nd[afn]();

											}, false, false, G.F() );

										}

									}


								}, false, false, {} );

							}

						}


					}, false, false, {} );


					return o;

				}

				, Trigger : function(ev){

					var o = this; ev=ev||null;

					o.Instance = G(function(){

						if(o.Status === true){

							var find = G('body').child('*:not([ggn-api-codex-acdec])'), found = 0;


							if(find.length){

								G.foreach(find, function(elm,k){

									found++;

									elm.attrib('ggn-api-codex-acdec', 'true');

								}, false, false, {} );


								if(found){o.Vendor();}

							}

							GAction.Detecting.Trigger(ev);

						}

						else{o.Stop();}

					}).timeout(o.Timer||300);

					o.Status = true;

					return o;

				}

			}

		}

		, constructor : function(){

			var o = this;


			o.Static=o.STATIC;
			
			o.Hote=false;
			
			o.getInstance=function(i){var spl=i.split(':');
			
				return {type:spl[0].trim(),value:spl[1]||false,split:spl};
			
			};

			o.getHote=function(p0){
			
				var h=p0,p=[h].join('').toLowerCase(),tf=GC.getObjectType(p0);if(tf=='-htmlelement'){h=p0.element||p0;}else if(tf=='-windowobject'){h=p0.window||p0;}else if(tf=='-documentobject'){h=p0.document||p0;}else if(tf=='-pureobject'){h=p0.object||p0;}else if(typeof p0=='string'){ h=G(p0).element||p0;} return h;
			
			};

			o.instance=o.getInstance(o.ARGS[0]);
			
			o.type=o.instance.type||false;
			
			if(o.type===false){
			
				o.Hote=o.getHote(o.ARGS[0])||GC.D;
			
			}
			
			else if(o.type=='handler'){
			
			}
			
			o.on=function(n,f){
				var o=this;o.Hote[['on',n].join('')]=f;
			};

		}


	}).create();

api 

	.dynamic('touchSlide',function(f){if(typeof this.Hote!='object'&&o.type!=false){return this;}var o=this,ev=Nat.Event(o.Hote);o.startMouse=false;o.endMouse=false;o.activate=false;o.slideX=false;o.slideY=false;o.actOn=false;o.actOnDrg=false;o.fcall=f||G.F();ev.listen('mousedown',function(ev0){var elc=G(ev0).source();o.startMouse=Nat.Mouse(ev0).position();o.actOn=elc;o.activate=true;});ev.listen('mouseup',function(ev1){o.endMouse=Nat.Mouse(ev1).position();var m0=o.startMouse,mf=o.endMouse;if(o.activate===true){if(typeof m0.x=='number'&&typeof mf.x=='number'){o.slideX=mf.x-m0.x;o.slideY=mf.y-m0.y;if((o.slideX!=0||o.slideY!=0)&&typeof o.fcall=='function'){o.fcall(o.slideX,o.slideY);}}}o.actOn=false;o.activate=false;});return o;})
	
	.dynamic('touchSlideRight',function(f){if(typeof this.Hote!='object'&&o.type!=false){return this;}var o=this;o.fcallr=f||G.F();o.touchSlide(function(x,y){var _o=this;if(x>0&&typeof o.fcallr=='function'){o.fcallr(Math.abs(x));}});return o;})
	
	.dynamic('touchSlideLeft',function(f){if(typeof this.Hote!='object'&&o.type!=false){return this;}var o=this;o.fcalll=f||G.F();o.touchSlide(function(x,y){var _o=this;if(x<0&&typeof o.fcalll=='function'){o.fcalll(Math.abs(x));}});return o;})
	
	.dynamic('touchSlideTop',function(f){if(typeof this.Hote!='object'&&o.type!=false){return this;}var o=this;o.fcallt=f||G.F();o.touchSlide(function(x,y){var _o=this;if(y<0&&typeof o.fcallt=='function'){o.fcallt(Math.abs(y));}});return o;})
	
	.dynamic('touchSlideDown',function(f){if(typeof this.Hote!='object'&&o.type!=false){return this;}var o=this;o.fcalld=f||G.F();o.touchSlide(function(x,y){var _o=this;if(y>0&&typeof o.fcalld=='function'){o.fcalld(Math.abs(y));}});return o;})
	
	.dynamic('listen',function(ev,f){var o=this;
		if(o.type=='handler'){
			var inst=o.instance.value,od=o.STATIC.Handlers,ev=(ev||'').split(' '),f=f||G.F();


			G.foreach(ev, function(evt){
				var ik;
				od[evt] = od[evt]||[];
				od[evt][inst] = od[evt][inst]||[];
				ik=od[evt][inst];
				od[evt][inst][ik.length] = f||G.F();
				
				o.STATIC.Handlers=od;
			},false,false,'.');

		}
	})


	.dynamic('assign',function(fn){var o=this, fn=fn||false;

		if(o.type == 'detecting' && isFunc(fn) ){

			var sel = o.instance.value;

			o.STATIC.Detecting.Scope[sel] = o.STATIC.Detecting.Scope[sel]||[];

			o.STATIC.Detecting.Scope[sel][o.STATIC.Detecting.Scope[sel].length] = fn;

		}

		return o;

	})

;


})(GC,GAPI);








/*
	GGN Event
*/
(function(GC,gAPI){

	var api = gAPI({
		
		name:'Event'

		, static : {

			version : '0.1'

		}

		, constructor : function(){

			var o = this;

			o.hote=o.ARGS[0]||GC.D;

			o.handler=[];

			o.handler.name=[];

			o.handler.ft=[];

		}


	}).create();

api

	
	.dynamic('source',function(){var e=this.hote;if(e==null){e=O.hote;} return e.target||e.srcElement||false;})

	.dynamic('clickType',function(){

		var e=this.hote

			, ret=false

			, w=e.which||false

		;

		if(w===1){
			ret='mouse.click.left';
		}

		if(w===2){
			ret='mouse.click.middle';
		}

		if(w===3){
			ret='mouse.click.right';
		}
		return ret;
	})

	.dynamic('isRightClick',function(){return (this.clickType()=='mouse.click.right') ? true : false;})

	.dynamic('isMiddleClick',function(){return (this.clickType()=='mouse.click.middle') ? true : false;})

	.dynamic('isLeftClick',function(){return (this.clickType()=='mouse.click.left') ? true : false;})


	.dynamic('add',function(n,f){var o=this;o.handler.name[o.handler.name.length]=([n].join(''));o.handler.ft[o.handler.ft.length]=(f);return o;})

	.dynamic('detect',function(n){
		var o=this,ar=arguments,Ns=o.handler.name,Ft=o.handler.ft,n=n||false;

		if(n===false){return o;}
		n=n.lower();
		GC.foreach(Ns,function(v,k){

			if(!isString(v)){return  false;}

			var v=v.lower();
			if(v==n){
				if(isFunction(Ft[k])){
					var a=[];
					GC.foreach(ar,function(v){
						a[a.length]=v;
					},1);

					Ft[k](a);
				}
			}
		});
		return o;
	})

	.dynamic('list',function(n){var o=this,Ns=o.handler.name,Ft=o.handler.ft,n=n||false;if(n===false){return o;}n=n.lower();o.item=[];GC.foreach(Ns,function(v,k){var v=[v].join('').lower();if(v==n){if(isFunction(Ft[k])){o.item[o.item.length]=(Ft[k]);}}});return o.item;})

	.dynamic('lists',function(n){var o=this,Ns=o.handler.name,Ft=o.handler.ft;o.item=[];GC.foreach(Ns,function(v,k){if(isFunction(Ft[k])){o.item[o.item.length]=(Ft[k]);}});return o.item;})
	
	.dynamic('remove reset',function(n){var o=this,Ns=o.handler.name,Ft=o.handler.ft,n=n||false;if(n===false){return o;}n=n.lower();GC.foreach(Ns,function(v,k){var v=[v].join('').lower();if(v==n){if(isFunction(Ft[k]||'')){o.handler.name[k]=undefined,o.handler.ft[k]=undefined;}}});return o;})
	
	.dynamic('removeAll resetAll',function(){var o=this,Ns=o.handler.name;GC.foreach(Ns,function(v,k){var v=[v].join('').lower();o.handler.name[k]=undefined,o.handler.ft[k]=undefined;});return o;})

	.dynamic('listen',function(ev,f,ar){

		var o=this
			,h=o.hote||G.D
			,ev=(ev||"").toString().split(" ")
			,f=f||G.F()
		;

		G.foreach(ev, function(evt){

			if(typeof h.addEventListener!='undefined'){h.addEventListener(evt,f,ar||false);}

			else if(typeof h.attachEvent!='undefined'){h.attachEvent(['on',evt].join(''),f);}

		});

		return o;
	})
	
	.dynamic('removeListener',function(ev,f){

		var o=this
			,h=o.hote||G.D
			,ev=(ev||"").toString().split(" ")
			,f=f||G.F()
		;

		G.foreach(ev, function(evt){

			if(typeof h.removeEventListener!='undefined'){h.removeEventListener(evt,f);return o;}

		});

		return o;
	})


	.dynamic('prevent',function(r){

		var ev=this.hote||window.event;
		
		r=(r===true)?false:true;
		
		if(ev.preventDefault){ev.preventDefault();}
		
		else{ev.returnValue=r;} 
		
		return this;

	})

	
	.dynamic('stop',function(){var ev=this.hote;if(ev.stopPropagation){ev.stopPropagation();}return this;})

;


})(GC,GAPI);






/*
	GGN Script
*/
(function(GC,gAPI){

	var api = gAPI({
		
		name:'Script'

		, static : {


			version : '0.1'


			, checkedTypes:[]


			, _loaded : []

			, doc : function(){return G.D.body;}

			, load : function(u,f){
			
				var o=this

					,u=u||''
			
					,f=f||false
			
					,k=u.escape()
			
					,deo=o.isLoaded(u)

					,st=StyleName||'<?php echo Register::_GET("style", "false"); ?>'
			
				;

				if(isObject(deo)){

					if(!f){return false;}

					else{deo.remove();}

				}

				
				if(isStr(st)){

					u+='&style=';

					u+=st;

				}


				var h=o.doc(),e=G(h).create({tag:'script'});

				e.attrib('type','text/javascript').attrib('src',u||'');

				o._loaded[k]=e;

				return e;

			} 


			, unload : function(u){

				var o=this,deo=o.isLoaded(u);

				if(isObject(deo)){

					deo.removeAttrib('type').removeAttrib('src');

					return false;

				}

				return o;

			}


			, isLoaded : function(u){

				var o=this,k=u.escape(),de=o._loaded;

				if(k in de){if(isObject(de[k])){return de[k];}}

				return false;

			}


			, exec : function(){

				var h=this.doc(),e=G(h).create({tag:'script'}),txt=arguments[0]||false;

				if(isFunction(e.appendChild||null)&&isFunction(D.createTextNode||null)){e.appendChild(D.createTextNode(txt));}

				else{eval(txt);}

				return e;

			}


			, package : function(p,u,styl){

				var o=this,a=arguments
			
					,e
			
					,p=p||false
			
					,u=u||G.domain
			

					,styl=styl||false
			
					,ul=[u,'jsFramework?version=&api=',p, ((isString(styl))?['&style=',styl].join(''):'') ].join('')

				;
			
				o.element=o.load(ul);
			
				return o;

			}


			, checkedTypes : []


			, check : function(){

				var o=this,a=arguments,ob=a[0]||undefined,fct=a[1]||G.F(),typ,k=a[2]||escape(ob),scr=false;
				
				if(isString(ob)){scr=o.exec(['GScript.checkedTypes["',k,'"] = typeof ',ob,';'].join(''));}

				typ=(isString(ob||false))?o.checkedTypes[k]: (isFunction(ob||'') ? typeof ob(o):false);

				if(scr){scr.remove();}
				
				if(typ=='undefined'){G(function(){o.check(ob,fct,k); }).timeout(256);return o;}
				
				if(typ!='undefined'){if(isFunction(fct)){fct(o);}}
				
				return o;
			
			} 



		}

		, constructor : function(){

			var o = this;

		}


	}).create();


})(GC,GAPI);






/*
	GGN Style
*/
(function(GC,gAPI){

	var api = gAPI({
		
		name:'Style'

		, static : {

			version : '0.1'

			, _browserKeys : 'webkit Moz ms O'

			, _loaded : []

			, D : false

			, doc : function(){var Dc = (this.D||G.D); return Dc.head||Dc.body||false;}

			, sheet : function(){var h=this.doc(),ss=h.getElementsByTagName('style'),e=ss[0]||false;if(e===false){var oe=G(h).create({tag:'style'});e=oe.element;oe.attrib('type','text/css').attrib('g-style-sheet','-self');}if(typeof ss.firstChild!='undefined'){h.insertBefore(e,ss.firstChild);}return G.D.styleSheets[0]||false;}
			
			, rules : function(){var s=this.sheet()||false;return (s===false)?false:((typeof s.cssRules=='object')?s.cssRules:s.rules);}
			
			, getKeyOfBrowser : function(n,md){
		
				var o=this,a={}
		
					,ks=o._browserKeys.split(' ')
		
					,b=G.Browser()
		
					,_n=(md===true)?'-':''
		
				;
				
				if(b.firefox===true||b.gecko===true||b.likeGecko===true){_n+=ks[1];}
			
				else if(b.appleWebkit===true||b.chrome===true){_n+=ks[0];}
			
				else if(b.ie===true||b.edge){_n+=ks[2];}
			
				else if(b.opera===true){_n+=ks[3];}

				_n+=(md===true)?'-':'';

				_n+=(md===true)?n:n.ucFirst();

				return (md===true)?_n.lower():_n;

			}

			, browserKey : function(n,d){var o=this,a={},_n;_n=o.getKeyOfBrowser(n);a[_n]=d;return a;}
			
			, load : function(u,f){

				var h=this.doc()

					,o=this
			
					,e=G(h).create({tag:'link'})
			
					,u=u||''

					,st=StyleName||'<?php echo Register::_GET("style", "false"); ?>'

					,k=escape(u)

					,deo=o.isLoaded(u)

					,f=f||false

				;


				if(isObject(deo)){

					if(!f){return false;}

					else{deo.remove();}

				}

				if(isStr(st)){

					u+='&style=';

					u+=st;

				}

				e.attrib('type','text/css').attrib('rel','stylesheet').attrib('href',u||'');

				o._loaded[k]=e;

				return e;

			}
			

			, isLoaded : function(u,f){

				var o=this,k=u.escape(),de=o._loaded, f=f||'';

				if(k in de){if(isObject(de[k])){ if(isFunction(f)){f();} return de[k];}}

				return false;

			}

			, __aSltr:[]
			
			, addSelector : function(s,c){var h=this.doc() ,sh=this.sheet() ,s=s||false ,c=c||false;
				
				if(isString(s)){
					this.__aSltr[s]=this.__aSltr[s]||{css:'',k:1};
					var _c='',db=this.__aSltr[s],k=db.k;

					if(isObject(c)){
						G.foreach(c,function(v,n){
							_c+=[n.replace(/([A-Z].*)$/g,"-$1"),':',v,';'].join('');
						},false, false, '-str');
					}

					if(isString(c)){_c = c;}

					if(typeof sh.addRule=='object'){sh.addRule(s,_c);} 
					if(typeof sh.insertRule=='function'){
						try{sh.insertRule([s,' {',_c,'}'].join(''),k);}
						catch(e){}
					}

					db.k++;db.css+=_c;

				}

				return sh;
			}

			, updateSelector : function(s,c){
				var o=this
					,h=this.doc()
					,sh=this.sheet()
					,r
					,s=s||false
					,c=c||false
					,rul
				;

				r = sh.cssRules || sh.rules;
				var rul=o.getSelector(s)
					,se=rul.selectorText
				;

				for(k in c){
					rul.style[k.replace(/([A-Z].*)$/g,"-$1")]=c[k];
				} 

			}

			, getSelector : function(s){
				var h=this.doc()
					,sh=this.sheet()
					,r
					,s=s||false
				;
				
				r = sh.cssRules || sh.rules;
				
				for(var n in r){
					var rul=r[n]
						,se=rul.selectorText
					;
					
					if(isString(rul.cssText||false)){
						var ex=rul.cssText.split("\n"),sx=ex[0].trim().split('{');
							se=sx[0].trim();
					}

					if(se==s || se==s.trim()){
						return rul;
						break;
					} 
				} 
				return false;
			} 

			, update : function(){var o=this,a=arguments,g=a[0]||false,c=a[1]||{}; 

				if(isObject(g||'')&&isObject(c||'')){

					if(isFunction(g.attrib||'')){

						var _c='',rgm=/([A-Z].*)$/g, nc={};

						GC.foreach(g.style,function(v,k){var kk=k*1; if(!isNaN(kk)){nc[v] = g.style[v];} });

						GC.merge(nc,c, '-str');

						GC.foreach(nc, function(r,k0){

							GC.foreach(k0.split(' && '), function(k){

								var kk=k*1;

								if(isString(r) && isNaN(kk) && k!='cssText'){

									if(!r.isEmpty()){	
										if(c[k]){
											_c+=[o.rKey(k),':',c[k],';'].join('');
										}
										else{
											_c+=[o.rKey(k),':',r,';'].join(''); 
										}
									}

								}
								else{

									if(c[k] && isString(r) ){
										var kr=o.rKey(k);
										_c+=[kr,':',r.toString(),';'].join(''); 
									}
								}


							});
							

						});

						g.attrib('style', _c); 

					} 
				} 

				return o;
			}

			,rKey : function(k){
				return (k||'').replace(/([A-Z].*)$/g,"-$1");
			}

			, package : function(p,u,styl){

				var o=this
			
					,a=arguments
			
					,e
			
					,p=p||false
			
					,styl=styl||false
			
					,u=u||G.domain
			
					,ul=[u,'cssFramework?version=&api=',p, ((isString(styl))?['&style=',styl].join(''):'') ].join('')
			
				;
			
				o.element=o.load(ul);
			
				return o;
			
			} 


		}

		, constructor : function(){

			var o = this;

		}


	}).create();


	api.dynamic('change', function(sty){

		var o=this,a=o.ARGS,ob=G(a[0])||false,u,cu,nu,fu,fu1;
		
		if(!isObject(ob||'')){return o;}
		
		u=ob.attrib('href')||false;

		if(isString(u)){
		
			nu = [];

			fu = u.split('?');

			fu1 = fu[1]||'';
			
			fu1.split('&').forEach(function(p){

				var cp=p.split('=');
		
				if(cp[0].lower()=='style'){cp[1]=sty;}

				nu[nu.length]=cp.join('=');
		
			});

			var uf = fu[0];

				uf += nu.join('&');
			
			ob.attrib('href', uf);
		
		}

		return o;

	})


	.dynamic('keyFrames', function(aNi){

		var o=this,a=o.ARGS,Nm=a[0]||false,an='';
		
		if(!isString(Nm||false)){return o;}

		if(!isObject(aNi||'')){return o;}

		var Sty = GStyle;
		
		GC.foreach(aNi,function(p,n){

			an +=n;
			
			an += !isNaN(n*1) ? '%':'';
			
			an += '{';

				GC.foreach(p,function(v,k){

					an += k;
			
					an += ':';
			
					an += v;
			
					an += ';';

				},false,false,'.');

			an+='}';

		}, false, false, {});

		var bk='@'; bk+=Sty.getKeyOfBrowser('keyframes',true); bk+=' '; bk+=Nm;

		Sty.addSelector(bk, an);

		var sel='@keyframes ';sel+=Nm;

		Sty.addSelector(sel, an);

		return o;

	});


})(GC,GAPI);






/*
	GGN Browser
*/
(function(GC,gAPI){

	var api = gAPI({
		
		name:'Browser'

		, static : {

			version : '0.1'

		}

		, constructor : function(){

			var o = this;

			o.name=N.appName;

			o.cname="<?php echo CLIENT_BROWSER; ?>";

			o.agent=N.userAgent.toString().toLowerCase();

			o.version=N.appVersion;

			o.platform=N.platform;

			o.get=function(n){
				var o=this;

				if((o.agent.indexOf(arguments[0]||'')||(-1))>=0){
					var su=n.substr(-1)=='/';
					o.name = n.replace(/\/ /gi, '');
					return true;
				}
				else{
					return false;
				}

			};

			o.MAC=o.get('mac');
			
			o.Win32=(o.platform=='Win32');
			
			o.JAVA=N.javaEnabled();
			
			o.flashShockwave=o.flash=function(){var m=N.mimeTypes["application/x-shockwave-flash"];return m && m.enabledPlugin;};
			
			o.gecko=o.get('gecko');
			
			o.likeGecko=o.get('like gecko')||o.gecko;
			
			o.appleWebkit=o.get('applewebkit');
			
			o.khtml=o.get('khtml');
			
			o.ie=o.IE=(o.get('trident/')&&o.get('clr')&&o.get('.net'))||o.get('msie')||o.get('Microsoft Internet Explorer');
			
			o.firefox=o.get('firefox/');
			
			o.chrome=o.get('chrome/');
			
			o.safari=o.get('safari/');
			
			o.opera=o.get('opera')||o.get('opr/');
			
			o.ie6=o.IE6=o.get('msie 6');
			
			o.ie7=o.IE7=o.get('msie 7');
			
			o.ie8=o.IE8=o.get('msie 8');
			
			o.ie9=o.IE9=o.get('msie 9');
			
			o.ie10=o.IE10=o.get('msie 10');
			
			o.ie11=o.IE11=(o.ie&&o.get('rv:11'));

			o.edge=o.IE6=o.get('edge/');
			
			o.iemobile=o.get('iemobile/');
			
			o.xbox=o.get('xbox');
			
			o.xBoxOne=o.get('xbox one');

		}


	}).create();



})(GC,GAPI);






/*
	GGN AMP
*/
(function(GC,gAPI){

	var api = gAPI({
		
		name:'AMP'

		, static : {

			version : '0.1'

			,objects:[]

			,events:'start restart play pause stop hit done end'

			,moment:{

				status:true

				,__callBack:[]

				,callBack:{

					saver:[]

					,add:function(n,o){this.saver[n]=o;}

					,reboot:function(){
		
						var o=this;
		
						G(o.saver).foreach(function(v,n,oj){
		
							if(typeof v=='object'){
		
								if(typeof v.play=='function'){
		
									if(v.status=='-pause'){v.play();}
		
								}
		
							}
		
						});
		
					}
		
				}
		
				,activate:function(){
		
					if(this.status===false){this.status=true;this.callBack.reboot();}
		
				}
		
				,deactivate:function(){
		
					this.status=false;
		
				}
		
				,toggle:function(){
		
					this.status=!this.status;if(this.status===true){this.callBack.reboot();}
		
				}
		
			}



		}

		, constructor : function(){

			var o = this;

			o.instance=o.ARGS||false;
			o.keyName=o.STATIC.objects.length;
			o.player=function(_o,f,c){
				var o=this; 
				if(typeof _o.to=='number'&&typeof _o.from=='number'&&typeof _o.sens=='boolean'&&typeof _o.level=='number'&&typeof _o.hit=='number'){

					f=typeof f=='function'?f:G.F(); 
					c=typeof c=='function'?c:G.F(); 
					var t=_o.getTimeBehavior(); 

					_o.timeOutCallee = function(){
						var ht=_o.getHitBehavior()*1
							,l=_o.level
							,_l=(_o.sens===true)?l+ht:l-ht
							,stp
							,tim=_o.getTimeBehavior()
							; 
						_l*=1;
						_l=_l.virgule(3);
						stp=((_o.counter+1)>=_o._ht);
						_o.behaviorTime=tim;
						_o.behaviorHit=ht;
						_o.setPercentListener(_o.counter);

						if(stp===true){_o.level=_o.to;_o.counter=_o._ht;f(_o,l);G(_o._player).clearInt();c(_o,l);}
						else{
							if(o.STATIC.moment.status===false&&_o.forge===false&&_o.status.lower()=='-play'){o.STATIC.moment.callBack.add(_o.keyName,_o);_o.pause();return false;}
							_o.level=_l;
							f(_o,l);
							_o._player=G(function(){_o.timeOutCallee();}).timeout(tim);
							_o.counter++;
						} 
					};

				_o._player=G(function(){_o.timeOutCallee();}).timeout(t);

				} 
			}; 

			o.init=function(){
			 	var o=this;
			 	o.status=false;
			 	o.cfg=o.instance[0]||{};
			 	o.from=o.from||o.cfg.from||0;
			 	o.to=o.to||o.cfg.to||0;
			 	o.loop=o.loop||o.cfg.loop||false;
			 	o.forge=o.forge||o.cfg.forge||false;
			 	o.tbr=o.tbr||o.cfg.timeBeforeRestarting||10;
			 	o._lrw=1;
			 	o.tbehavior=o.tbehavior||o.cfg.timeBehavior||{};
			 	o.hbehavior=o.hbehavior||o.cfg.hitBehavior||{};
			 	o.timeline=o.timeline||o.cfg.timeline||1;
			 	o.__ons=o.STATIC.events.split(' ');
			 	o.callBack={};
			 	o._e=GEvent(o);
			 	o.event=o._e;
			 	o.behaviorTime=0;
			 	o.ecart=function(){
			 		var o=this;return Math.abs(o.to-o.from);
			 	};
			 	o._ht=(o.timeline>=1000)?100:(o.timeline/10);
			 	o._hti=(o._ht/10);
			 	o._tmln=1;
			 	o.getSens=function(){
			 		var o=this;return o.from<o.to;
			 	};
			 	o._hit=function(){
			 		var o=this;return (o.ecart()/o._ht);
			 	};
			 	o._timeTrame=function(){
			 		var o=this;
			 		return ((o._hit()*o.timeline)/o.ecart()).virgule(1);
			 	};
			 	o.hit=o._hit();
			 	o.timer=o._timeTrame();
			 	o.sens=o.getSens();
			 	o.level=o.from;
			 	o.counter=0;
			 	o.percent=0;
			 	o.pAsd=[];
			 	o._percents=function(){var o=this,xk=o._hti,a=[];for(var x=0;x<=100;x++){var xa=Math.floor((x*xk)/10);a[xa]=a[xa]||[];a[xa].push(x);if(!(x in o.pAsd)){o.pAsd[x]=xa;}};return a;};
			 	o.percents=o._percents();
			 	o.getPercent=function(){var o=this;return o.percents[(typeof arguments[0]=='undefined')?o.counter:arguments[0]]||false;};
			 	o.percentListener=[];
			 	o.onPercent=function(l,f){var o=this;o.percentListener[l]=f;return o;};
			 	o.SPLCBF=false;
			 	o.setPercentListener=function(c){var o=this,k=(typeof arguments[0]=='undefined')?o.counter:c,a=o.percents[k]||false,tbl=o.percentListener;if(a!=false&&tbl.length>0){for(var x=0;x<a.length;x++){var l=a[x];if(l in tbl){o.SPLCBF=tbl[l];if(typeof o.SPLCBF=='function'){o.SPLCBF(l);}}}}};
			 	o.getTimeBehavior=function(){var o=this;return o.timeBehaviors[o.counter];};
			 	o.getHitBehavior=function(){var o=this;return o.hitBehaviors[o.counter];};
			 	o.timeBehaviors=[];
			 	o.hitBehaviors=[];
			 	o.initBehaviors=function(B,I,II,IV){var o=this,k=o.counter,a=[],m=0,xs=0,e=IV,lm=e,lim=B*o._ht;for(var x=0;x<=o._ht;x++){var lim,ax=o.getBehaviorBy(B,I,II,x,'x');a+=' ';a+=(typeof ax=='number')?(ax*1).virgule(0):ax;if(ax=='x'){xs++;}if(ax!='x'){m+=ax;}}var xz=(Math.abs(e-m)/((xs!=0)?xs:1)).virgule(3),r='';r+=a.substr(1).replace(/[x]/gi,xz);return r.split(' ');};
			 	o.initTimeBehaviors=function(B,I,II){var o=this;o.timeBehaviors=o.initBehaviors(o.timer,'tbehavior','_tbehavior',o.timeline);return o;};
			 	o.initHitBehaviors=function(B,I,II){var o=this;o.hitBehaviors=o.initBehaviors(o.hit,'hbehavior','_hbehavior',o.ecart());return o;};
			 	o.getBehaviorBy=function(B,I,II,III,IV){var III=(typeof arguments[3]=='undefined')?false:arguments[3],IV=(typeof arguments[4]=='undefined')?false:arguments[4],o=this,be=o[I]||false,hit=o.callBack[I]||B;if(typeof be=='object'||typeof o.callBack[I]=='number'){var k=o.getPercent(III),bec=false;for(var x=0;x<k.length;x++){bec=be[k[x]]||false;if(bec!==false){break;}};if(typeof bec=='string'||typeof o.callBack[II]=='number'){var c,b0=bec.trim(),_h,ht=hit,b,p,n,s,h;c=b0.substr(0,1);b=b0.substr(1);p=b.substr(0,1);s=b.substr(-1);n=Math.abs(b.substr(0,b.length-1)*1);n=(typeof n=='number')?n:0;h=0;_h=B;if(!isNaN(n)&&typeof ht=='number'){if(s=='%'){h=(n!==0)?n.cpercent(ht):ht;}if(s=='x'){h=n;}if(p==='+'){_h+=h;}if(p==='-'){_h-=h;}if(p==='*'){_h*=h;}if(p==='/'){_h/=h;}}if(c=='_'){o.callBack[I]=_h;o.callBack[II]=bec||o.callBack[II];}if(c=='/'){o.callBack[I]+=_h;o.callBack[II]=bec||o.callBack[II];}if(c==('\ ').trim()){o.callBack[I]-=_h;o.callBack[II]=bec||o.callBack[II];}if(c!='_'&&c!='/'&&c!=('\ ').trim()&&typeof o.callBack[I]!='undefined'&&typeof o.callBack[II]!='undefined'){o.callBack[I]=undefined;o.callBack[II]=undefined;}hit=_h;}}return (hit==B)?((IV===false)?hit:IV):hit;};
			 	G.foreach(o.__ons,function(v,n){
			 		if(!isString(v)){return false;}

			 		var on=['on',v.ucfirst()].join('');
			 		o[on]=o[on]||o.cfg[v]||G.F();
			 	});

			 	return o.initTimeBehaviors().initHitBehaviors();
			}; 


		 o.STATIC.objects[o.keyName]=o;


		}


	}).create();

	api

		.dynamic('start', function(){var o=this;o.status='-start';o._e.detect('start',o);o.onStart();o.play();return o;})

		.dynamic('restart', function(){var o=this;o.status='-restart';o._e.detect('restart',o);o.onRestart();G(function(){var lpr=o._lrw,co=o.init().start();co._lrw=lpr+1;}).timeout(o.tbr);return o;})

		.dynamic('pause', function(){var o=this;o.status='-pause'; try{G(o._player).clearInt();}catch(err){} o._e.detect('pause',o);o.onPause();return o;})

		.dynamic('stop', function(){

			var o=this;
			o.status='-stop';
			o.level=o.from;
			try{G(o._player).clearInt();}catch(err){} 
			o._e.detect('stop',o);
			o.onStop();

			return o;
		})
		
		.dynamic('play', function(){

			var o=this;o.status='-play';o._e.detect('play',o);o.onPlay();o.player(o,function(_o,l){_o.callBack.level=l;_o._e.detect('hit',o);_o.onHit();},function(_o,l){_o._e.detect('done',o);_o.onDone();if(_o.loop!==false){if(typeof _o.loop=='number'||_o.loop===true){if((_o._lrw<_o.loop)||(_o.loop===true)){_o.restart();}if((_o._lrw>=_o.loop)||(_o.loop===true)){_o._e.detect('end',o);_o.onEnd();}}}else{_o._e.detect('end',o);_o.onEnd();}});

			return o;
		})

	;



})(GC,GAPI);






/*
	GGN Screen
*/
(function(GC,gAPI){

	var api = gAPI({
		
		name:'Screen'

		, static : {

			version : '0.1'

			,xid:'GougnonJSScreenOffsetX'
			
			,xoj:false
			
			,yid:'GougnonJSScreenOffsetY'
			
			,yoj:false
			
			,pixelDepth:function(n){return G((typeof n=='number')?n:100).cpercent(S.pixelDepth);}
			
			,colorDepth:function(n){return G((typeof n=='number')?n:100).cpercent(S.colorDepth);}
			
			,width:function(n){return G((typeof n=='number')?n:100).cpercent(S.width);}
			
			,height:function(n){return G((typeof n=='number')?n:100).cpercent(S.height);}
			
			,XOffset:function(n){return G((typeof n=='number')?n:100).cpercent(G.getDocElement().offsetWidth);}
			
			,YOffset:function(n){return G((typeof n=='number')?n:100).cpercent(G.getDocElement().offsetHeight);}

			,Offset:function(p){
			
				var o=this
			
					,b=typeof arguments[0]=='undefined'
			
					,n=arguments[1]||false
			
					,a={width:o.XOffset(n),height:o.YOffset(n)}

				;

				return (b===true)?a:(a[p]||a);

			}

		}

		, constructor : function(){

			var o = this;

			o.screen=o.STATIC;

			o.instance = isObj(o.ARGS[0]||false) ? o.ARGS[0] : ((isStr(o.ARGS[0])) ? G(o.ARGS[0]) : false );

		}


	}).create();
	

	api

		.dynamic('setCenter',function(p0){
			var o=this;if(typeof o.instance!='object'){return false;}var eo=o.instance,e=eo,w=e.offsetWidth,h=e.offsetHeight,t,l,s=o.screen,c={},p0=p0||false,a=o.ARGS[1]||{};t=(s.YOffset(100)).nuspacer(h),l=(s.XOffset(100)).nuspacer(w);t+='px',l+='px';a.x=a['x']||false;a.x=(a.x.toString().lower()=='right')?'right':'left';a.y=a['y']||false;a.y=(a.y.toString().lower()=='bottom')?'bottom':'top';c[a.x]=l;c[a.y]=t;if(typeof p0=='string'){c.position=p0;}eo.css(c);return o;
		})

		.dynamic('alwaysOn',function(x,y){
			if(typeof this.instance!='object'){return false;}
			var o=this ,eo=o.instance ,sof=o.screen.Offset(false,100) ,eof=eo.Offset(false,100) ,a=o.ARGS[1]||{},xy=a['xy']||[0,0] ,sur=a['surface']||[sof.width,sof.height] ,padd=a['padding']||[0,0] ,_x ,_y ,_w=eof.width ,_h=eof.height ,x=typeof x=='number'?x:0 ,y=typeof y=='number'?y:0 ,lx ,ly ,c={} ; a.x=a['x']||'left';a.x=(a.x.lower()=='right')?a.x:'left';a.y=a['y']||'top';a.y=(a.y.lower()=='bottom')?a.y:'top';_x=x+_w;_y=y+_h;xy[0]=xy[0]||0;xy[1]=xy[1]||xy[0]||0;sur[0]=sur[0]||sof.width;sur[1]=sur[1]||sur[0]||sof.height;padd[0]=padd[0]||0;padd[1]=padd[1]||padd[0]||0;lx=xy[0]+sur[0]*1;ly=xy[1]+sur[1]*1;var __x=(xy[0]+x),__y=(xy[1]+y),__xw=__x+_w,__yh=__y+_h;if(_x>lx||__xw>lx){__x=lx-_w-padd[0];}if(_y>ly||__yh>ly){__y=ly-_h-padd[1];}if(__x<xy[0]){__x=xy[0];}if(__y<xy[1]){__y=xy[1];}__x+='px';__y+='px';c[a.x]=__x;c[a.y]=__y;eo.css(c);
			return o;
		})

		.dynamic('coordinate',function(){

			var o=this; 
			
			if(typeof o.instance!='object'){return false;} 
			
			if(typeof o.instance!='object'){return false;} 

			var oi=o.instance,oe=oi,x=0,y=0,ob=oe,of=oi.Offset(), pos; 

			x=of.left; y=of.top;


			// x = G.browseHTMLElementPath(ob,function(e){return e.parentNode.offsetLeft;});

			// y = G.browseHTMLElementPath(ob,function(e){return e.parentNode.offsetTop;});

			while(ob.parentNode){

				x+=ob.parentNode.offsetLeft;

				y+=ob.parentNode.offsetTop;

				if(ob==G('body').node(0)){break;}

				else{ob=ob.parentNode;}

			} 

			o.x=x;o.y=y;

			return o;
		})

	;


})(GC,GAPI);






/*
	GGN Mouse
*/
(function(GC,gAPI){

	var api = gAPI({
		
		name:'Mouse'

		, static : {

			version:'0.1'

			,DOMWheel:function(){return (GBrowser().gecko===true)?"DOMMouseScroll":"mousewheel";}

		}

		, constructor : function(){

			var o = this;

			o.instance=o.ARGS[0]||false;

			o.browser=G.Browser();

		}


	}).create();
	

	api

		.dynamic('position pos',function(){
			var o=this,oi=o.instance||false;if(typeof oi!='object'){return false;}o.event=oi;o.x=oi.clientX||0;o.y=oi.clientY||0;o._x=oi.pageX||0;o._y=oi.pageY||0;
			return o;
		})

		.dynamic('wheel',function(){
			var o=this,oi=o.instance||false,fa=arguments[0]||G.F();if(typeof oi!='object'){return false;}var EVt=GEvent||GC.Event;o.hote=G(oi);o.callF=fa;EVt(o.hote.prop()).listen(o.STATIC.DOMWheel(),function(e){var dv=e['detail']?e['detail']*(-1):(e['wheelDelta']?e['wheelDelta']:0),u=Math.abs(dv),dvi=120 ,un=(e['detail'])?((u<=3)?dvi:dvi*2):u;o.delta=(e['detail'])?(e.detail*(-1)):((e['wheelDelta'])?e.wheelDelta:false);o._delta=(dv>0)?un:((dv<0)?un*(-1):0);o.event=e;o.callF(e);});return o;
		})

	;


})(GC,GAPI);







/*
	GGN Move
*/
(function(GC,gAPI){

	var api = gAPI({
		
		name:'Move'

		, static : {

			version:'0.1'

			,events:'start move stop'

			,moment:{

				selected:false

			}

		}

		, constructor : function(){

			var o = this;

			o.instance=G(o.ARGS[0]||false);

			o.event=G.Event(o);

		}


	}).create();
	

	api

		.dynamic('init',function(cfg){
			var o=this
				,oi=o.instance||false
				,eo
			;

			if(typeof oi!='object'){return false;}

			eo=oi;
			o.hote=eo;
			o.cfg=cfg||{};
			o.moving=(o.cfg.moving===true)?true:((typeof o.cfg.moving=='boolean')?o.cfg.moving:true);

			o.droppable=(typeof o.cfg.droppable=='undefined')?false:o.cfg.droppable;

			o.backPosition=o.cfg.backPosition||false;
			o.axe=o.cfg.axe||'x:y';
			o.axe=o.axe.lower();

			o.evts = o.STATIC.events.split(' ');
			G.foreach(o.evts,function(v,n){if(!isString(v)){return false;} var on=['on',v.ucfirst()].join('');o[on]=o[on]||o.cfg[v]||G.F();});

			o.MPos=function(evt){var o=this;o.mouse=G.Mouse(evt).position();o.mouseX=o.mouse.x;o.mouseY=o.mouse.y;return o;};

			o.ini_={};
			o.__draggable=false;
			o.off_=oi.Offset();

			o.dragging=function(el,evt,lk){
				var o=this; o.of_=oi.offset();

				var lk=lk||[0,0]
					,x0=o.off_.left
					,x1=o.of_.left
					,y0=o.off_.top
					,y1=o.of_.top
					, axeX=o.axe=='x:y'||o.axe=='x'
					, axX=o.axe=='x'
					, axeY=o.axe=='x:y'||o.axe=='y'
					, axY=o.axe=='y'
					;

					o.MPos(evt);
					o.x=o._x=x0;
					o.y=o._y=y0;
					o._x+='px';
					o._y+='px';

					if(axeX){
						o.x=o._x=o.mouseX-lk[0];o._x+='px';
					}
					if(axeY){
						o.y=o._y=(o.droppable===true)?o.mouseY+10:o.mouseY-lk[1];o._y+='px';
					}

					if(o.droppable===true){GMove.moment.selected=o.instance;}

					if(o.moving===false){return o;}

					el.draggable=!o.__draggable;

					o.instance.css({left:o._x,top:o._y});

				return o;
			};

			eo.draggable=!o.__draggable;

			o.SetBackPos=function(x,y,xf,yf){
				var o=this
					,fx
					,xx
					,yy
					,iNs=o.instance
				;

				x+='px';
				xf+='px';
				y+='px';
				yf+='px';

				iNs.css({left:x,top:y});
				fx=iNs.animation({from:{left:xf,top:yf},to:{left:x,top:y}},300,'ease-in-out');
				return o;
			};

			o.mdwn=oi.on('mousedown',function(evt0){o.NDP=GScreen(eo).coordinate();var el0=this,_DRAG_INSIDE_=true,l,t,l0=o.NDP.x,t0=o.NDP.y;eo.draggable=o.__draggable;o.MPos(evt0);
				t=(o.mouseY-t0);
				l=(o.mouseX-l0);
				o.ini_={x:eo.offsetLeft,y:eo.offsetTop,left:eo.offsetLeft,top:eo.offsetTop};
				o.event.detect('start',evt0,o);
				if(isFunction(o['onStart']||'')){o.onStart(evt0);}

				G.D.onmousemove = function(evt1,e0){
					var el1=this;
					el0.draggable=!o.__draggable;
					o.dragging(el0,evt1,[l,t]);
					o.event.detect('move',evt1,o);
					if(isFunction(o['onMove']||'')){o.onMove(evt1);}
					return false;
				};

				G.D.onmouseup = function(evt2){
					var el2=this;
					o.event.detect('stop',evt2,o);
					if(isFunction(o['onStop']||'')){o.onStop(evt2);}
					if(o.backPosition===true&&o.moving===true){o.SetBackPos(o.ini_.left,o.ini_.top,o.x,o.y);}
					o.STATIC.moment.selected=false;
					el0.draggable=false;
					_DRAG_INSIDE_=false;
					G.D.onmousemove = null;
					G.D.onmouseup = null;
					return false;
				};

					return false;
			});

			return o;

		})

	;


})(GC,GAPI);







/*
	GGN Drop
*/
(function(GC,gAPI){

	var api = gAPI({
		
		name:'Drop'

		, static : {

			version:'0.1'

			,events:'start enter leave drop'

		}

		, constructor : function(){

			var o = this;

			o.instance=G(o.ARGS[0]||false);

			o.event=G.Event(o);

			o.evts=o.STATIC.events.split(' ');

		}


	}).create();
	

	api

		.dynamic('init', function(ar){

			var o=this
				,oi=o.instance||false
				,oe
				,ar=ar||{}
				,Ev=GEvent
				,Mm = GMove.moment
			;

			if(typeof oi!='object'){return false;}

			oe=oi;
			o.oi=oi;
			o.oe=oe;
			o.cfg=ar;
			o.format=o.format||o.cfg.format||'Text';

			G.foreach(o.evts,function(v){if(!isString(v)){return false;}var _n='on';_n+=v.ucfirst();o[_n]=o[_n]||o.cfg[v]||G.F();});

			o.DragNow = false;

			Ev(oe).listen('mouseenter',function(ev){if(typeof o.onEnter=='function' && isObject(Mm.selected||'')){o.onEnter(false,Mm.selected);}},false);
			
			Ev(oe).listen('mouseleave',function(ev){if(typeof o.onLeave=='function' && isObject(Mm.selected||'')){o.onLeave(false,Mm.selected);}},false);
			
			Ev(oe).listen('mousemove',function(ev){if(typeof o.onOver=='function' && isObject(Mm.selected||'')){o.onOver(false,Mm.selected);}},false);
			
			Ev(oe).listen('mouseup',function(ev){if(typeof o.onDrop=='function' && isObject(Mm.selected||'')){o.onDrop(false,Mm.selected);} },false);

			var ov=Ev(oe);

			ov.listen('dragstart',function(ev){if(typeof o.onStart=='function'){o.onStart(ev,false);}},false);
			
			ov.listen('dragenter',function(ev){if(typeof o.onEnter=='function'){o.onEnter(ev,false);}},false);
			
			ov.listen('dragover',function(ev){ev.dataTransfer.dropEffect='move';if(typeof o.onOver=='function'){o.onOver(ev,false);}if(ev.preventDefault){ev.preventDefault();}return false;},false);
			
			ov.listen('dragleave',function(ev){if(typeof o.onLeave=='function'){o.onLeave(ev,false);}},false);
			
			ov.listen('drop',function(ev){if(typeof o.onDrop=='function'){o.onDrop(ev,false);}if(ev.stopPropagation){ev.stopPropagation();}if(ev.preventDefault){ev.preventDefault();}return false;},false);
			
			ov.listen('dragend',function(ev){if(typeof o.onDragend=='function'){o.onDragend(ev,false);}return false;},false);

			return o;

		})

	;


})(GC,GAPI);







/*
	GGN Awake
*/
(function(GC,gAPI){

	var api = gAPI({
		
		name:'Awake'

		, static : {

			version:'0.1'

			,_vars:'hote fixed depth opacity locked width height top left follow from'

			,_events:'show lock close'

			,Zin : function(ht,p){

				var ht=isObject(ht) ? ht : G('body'), p=p||2, l=ht.getChildStyle('z-index'),v=1;

				GC.foreach(l[1],function(z, kk){

					var el = l[0][kk];


					if(
						z.lower()=='auto'

						|| el.tagName.lower() == 'script'

						|| el.tagName.lower() == 'style'

						|| el.tagName.lower() == 'meta'

						|| el.tagName.lower() == 'link'

					){

						return false;

					}

					if(el){

						if((/toast-api-item/gi).test(el.className)){

							return false;

						}

					}

					
					v+=z*1;
				
				},false,false,'.');

				return v.abs() + p;

			}

		}

		, constructor : function(){

			var o = this,stc = o.STATIC;

			o.cfg=o.ARGS[1]||{};

			o.promise=G(o.ARGS[0]||false);
				
			o.event=G.Event(o);

			o.vars=stc._vars.split(' ');

			o.evts=stc._events.split(' ');

			o.status = false;

			o.CATs = 150;


			GC.foreach(o.vars, function(n){o[n]=o.cfg[n]||false;},false,false,'.');

			GC.foreach(o.evts, function(n){var nn='on';nn+=n.ucFirst();o[nn]=o.cfg[n]||G.F();},false,false,'.');

			o.hote = isObject(o.hote) ? o.hote : G('body');
			
			o.fixed = o.fixed || false;

			o.activeFx = (typeof o['activeFx'] == 'boolean') ? ((o.activeFx==false) ? false : true) : true;

			o.top = o.top || 0;

			o.left = o.left || 0;

			o.opacity = o.opacity || 0.75;

			o.promiseCallBack = null;

			o._iEl()._content();

			var bx = o.bx, gde = G.getDocElement();

			/* Position du contenu fixé par raport au scrollbar */
			if(isObj(o.from||'')){

				o.activeFx = false;

				o.event.add('before.show', function(){

					var sxy = GScreen(o.from).coordinate(), gshp = o.from.getShape()

						, cshp = bx.ctn.getShape()

						,cof = bx.ctn.offset()

							, cx = [cof.left,'px'].join('')
							, cy = [cof.top,'px'].join('')

						,c = {}

					;

					bx.ctn.addClass('gui pos-absolute').css({'transform':'translateX(-48%) translateY(-48%) scale(0.01)'});

					c.left = (sxy.x )  - gde.scrollLeft; c.left+='px';

					c.top = (sxy.y )  - gde.scrollTop; c.top+='px';

					gshp.width = 'initial';

					gshp.height = 'initial';

					G.foreach(gshp,function(v,k){c[k] = v;});


					bx.ctn.css(c).addClass('fx');


					G(function(){
						
						bx.ctn.css({'transform':'translateX(0%) translateY(0%)  scale(1)'});
					
						var c0 = {};
					
						c0.top = cy;

						c0.left = cx;

						bx.ctn.css(c0);

					}).timeout(o.CATs/5);


					G(function(){

						var c1 = {};

						cshp.width = 'initial';

						cshp.height = 'initial';

						G.foreach(cshp,function(v,k){c1[k] = v;});

						bx.ctn.css(c1);

					}).timeout(o.CATs/2);


					G(function(){

						bx.ctn.removeClass('gui pos-absolute');

					}).timeout(o.CATs + (o.CATs/2));

						
					
				});

				o.event.add('before.close', function(){

					var sxy = GScreen(o.from).coordinate(), gshp = o.from.getShape()

						, cshp = bx.ctn.getShape()

						,c = {}

					;

					o.closeTimeout = o.CATs - (o.CATs/5);


					c.left = sxy.x  - gde.scrollLeft; c.left+='px';

					c.top = sxy.y  - gde.scrollTop; c.top+='px';

					gshp.left = c.left;

					gshp.top = c.top;

					gshp.width = false;

					gshp.height = false;

					G.foreach(gshp,function(v,k){c[k] = v;});

					bx.ctn.css(c).addClass('gui pos-absolute').css({'transform':'translateX(-48%) translateY(-48%) scale(0.01)'});;

					G(function(){

						bx.ctn.removeClass('gui pos-absolute fx');

					}).timeout(o.CATs*2);

				});


			}


			/* Suivre l'ecran */
			GEvent(o.hote===G('body') ? window : o.hote).listen('scroll', function(){

				if(o.follow == true){

					o._ajustPos();

				}

			});

			

		}


	}).create();
	

	api

		.dynamic('_iEl', function(){

			var o=this,bx = o.bx||{},pcn='pos-', ht=o.hote, hof=ht.offset(), stc=o.STATIC, pib = ht===G('body');

			o.Zin = stc.Zin(ht);

			pcn += (o.fixed === true && ht===G('body')) ? 'fixed' : 'absolute' ; // (G('body')===ht ? 'fixed' : 'absolute')


			bx.p = bx.p || ht.create({cn:'gui awake-api-encompass pos-absolute gui-fx'});
			// bx.p = bx.p || ht.create({cn:pcn});

				bx.p.css({'z-index' : o.Zin.toString(), display:'none'});

				bx.p.attrib('ggn-awake-item','true');

				// alert([ bx.p.css('z-index'), o.Zin, typeof o.Zin, typeof o.Zin.toString() ].join('\n'))


			bx.lgh = bx.lgh || bx.p.create({cn:'light gui pos-absolute gui-fx'});


			bx.ctnr = bx.ctnr || bx.p.create({cn:'container gui flex center wrap gui-fx'}).addClass(pcn);

				bx.ctn = bx.ctn || bx.ctnr.create({cn:'content gui-fx'});

					bx.ctn.opacity(0.1);
				

			o.bx = bx;

			o.event.detect('state.elements',o);

			o._ajustSize();


			GEvent(pib ? W : ht).listen('resize', function(){

				o._ajustSize();

			});


			return o;

		})


		.dynamic('_ajustPos', function(){

			var o=this, bx=o.bx, ht=o.hote, gde = G.getDocElement()

				, x = gde.scrollLeft + (o.left||0)

				, y = gde.scrollTop + (o.top||0)

				, cr = {}

			;

			o.event.detect('ajust.position',o);


			/* Position du contenu fixé par raport au scrollbar */
			if(o.fixed==true){

				x -= gde.scrollLeft;

				y -= gde.scrollTop;

			}

			x+='px';

			y+='px';

			cr['left'] = x;

			cr['top'] = y;


			/* Applicaiton du style sur le conteneur "container" */
			bx.ctnr.css(cr);
			
			return o;

		})

		.dynamic('_ajustSize', function(){

			var o=this, bx=o.bx, ht=o.hote, gde = G.getDocElement(), pib = ht===G('body'), pof=ht.offset()

				,lc = {}, off_ = o._offset()

				, cr = {}

			;

			o.event.detect('ajust.size',o);


			lc.width = off_.scrollWidth; lc.width += 'px';

			lc.height = off_.scrollHeight; lc.height += 'px';


			/* definition de la taille en fontion du parent */
			if(pib){

				cr.width = '100vw';

				cr.height = '100vh';

			}

			if(!pib){

				cr.width = pof.width;cr.width+='px';

				cr.height = pof.height;cr.height+='px';

			}

			

			/* Applicaiton du style sur le conteneur "container" */
			bx.ctnr.css(cr);


			/* Application du style sur le 'parent' */
			bx.p.css(lc);

			return o._ajustPos();

		})

		.dynamic('_offset', function(){

			var o=this, bx=o.bx, ht=o.hote, ph = ht===G('body') ? G.getDocElement() : ht;

			return ((isFunc(ph.offset||'')) ? ph : ht).offset();

		})

		.dynamic('_content', function(ctn){

			var o=this, bx=o.bx;

			if(isObject(bx['ctn']||'')){

				o.promise = ctn||o.promise;

				if(isObject(o.promise)){

					o.promise.removeAttrib('ggn-awake-promise');

					o.event.detect('state.content',o);

					bx.ctn.append(o.promise);
					
				}

				if(isString(o.promise)){

					bx.ctn.addClass('auto-content box-shadow-dark');

					o.event.detect('state.content',o);

					bx.ctn.html(o.promise);
					
				}

				bx.ctn.opacity(1);

				o._size();

			}

			return o;

		})

		.dynamic('_size', function(){

			var o=this, bx=o.bx, s = {};

			o.event.detect('state.size',o);

			if(o.width||o.height){

				G.foreach( ('width height').split(' '), function(n){

					if(isNumber(o[n]) || isString(o[n])){

						var d = o[n];

							d += isNumber(o[n]) ? 'px' : '';

							s[n] = d;

					}

				},false,false,'.');

			}


			bx.ctn.css(s);

			return o;

		})

		.dynamic('_actionsCloser', function(ev,o){

			if(GEvent(ev).source()===this){

				if(o.locked===true){

					var bx = o.bx;

					o.event.detect('destroy.light',o);
					
					bx.ctn.cancelStyleB('animation');

					bx.p.addClass('locked');

					G(function(){

						bx.p.removeClass('locked');

					}).timeout(150);

				}

				else{
					o.close();
				}

			}


		})

		.dynamic('_actions', function(){

			var o=this, bx=o.bx;

			o.event.detect('state.actions',o);

			bx.lgh.on('click', o._actionsCloser, o);

			bx.ctnr.on('click', o._actionsCloser, o);


			if('KeyShot' in G){

				try{

					var Esc = GKeyShot(function(){

						if(o.locked===false){o.close(); }

					}).key('ESCAPE');

					GEvent(G.DOC).listen('keypress', function(ev){Esc.detect(ev, false);},true);

				}
				catch(e){}

			}

			return o;

		})

		.dynamic('_depth', function(){

			var o=this, bx=o.bx, d=o.depth||false;

			if(isString(o.depth)){

				o.event.detect('state.depth',o);

				o.hote.attrib('ggn-awake-depth',o.depth);

				bx.p.attrib('ggn-awake-depth-self',o.depth);

			}

			return o;

		})

		.dynamic('_destroy_depth', function(){

			var o=this, bx=o.bx, d=o.depth||false;

			if(isString(o.depth)){

				o.event.detect('destroy.depth',o);

				o.hote.removeAttrib('ggn-awake-depth');

				bx.p.removeAttrib('ggn-awake-depth-self');

			}

			return o;

		})

		.dynamic('close', function(){

			var o=this, bx=o.bx;

			if(o.status===false){return o;}

			o.closeTimeout = 1;

			o.event.detect('before.close',o);


			G(function(){

				bx.ctn.opacity(0.001);

				bx.lgh.opacity(0.001);

			}).timeout(350);


			if(o.activeFx){

				bx.ctn.animation(

					{
						from : {'transform' : 'scale(1)', 'opacity' : '1'}

						,to : {'transform' : 'scale(2)', 'opacity' : '0.01'}
					}

					,150,'ease-out'

					,function(){

						o.event.detect('close',o);

						bx.p.display('none');

						o._destroy_depth();

						o.status = false;

					}

				);

			}



			if(!o.activeFx){

				G(function(){

					o.event.detect('close',o);

					bx.p.display('none');

					o._destroy_depth();

					o.status = false;

				}).timeout(o.closeTimeout);

			}


			return o;

		})

		.dynamic('show', function(){

			var o=this,bx;

			if(o.status===true){return o;}


			bx=o.bx;


			bx.p.display('flex');


			o._actions()._depth()._size();

			bx.lgh.opacity(o.opacity);

			o.event.detect('before.show',o);

			// bx.p.removeClass('disable');

			o._size()._ajustSize();

			if(o.activeFx){

				bx.ctn.animation(

					{

						from : {'transform' : 'scale(0.3)', 'opacity' : '1'}
						
						, to : {'transform' : 'scale(1)', 'opacity' : '0.01'} 

					} 

					,150,'ease-out'

					, function(){o.event.detect('show',o);bx.ctn.opacity(1);o.status = true;}

				);

			}


			if(!o.activeFx){

				bx.ctn.opacity(1);

				o.event.detect('show',o);

				o.status = true;

			}


			return o;

		})

		.dynamic('setContent', function(c){

			var o=this,bx = o.bx,c=c||false;

			if(isString(c)){

				o.event.detect('state.content');

				bx.ctn.html(c);

				o._size();

			}

			return o;

		})

	;


})(GC,GAPI);







/*
	GGN Toast
*/
(function(GC,gAPI){

	var api = gAPI({
		
		name:'Toast'

		, static : {

			version : '0.1.2'

			,objects : []

			,MasObjects : []

			,events : 'show close click'

			,vars : 'hote title text icon image imageSize paletteColor delay click permanent'

			,ids : '#ggn-toast-api-master'

			,delay : 3000

			,paletteColor : 'primary'

			,master : function(b0){

				var o = this
				
					, k = o.MasObjects.len()
				
					, ids = G(o.ids)
				
					, b = isObj(b0||'') ? b0 : G('body')
				
					, cls = isObj(b0||'') ? 'pos-absolute' : 'pos-fixed'
				
					, id = !isObj(b0||'') ? o.ids.substr(1) : (b0.id.toString().isEmpty() ? ['ggn-toast-api-master-custom', k].join('-') : b0.id )
				
					, base = o.MasObjects[id] || b.create({id:id,cn:'gui flex column-rev center'}).addClass(cls);
				
				;


				if(!o.MasObjects[id]){o.MasObjects[id] = base;}

				return base;

			}

			,CY : function(){

				var o=this,h=0;

				GC.foreach(o.objects, function(oj){

					if(!isObject(oj)){return false;}

					if(!oj.status){return false;}


					if(!isObject(oj['bx']||'')){return false;}

					if(!isObject(oj.bx['p']||'')){return false;}

					h+=oj.bx.p.offset().height;

				},false,false,{});

				return h;

			}


			,autoRGS : function(){

				var l=0,o=this;

				GC.foreach(o.objects, function(oj){

					if(!isObject(oj)){return false;}

					if(!oj.status){return false;}

					if(!isObject(oj['bx']||'')){return false;}

					if(!isObject(oj.bx['p']||'')){return false;}

					var p=oj.bx.p,off=p.offset(), b=(p.css('bottom')||'').stripAlphaChar()*1, h=off.height;
					
					if(l!=b){

						var lh=l;lh+='px';

						p.css({bottom:lh});

					}

					l+=h;

				},false,false,{});


			}


		}

		, constructor : function(){

			var o = this

				, Stt = o.STATIC

				,oj = Stt.objects

			;

			o.ins=o.ARGS[0]||false;

			o.key = oj.length;

			o.event = GEvent(o);

			o.status = false;

			o.delayTimer = false;


			if(isString(o.ins)){
			
				o.text = o.ins;

				o.delay = Stt.delay;
			
			}
			
			if(isObject(o.ins)){

				GC.foreach(Stt.vars.split(' '), function(n){o[n]=o.ins[n]||false;},false,false,'.');

				GC.foreach(Stt.events.split(' '), function(n){var nn='on';nn+=n.ucFirst();o[nn]=o.ins[n]||G.F();},false,false,'.');

				o.delay = (o.ins['delay']===null) ? null : ((isNumber(o.delay)) ? o.delay : Stt.delay);

			}


			o.paletteColor = (isString(o.paletteColor)) ? o.paletteColor : Stt.paletteColor;

			o.hote = Stt.master(o.hote||false);

			o.click = (isFunction(o.click)) ? o.click : G.F();

			o.icon = (isString(o.icon)) ? o.icon : 'info';

			Stt.objects[o.key] = o;

			o.hote.attrib('ggn-awake-no-depth', 'true');


		}


	}).create();
	

	api

		.dynamic('_iEl', function(){

			var o=this,z;

			o.bx = {};

			z = -1 * o.key * 1;z+=' !important';

			o.bx.p = o.bx.p || o.hote.create({cn:'gui toast-api-item flex row center x48-h-min text-x14 x768-w-max', css : {'z-index' : z} });// pos-fixed

				o.bx.p.data('toast-item-status', 'false');


			if(isString(o.icon)){o.bx.icn = o.bx.icn || o.bx.p.create({cn:'x48-w x48-h-min gui flex center'});o._BxCOn('icn');}

			if(isString(o.image)){o.bx.img = o.bx.img || o.bx.p.create({cn:'image x64-w-min x48-h-min _h10 background-abs-center'});o._BxCOn('img');}

			o.bx.cnt = o.bx.cnt || o.bx.p.create({cn:'content col-0 gui flex column start'});o._BxCOn('cnt');

				o.bx.ttl = o.bx.ttl || o.bx.cnt.create({cn:'title gui flex start _w10 text-x18'});o.bx.p.replaceClass('center','start');

				o.bx.txt = o.bx.txt || o.bx.cnt.create({cn:'text _w10'});

			o.bx.cls = o.bx.cls || o.bx.p.create({cn:'close x32-w gui flex center'});

				o.bx.clsa = o.bx.clsa || o.bx.cls.create({tag:'a',cn:'x32-w'});

					o.bx.clsa.attrib('href','#').on('click', function(){o.close();return false;}).html('<span class="gui iconx x16">close</span>');

			o._permanent();

			o._paletteColor(o.paletteColor);



			return o;

		})

		.dynamic('_paletteColor', function(c){

			var o =this,c=c||false;

			if(isString(c)){
				
				var c0 = 'bg-';
				
				c0 += c;

				o.bx.p.addClass(c0);

			}

			return o;

		})

		.dynamic('_permanent', function(p){

			var o =this;

			o.permanent = (typeof p != 'undefined') ? p||false : o.permanent;

			if(o.permanent===false){o.bx.cls.display('flex');}

			if(o.permanent===true){o.bx.cls.display('none');}

			return o;

		})

		.dynamic('_BxCOn', function(c){

			var o =this,c=c||false;

			if(isString(c) && isObject(o.bx[c])){

				o.bx[c].on('click',function(ev){

					o.event.detect('click');

					var ret = (o.click(ev)===false) ? false : true;

					if(isFunction(o['onClick']||false)){o.onClick(ev);}

				});

			}


			return o;

		})

		.dynamic('_icon', function(){

			var o =this,c='<span class="gui iconx text-x24">';

			if(!isString(o.icon)){return o;}

				c+=o.icon;
				
				c+='</span>';

				o.bx.icn.html(c);

			return o;

		})

		.dynamic('_image', function(){

			var o =this,c='url(';

			if(!isString(o.image)){return o;}


			if(isObject(o.imageSize)){

				var s=o.imageSize
					, w=s[0]||48
					, h=s[1]||s[0]||48
				;

				w+='px';
				
				h+='px';

				o.bx.img.css({'width':w,'min-height':h})

			}

				c+=o.image;
				
				c+=')';
				
				o.bx.img.css({'background-image':c});

			return o;

		})

		.dynamic('_title', function(t){

			var o =this,tt=t||o.title||false;

			if(!isString(tt)){return o;}

			// o._adjustPadding(o.bx.txt);

			o.bx.ttl.html(tt);

			return o;

		})


		.dynamic('_adjustPadding', function(bx){

			var o =this;

			if(!isObj(bx||'')){o.bx.cnt.addClass('only'); }

			if(isObj(bx||'')){

				if(!bx.html().inner.toString().isEmpty()){o.bx.cnt.removeClass('only'); }

				else{o.bx.cnt.addClass('only'); }

			}

			return o;

		})


		.dynamic('_text', function(t){

			var o =this;

			// o._adjustPadding(o.bx.txt||'');

			o.bx.txt.html(t||o.text||'');

			return o;

		})

		.dynamic('_autoRGS', function(k){

			var o =this,im=o.STATIC.objects;

				GC.foreach(im, function(oj,ko){

					if(k < ko){

						var y0=oj.bx.p.css('bottom').stripAlphaChar(), y1=o.off.height, h1 = y0 - y1;

						h1+='px';

						oj.bx.p.css({bottom:h1});

					}

				});

			return o;

		})

		.dynamic('close', function(){

			var o =this

				,bf=''

				,p=o.bx.p

				,k = o.key

			;


			o.event.detect('close');

			if(isFunction(o['onClose']||false)){if(o.onClose()===false){return false;}}


			bf += -1 * p.offset().height;

			bf+='px';


			o.off = o.bx.p.offset();

			p.animation(

				{

					from : {'margin-bottom' : '0px', opacity : '1'}

					,to : {'margin-bottom' : bf, opacity : '0.1'}

				}

				,300

				,'ease-in-out'

				,function(){

					p.display('none');

					o.STATIC.autoRGS();

					p.remove();

				}
				
			);

			o.status = false;

			o.bx.p.data('toast-item-status', 'false');


			return o;

		})

		.dynamic('show', function(){

			var o =this
				
				,b
				
				,bf = 0

				,p = o.bx.p

				,po = p.offset()

				,h0 = o.STATIC.CY()

			;


			if(isNumber(o.delayTimer)){

				o.delayTimer.clearOut();

			}

			o.event.detect('show');

			if(isFunction(o['onShow']||false)){if(o.onShow()===false){return false;}}


			p.display('flex');


			bf = -1 * po.height;

			b = h0; 


			b += 'px';

			bf += 'px';

			p.css({bottom : b, opacity : '1'});


			p.animation(
				{

					from : {'margin-bottom' : bf, opacity : '0.1'}

					,to : {'margin-bottom' : '0px', opacity : '1'}

				}

				,300

				,'ease-in-out'

				,function(){

					// o.STATIC.autoRGS();

				}

			);


			o.status = true;

			o.bx.p.data('toast-item-status', 'true');

			o._delay();

			return o;

		})

		.dynamic('_delay', function(d){

			var o =this

			;

			o.delay = d||o.delay;

			if(o.delay!==null){

				o.delayTimer = G(function(){o.close();}).timeout(o.delay);

			}

			return o;

		})

		.dynamic('bubble', function(tq){

			var o =this

				,tq = tq || false

				,z

			;

			o._iEl();


			o.bx.p.addClass('bubble');

			o._icon()._image()._title()._text();


			if(tq===false){

				o.show();

			}

			return o;

		})

		.dynamic('info', function(tq){

			var o =this,tq=tq||false;

			o.paletteColor = 'dark color-light';

			o.bubble(tq);

			return o;

		})

	;


	GC.foreach(('success error warning wait').split(' '), function(n,k){

		api.dynamic(n, function(tq){

			var o = this,tq=tq||false,nn=n;

			nn += ' color-';
			nn += n;
			o.paletteColor = nn;

			o.icon = (n=='error' ? 'error' : (n=='success' ? 'check' : (n=='warning' ? 'warning' : (n=='wait' ? 'sync' : 'info') ) ) );

			o.bubble(tq);

			return o;

		});


	},false,false,'.');


})(GC,GAPI);







/*
	GGN Drop
*/
(function(GC,gAPI){

	var api = gAPI({
		
		name:'Ajax'

		, static : {

			version:'0.1'

			,events:'load progress error abort loadend success fail wait'

			,xhrvars:'data mode contentType mime charset headers upload'

		}

		, constructor : function(){

			var o = this;

			o.instance=o.ARGS[0]||false;
			
			o.event=G.Event();
			
			o.evts=o.STATIC.events.split(' ');

		}


	}).create();
	

	api

		.dynamic('__xhrCD',function(){var o=this;return (function(oo){return (!oo)?((W.XMLHttpRequest)?new XMLHttpRequest():null):new XDomainRequest();})(W.XDomainRequest||false);})

		.dynamic('__xhr',function(){var o=this;return (function(oo){var ieo=function(){try{var x=null;var x=new ActiveXObject("Msxml2.XMLHTTP");}catch(e){var x=new ActiveXObject("Microsoft.XMLHTTP");}return x;};return (oo===false)?((W.ActiveXObject)?ieo():null):new XMLHttpRequest();})(W.XMLHttpRequest||false);})

		.dynamic('XHR',function(){

			var o=this
				,x=null
			;

			o.working=false;

			o.toString=function(){return '[Gougnon Ajax.XHR.API]';};

			o.__novars=o.STATIC.xhrvars.split(' ');

			o.cfg=o.instance||{};

			o.URI=o.URI||o.cfg.URI||o.cfg.uri||false;

			o.crossDomaine=o.crossDomaine||o.cfg.crossDomaine||false;o.crossDomaine=(typeof o.crossDomaine=='boolean')?o.crossDomaine:false;

			if(o.URI===false){return false;}

			G.foreach(o.__novars,function(v,n,oj){o[v]=o[v]||o.cfg[v]||false;},false,false,'.');

			o.mode=[o.mode||'get'].join('').upper();

			o.contentType=o.contentType||'application/x-www-form-urlencoded';

			o.mime=o.mime||'text/xml';

			x=(o.crossDomaine==false)?o.__xhr():o.__xhrCD();

			if(x==null){return false;}

			o.xhr=x;

			o._EL=GEvent(o.xhr);

			G.foreach(o.evts,function(v,n,oj){var _n='on';_n+=[v].join('').ucfirst();o[_n]=o[_n]||o.cfg[v]||G.F();if(v!=='load'&&v!=='success'&&v!=='fail'){o._EL.listen(v,function(ev){o.resultEvent=ev;o.event.detect(v,o);((typeof o[_n]=='function')?o[_n]():G.F()());},false);}},false,false,'.');

			o._EL.listen('load',function(ev){o.event.detect('load',o);o.onLoad();


			if(isObject(o.upload)){

				var Up = o.xhr.upload, UpE = GEvent(Up), EvUp = 'progress load error abort';

				G.foreach(EvUp.split(' '), function(n){

					UpE.listen(n, o.upload[n]||G.F());

				},false,false,'.');

			}

			o.resultEvent=ev;

			if(o.xhr.readyState==4&&o.xhr.status==200){
				o.working=false;
				o.event.detect('success',o);((typeof o['onSuccess']=='function')?o.onSuccess():G.F()());
				return false;
			}

			if(o.xhr.readyState==4&&o.xhr.status==404){o.event.detect('fail',o);((typeof o['onFail']=='function')?o.onFail():G.F()());return false;}

			else{o.event.detect('error',o);((typeof o['onError']=='function')?o.onError():G.F()());}},false);o._EL.listen('progress',function(ev){o.event.detect('progress',o);o.onProgress(ev);},false);o._EL.listen('abort',function(ev){o.event.detect('abort',o);o.onAbort(ev);},false);o.xhr.open(o.mode,o.URI,true);

		o.send=function(){var o=this,ar=arguments;
			if(o.xhr.overrideMimeType && o.charset!=false){o.xhr.overrideMimeType([o.mime,';charset=',o.charset].join(''));}

			o.xhr.setRequestHeader('Content-type',[o.contentType,' charset=',((typeof o.charset!='string')?'utf-8':o.charset),';'].join(''));

			if(isObject(o.headers||false)){
				G.foreach(o.headers, function(h,n){
					if(isFunction(h)){return false;}
					o.xhr.setRequestHeader(n,h);
				});
			}

			o.event.detect('wait',o);o.onWait();
			o.xhr.send(ar[0]||o.data||null);
			o.working=true;
			return o;
		};

			return o;

		});
	;


})(GC,GAPI);






/* Gougnon : Fusion */
GC.merge(G,GC);



/* Initialisation de l'Action Handler */

	GAction.Handler(G.HTMLEventsName);



})(window,document,screen,navigator);