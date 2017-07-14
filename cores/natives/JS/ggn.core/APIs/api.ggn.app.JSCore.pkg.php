<?php global $GLANG; ?>/* GougnonJS.App, version : 0.1, update : 161110#0838, Copyright GOBOU Y. Yannick 2015 */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GApp 0.1 ');return false;}


	if(!G['UI']){GScript.package('ggn.ui');}


	API=G.API({

		name:'App'

		,static:{
			
			version:'0.1 nightly, Nov 2016, 161110.0838'

			, FloatingMenu : {

				Items : []

				, Actions : []

				, _Bx : false

				, _Shape : false

				, _Size : 'x48'

				, _IconSize : 'x32'

				, State : function(Cfg){

					var o = this, Cfg = Cfg||{};

					o._Shape = Cfg['shape'] || '';

					o._Size = Cfg['size'] || 'x48';

					o._IconSize = Cfg['icon-size'] || 'x32';

					o._Bx = Cfg['Bx'] || G('body').create({id:'ggn-floating-menu', cn:'gapp-floating-menu gui flex row end gui-fx'});



					GEvent(window).listen('load resize', function(){

						o.Layout();

					});

					return o;

				}

				, Clear : function(){

					var o = this;

					if(isObj(o._Bx||'')){

						o._Bx.html('');

						o.Items = [];

					}

					return o;

				}

				, Show : function(){

					var o = this;

					if(isObj(o._Bx||'')){

						o._Bx.removeClass('disable');

					}

					return o;

				}

				, Hide : function(){

					var o = this;

					if(isObj(o._Bx||'')){

						o._Bx.addClass('disable');

					}

					return o;

				}

				, Layout : function(){

					var o = this;

					if(isObj(o._Bx||'')){

						var scrn = GScreen.Offset(), offs = o._Bx.offset()

							, ws = scrn.width, x

						;

						// if(ws >= 979){

						// 	x = ws.nuspacer(offs.width).floor()

						// 	x+='px';

						// }

						// if(ws < 979){

						// 	x = o._Bx.css('bottom');
						// }

						// o._Bx.css({"right" : x})

					}

					return o;

				}

				, Add : function(name, item){

					var o = this, k = o.Items.length,i,a;

					if(isObj(o._Bx||'')){

						i = item['icon']||'lens';

						a = item['action']||false;

						itm = o._Bx.create({cn:'gapp-ftm-item gui-fx gui flex center x48 cursor-pointer margin-l-x8'})

							.attrib('gapp-ftm-item', (k||'0').toString())

							.on('click', function(){

								if(isStr(a)){

									var ac = '(';

									ac += a;

									ac += ')(GApp.FloatingMenu.Items["'

									ac += name;

									ac += '"]);';

									GScript.exec(ac);

								}

								if(isFunction(a)){

									a();

								}

							})

							.addClass(o._Size)

						;

						var ss = 'text-';

							ss += o._IconSize;

						var icn = itm.create({cn:'gui iconx icn text-x32'})

							.html(i)

							.addClass(ss)

						;


						if(o._Shape){

							if(o._Shape == 'rounded'){

								itm.addClass('box-rounded');

							}

							if(o._Shape == 'circle'){

								itm.addClass('box-circle');

							}

						}

						o.Items[name] = itm;

					}

					return o;

				}

			}

		}

		,constructor:function(){
		
			var o=this;
		
				o.args = arguments[0]||[];
		
				o.Box = o.args[0]||[];
		
				o.event = G.Event(o);
		
		}

	}).create();


	API

		.static('Init', function(){



		})

	;


	return GApp;

})(window,document,navigator).Init();
