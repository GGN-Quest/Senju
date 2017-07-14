/* GougnonJS.UI, Copyright GOBOU Y. Yannick 2015 */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GUI 0.1 ');return false;}



	API=G.API({

		name:'UI'
		
		, static:{

			version:'0.2.170611.1005'

			, Entry : []


			,Awk : function(bx,Wk){

				var o = this

					, Wk = Wk||{}

					,Awk

				;

				Wk.follow =(!isUndefined(Wk.follow||undefined) ? Wk.follow : true );

				Wk.depth = Wk.depth || 'gray-blur';

				Wk.locked = false;

				Awk = GAwake(bx, Wk);

				return Awk;

			}


			,Loading : {

				Wait : function(lb){

					var bx={};

					bx.ui = G('body').create({cn:'x320-w-min x64-h-min gui flex row center wrap text-x14 box-rounded'})

						, bx.circle = bx.ui.create({cn:'gui loading circle x32 text-color-hover margin-x12 align-left'})

						, bx.label = bx.ui.create({cn:'align-left text-left padding-lr-x16 col-0'}).append(lb)

					;

					bx.UI = bx.ui;

					return bx;

				}

				, WaitBar : function(){

					var bx = {};

					bx.ui = G('body').create({cn:'ui-wait-bar'});

						bx.unit1 = bx.ui.create({cn:'ui-wait-unit'});

						bx.unit2 = bx.ui.create({cn:'ui-wait-unit'});

						bx.unit3 = bx.ui.create({cn:'ui-wait-unit'});

						bx.unit4 = bx.ui.create({cn:'ui-wait-unit'});
						
					
					bx.UI = bx.ui;

					return bx;

				}

			}

			,ShineFlat : {

				IN : function(f,cat,cn,axe){return this.I(f||false,cat||false,cn||false,axe||false,'0%','100%',false);}

				, OUT : function(f,cat,cn,axe){return this.I(f||false,cat||false,cn||false,axe||false,'100%','0%',true);}

				, I : function(f,cat,cn,axe,dp,arr,sss){

					var bx={},f=f||G.F(),ax = axe||GUI.Axe.Y,cn=cn||'primary',cs='gui gui-fx _w10 pos-absolute bg-', c=cs, d=cs,l=cs, cat=cat||256, dp=dp||'0%', arr=arr||'100%'
						,sss=sss||false;

					c+=cn;

					d+=cn; d+='-d';

					l+=cn; l+='-l';

					bx.ui = G('body').create({cn:'gui _w10 _h10 pos-relative'});

					bx.c0 = bx.ui.create({cn:l}).css({'height':dp,'z-index':'1'});

					bx.c1 = bx.ui.create({cn:c}).css({'height':dp,'z-index':'2'});

					bx.c2 = bx.ui.create({cn:d}).css({'height':dp,'z-index':'3'});

					bx.sss = sss;


					bx.trigger = function(){

						var _o = this;

						G(function(){

							_o[((!bx.sss) ? 'c0' : 'c2')].css({height:arr});

							G(function(){

								_o.c1.css({height:arr});

								G(function(){

									_o[((!bx.sss) ? 'c2' : 'c0')].css({height:arr});

									G(function(){

										if(isFunc(f)){f(_o);}

									}).timeout(cat*2);

								}).timeout(cat);

							}).timeout(cat);

						}).timeout(100);

					};

					return bx;

				}

			}
				
			,'WndooAwake': function(Show, Wk){


				var o = this, UI = o.Wndoo(), Awk, Show = Show||G.F()

					, bx = UI.bx

					, Wk = Wk||{}

					, BOCBx = false, BOCBy = false, oBody = G('body')

				;


				Wk.follow = true;

				Wk.depth = Wk.depth || 'gray-blur';


				Show = (isFunction(Show)) ? Show : G.F();


				bx.p.addClass('_w10 _h10');

				Awk = GAwake(bx.p ,Wk);


				Awk.bx.ctn.addClass('vw5 vh7 x320-w-min');


				bx.cls.addClass('gui iconx').html('close').on('click', function(){

					Awk.close();

				});


				Awk.event.add('before.show', function(){

					var bdy = oBody;

					BOCBx = bdy.css('overflow-x');

					BOCBy = bdy.css('overflow-y');

					bdy.css({'overflow-x':'hidden', 'overflow-y':'hidden'});

				});


				Awk.event.add('show', function(){

					bx.ctnr.addClass('enable-y-auto-scrollbar disable-x-scrollbar');

					Show(Awk, UI);

				});


				Awk.event.add('close', function(){

					var bdy = oBody;

					bdy.css({'overflow-x':BOCBx, 'overflow-y':BOCBy});

					bx.p.remove();

				});



				return {Awk:Awk, UI:UI};


			}

				
			,'Wndoo': function(){

				var o = this

					, bx = {}

					, h = G('body')

				;

				bx.p = h.create({cn:'ggn-ui-wndoo gui flex column box-shadow-black bg-dark color-light-l'})


					,bx.h = bx.p.create({cn:'head pos-relative gui flex row center bg-primary color-light-l'})

						,bx.cls = bx.h.create({cn:'btn-close gui iconx padding-tb-x16 padding-lr-x16 text-x16 cursor-pointer'})

						,bx.icnl = bx.h.create({cn:'gui iconx'})

						,bx.ttl = bx.h.create({cn:'title text-center col-0 text-x16 padding-tb-x12 padding-lr-x16 gui-fx text-ellipsis'})

						,bx.valid = bx.h.create({cn:'btn-submit mi-col-0 text-x18 padding-tb-x12 padding-lr-x20 cursor-default disable'})

						,bx.icn = bx.h.create({cn:'mi-disable li-disable gui iconx disable'})


					,bx.uh = bx.p.create({cn:'uhead gui-fx bg-primary-d text-x14 color-light-l gui flex column disable'})

					,bx.ctnr = bx.p.create({cn:'container col-0 pos-relative enable-y-auto-scrollbar'})

						,bx.ctn = bx.ctnr.create({cn:'content gui flex column center full'})


					,bx.loader = bx.p.create({cn:'loader gui-fx disable'})

				;

				return {bx:bx};

			}


			// ,'Awk': function(bx,Wk){

			// 	var o = this

			// 		, Wk = Wk||{}

			// 		,Awk

			// 	;

			// 	Wk.follow =(!isUndefined(Wk.follow||undefined) ? Wk.follow : true );

			// 	Wk.depth = Wk.depth || 'gray-blur';

			// 	Wk.locked = false;

			// 	Awk = GAwake(bx, Wk);

			// 	return Awk;

			// }

			,Axe : { 

				Y : 'axe.y'

				,X : 'axe.x'

			}

			,Scroll : {

				Doc : function(){ return G.getDocElement(); }

				,Slide : function(n,d,ht){

					var o=this
						
						,d=d||GUI.Axe.Y

						, ht = ht||o.Doc()
						
						,scr= (d == GUI.Axe.Y) ? 'scrollTop': 'scrollLeft'
						
						,s=ht[scr]

					;

					var AMP = G.AMP({

						from : s

						,to : n

						,timeline : 256

						,hit : function(){

							ht[scr] = this.level;

						}

					})

						.init()

						.start()

					;

					return AMP;

				}

			}

			, Forms : {

				Field : function(){

					var bx = {}, ht = G('body');

					bx.UI = ht.create({cn:'field-input styled xl col-16 gui box-rounded gui flex row center'});

						bx.icn = bx.UI.create({tag:'span',cn:'gui iconx icon'});

						bx.inp = bx.UI.create({tag:'input',cn:'col-0'}).attrib('type', 'text');

					return bx;


				}

			}



		}

		,constructor:function(){
		
			var o=this;

			o.Stc = o.STATIC;

			o.Args = arguments[0];

			o.Cfg = o.Args[0];

			o.event = G(o);


			o.DKEY = o.Stc.Entry.length;

			o.Stc.Entry[o.DKEY] = o;

		}

	})

		.create()



		.static('Trigger', function(){
			
			var o = this;
			

			GAction('detecting:*[ui-icon]').assign(function(){

				this

					.addClass('gui iconx')

					.attrib('draggable', 'true')

					.html(this.attrib('ui-icon'))

				;

			});



			if(GAction.Detecting.Status === false){ GAction.Detecting.Trigger(); }
				
			return o;

		})


	;


	GEvent(A).listen('load', function(){G.UI.Trigger();});


})(window,document,navigator);