/* GougnonJS.Sense, version : 0.1, update : 160930#0804, Copyright GOBOU Y. Yannick 2016 */
<?php if(isset($this->Register) && isset($this->Register->USER) && is_array($this->Register->USER) && isset($this->Register->USER['ACCOUNT_TYPE']) && $this->Register->USER['ACCOUNT_TYPE'] >= 3){ ?>

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GSense 0.1 ');return false;}

	API=G.API({

		name:'Sense'

		,static:{
			
			version:'0.1 nightly, Sept 2016, 160930.0804'

			, Settings : {}

		}

		,constructor:function(){
		
			var o=this;
		
				o.args = arguments[0]||[];
		
				o.event = G.Event(o);
		
		}

	}).create();


	API

		.static('Initialize', function(){

			var o = this, wait;

			G.Gabarit.Ajax.Capture = true;

			G.Gabarit.Ajax.Target = '#ggn-sheet-container';

			G.Gabarit.Ajax.ActiveHistory = true;

			G.Gabarit.Ajax.Events.add('wait', function(){

				if(isObj(wait||'')){wait.close();}

				wait = GToast({

					text : "Chargement..."

					, permanent : true

					, delay : null

				}).wait();

			});

			G.Gabarit.Ajax.Events.add('wait.end', function(){

				G(function(){

					wait.close();

					GApp.FloatingMenu.Show();

				}).timeout(150);

			});

			GAction('handler:Sense.Editor.Overview').listen('focus click', function(e,ev){

				var p = e.attrib('editor-overview-part')||'';

				o.Junctions.Overview(p);

			});

			GAction('handler:Sense.Blocks.Add').listen('focus click', function(e,ev){

				o.Windoo.Show('./junctions/blocks/add', 'Créer un nouveau Bloc', null, {width:'50vw', height:'50vh'});

			});

			GAction('handler:Sense.Blocks.Save').listen('focus click', function(e,ev){

				o.Windoo.Load('./junctions/blocks/save', 'Création du bloc...', e.form.strToSend());

			});

			GAction('handler:Sense.Blocks.Edit.Save').listen('focus click', function(e,ev){

				o.Junctions.Blocks.Update(e.form);

			});

			GAction('handler:Sense.Settings.Save').listen('focus click submit', function(e,ev){

				o.Windoo.Show('./junctions/settings?now=save', 'Enregistrement...', e.form.strToSend());

			});

			

			GAction('handler:Sense.Junction.Save').listen('focus click', function(e,ev){

				o.Windoo.Load('./junctions/save', 'Création de la Jonction...', e.form.strToSend());

			});

			return o;

		})


		.static('Junctions', {

			Blocks : {

				ID : '#ggn-sense-junction-block-editor-frame'

				, Prisma : false

				, Update : function(form){

					var wa = '<div class="gui loading circle x16"></div>'

						, wait = G('.sense-mini-wait')

							.removeClass('disable')

							.html(wa)

						, data = form.strToSend()

						, jx

					;

					jx = GAjax({

						URI : './junctions/blocks/update'

						, mode : 'POST'

						, data : data

						, success : function(){

							// console.log('Result', this.xhr.responseText)

							wait.html('<span class="gui iconx text-x24">check</span>');

						}

						, fail : function(){

							wait.html('<span class="gui iconx text-x24">warning</span>');

						}

						, error : function(){

							wait.html('<span class="gui iconx text-x24">error</span>');

						}

						, loadend : function(){

							G(function(){wait.addClass('disable').html(wa); }).timeout(3000);
							

						}

					}).XHR().send();

				}

				, Editor : function(ID){

					var o = this, ID = ID||o.ID, el = G(ID);

					G(function(){

						if(isObj(el)){

							o.Prisma = GPrisma(ID).SetUp({});

							o.Prisma.event

								.add('save', function(args){

									var Prisma = args[0];

									o.Update( Prisma.TextArea.form );

								})

							;

						}

						else{GToast('Element introuvable pour le < GGN Prisma > ').error();}

					}).timeout(1000);


					return o;

				}


			}


			, Editor : {

				Key : false

				, Prlx : false

				, Awk : false

				, iFrame : false

				, iFrameContent : false

				, ID : {

					Overview : '#sense-junc-overview-area'

				}

				, Viewer : {

					Type : ''

					, Rendering : '0'

				}

				, SetKey : function(Key, Prlx){

					this.Key = Key||false;

					this.Prlx = Prlx||false;

					G.Gabarit.Ajax.SetData('ggn-sense-junction-key', Key);

					return this;

				}

				, DestroyKey : function(){

					this.Key = false;

					this.Prlx = false;

					G.Gabarit.Ajax.SetData('ggn-sense-junction-key', null);

					return this;

				}

				, GetStates : function(){

					var o = this;

					if(isStr(o.Key||false)){

						var ge = G('.header-options'), cntr = G('.sense-container');

						if(isObj(ge)){

							var h = '<span class="color-primary">';

							h += o.Prlx||'jonction///';

							h += '</span>';

							h += o.Key;

							ge.html(h).addClass('text-x24 text-upper text-ellipsis padding-lr-x12 opacity-x80'); 

						}

						if(isObj(cntr)){cntr.removeClass('disable'); }

					}

					else{

						GSense.Windoo.Show('./junctions/created', 'Toutes les jonctions créées');

					}

					return this;
					
				}

				, Awake : function(bx){

					var o = this, bx = bx||'';

					o.Awk = GAwake(bx, {

						fixed : false

						, locked : true

						// , width : '320px'

						, depth : 'gray-blur'

					});


					return o.Awk;

				}

				, Wait : function(p){

					var o = this;

					return this;
					
				}

				, Overview : function(p){

					var o = this,jx,p = p||''
						
						, ge = G(o.ID.Overview)
						
						, u = '<?php echo HTTP_HOST; ?>'

						, data = ''

					;

					if(isObj(ge)){

						var wlb = G('body').create({cn:''}).html('Création de l\'aperçu...')
							
							, wait = G.UI.Loading.Wait(wlb)

						;

						if(isObj(o.Awk||'')){o.Awk.close();}

						
						o.Awk = o.Awake(wait.ui);

						wait.ui.addClass('box-shadow');

						o.Awk.show();

						
						u += 'ggn.sense.viewer?key=';

						u += o.Key;

						u += '&type=';

						u += p;


						u += '&viewer-type='; u += o.Viewer.Type;

						u += '&viewer-mode='; u += o.Viewer.Rendering;


						ge.html("");

						var ifrm = ge.create({tag:'iframe', id:'ggn-junction-editor-iframe', cn:'gui col-0 _w10 _h10'});


						ifrm.attrib('src', u);

						ifrm.attrib('frameborder', '0');


						o.iFrame = ifrm;

						o.iFrameContent = (o.iFrame['contentWindow'] || o.iFrame['contentDocument'].body);
						
						o.iFrameContent.onload = function(){

							G(function(){

								o.Awk.close();

								GApp.FloatingMenu.Hide();

							}).timeout(150);


						};


					}

					return this;

				}

			}

		})

		.static('Windoo', {

			Awk : false

			, UI : false

			, Awake : function(bx, w, h){

				var o = this, bx = bx||'', w = w||'85vw', h = h||'85vh';

				o.Awk = GAwake(bx, {

					hote : G('body')

					, locked : false

					, width : w

					, height : h

					, depth : 'gray-blur'

				});

				o.Awk.bx.ctn.css({'min-width':'290px', 'min-height':'258px'});

				return o.Awk;

			}

			, CTN1 : function(t){

				var o = this, t=t||false;

				o.UI.bx.p.addClass('_h10');

				if(isStr(t)){o.UI.bx.ttl.html('').append(t);}

				o.UI.bx.ttl.removeClass('mi-disable');

				o.UI.bx.ctn.replaceClass('row', 'column').addClass('full').html('<div class="gui loading circle x48"></div>');

				return o;

			}

			, Close : function(){

				var o = this;

				if(isObj(o.Awk)){o.Awk.close(); }

				return o;

			}

			, Load : function(u,t,dat){

				var o = this, u=u||'./index?empty.page', t=t||false, jx, dat = dat||null;


				jx = GAjax({

					URI : u

					, mode : 'POST'

					, data : dat

					, headers : {

						'X-Requested-Width' : 'XMLHttpRequest'

					}

					, success : function(){

						var h = this.xhr.responseText||'';

						o.UI.bx.ctn.html(h).execScript();

					}

					, fail : function(){

						o.UI.bx.ctn.html('<div class="gui iconx x96">warning</div><div class="text-x32">Echec</div>');

					}

					, error : function(){

						o.UI.bx.ctn.html('<div class="gui iconx x96">error</div><div class="text-x32">Erreur</div>');

					}

				})

					.XHR()

					.send()

				;

				o.CTN1(t);

				return o;

			}

			, Show : function(u,t, dat, sz){

				var o = this, vX,vY,bdy = G('body'), u=u||'./index?empty.page', t=t||'GGN Sense', dat = dat||null, sz = sz||{}, w = sz.width||false, h = sz.height||false;

				o.UI = G.UI.Wndoo();

				o.Awake(o.UI.bx.p, w, h).show();


				vX = bdy.css('overflow-x');

				vY = bdy.css('overflow-y');

				bdy.css({overflowX:'hidden', overflowY:'hidden'})

				o.Awk.event.add('close', function(){

					bdy.css({overflowX:vX, overflowY:vY});

				});


				o.Awk.event.add('show', function(){

					o.Load(u, t, dat);

				});

				o.CTN1(t);

				o.UI.bx.cls

					.addClass('text-x18')

					.html('close')

					.on('click', function(){

						o.Awk.close();

					})

				;

				return o;

			}

		})

	;

	G.Sense.Initialize();

})(window,document,navigator);

<?php } ?>