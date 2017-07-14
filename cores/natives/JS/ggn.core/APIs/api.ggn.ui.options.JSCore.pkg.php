/* GougnonJS.UI.Options, Copyright GOBOU Y. Yannick */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GUI 0.1 ');return false;}



	API=G.API({

		name:'UIOptions'
		
		, static:{

			version:'0.1.170611.2247'

			, Entry : []

			, Init : function(){

				var th = this;

				return th;

			}

		}

		,constructor:function(){
		
			var o=this;

			o.Stc = o.STATIC;

			o.Args = arguments[0];

			o.Cfg = o.Args[0];

			o.Cfg.Panel = o.Cfg.Panel||(o.Stc.Entry.length);

			o.Cfg.Hote = o.Cfg.Hote||G('body');

			o.Cfg.Size = o.Cfg.Size||'x4';

			o.Cfg.Omni = o.Cfg.Omni||false;

			o.events = GEvent(o);


			o.Stc.Entry[o.Cfg.Panel] = o;

			o.Keys = [];


			o.Init();

		}

	})

		.create()


		.dynamic('Els', function(){

			var o = this;

				o.bx = {};

				o.bx.p = o.Cfg.Hote.create({cn:'ui-options-parent gui pos-abs disable-scrollbar opened'})

					o.bx.lgh = o.bx.p.create({cn:'ui-options-light gui pos-abs cursor-pointer'})

					o.bx.cntr = o.bx.p.create({cn:'ui-options-container gui pos-abs gui flex column'})

						o.bx.hder = o.bx.cntr.create({cn:'ui-options-header gui flex row'})

							o.bx.cls = o.bx.hder.create({cn:'ui-options-closer padding-x16 text-x16 _h10 gui flex center color-text color-error-hover cursor-pointer'}).attrib('ui-icon', 'close')

							o.bx.ttl = o.bx.hder.create({cn:'ui-options-title padding-lr-x16 padding-tb-x8 text-x24 col-0'})

						// o.bx.wait = o.bx.cntr.create({cn:'ui-options-wait'}).css({'height':'3px'})

						o.bx.ctn = o.bx.cntr.create({cn:'ui-options-content col-0 disable-x-scrollbar enable-y-auto-scrollbar'})

						o.bx.bts = o.bx.cntr.create({cn:'ui-options-buttons disable x48-h'})

				;

				var zin = GAwake.Zin(o.Cfg.Hote).toString();

				o.bx.p.css({'z-index': zin });

				o.bx.lgh.on('click', function(){o.Close();});

				o.bx.cls.on('click', function(){o.Close();});


				if(o.Cfg.Hote === G('body')){

					o.bx.p.replaceClass('pos-abs', 'pos-fixed');

				}


				if(o.Cfg.Omni === true){

					o.bx.p.addClass('omni').addClass(o.GetSize(o.Cfg.Size));

				}


				o.bx.cntr.addClass(o.GetSize(o.Cfg.Size));

			return o;

		})


		.dynamic('GetSize', function(xS){

			var o = this, xS = xS||false, ret = false;


			if(xS == 'x1'){ret = ('xBar'); }
			
			else if(xS == 'x2'){ret = ('xSection'); }
			
			else if(xS == 'x3'){ret = ('xSmall'); }
			
			else if(xS == 'x4'){ret = ('xNormal'); }
			
			else if(xS == 'x5'){ret = ('xLarge'); }
			
			else if(xS == 'x6'){ret = ('xFull'); }

			else{ret = ('xNormal'); }

			return ret;

		})


		.dynamic('Close', function(){

			var o = this;

			o.bx.p.replaceClass('opened', 'closed');

			G(function(){

				o.bx.p.remove();

				o.events.detect('close');

			}).timeout(301);

			return o;

		})


		.dynamic('Init', function(){

			var o = this;

			o.Els();

			o.events.detect('open');

			return o;

		})


		.dynamic('SetTitle', function(txt){

			var o = this, bx = o.bx;

			if(isStr(txt||false)){bx.ttl.html(txt); }

			return o;

		})

		.dynamic('Title', function(txt){

			var o = this, bx = o.bx;

			if(isStr(txt||false)){bx.ttl.html(txt); }

			else{return obx.ttl.html().inner;}

		})


		.dynamic('SetContent', function(txt){

			var o = this, bx = o.bx;

			if(isStr(txt||false)){bx.ctn.html(txt); }

			return o;

		})

		.dynamic('Content', function(txt){

			var o = this, bx = o.bx;

			if(isStr(txt||false)){bx.ctn.html(txt); }

			else{return obx.ctn.html().inner;}

		})


		.dynamic('PresetContents', function(typ){

			var o = this, typ = typ||false;

			if(typ == '-progress.bar'){

				o.bx.loading = o.bx.ctn.create({cn:'ui-options-loading gui flex row x32-h-min'});

					o.bx.percent = o.bx.loading.create({cn:'ui-options-loading-percent x64-w text-x32 padding-x12'});

					o.bx.loader = o.bx.loading.create({cn:'ui-options-loading-loader col-0'});

						o.bx.label = o.bx.loader.create({cn:'ui-options-loading-label text-x18 text-center padding-x12'});

						o.bx.progress = o.bx.loader.create({cn:'ui-options-loading-progress ui-progress-bar'});

							o.bx.track = o.bx.progress.create({cn:'ui-options-loading-track gui-fx ui-progress-track'});

					o.bx.infos = o.bx.loading.create({cn:'ui-options-loading-infos x64-w text-x16 padding-x12'});

			}

			return o;

		})



	;


	GUIOptions.Init();

})(window,document,navigator);