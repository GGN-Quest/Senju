/* GougnonJS.Sense.Page.Manager, version : 0.1, update : 160930#0804, Copyright GOBOU Y. Yannick 2016 */
<?php if(isset($this->Register) && isset($this->Register->USER) && is_array($this->Register->USER) && isset($this->Register->USER['ACCOUNT_TYPE']) && $this->Register->USER['ACCOUNT_TYPE'] >= 3){ ?>

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GSensePageManager 0.1 ');return false;}

	GEvent(A).listen('load', function(){
		

		if(!('COMService' in G)){GScript.package('ggn.com.service');}
		

		GScript.check('GCOMService'

		, function(){

				API=G.API({

					name:'SensePageManager'

					,static:{
						
						version:'0.1 nightly, Sept 2016, 160930.0804'

						, Bx : {}

						, Menu : {

							QuickStart : [

								['bloc-data', 'Blocs et données', 'toc']

								, ['layout', 'Structure', 'view_quilt']

								, ['theme', 'Thèmes', 'color_lens']

								, ['bricks', 'Briques du thème', 'view_stream']

								, ['mods', 'Modules', 'view_module']

								, ['settings', 'Paramètres', 'settings']

							]

						}

						, CallBack : {}

						, Status : {

							Initialize : false

							, Windoo : false

							, Current : false

							, Mod : false

						}

					}

					,constructor:function(){
					
						var o=this;
					
							o.args = arguments[0]||[];
					
							o.event = G.Event(o);
					
					}

				}).create();


				API

					.static('Initialize', function(){

						var o = this, B = G('body'), zin = GAwake.Zin().toString(), p = o.Status.Current||'menu';


						if(!o.Status.Initialize){

							o.Bx.Opnr = B.create({cn:'sense-pm-qs-opener x48 sense-logo-x64 background-abs-center cursor-pointer gui-fx gui pos-fixed'})

								.attrib('tabindex', '1')

								.on('click', function(){

									o.Open();

									o.GoTo(o.Status.Current);

								})

							;

							o.Bx.Windoo = B.create({cn:'sense-pm-windoo gui pos-fixed gui-fx flex center column '})

								.css({'z-index' : zin})

							;

								o.Bx.Light = o.Bx.Windoo.create({cn:'light gui pos-absolute _w10 _h10 gui flex center'});

								o.Bx.Container = o.Bx.Windoo.create({cn:'gui pos-relative flex column container gui-fx'});

									o.Bx.Head = o.Bx.Container.create({cn:'head gui flex start _w10 gui-fx'});

										o.Bx.Close = o.Bx.Head.create({cn:'close gui x-icon gui-fx bg-error color-error'}).html('close')

											.on('click', function(){o.Close();})

										;

										o.Bx.Back = o.Bx.Head.create({cn:'back gui x-icon gui-fx disable'}).html('keyboard_arrow_left')

											.on('click', function(){o.GoTo(false);})

										;

										o.Bx.Title = o.Bx.Head.create({cn:'title col-0 gui-fx'});

									o.Bx.Body = o.Bx.Container.create({cn:'body col-0 disable-x-scrollbar enable-y-auto-scrollbar'});

							o.Status.Initialize = true;

						}

						return o;

					})

					.static('Open', function(){

						var o = this, B = G('body'), p = p||'quick-start';


						o.CallBack.BodyOverflow = {

							'x' : B.css("overflow-x")

							, 'y' : B.css("overflow-y")

						};


						B.css({'overflow-x' : 'hidden', 'overflow-y' : 'hidden'});

						o.Bx.Windoo.addClass('open');

						o.Bx.Opnr.addClass('actived');

						o.Status.Windoo = true;

						return o;

					})

					.static('Close', function(){

						var o = this, CBOF = o.CallBack.BodyOverflow, B = G('body');
						
						o.Bx.Opnr.removeClass('actived');

						o.Bx.Windoo.removeClass('open');

						B.css({'overflow-x' : CBOF.x||'auto', 'overflow-y' : CBOF.y||'auto'});

						o.Status.Windoo = false;

						return o;

					})

					.static('GoTo', function(p, mod){

						var o = this, B = G('body')

							, p = p||'quick-start'

							, mod = mod||[]

						;

						
						if(p == 'quick-start'){

							o.Bx.Container.addClass('mode-menu').removeClass('mode-full');

							o.Bx.Body.removeClass('waiting gui flex center column');

							o.Bx.Title.html('GGN Sense');

							o.Bx.Body.html('');

							o.Bx.Back.addClass('disable');

							var ctn = o.Bx.Body.create({cn:'items _w10 gui flex row wrap'});

							G.foreach(o.Menu.QuickStart, function(item){

								var m = ctn.create({cn:'item gui flex row _w5 mi-col-16 gui-fx cursor-pointer'})

										.attrib('tabindex', '2')

										.on('click', function(){o.GoTo('module', item); })

									, ic = m.create({cn:'gui x-icon padding-tb-x16 padding-l-x16 padding-r-x8 text-x32'})

									, lb = m.create({cn:'label padding-tb-x16 padding-r-x16 padding-l-x8 col-0 text-x20 text-ellipsis '})

								;

								ic.html(item[2]);

								lb.html(item[1]);

							});

						}
						
						if(p == 'module' && isStr(mod[0])){

							var u = G.domain;

							u += 'ggn.sense/';

							u += mod[0];

							o.Bx.Container.addClass('mode-full').removeClass('mode-menu');

							o.Bx.Back.removeClass('disable');

							o.Bx.Title.html(mod[1] || 'GGN Sense');

							o.Bx.Body.addClass('waiting gui flex center column').html('<div class="gui loading circle x32 text-color"></div>');

							var jx = GAjax({

								URI : u

								, success : function(){

									var h = this.xhr.responseText;

									o.Bx.Body

										.removeClass('waiting gui flex center column')

										.html(h)

										.execScript()

									;
									
								}

								, fail : function(){

									o.Bx.Body.html('<div class="gui x-icon text-x48 color-warning-p">warning</div>Donnée introuvable');

								}

								, error : function(){

									o.Bx.Body.html('<div class="gui x-icon text-x48 color-error-p">error</div>Erreur observé lors du chargment de la page');

								}

								, load : function(){}

							})

								.XHR()

								.send()

							;

						}
						
						o.Status.Current = p;

						o.Status.Mod = mod[0];

						return o;

					})


				;

			G.SensePageManager.Initialize();

		});


	});


})(window,document,navigator);

<?php } ?>