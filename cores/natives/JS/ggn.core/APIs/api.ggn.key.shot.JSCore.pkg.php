/* GougnonJS.KeyShot, version : 0.1, update : 161226.1440, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I,gAPI){var api; if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec KeyShot 0.1 ');return false;} 

	api=gAPI({name:'KeyShot'
		,static:{
			
			version:'0.1, Dec 2016, 161227.2054'
			
			,ShortCuts:{

				Active:true

			}
			
			,varsevent:'show close click'
			
			,_keys:'BACKSPACE TAB ENTER SHIFT CTRL ALT PAUSE.BREAK CAPS.LOCK ESCAPE PAGE.UP PAGE.DOWN END HOME LEFT.ARROW UP.ARROW RIGHT.ARROW DOWN.ARROW INSERT DELETE 0 1 2 3 4 5 6 7 8 9 A B C D E F G H I J K L M N O P Q R S T U V W X Y Z LEFT.WINDOW.KEY RIGHT.WINDOW.KEY CONTEXT.MENU.KEY NUMPAD.0 NUMPAD.1 NUMPAD.2 NUMPAD.3 NUMPAD.4 NUMPAD.5 NUMPAD.6 NUMPAD.7 NUMPAD.8 NUMPAD.9 MULTIPLY ADD SUBTRACT DECIMAL.POINT DIVIDE F1 F2 F3 F4 F5 F6 F7 F8 F9 F10 F11 F12 NUM.LOCK SCROLL.LOCK SEMI.COLON EQUAL.SIGN COMMA DASH PERIOD FORWARD.SLASH GRAVE.ACCENT OPEN.BRACKET BACK.SLASH CLOSE.BRAKET SINGLE.QUOTE'
			
			,_codes:'8 9 13 16 17 18 19 20 27 33 34 35 36 37 38 39 40 45 46 48 49 50 51 52 53 54 55 56 57 65 66 67 68 69 70 71 72 73 74 75 76 77 78 79 80 81 82 83 84 85 86 87 88 89 90 91 92 93 96 97 98 99 100 101 102 103 104 105 106 107 109 110 111 112 113 114 115 116 117 118 119 120 121 122 123 144 145 186 187 188 189 190 191 192 219 220 221 222'

		} 

		,constructor:function(){

			var o=this; 

			o.Stc=this.STATIC; 

			o.args=o.ARGS||[]; 

			o.doc=o.args[0]||false; 

			o.__dSCK = false;

			o._keys=o.Stc._keys.split(' '); 

			o._codes=o.Stc._codes.split(' '); 

			o.counter=0; o.event=GEvent(o); 

		} 

	})
	
		.create()


		.dynamic('getCodeByKey',function(ka){var o=this ,a=arguments ,ret=false; if(typeof a[0]!='string'){return false;} for(var k in o._keys){var c=o._keys[k];if(c==ka.upper()){ret=o._codes[k]*1;break;}else{}}; return ret; })

		.dynamic('getKeyByCode',function(ka){var o=this ,a=arguments ,ret=false; ka*=1; for(var k in o._codes){var c=o._codes[k];if(c==ka){ret=o._keys[k];break;}else{}}; return ret; }) 

		.dynamic('key',function(){var o=this,a=arguments; if(typeof a[0]!='string'){return o;} o.keyChar=a[0]; o.keyCode=o.getCodeByKey(o.keyChar); return o; }) 

		.dynamic('code',function(evt){var o=this,a=arguments;return ((evt.which)?evt.which:evt.keyCode);})

		.dynamic('detect',function(){
			var o=this,a=arguments; 

			if(o.__dSCK==true){return false;} 
			if(typeof o['doc']!='function'){return false;} 
			if(typeof a[0]!='object'){return false;} 

			var evt=a[0]||A.event
				,kyc=(evt.which)?evt.which:evt.keyCode
				,lp=a[1]||false
				,kc=o.keyCode||false
				,kch=o.keyChar
				,fa=o.doc
				,uc=evt['charCode']||evt['keyCode']
				,kych=String.fromCharCode(uc)
			; 

			o._unicode=uc;
			o._keyCode=kyc;
			o._keyChar=kych;

			o.Accept=o.getKeyByCode(kc); 
			o.Pressed=o.getKeyByCode(kyc); 

			if(lp==false&&o.counter>=1){return false;} 
			o.callF=fa; 
			if(typeof lp=='number'&&lp<=o.counter){return false;} 
			if(kc==kyc||kych==kch){
				if(typeof fa=='function'){
					o.callF(evt);
					o.event.detect('execute',o,evt);
					o.counter++;
					return true;
				}
			} 

			return false; 
				
		})

		.dynamic('shortcuts ShortCuts',function(){

			var o=this, cmds=arguments, doc = o.doc||false, Trg, cmd0, Fn=o.args[1]||G.F();
			

			if(typeof o['doc']!='object'){return false;}

			if(typeof cmds.length<2){return false;}


			o.Detector = [];

			o.Exector = isFunction(Fn||'') ? Fn : G.F();


			o.Already = false;

			o.Hits = [];

			G.foreach(cmds, function(cm){o.Hits[o.Hits.length]=cm; });

			o.Hits = o.Hits.purge('.');


			o.Return = o.args[2]||false;

			o.Cmd0 = cmds[0];

			o.Loop = (typeof o.args[3] == 'boolean') ? o.args[3] : true;

			o.Cmds = cmds;

			o.Doc = doc;
			

			Trg = o.Stc(function(ev){

				o.Hit=[o.Cmd0];

				o.ShortCutsHit(1);

			}).key(o.Cmd0);


			o.K = 0;

			o.Hit = [];

			GEvent(doc).listen('keydown', function(ev){

				if(o.Stc.ShortCuts.Active===true && o.__dSCK == false && (o.Loop || (!o.Loop && !o.Already) ) ){

					Trg.detect(ev, true);

				}

			}, true);

			return o; 

		})

		.dynamic('ShortCutsHit',function(k){

			var o = this, doc=o.Doc, cmds = o.Cmds, Ex, Len = cmds.length, Lim = Len-1 == k, KEY = cmds[k]||false;

			if(!isStr(KEY)){ return o; }

			o.K = k;

			Ex = o.Stc(function(ev){

				var GEv = GEvent(ev);

				o.Hit[o.Hit.length] = KEY;

				o.Hit = o.Hit.purge('.');


				if(Lim&&o.Hit.join('+')==o.Hits.join('+') ){

					o.event.detect('done',o,ev);

					o.Exector(ev);

					o.Already = true;

					doc.onkeydown = G.F();

				}

				else{

					o.event.detect('hit',o,KEY,ev);

					o.ShortCutsHit(k+1);
					
				}

			}).key(KEY);


			o.Detector[o.Detector.length] = Ex;

			doc.onkeydown = function(ev){

				var is = Ex.detect(ev, false);

				o.Hit[o.Hit.length] = Ex.Pressed;

				o.Hit = o.Hit.purge('.');

				if(is===true){

					if(!o.Return&& Lim){return o.Return;}
					
				}

			};

			doc.onkeyup = function(ev){

				o.Reset();

			};

			return o; 

		})

		.dynamic('resetDetectors',function(){

			var o=this, D = o.Detector||false;

			if(isObj(D)){G.foreach(D, function(dec){dec.counter = 0;}); }

		})

		.dynamic('Reset', function(){

			var o=this, doc = o.Doc||false;

			if(isObj(doc)){

				o.Hit = [];

				o.resetDetectors();

				doc.onkeyup = G.F();

				doc.onkeydown = G.F();

			}

			else{

				o.counter = 0;

			}

			return o; 

		})

		.dynamic('Destroy', function(){

			var o=this;

			o.__dSCK = true;

			return o;

		})
;

})(window,screen,navigator,GAPI);