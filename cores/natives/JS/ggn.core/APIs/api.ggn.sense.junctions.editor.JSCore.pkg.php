/* GougnonJS.Sense, version : 0.1, update : 160930#0804, Copyright GOBOU Y. Yannick 2016 */
<?php if(isset($this->Register) && isset($this->Register->USER) && is_array($this->Register->USER) && isset($this->Register->USER['ACCOUNT_TYPE']) && $this->Register->USER['ACCOUNT_TYPE'] >= 3){ ?>

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GSense 0.1 ');return false;}


	API=G.API({

		name:'SenseJunctionsEditor'

		,static:{
			
			version:'0.1 nightly, Dec 2016, 161208.0927'

			, Settings : {}

			, Awk : {}

		}

		,constructor:function(){
		
			var o=this;
		
				o.args = arguments[0]||[];
		
				o.event = G.Event(o);
		
		}

	}).create();


	API

		.static('Init', function(){

			var o = this;

			o.iFrame = parent.frames['ggn-junction-editor-iframe'];

			o.iFrameContent = (o.iFrame['contentWindow'] || o.iFrame['contentDocument'].body);


			GAction('handler:Sense.Layout.Tool.Layer.Choose').listen('click', function(e,ev){

				var rank = e.attrib('junction-layer-rank')||''

					, insert = e.attrib('junction-layer-insert')||''

					, key = G('body').attrib('ggn-junction-key')||false

					, u = '<?php echo HTTP_HOST; ?>ggn.sense/junctions/editor/tools/layout.choose.to.merges?k='

				;

				u += key;

				u += '&rank='; u+=rank;

				u += '&insert='; u+=insert;

				o.Windoo.Show(u, "Ajouter une nouveau dispositif");

			});


			GAction('handler:Junction.Layer.Edit').listen('click', function(e,ev){

				var rank = e.attrib('junction-layout-layer-rank')||''

					, ltype = e.attrib('junction-layout-layer-type')||''
					
					, key = G('body').attrib('ggn-junction-key')||false

					, u = '<?php echo HTTP_HOST; ?>ggn.sense/junctions/editor/tools/layout.layer.edit?k='

				;

				u += key;

				u += '&rank='; u+=rank;

				u += '&layer-type='; u+=ltype;

				o.Windoo.Show(u, "Editer");

			});


			GAction('handler:Sense.Layout.Tool.Layer.Add').listen('click', function(e,ev){

				var name = e.attrib('layout-name')||''

					,key = e.attrib('layout-key')||''

					,rank = e.attrib('layout-rank')||''

					,insert = e.attrib('layout-insert')||''

				;

				if(isObj(o.Windoo.Awk)){

					o.Windoo.Close();

					G(function(){

						var u = '<?php echo HTTP_HOST; ?>ggn.sense/junctions/editor/tools/layout.choose.to.merges.save?k=';

						u += key;

						u += '&rank='; u+=rank;

						u += '&insert='; u+=insert;

						u += '&name='; u+=name;

						o.Windoo.Show(u, "Ajout du dispositif...", null, {width:320, height:288});

					}).timeout(512);

				}

			});



			GAction('handler:Sense.Layout.Layer.Save').listen('click', function(e,ev){

				var f = e.form||false;

				if(isObj(o.Windoo.Awk) && isObj(f)){

					var dat = f.strToSend()

					// o.Windoo.Close();

					// G(function(){

						var u = '<?php echo HTTP_HOST; ?>ggn.sense/junctions/editor/tools/layout.layer.save?';

						o.Windoo.Load(u, "Suppression du dispositif...", dat);

					// }).timeout(512);

				}


			});



			GAction('handler:Sense.Layout.Layer.Delete').listen('click', function(e,ev){

				var f = e.form||false

					, key = f.key.value||''

					, rank = f.rank.value||''

				;

				if(isObj(o.Windoo.Awk) && isObj(f)){

					// o.Windoo.Close();

					// G(function(){

						var u = '<?php echo HTTP_HOST; ?>ggn.sense/junctions/editor/tools/layout.layer.delete?k=';

						u += key;

						u += '&rank='; u+=rank;

						o.Windoo.Load(u, "Suppression du dispositif...");

					// }).timeout(512);

				}

			});




			return o;

		})


		.static('Refresh', function(){

			var o=this;

			if(o['iFrameContent']){

				o.iFrameContent.location.reload();

			}

			return o;

		})


		.static('Windoo', {

			Awk : false

			, UI : false

			, Awake : function(bx,w,h){

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

				if(isStr(t)){o.UI.bx.ttl.append(t);}

				o.UI.bx.ttl.removeClass('mi-disable');

				o.UI.bx.h.removeClass('bg-primary');

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

						o.UI.bx.ctn.removeClass('center full').html(h).execScript();

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

			, Show : function(u,t,dat,sz){

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

					o.Load(u,false);

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

	G.SenseJunctionsEditor.Init();

})(window,document,navigator);

<?php } ?>