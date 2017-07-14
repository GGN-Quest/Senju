/* GougnonJS.UI.Setup, Copyright GOBOU Y. Yannick */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GUI 0.1 ');return false;}



	API=G.API({

		name:'UISetup'
		
		, static:{

			version:'0.1.170611.2127'

			, Entry : []

			, Init : function(){

				var th = this;


				GAction('handler:UI.Setup.Prev').listen('click', function(e, ev){

					if(GEvent(ev).isLeftClick()){

						var o = th.Entry[e.attrib('ggn-ui-setup-panel')||0]||false;

						if(isObj(o)){o.Go(o.Slugs[o.Key-1]); }

					}

				});

					

				GAction('handler:UI.Setup.Go').listen('click', function(e, ev){

					if(GEvent(ev).isLeftClick()){

						var o = th.Entry[e.attrib('ggn-ui-setup-panel')||0]||false;

						if(isObj(o)){o.Go(o.Slugs[(e.attrib('setup-go')||'0')*1]);}

					}

				});

					

				GAction('handler:UI.Setup.Next').listen('click', function(e, ev){

					if(GEvent(ev).isLeftClick()){

						var o = th.Entry[e.attrib('ggn-ui-setup-panel')||0]||false;

						if(isObj(o)){o.Go(o.Slugs[o.Key+1]);}

					}


				});


				return th;

			}

		}

		,constructor:function(){
		
			var o=this;

			o.Stc = o.STATIC;

			o.Args = arguments[0];

			o.Cfg = o.Args[0];

			o.Cfg.Panel = o.Cfg.Panel||(o.Stc.Entry.length);

			o.event = G(o);


			o.Stc.Entry[o.Cfg.Panel] = o;

			o.Keys = [];


			o.Cfg.Doc = o.Cfg.Doc||G('body');

			o.Cfg.Axe = o.Cfg.Axe||GUI.Axe.Y;

			o.Cfg.Prefix = o.Cfg.Prefix||'';

			o.Cfg.Slug = o.Cfg.Slug||'';

			o.Cfg.Next = o.Cfg.Next||G.F();

			o.Cfg.Prev = o.Cfg.Prev||G.F();

			o.Cfg.Go = o.Cfg.Go||G.F();


			o.Key = 0;

			o.Slug = false;

			o.Slugs = o.Cfg.Slug.split(' ');


			o.Init();

		}

	})

		.create()


		.dynamic('Go', function(slug, fn){

			var o = this;

			if(!isObj(o.Cfg.Doc||'')){return o;}

			var fnd = false, ckey = o.Key, outt = 1, cur = o.iDel(o.Slugs[o.Key]||false), sens = true;


			if(isObj(cur)){

				var ssu = o.Keys[slug]||0 , sens = ssu >= ckey;

				if(sens===true){cur.replaceClass('setup-show', 'setup-out');}

				else{cur.removeClass('setup-show');}

				outt = 301;

			}


			G(function(){

				G.foreach(o.Slugs, function(slg, ks){

					var id = '#', eli,el, ks=ks*1;

						id += o.Cfg.Prefix;

						id += slg;

						el = o.iDel(slg);


					if(isObj(el)){

						var axe = el.attrib('ggn-ui-setup-axe')||o.Cfg.Axe||GUI.Axe.Y, axc = (axe==GUI.Axe.Y) ? 'axe-y': 'axe-x';

						el.removeClass('setup-show').removeClass('setup-out');

						el.display('none').addClass(axc);


						if(slug == slg){

							fnd = true;

							o.Key = ks;

							if(sens===false){el.addClass('setup-out');}

							G(function(){

								var fn = el.attrib('ggn-ui-setup-callback');

								el.display(el.attrib('ui-setup-callback-display')||'block');

								G(function(){

									if(sens===false){el.removeClass('setup-out');}

									el.addClass('setup-show').addClass(axc);

									if(fn){

										var fnt = '';

											fnt += fn;

											fnt += '(GUISetup.Entry["';

											fnt += o.Cfg.Panel;

											fnt += '"], G("';

											fnt += id;

											fnt += '") );';

										GScript.exec(fnt);

									}


								}).timeout(10);

							}).timeout(10);

						}

					}


				});


				if(fnd===false){

					o.Go(o.Slugs[ckey]||false);

				}


			}).timeout(outt);


			return o;

		})



		.dynamic('iDel', function(slg){

			var o=this, id = '#', eli;

			id += o.Cfg.Prefix;

			id += slg;

			eli = o.Cfg.Doc.child(id);

			return eli[0]||false;

		})



		.dynamic('Init', function(adjust){
	
			var o = this;

			if(!isObj(o.Cfg.Doc||'')){return o;}

			var prn = o.Cfg.Doc, off = prn.offset(), adjust = adjust||false;

			G.foreach(o.Slugs, function(slg, ks){

				var id = '#', eli,el;

					id += o.Cfg.Prefix;

					id += slg;

					eli = prn.child(id);

					el = eli[0]||false;

				o.Keys[slg] = ks*1;


				if(isObj(el)){

					var cs = {};

					cs.width = off.width; cs.width += 'px';

					cs.height = off.height; cs.height += 'px';

					el.css(cs);

					if(adjust === false){

						el.attrib('ui-setup-callback-display', el.css('display')||'block');
						
					}

				}

			});


			if(adjust === false){

				// GEvent(window).listen('resize', function(){o.Init(true); });
				
			}

			return o.Go(o.Slugs[0]);

		})


	;


	GUISetup.Init();

})(window,document,navigator);