/* GougnonJS.Prisma, version : 0.1, update : 160930#0804, Copyright GOBOU Y. Yannick 2016 */
(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GPrisma 0.1 ');return false;}


	API=G.API({

		name:'Prisma'

		,static:{
			
			version:'0.1 nightly, Dec 2016, 161226.1440'

			, Settings : {}

			, Util : {}

			, FW : {

				JS : 'nightly.0.1'

				, CSS : 'nightly.0.1'

				, Style : 'dark:ggn'

				, CSSAPI : [

					// 'ggn.gabarit'

				]

				, JSAPI : [

					'ggn.key.shot'

				]

				, URL : function(typ, api){

					var o = this

						, typ = typ||'js'

						, u = "<?php echo HTTP_HOST; ?>"

					;


					u += typ;

					u += "FrameWork?version=";

					u += (typ=='css' ? o.CSS : o.JS)||'nightly.0.1';

					u += "&api=";

					u += ((typ=='css' ? o.CSSAPI : o.JSAPI)||[]).join(',');

					u += "&style=";

					u += o.Style;


					return u;

				}

				, CSSURL : function(){

					return this.URL('css', this.CSSAPI);

				}

				, JSURL : function(){

					return this.URL('js', this.JSAPI);

				}

			}


		}

		,constructor:function(){
		
			var o=this;
		
				o.args = arguments[0]||[];

				o.event = G.Event(o);
		

			o.Hote = G(o.args[0])||false;

			o.Name = false;

			o.IFrame = false;

			o.IFrameContent = false;

			o.HDoc = false;

			o.tDoc = false;

		
		}

	}).create();


	API

		.dynamic('SetUp', function(){

			var o = this, doc;

			o.AvailableHote();

			if(o.IFrame){

				o.IFrameContent = (o.IFrame['contentWindow'] || o.IFrame['contentDocument'].body);

				o.HDoc = o.IFrame.contentDocument||o.IFrame.contentWindow.document;

				o.Init();
				
			}

			return o;

		})

		.dynamic('Init', function(){

			var o = this;

			if(o.HDoc){

				o.IFrameContent.addEventListener('load', function(){

					var _O = this, DOC = this.document

						, ScM = o.HDoc.createElement('script')

						, StM = o.HDoc.createElement('link')

						, SyM = o.HDoc.createElement('style')

						, Mt0 = o.HDoc.createElement('meta')

						, Mt1 = o.HDoc.createElement('meta')

						, Mt2 = o.HDoc.createElement('meta')

						, JSFw = o.STATIC.FW.JSURL()

						, CSSFw = o.STATIC.FW.CSSURL()

					;

					o.tDoc = DOC;

					o.tDoc.title = "GGN Prisma";



					Mt0.setAttribute('name', 'viewport');

					Mt0.setAttribute('content', 'width=device-width,initial-scale=1, maximum-scale=1.0, user-scalable=no');

					DOC.head.appendChild(Mt0);



					Mt1.setAttribute('charset', 'utf-8');

					DOC.head.appendChild(Mt1);



					Mt2.setAttribute('http-equiv', 'pragma');

					Mt2.setAttribute('content', 'cache');

					DOC.head.appendChild(Mt2);



					StM.id = 'ggn-css-framework-packages';

					StM.setAttribute('rel', 'StyleSheet');

					StM.setAttribute('type', 'text/css');

					StM.setAttribute('href', CSSFw);

					o.StyleMajor = StM;

					DOC.head.appendChild(o.StyleMajor);



					SyM.id = 'ggn-css-framework-styles';

					SyM.setAttribute('type', 'text/css');

					o.IStyleMajor = SyM;

					DOC.head.appendChild(o.IStyleMajor);
					


					ScM.id = 'ggn-js-framework-packages';

					ScM.setAttribute('type', 'text/javascript');

					ScM.setAttribute('src', JSFw);

					o.ScriptMajor = ScM;

					DOC.head.appendChild(o.ScriptMajor);



					_O.DetectJSFw = function(){

						if(typeof this['G'] == 'function'){
							
							var SyF0 = G.domain;

								SyF0 += 'ggn.prisma/editor.css';

							this.GStyle.load(SyF0);

							o.ISheet(this);

						}

						else{G(function(){_O.DetectJSFw();}).timeout(10);}

					};

					_O.DetectJSFw();

				});

			}

			return o;

		})

		.dynamic('ISheet', function(_O){

			var o = this, _O = _O||false;

			if(o.HDoc&&_O){

				var DOC = _O.document;

				_O.G.D = DOC;


				var Splash = DOC.body.create({cn:'gui flex full center xh1 no-ff bg-dark'}).html('...');

				G(function(){

					Splash.remove();

					o.Area = DOC.body.create({tag:'div',cn:'prisma-editor-area disable-scrollbar'}).attrib('contenteditable', 'true');

					DOC.body.on('click', function(){o.Area.focus();});

					GEvent(DOC.body).listen('keydown', function(ev){

						o.SyncContents(ev);

						o.event.detect('keydown',o,_O,ev);

					});

					o.Area.html(o.OldContent);

					o.Area.focus();

					o.event.detect('load',o,_O);

					o.ShortCuts(_O);

				}).timeout(960);

			}

			return o;

		})

		.dynamic('SyncContents', function(ev){

			var o = this;

			o.textContent = o.Area.textContent || o.Area.innerText;

			o.TextArea.value = o.textContent;

			// console.log("Sync", o.textContent.split("\n") );

			return o;

		})


		.dynamic('InsertNode', function(Nd){

			var o = this
			
				, Dc = o.Area.ownerDocument.defaultView
			
				, sL = Dc.getSelection()
			
				, Rg = sL.getRangeAt(0)
			
				, nNd = document.createTextNode(Nd)
			
			;

	        Rg.insertNode(nNd);
	        
	        Rg.setStartAfter(nNd);
	        
	        Rg.setEndAfter(nNd); 
	        
	        sL.removeAllRanges();
	        
	        sL.addRange(Rg);

			return o;

		})

		.dynamic('ShortCuts', function(_O){

			var o = this,_O = _O||false;


			if(typeof window.GKeyShot == 'function' && _O){

				// try{

					var Save = GKeyShot(_O.document, function(ev){o.event.detect('save',o,_O,ev);}).ShortCuts('CTRL','S');

					var Tab = GKeyShot(function(ev){GEvent(ev).prevent(true);o.InsertNode("\t");o.event.detect('tab',o,_O,ev);}).key('TAB');

						GEvent(_O.document).listen('keydown', function(ev){Tab.detect(ev,true);},true);

				// } catch(e){}

			}


			return o;

		})

		.dynamic('AvailableHote', function(){

			var o = this;

			if(isObj(o.Hote)){

				o.OldContent = o.Hote.html().inner;

				o.Hote.html('');

				o.Name = o.Hote.attrib('prisma-name')||'prisma-content';

				o.IFrame = o.Hote.addClass('_h10 ').create({tag:'iframe', cn:'disable-scrollbar'});

				o.TextArea = o.Hote.create({tag:'textarea',cn:'disable'}).attrib('name', o.Name);

				o.IFrame.attrib('frameborder', '0');

				o.IFrame.cn('gui w-inherit h-inherit');

			}

			return o;

		})



	;



})(window,document,navigator);