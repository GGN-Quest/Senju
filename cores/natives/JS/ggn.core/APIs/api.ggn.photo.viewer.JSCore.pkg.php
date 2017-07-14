/* GougnonJS.PhotoViewer, version : 0.1, update : 160408#1106, Copyright GOBOU Y. Yannick 2015 */<?php global $GRegister; ?>

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GPhoto.Viewer 0.1 ');return false;}


	if(!G['Photo']){GScript.package('ggn.photo');}


	if(!G['UI']){GScript.package('ggn.ui');}



GScript.check('GPhoto', function(){

	GScript.check('GUI', function(){


		API=G.API({

			name:'PhotoViewer'
			
			,static:{

				version : '0.1 nightly, Avril 2016, 160419.1856'

				, parentObject : G.Photo

				, Avail : []


				, CurrentKey : function(){

					var o=this, ck;

					G.foreach(o.cEls, function(ge,k){

						if(ge===o.cEl){

							ck = k * 1;

						}

					});

					return ck;

				}


				, States : function(ime){

					var o=this, bx=o.bx, ck=o.CKey||0, base = o.URL, ukey = o.Ukey, Service = o.Service, typ=o.Type, Pr = o.parentObject;

					bx.cLike = 0;

					/* Likes */
					bx.lkin.html('...');

					bx.lk

						.attrib('title', 'Like')

						.on('click', function(){

							var dat='entity=',h;

							dat += encodeURIComponent(ime);

							dat += '&ukey='; dat+=ukey;

							dat += '&type='; dat+=typ;

							dat += '&mid='; dat+=o.MId;


							var toast = GToast({

								title : 'Nouveau "Like"'

								, text : 'Enregistrement en cours...'

								, delay : 3000

							}).wait();


							h = Service.Open('like', {

								data : dat

								,success : function(rec){

									var t = rec.treat||false;

									toast.close();

									if(t){

										var res = t.insert||false;

										if(res){

											var lk = (bx.cLike + 1) * 1;

											bx.lkin.html(lk.zeroBefore(2));

											toast.success()._text('Enregistré avec succès');
											
										}

										else{

											if(t.exists){

												toast.info()._title('Déjà "Liké"')._text('Vous aimé déja cette photo');

											}

										}

									}

								}

								, fail : function(){

									toast.close().warning()._text('Echec');

								}

								, error : function(){

									toast.close().error()._text('Erreur');

								}


							});
							

						})

					;


					/* Legende */

					bx.cmtla.html('Aucune legende');




					bx.cmtltedit

						.html('<span class="gui icon pencil padding-r-x12"></span> Modifier')

						.attrib('title','Modifier la legende ')

						.on('click',function(){


							var awkc = G.AwakeConfirm('',{

								hote : bx.ctnr

								,fixed : true

								,follow : true

								,locked : true

								,depth : 'gray-blur'


							})

								, olcb

								, finp = G('body').create({cn:'gui flex row field-input'})

								, fxt = finp.create({cn:'x32-h-min x160-h-max',tag:'textarea'})

									.attrib('name', "_omessage")

									.attrib('placeholder', "Ajouter une légende à la photo")

									.attrib('ggn-handler-keyup', "Gabarit.Form.TextArea.Flexible")

									.html((bx.legend||'').toString().ucfirst())

							;


							awkc.awk.event.add('before.show', function(){

								olcb = bx.ctnr.css("overflow-y");

								bx.ctnr.css({'overflow-y':'hidden'});

							});


							awkc.awk.event.add('before.close', function(){

								bx.ctnr.css({'overflow-y': olcb});

							});

							awkc.awk.bx.ctn.addClass('mi-col-15 li-col-15 s-col-12 col-8 x480-w-max');

							awkc.bx.ctn.addClass('gui flex center column no-wrap');


							awkc.message(

								'Modifier la légende de la photo'

								, finp
								
								,{

									Cancel : {label : 'Annuler',click:G.F()}

									,Ok : {

										label : 'Sauvegarder'

										,focus : true

										,click : function(){

											var _m = fxt || false;

											if(!_m.value.toString().isEmpty()){

												var pca = Pr.Legend(ime,_m.value).Change();

											}

											else{

												return false;
												
											}

										}

									}

								}

							);

						})

					;



					/* Formulaire : Commentaire */

					bx.cmtredacfrm.on('submit', function(){
									
							var f=this, dat='entity=',h;

							if(!f.comment.value.toString().isEmpty()){

								dat += encodeURIComponent(ime);

								dat += '&ukey='; dat+=ukey;

								dat += '&mid='; dat+=o.MId;

								// dat += '&type='; dat+=typ;

								dat += '&comment='; dat+=escape(f.comment.value);


								var toast = GToast({

									title : 'Commentaire'

									, text : 'Enregistrement en cours...'

									, delay : 3000

								}).wait();


								h = Service.Open('comment', {

									data : dat

									,success : function(rec){

										var t = rec.treat||false;

										toast.close();

										if(isObj(t)){

											var res = t.insert || false;

											if(res == true ) {

												toast.success()._text('Enregistré avec succès'); 

												bx.cmtredacinpt.value = '';

												return false; 													

											} 

										}

										toast.close().warning()._text('Echec');

									}

									, fail : function(){

										toast.close().warning()._text('Echec');

									}

									, error : function(){

										toast.close().error()._text('Erreur');

									}


								});


							}
							

							return false;

						})

					;
						



					return o;

				}


				, LoadData : function(ime){

					var o=this, bx=o.bx, ukey = o.Ukey, Service = o.Service;


					/* chargement de commentaire  */
					var cmtdat =  'entity=',cmtLd;

					cmtdat+=encodeURIComponent(ime);

					cmtdat+='&ukey=';cmtdat+=ukey;

					cmtdat+='&mid=';cmtdat+=o.MId;
 	

 					bx.cmtlsts.html('');

 					bx.cmtlsttnbr.html('');

 					bx.cmtltedit.addClass('disable');



					cmtLd = Service.Open('load', {

						data : cmtdat

						,load : function(rec){


						}

						,success : function(rec){

							 var t = rec.treat || false;

							 t.like*=1;

							bx.lkin.html('00');


							if(t.connected == false){

							 	bx.cmtredac.addClass('disable');

							}


							if(t.isMe == true){

							 	bx.cmtltedit.removeClass('disable');

							}


							if(isStr(t.username || false)){

							 	bx.cmtusrn.html('').append(t.username.ucfirst());

							}


							if(isNumber(t.created || false) && (GGabarit) ){

							 	bx.cmtusrp.html('').append( (G.Gabarit.Date.Label(t.created * 1000)).ucfirst() );

							}


							if(isStr(t.legend || false)){

							 	bx.legend = t.legend;

							 	bx.cmtla.html('');

							 	bx.cmtla.append(t.legend.ucfirst());

							}


							if(isNumber(t.like || false)){

							 	var llb = 'Soit ';

							 		llb+=t.like.zeroBefore(2).toString();

							 		llb+=' like';

							 		llb+= (t.row > 1) ? 's' : '';

							 	bx.cLike = t.like;

							 	bx.lkin

							 		.html(t.llike)

							 		.attrib('title', llb)

						 		;

							}


							if(isObj(t.comments || false)){

							 	var lb = 'Soit ';

							 		lb+=t.row.zeroBefore(2).toString();

							 		lb+=' commentaire';

							 		lb+= (t.row > 1) ? 's' : '';

							 	bx.cmtlsttnbr

							 		.html(t.lrow)

							 		.attrib('title', lb)

							 	;

							 	G.foreach(t.comments,function(cmt){

							 		var bix = o.UICommentItem(bx.cmtlsts);

							 		bix.ttl.html((cmt.username||'').ucwords());

							 		bix.abt.append((cmt.comment||'').ucfirst());

							 		bix.thumb.html(cmt.username.toString().firstLetters(2).upper());

							 	})


							}


						}



					});


					return o;

				}


				, GetGallery : function(gal){

					var o=this, bx=o.bx,gl = isStr(gal) ? gal.split(';') : gal, base = o.URL||'', typ=o.Type;


					if(isObj(gl)){

						if(gl.length > 1){

							bx.rnav

								.on('click', function(){

									var ck=o.CKey||0, k1 = ck + 1;

									if(isStr(gl[k1])){

										var u = base;

											u+=gl[k1];

										o.Load(u);

										o.CKey = k1;

									}

									else{this.addClass('disable'); }

									bx.lnav.removeClass('disable');

								})

								.removeClass('disable')

							;


							bx.lnav

								.on('click', function(){

									var ck=o.CKey||0, k1 = ck - 1;

									if(isStr(gl[k1])){

										var u = base;

											u+=gl[k1];
											
										o.Load(u);

										o.CKey = k1;

									}

									else{this.addClass('disable'); }

									bx.rnav.removeClass('disable');

								})

								.removeClass('disable')

							;



						}

					}

					return o;

				}


				, Load : function(img){

					var o=this, bx=o.bx, Pr = o.parentObject,ime,im=img;

					if(isStr(img)){

						if(o.Type == 'rsrc'){

							im = img.substr("<?php echo strlen(HTTP_HOST); ?>");

							ime = o.GetIME(im);

						}


						img+='&';

						img+=Pr.Filter({width:1024,height:1024,quality:'-high'});


						bx.sr.removeClass('gui-transition').css({opacity:'0'});

						bx.lded.replaceClass('disable', 'enable');

						bx.sr.addClass('disable');


						G(function(){
							
							bx.sr.src = img;

							G(function(){

								bx.sr.addClass('gui-transition');

							}).timeout(50);

						}).timeout(100);



						o.States(ime||im);

						o.LoadData(ime||im);

					}
					


					return o;

				}


				, GetScopes : function(scope){

					var o=this, bx=o.bx;


					if(isStr(scope)){

						var sco = '[photo-viewer-scope="',ges;

						sco+=scope;

						sco+='"]';

						ges = G('body').child(sco);

						if(ges.length > 1){

							o.cEls = ges;

							var ck = o.CurrentKey(); 


							bx.rnav

								.on('click', function(){

									var k1 = ck + 1;

									if(isObj(ges[k1])){

										o.Close();

										o.Trigger(ges[k1]);

									}

									else{this.addClass('disable'); }

								})

								.removeClass('disable')

							;

							bx.lnav

								.on('click', function(){

									var k0 = ck - 1;

									if(isObj(ges[k0])){

										o.Close();

										o.Trigger(ges[k0]);

									}

									else{this.addClass('disable');}

								})

								.removeClass('disable')

							;


						}


					}

					else{

						return false;

					}


					return o;

				}


				, Close : function(ge){

					var o=this, bx=o.bx||false, Awk = o.Awk||false;

					if(isObj(Awk)){

						o.Awk.close();

					}

					else{

						if(isObj(bx)){

							o.bx.remove();

						}

					}

					return o;

				}


				, GetIME : function(im){

					var o = this, rsrcex = im.split('/');

					rsrcex[0] = '';

					rsrcex[1] = o.Ukey;

					ime = 'rsrc:/'

					ime += rsrcex.join('/');

					return ime;

				}


				, Reset : function(){

					var o = this, bx = o.bx;

					
					o.Service = null;

					o.Type = null;

					o.URL = null;

					o.CKey = 0;

					o.cEl = null;

					o.cEls = [];

					o.Awk = null;

					o.bx = {};

					o.Ukey = null;


					return o;

				}


				, Trigger : function(ge){

					var o = this

						, img = ge.attrib('photo-viewer-src')||ge.attrib('src')||false

							,im=''

							,ime=false

						, scope = ge.attrib('photo-viewer-scope')||false


						, gal = ge.attrib('photo-viewer-gallery')||false

						, url = ge.attrib('photo-viewer-url-base')||false


						, mid = ge.attrib('photo-viewer-mid')||false

						, ukey = ge.attrib('photo-viewer-ukey')||''

						, typ = (ge.attrib('photo-viewer-type')||'').lower()

						, onc = ge.attrib('photo-viewer-on-left-done')||''

						, onc = ge.attrib('photo-viewer-on-right-done')||''

						, Pr = o.parentObject

						, Service = Pr.Service.Init()

						, UI = G.UI.Wndoo()

						, Awk

						, bx

						// , Me = <?php echo isset($GRegister->USER) ? "'".$GRegister->USER['UKEY']."'" : 'false' ; ?>

						, bdy = G('body')

						, ofwx = bdy.css('overflow-x')

						, ofwy = bdy.css('overflow-y')

						// , bg = 'url('

					;




					if(!isStr(img)){return false; }


					o.Service = Service;

					o.Ukey = ukey;

					o.MId = mid;

					o.Type = typ;

					o.URL = url;

					o.CKey = 0;

					o.cEl = ge;

					o.cEls = [];

					// bg+=img;

					// bg+=')';

					im = img;


					if(typ == 'rsrc'){

						im = img.substr("<?php echo strlen(HTTP_HOST); ?>");

						ime = o.GetIME(im);

					}


					img+='&';

					img+=Pr.Filter({width:1024,height:1024,quality:'-high'});

					

					bx = UI.bx; 


					Awk = G.UI.Awk(bx.p, {

						opacity : 0.75

					});


					Awk.event.add('before.show', function(){

						bdy.css({'overflow-x' : 'hidden', 'overflow-y' : 'hidden'});

					});


					Awk.event.add('close', function(){

						o.Reset();

						bdy.css({'overflow-x': ofwx, 'overflow-y': ofwy});

					});




					bx.p.addClass('ggn-photo-wndoo vw10 vh10');

					bx.ttl.html('Aperçu');

					bx.icn.addClass('image x16 padding-x16').removeClass('disable');

					bx.cls
					
						.on('click', function(){

							Awk.close();

						})
					
					;

					
					/* Initialisation des Elements HTML */

					bx.splash = bx.ctnr.create({cn:'gui pos-absolute _w10 _h10 bg-primary gui flex center column'}).css({left:'0px',top:'0px','z-index':'100'}).html('<span class="gui icon image text-x9-vh"></span>');

					G(function(){

						if(isObj(bx.splash||false)){var l = bx.splash.create({cn:'gui loading circle x32 margin-t-x32'});}

					}).timeout(1962);


					bx.ctnr.addClass('gui disable-scrollbar');

					bx.img = bx.ctn.create({cn:'vh9 screen-image background-abs-center gui flex center'});

					bx.lded = bx.img.create({cn:'text-x7-vw gui loading circle x64 light enable gui-transition'}).html('').css({opacity:'0.1'});

					bx.sr = bx.img.create({tag:'img', cn:'disable gui-transition'}).css({opacity:'0.1',width:'auto',height:'auto','max-width':'100%','max-height':'100%'});




					/* Initialisation de l'image */

					bx.sr.on('load', function(e){

						bx.sr.removeClass('disable');

						bx.lded.replaceClass('enable', 'disable');

						if(isObj(bx.splash||false)){bx.splash.remove();}

						G(function(){

							bx.sr.css({opacity:'1'});

						}).timeout(100);


					});



					G(function(){
						
						bx.lded.css({opacity:'1'});

					}).timeout(100);


					bx.sr.src = img;



					bx.ctnb = bx.ctnr.create({cn:'gui pos-absolute _w10 _h10'}).css({

						'top':'0px'

						,'left':'0px'

						,'z-index':'10'

					});

						bx.lnav = bx.ctnb.create({cn:'x48-w _h10 gui-transition pos-absolute navigate left gui icon arrow-left flex center text-x24 cursor-pointer disable'});

						bx.rnav = bx.ctnb.create({cn:'x48-w _h10 gui-transition pos-absolute navigate right gui icon arrow-right flex center text-x24 cursor-pointer disable'});


						bx.stls = bx.ctnb.create({cn:'x48-w _h10 pos-absolute tools mi-disable gui-transition gui flex center'}).css({'z-index':'1'});

					

					bx.ttl.removeClass('mi-disable');


					bx.valid

						.cn('text-x18 padding-tb-x12 padding-lr-x20 gui icon menu disable mi-enable cursor-pointer')

						.on('click', function(){

							var ge=G(this), vst = (ge.data('tggl-status')||'0') * 1;

							if(!vst){

								bx.stls.removeClass('mi-disable');

							}

							else{

								bx.stls.addClass('mi-disable');

							}

							ge.data('tggl-status', (!vst) ? '1' : '0');

						})

					;




					/* Outils */

					bx.stlsm = bx.stls.create({cn:'x48-w _h10 menu gui-transition gui flex column'});

						bx.cLike = 0;


						bx.lk = bx.stlsm.create({cn:'gui-transition gui icon heart cursor-pointer pos-relative bg-primary'});


						bx.lkin = bx.lk.create({cn:'gui pos-absolute bg-primary padding-lr-x16 text-x16 padding-tb-x16 text-light'})

							.css({right:'48px',top:'0px'})

						;

						// bx.ann = bx.stlsm.create({cn:'gui-transition gui icon announcement cursor-pointer'})

						// 	.attrib('title', 'Je suis interessé')

						// ;

						// bx.cmt = bx.stlsm.create({cn:'gui-transition gui icon comments cursor-pointer'})

						// 	.attrib('title', 'Commentaires')

						// ;

						// bx.shar = bx.stlsm.create({cn:'gui-transition gui icon share cursor-pointer'})

						// 	.attrib('title', 'Partage')

						// ;

						// bx.dwn = bx.stlsm.create({cn:'gui-transition gui icon download cursor-pointer'})

						// 	.attrib('title', 'Télécharger')

						// ;


					bx.stlspg = bx.stls.create({cn:'h-inherit tab gui-transition gui flex column disable-scrollbar col-0'});



						bx.cmtlstbx = bx.stlspg.create({cn:'gui flex column full '});



							bx.cmtusrx = bx.cmtlstbx.create({cn:'padding-lr-x8 gui flex row wrap '});

								bx.cmtusr = bx.cmtusrx.create({cn:'gui flex row padding-x8'});

									bx.cmtusrph = bx.cmtusr.create({cn:'x48 box-circle bg-primary-d color-light gui flex center disable'});

										bx.cmtusrphicn = bx.cmtusrph.create({cn:'gui icon user x16'});

									bx.cmtusrnmd = bx.cmtusr.create({cn:'col-0 padding-lr-x12 padding-tb-x4'});

										bx.cmtusrn = bx.cmtusrnmd.create({cn:'text-x20'});

										bx.cmtusrp = bx.cmtusrnmd.create({cn:'text-x12'});
							


							bx.cmtlngdx = bx.cmtlstbx.create({cn:'padding-r-x12 gui flex row wrap '});

								bx.cmtlngd = bx.cmtlngdx.create({cn:'padding-lr-x16'});

									bx.cmtlt = bx.cmtlngd.create({cn:'gui flex row wrap'});

									bx.legend = '';

									bx.cmtltedit = bx.cmtlt.create({cn:'text-x12 cursor-pointer button margin-x12 gui flex row disable',tag:'div'})

									bx.cmtla = bx.cmtlngd.create({cn:'text-x14 text-justify'});

									




							bx.cmtanncx = bx.cmtlstbx.create({cn:'padding-lr-x8 gui flex row wrap '});

								bx.cmtannc = bx.cmtanncx.create({cn:'padding-lr-x12 padding-tb-x8 gui flex row wrap'});




							bx.cmtlstt = bx.cmtlstbx.create({cn:'padding-tb-x16 gui flex row wrap padding-lr-x16'});

								bx.cmtlstticn = bx.cmtlstt.create({tag:'span',cn:'text-x12 gui icon comments padding-lr-x12 padding-t-x8'});

								bx.cmtlsttt = bx.cmtlstt.create({cn:'text-x20'}).html('Commentaires');

								bx.cmtlsttnbr = bx.cmtlstt.create({cn:'text-x20 padding-lr-x4 padding-t-x0 color-primary-l'});


							bx.cmtlsts = bx.cmtlstbx.create({cn:'padding-tb-x4 text-x12 enable-y-scrollbar'});



							bx.cmtredac = bx.cmtlstbx.create({cn:'padding-x16 gui flex row wrap'});

								bx.cmtredacfrm = bx.cmtredac.create({tag:'form', cn:'gui flex column wrap _w10'})

									.attrib('action', '#')

									.attrib('method', 'POST')

								;

									bx.cmtredacinpt = bx.cmtredacfrm.create({tag:'textarea', cn:'x32-h-min x128-h-max'})

										.attrib('name', 'comment')

										.attrib('placeholder', 'Votre commentaire')

										.attrib('ggn-handler-keyup', 'Gabarit.Form.TextArea.Flexible')

									;

									bx.cmtredacsubm = bx.cmtredacfrm.create({tag:'button', cn:'button active margin-t-x4 align-right'}).html('Envoyer');




					/* Awake */

					Awk.event.add('close', function(){

						bx.p.remove();

					});

					Awk.show();


					o.Awk = Awk;

					o.bx = bx;

					o.Ukey = ukey;



					/* Initialisations */
					
					o.States(ime||im);

					o.LoadData(ime||im);




					/* Portée */

					if(isStr(scope) && !isStr(gal)){

						o.scopes = o.GetScopes(scope);

					}

					if(!isStr(scope) && isStr(gal)){

						o.gallery = o.GetGallery(gal);

					}

					o.Avail[scope||(o.Avail.len())] = o;

					return o;

				}


				,UICommentItem : function(cmtlsts){

					var bix = {};

					cmtlsts.html('');

					bix.p = cmtlsts.create({cn:'padding-lr-x8 padding-tb-x12 text-x12 gui flex row'})

						,bix.thumb = bix.p.create({cn:'bg-primary-d gui text-x24 color-light box-circle flex center x48'})

						,bix.ctnr = bix.p.create({cn:'padding-x8 col-0'})

							,bix.ttl = bix.ctnr.create({cn:'text-x16'})

							,bix.abt = bix.ctnr.create({cn:'text-x12'})

					;

					return bix;
				}
				
			}

			,constructor:function(){
			
				var o=this;

				o.Stc = o.STATIC;

				o.event = G(o);

			}

		})

			.create()


			.static('Listeners', function(){

				var o=this;

				GAction('handler:Photo.Viewer').listen('click',function(e,ev){

					if(GEvent(ev).isLeftClick()){

						o.Trigger(G(e));

					}

				});

				return o;

			})

		
		;


		G.Photo.Viewer = G.PhotoViewer.Listeners();


	});

});


})(window,document,navigator);
