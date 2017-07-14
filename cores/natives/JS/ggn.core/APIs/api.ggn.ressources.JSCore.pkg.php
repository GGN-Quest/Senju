/* GougnonJS.Ressources, version : 0.1, update : 160408#1106, Copyright GOBOU Y. Yannick 2015 */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GRessources 0.1 ');return false;}


	if(!G['COM']){GScript.package('ggn.com');}


	if(!G['UI']){GScript.package('ggn.ui');}


	if(!G['Photo']){GScript.package('ggn.photo');}


GScript.check('GCOM', function(){

	GScript.check('GUI', function(){

	GScript.check('GPhoto', function(){


		API=G.API({

			name:'Ressources'
			
			,static:{
				
				version:'0.1 nightly, Avril 2016, 160408.1104'
				
				, Users : undefined

				, Vars : {

					I : 'hote choose multiple importTo Awk user confidentiality MId dirname order number limit'

				}

				, Service : {

					Name : 'ggn.ressources'

					, Title : 'GGN Ressources'

					, Obj : false

					, Init : function(){return this.Obj||GCOMService(this.Name).Init({Title:this.Title});}

				}

				, FileName : function(u){

					var u = u||false;

					if(isStr(u)){

						var ex = u.split('.')

							,re = ex.reverse()

							,ty = re[0]

							,f = u.substr(0, (u.length - ty.length-1) )

						;

						f+='?ext=';

						f+=ty;

						return f;


					}

					return u;

				}

				, UI : {

					Import : {

						Build : function(f,c){

							var bx = {}, f=f||false,c=c||{};

							c.multiple = c.multiple||false;

							c.accept = c.accept||'*';

							bx.form = G('body').create({tag:'form', cn:'ggn-rsrc-ui-import-form'})

								.attrib('action', '#')

								.attrib('method', 'POST')

								.attrib('enctype', 'multipart/form-data')

							;

							bx.input = bx.form.create({tag:'input', cn:'disable'})

								.attrib('type', 'file')

								.attrib('name', 'rsrc')

								.attrib('accept', c.accept)

								.on('change', (isFunc(f)) ? f : G.F() )

							;

							if(c.multiple){

								bx.input.attrib('multiple', 'multiple');

							}
								
							bx.choose = bx.form.create({cn:'choose x192-w-min x128-h-min gui flex column cursor-pointer box-rounded-normal'})

								.on('click', function(){

									bx.input.click();

								})

							;

								bx.icon = bx.choose.create({cn:'gui icon import text-x32 padding-x16 col-0 gui flex column end '});

								bx.label = bx.choose.create({cn:'text-x16 text-ellipsis text-center padding-t-x8 padding-b-x16 padding-lr-x16'}).append('Depuis votre ordinateur');


							return bx;

						}

					}

				}

			}

			,constructor:function(){
			
				var o=this, GAB = G.Gabarit;

					o.Stc = o.STATIC;

					o.Service = o.Stc.Service.Init();

					o.oBody = G('body');

					o.event = G.Event(o);

					o.cfg = o.ARGS[1]||{};

					o.type = o.ARGS[0]||'*';

					o.currentObjectLoad = false;
					


				G.foreach(o.Stc.Vars.I.split(' '), function(n){o[n]=o.cfg[n]||false; });



				var bx, UI

					, h=o.hote || o.oBody

					, Wk = o.Awk || {}

					,wait = G.UI.Loading.Wait('Patientez...')

				;



				wait.ui.replaceClass('row', 'column').replaceClass('text-x14', 'text-x3-vw').addClass('color-light-d text-thin');
				
				Wk.follow = (!isUndefined(Wk.follow||undefined) ? Wk.follow : true );

				Wk.depth = Wk.depth || 'gray-blur';

				Wk.locked = true;


				UI = G.UI.Wndoo();

				bx = UI.bx;

				bx.p.addClass('ggn-rsrc-ui vw9 vh9');

				h.append(bx.p);

				bx.valid.addClass('opacity-x40').html('Continuer&nbsp;&nbsp;<span class="gui icon arrow-right x16"></span>').removeClass('disable');

				bx.icn.addClass('import x16 padding-x16').removeClass('disable');

				bx.uh.removeClass('disable');

				bx.ctn.append(wait.ui);


				bx._tls = [];

				o.bx = bx;

				o.callBackData = o.callBackData||[];

				o._selected = 0;


				o.MId = o.MId||'';

				o.order = o.order||'desc';

				o.start = o.start||0;

				o.limit = o.limit||10;

				o.startC = 0;


				o.BOCBx = false;

				o.BOCBy = false;

				o.Awk = GAwake(bx.p ,Wk);


				o.Awk.event.add('before.show', function(){

					var bdy = o.oBody;

					o.BOCBx = bdy.css('overflow-x');

					o.BOCBy = bdy.css('overflow-y');

					bdy.css({'overflow-x':'hidden', 'overflow-y':'hidden'});

					o.Load();

				});


				o.Awk.event.add('close', function(){

					var bdy = o.oBody;

					bdy.css({'overflow-x':o.BOCBx, 'overflow-y':o.BOCBy});

					bx.p.remove();

				});


				bx.cls.on('click', function(){o.close();});


				o.__Tools();

				o.__Title();

				o.__Import();

				o.__Choose();

			}

		})

			.create()


			.dynamic('Load', function(N){

				var o = this
				
					,bx=o.bx
				
					,N = N||false

					,hn

					,u ='load?user='

					,wt = G.UI.Loading.Wait('Chargement...')

				;


				o.lToast = o.lToast||GToast({

					text : 'Chargement...'

					,delay : null

					,permanent : true

				}).wait();


				o.lToast.close();


				wt.ui.replaceClass('row', 'column').replaceClass('text-x14', 'text-x4-vw').addClass('color-light-d text-thin');

				wt.circle.addClass('disable');

				u+=(o.user||false).toString();

				u+='&confidentiality='; u+=(o.confidentiality||false).toString();

				u+='&type='; u+=(o.type||false).toString();

				u+='&dirname='; u+=(o.dirname||'').toString();

				u+='&order='; u+=(o.order||'desc').toString();

				u+='&start='; u+=(N||o.start||0).toString();

				u+='&limit='; u+=(o.tmpLimit||o.limit||10).toString();


				if(!N){

					bx.ctn

						.html('')

						.append(wt.ui)

					;

					o._selected = 0;

				}


				hn = o.Service.Open(u,{

					success : function(rec){

						var rsrc = rec.rsrc||false;

						if(isObj(rsrc)){

							var files = rsrc.files||false, rtyp = rsrc.type||false, ukey = rsrc.ukey||false, usrm = rsrc.username||false, isMy = rsrc.isMy||false;


							if(isObj(files) && isStr(usrm) && isStr(ukey)){

								var l = files.length;

								if(l>0){

									o.startC+=l;

									if(!N){

										bx.ctn.html('').addClass('wrap');

										bx.CTNForm = bx.ctn.create({tag:'form', cn:'gui flex center full wrap ggn-rsrc-ui-form'})

											.attrib('action','#')

											.attrib('method','POST')

											.on('submit', function(){return false;})

										;


										bx.p.on('click', function(){

												var els = bx.CTNForm.child('input[type="checkbox"]'), STOP = false;

												o.callBackData = [];

												o._selected = 0;

												if(els.length){

													G.foreach(els, function(el){

														if(el.checked && !STOP){

															o.callBackData[o.callBackData.length] = el.value;

															o._selected++;

															if(o._selected === (o.choose * 1) && (!isBoolean(o.choose))){

																STOP=true;

																G(function(){

																	bx.valid.onclick();

																}).timeout(1);

															}

														}

													});

												}


												if(bx.tlslb){

													var l = o.callBackData.length||'';

													h = (isNumber(l)) ? l.zeroBefore(2).toString() : 'Aucun';

													// h+=' élément';

													// h+= l>1 ? 's' : '';

													h+=' sélectionné';

													h+= l>1 ? 's' : '';

													bx.tlslb.html(h);

												}

												if(bx.valid){

													if(o._selected){

														bx.valid
														
															.replaceClass('opacity-x40 cursor-default', 'opacity-cancel cursor-pointer')

															.on('click', function(){

																o.event.detect('done',o,o.callBackData);

																o.Awk.close();

															})
															
														;

													}

													else{

														bx.valid

															.replaceClass('opacity-cancel cursor-pointer', 'opacity-x40 cursor-default')

															.on('click', G.F())

														;

													}

												}


											});

										;

									}


									var uri = "<?php echo HTTP_HOST . 'rsrc/'; ?>";

									uri+=usrm;

									uri+='/';

									uri+=o.type;

									uri+='/';


									G.foreach(files, function(f,k){

										G(function(){

											var bim = o._UIItem()

												,it = bim.it

												,im = bim.im

												,sr = uri

												,src = f.src

												,meta = f.meta

												,bg = 'url('

												,bu = ''

												,buf = ''

												,ttl = bim.ttl

													.append((meta.title||meta.name||'').ucFirst())


												,ra = it.create({cn:'thumb-check gui pos-absolute'})

												,rad = ra.create({tag:'input',cn:'disable'})

													.attrib('type', 'checkbox')

													.attrib('checkbox-scope', 'rsrc.files')

													.attrib('name', 'rsrc-assoc')

													.attrib('value', f.src)

												,tls = it.create({cn:'thumb-tools gui pos-absolute'})

													, view = tls.create({cn:'tool gui icon eye x16 color-light-l padding-lr-x12 cursor-pointer box-rounded gui-transition margin-r-x4'})

													, del = tls.create({cn:'tool gui icon close x16 color-light-l padding-lr-x12 cursor-pointer box-rounded gui-transition'})

												,ckd = im.create({cn:'check-status gui iconx gui flex center text-x8-vh gui-transition'})

											;


											sr += src;

											bu += o.Stc.FileName(sr);


											buf = bu;

											buf += '&';

											buf += G.Photo.Filter({resize:true,width:512,height:512,rogner:'1'});
									

											bg += buf;

											bg += ')';


											// alert(bg)
	

					
											del

												.on('title', 'Supprimer')

												.on('click', function(){

													var dat = 'file=',h;

													dat+=f.src;

													dat+='&user='; dat+=o.user||'false';

													dat+='&ukey='; dat+=ukey;

													dat+='&type='; dat+=rtyp;


													var toast = GToast({

														title : 'Suppression'

														, text : 'En cours...'

														, delay : 3000

													}).wait();



													h = o.Service.Open('remove',{

														data : dat

														,success : function(rec){

															var r = rec.rsrc||{}, un=r.unlink||false;

															toast.close();

															if(un){

																toast.success()._text('Effectué avec succès');

																G(function(){

																	o.Load();

																}).timeout(300);

															}

															else{

																toast.info()._text('Ressource introuvable');

															}


														}

														,fail : function(){

															toast.close().warning()._text('Echec');

														}

														,error : function(){

															toast.close().error()._text('Erreur');

														}

													})

												;


												})

											;



												
											view

												.attrib('title', 'Aperçu de l\'image')

												.attrib('handler-click', 'Photo.Viewer')

												.attrib('photo-viewer-src', bu)

												.attrib('photo-viewer-ukey', ukey)

												.attrib('photo-viewer-mid', o.MId||'NaN')

												.attrib('photo-viewer-type', 'rsrc')

												.attrib('photo-viewer-scope', 'rsrc-photo-view')

												.on('click', function(){

													if(typeof GPhotoViewer != 'function'){

														var ge = this;

														if(o.Toast){o.Toast.close();}

														o.Toast = GToast({

															hote : bx.ctn

															,text : 'Patientez...'

															,permanent : true

															,delay : null

														}).wait();

														GScript.package('ggn.photo.viewer');

														GScript.check('GPhotoViewer', function(){

															o.Toast.close();

															G.Photo.Viewer.Trigger(ge);

														});

													}


												})

											;

											im
												.addClass('cursor-pointer')

												// .attrib('photo-viewer-scope', 'rsrc-photo-view')

												// .attrib('photo-viewer-src', bu)

												.on('click', function(){

													if(rad.checked){
												
														im.removeClass('checked');
												
														rad.removeAttrib('checked');

														rad.checked = false;
												
													}

													else{
												
														im.addClass('checked');
												
														rad.attrib('checked', 'checked');

														rad.checked = true;
												
													}


												})

												.css({'background-image' : bg});
												
											;




											G(function(){it.css({'transform':'scale(1)'}).replaceClass('opacity-x10', 'opacity-cancel');}).timeout(100);


											if(files.length-1 == (k*1)){

												var more = o._UIItem();

												more.it

													.addClass('cursor-pointer more-btn')

													.on('click', function(){

														o.Load(o.startC);

														o.lToast.close().wait()._text('Un instant...');

														G(this).remove();

													})

													.title = 'Plus encore'
												;

												more.im.addClass('gui flex center text-x8-vw icon more-alt color-light-l').replaceClass('bg-dark-d', 'bg-primary-d').removeClass('box-check');

												more.ttl.addClass('disable');


												if(bx.tlsall&&o.tmpLimit){

													G.Gabarit.Form.CheckBox.Trigger(bx.tlsall);

													bx.tlsall.onclick();

													bx.p.onclick();

												}

												o.tmpLimit = 0;

											}


											if(N){

												G(function(){

													G.UI.Scroll.Slide(bx.ctnr.scrollHeight, false, bx.ctnr);

												}).timeout(100);

											}


										}).timeout(100*(k*1));


									});


									o.lToast.close();

									return false;

								}

								else{


									o.lToast.close().warning()._text('Vous avez atteint la fin de la liste')._delay(3000);

								}

							}

							else{

								wt.ui.html('Aucun resultat');

							}

						}



						wt.ui.html('Aucun resultat');

						// console.log(rec)

					}

					,fail : function(){

						wt.ui.html('Echec');

					}

					,error : function(){

						wt.ui.html('Erreur');

					}

				});


				return o;

			})


			.dynamic('_UIItem', function(){


				var o=this, bx=o.bx

					,it = (bx.CTNForm||bx.ctn).create({cn:'box-thumb mi-col-16 li-col-16 s-col-8 col-4 f-col-3 sf-col-2 vh4 margin-tb-x4 gui-transition opacity-x10 pos-relative '})

						.css({'transform':'scale(0.1)'})

					,im = it.create({cn:'thumb-img _h10 box-check box-rounded bg-dark-d margin-lr-x4 background-abs-center gui pos-relative disable-scrollbar'}).css({'background-size':'100%'})

					,ttl = im.create({cn:'thumb-title gui-transition bottom hide gui pos-absolute padding-t-x20 padding-b-x12 padding-lr-x20 color-light-l text-x24 text-ellipsis'}).css({width:'97%'})

				;


				G(function(){it.css({'transform':'scale(1)'}).replaceClass('opacity-x10', 'opacity-cancel');}).timeout(100);

				return {it:it, im:im, ttl:ttl};

			})


			.dynamic('__Tools', function(ev,o){

				var o = this,bx=o.bx;

				bx.tls = bx.uh.create({cn:'tools gui flex row wrap x32-h-min'});

				bx.Uh = bx.uh.create({cn:'uh gui-transition'});

				return o;

			})


			.dynamic('__Title', function(ev,o){

				var o = this,bx=o.bx

					,ttl = o._titleFc().toString()

				;

				ttl+='les ';

				ttl+=o._titleLb();

				ttl+='s';

				ttl = ttl.ucFirst();

				bx.ttl.html(ttl);

				return o;

			})


			.dynamic('__Import', function(ev,o){

				var o = this,bx=o.bx;

				if(o.importTo){

					o
						._tool({

							label : '<span class="gui icon import"></span> <span class="mi-disable li-disable">Importer</span>'

							// , focus : false

							, click : o._UIImportTo

						})
					;
					
				}

				return o;

			})


			.dynamic('__Choose', function(ev,o){

				var o = this,bx=o.bx;

				if(o.choose){

					bx.tlslb = bx.tls.create({cn:'tool label col-0 text-x16 text-center'})

						.append('Aucun sélectionné')

					;

					bx.tlsall = bx.tls.create({cn:'tool align-center label text-x16 cursor-pointer'})

						.html('<span class="gui icon plus"></span> Tout sélectionner')

						.attrib('handler-click', 'Gabarit.Form.CheckBox')

						.attrib('checkbox-set-scope', 'rsrc.files')

						.attrib('checkbox-form', '.ggn-rsrc-ui .ggn-rsrc-ui-form')

						.attrib('checkbox-on', '<span class="gui icon minus"></span> Tout désélectionner')

					;

					bx.tlsall

						.attrib('checkbox-off', bx.tlsall.html().inner)

						.attrib('checkbox-active-class', 'checked')

						.on('click', function(){

							var sT = this.data('gabarit-checkbox-status')||'false'

								, ht = bx.ctn

								, ims = ht.child('.thumb-img.box-check')

							;

							// alert(['on Select All //', ].join('\n'))

							sT = sT=='true' ? true : false;

							if(isObj(ims)){

								G.foreach(ims, function(im){

									if(sT==true){im.addClass('checked');}

									else{im.removeClass('checked');}

								});

							}

						})

					;

					
				}

				return o;

			})



			.dynamic('_UIImportTo', function(ev,o){

				var bx = o.bx,bu,inp,acc = o.type ,Uha ,Uh;

				Uh = o._Uha().bx.Uh;

				acc += (acc=='*') ? '': '/*';


				if(o._Uha_===true){

					bu = o.Stc.UI.Import.Build(

						function(){

							o._UIImportEl(this.files||false);

						}

						,{

							multiple : o.multiple

							, accept : acc

						}

					);

					Uh.addClass('gui flex center full').append(bu.form);

				}

				else{

					Uh.removeClass('gui flex center');

					Uh.html('');

				}

			})


			.dynamic('_UIImportEl', function(files){

				var o = this,bx=o.bx,fs=files||false;

				if(isObj(fs)){

					var l = fs.length, ht='';

					ht += (l.toString());

					// ht += (' élément');

					// ht += ( ((l > 1) ? 's' : '') );
				
					ht += (' sélectionné');

					ht += ( ((l > 1) ? 's' : ' ') );


					bx.uh.html('');

					o._maxu(false);

					var strt = bx.uh.create({cn:'gui flex center full'}).html('<span class="gui icon import text-x8-vh"></span>');



					G(function(){

						strt.remove();

						// bx.uh.removeClass('gui flex center');

						var sh = G.UI.ShineFlat.IN(function(_o){	

							bx.uh.addClass('bg-primary-d').html('<span class="gui icon more-alt text-x7-vw"></span>');

							G(function(){o._UIImportElItm(fs);}).timeout(300);

						});

						bx.uh.append(sh.ui);

						sh.trigger();

					}).timeout(150);

				}

				return o;

			})



			.dynamic('_UIImportElItm', function(fs){

				var o = this,bx=o.bx,fs=fs||false, l=fs.length;

				bx.uh.html('');

				if(isObj(fs)){

					o.toImports = [];

					o.cancelImports = false;

					var itms = bx.uh.create({cn:'import-items _w10 gui flex start wrap enable-y-auto-scrollbar opacity-x10 gui-transition'})

						,lay = function(){

							var po=bx.p.offset()
								
								,ho=bx.h.offset()

								,h=po.height - ho.height

							;

							h+='px';

							itms.css({height:h});

						}

					;

					lay();

					GEvent(window).listen('resize', function(){lay();});

					if(l<=0){

						itms.html('<h1>Aucun fichier sélectionné</h1>');

					}

					if(l>0){

						o.tmpLimit = 0;
					
						G.foreach(fs, function(f,k0){

							var k = k0*1;

							G(function(){

								o._importItem(itms,f,k0);

								// G(function(){

								// 	o._loadFile(k0*1); //f,th,per,trck,lb,it, (k0*1)==(fs.length-1)
									
								// }).timeout(512*(k||1) );

								if((l-1)==k){

									G(function(){o._loadFile(0);}).timeout(150);

								}

							}).timeout(10*(k+1));

						},false,false,{});

					}

					itms.replaceClass('opacity-x10','opacity-cancel');

				}

				else{

					var err = bx.uh.create({cn:'gui flex column center full'}).html('<div class="gui icon close text-x8-vh padding-x32"></div><div class="text-x5-vw">Vide</div>');

				}

				return o;

			})



			.dynamic('_importItem', function(itms,f,k0){

				var o = this, bxi = {} , k = k0*1;

				bxi.it = itms.create({cn:'item mi-col-15 li-col-15 s-col-16 m-col-7 l-col-7 col-3 x128-h gui flex center row align-top'}).css({padding:'1% 2%'})

					,bxi.th = bxi.it.create({cn:'thumb box-circle x96-w x96-h gui margin-r-x16 gui flex center'}).html('<div class="gui loading circle x32"></div>')

					,bxi.prg = bxi.it.create({cn:'progress col-10 gui _h10 flex column center '})
						
						,bxi.per = bxi.prg.create({cn:'percent text-thin text-left text-x48 col-15 padding-b-x8'}).append('0%')

						,bxi.bar = bxi.prg.create({cn:'bar col-15'})

							,bxi.trck = bxi.bar.create({cn:'track col-null gui _h10 gui-transition'})

						,bxi.lb = bxi.prg.create({cn:'label col-15 text-x12 text-ellipsis text-left padding-tb-x8 padding-lr-x16'}).append(f.name)

					,bxi.space = bxi.it.create({cn:'space col-0'})

					// ,bxi.acts = it.create({cn:'actions x80-w gui _h10 flex column center'})

				;

				bxi.it.animation({
			
					0 : {'transform' : 'translateY(-50%) rotateX(90deg)','opacity' : '0.01'}
			
					,100 : {'transform' : 'translateY(0%) rotateX(0deg)','opacity' : '1'}
			
				}, 768, 'ease');


				o.toImports[k] = {
				
					box:bxi
				
					,key:k

					,file:f
				
				};

				return o;

			})



			.dynamic('_loadNextFile', function(k0){

				var o = this,k=(k0*1)+1,To=o.toImports, Ti = To[k]||false,bx = o.bx;

				if(Ti){

					G(function(){

						o._loadFile(k);
					
					}).timeout(100);

				}

				else{

					G(function(){

						o._maxu(true);

						o.Load();

						if(o.Toast){o.Toast.close();}

						o.Toast = GToast({

							hote : bx.ctn

							,text : 'Importation terminé'

							,delay : 1962

						}).success();


					}).timeout(150);


				}
				
				return o;

			})



			.dynamic('_cancelImports', function(){

				var o = this,t,bx=o.bx;

				o.cancelImports = true;

				G(function(){

					o._maxu(true); 

					if(o.Toast){o.Toast.close();}

					o.Toast = GToast({

						hote : bx.ctn

						,text : 'Importation annulée...'

						,delay : 1962

					}).warning();


				}).timeout(100);


				return o;

			})



			.dynamic('_loadFile', function(k){

				var o = this,Ho={},To=o.toImports, Ti = To[k]||{}, Bx = Ti.box||{}
				
					,f=Ti.file||false
				
					,it=Bx.it||false

					,th=Bx.th||false
				
					,per=Bx.per||false
				
					,trck=Bx.trck||false

					,St= To.len()==(k+1)

					,k1 = k+1
				
				;


				if(isObj(f)){

					var R  = new FileReader()

						, Ev = GEvent(R)

						, h

						,u ='import?user='

						, dat='file='

					;

					<?php 

						/* Pour les valuers Numeriques */
						new \GGN\Using('Numeric');

						$FileSizeMax = \_GGN::varn('UPLOAD_PHOTO_SIZE_MAX');


					?>


					if(f.size > "<?php echo $FileSizeMax; ?>"){

						if(isObj(o.lToast)){o.lToast.close();}

						o.lToast = GToast({

								title : 'Echec Importation : Fichier trop grand (taille max : <?php echo (new \GGN\Numeric\Unit($FileSizeMax, 1))->Label; ?> )'

								, text : f.name

								, delay : 1500

							})

							.error()

						;

						o._loadNextFile(k);

						return false;

					}


					
					if(o.cancelImports===true){o._cancelImports();return o;}


					u+=(o.user||false).toString();

					u+='&confidentiality='; u+=(o.confidentiality||false).toString();

					u+='&type='; u+=(o.type||false).toString();


					trck.css({width:'0%'});

					Ho.pbar = function(p){

						p = (p*1).virgule(1);

						p+='%';

						per.html(p);

						trck.css({width:p});

					};

					Ho.error = function(txt, icn){

						per.replaceClass('text-x48 text-thin','text-x14').html(txt||'Echec');

						th.replaceClass('more-alt', icn||'na');

					};

					Ho.wait = function(txt){

						per.replaceClass('text-x48 text-thin','text-x18').html(txt||'Un instant...');

						th.replaceClass('more-alt');

					};


					Ev.listen('progress', function(ev){

						if(o.cancelImports===true){o._cancelImports();R.abort();return false;}

						if(ev.lengthComputable===true){

							Ho.pbar((ev.loaded/ev.total) * 100);

						}
						
					});

					Ev.listen('fail', function(){

						Ho.error('Echec lors de la lecture', 'close');

						o._loadNextFile(k);

					});

					Ev.listen('error', function(){

						Ho.error('Erreur lors de la lecture');

						o._loadNextFile(k);

					});

					Ev.listen('load', function(){

						if(o.cancelImports===true){o._cancelImports();R.abort();return false;}


						var img = this.result;

						Ho.pbar(100);

						Ho.wait('Sauvegarde...');

						th.html('').addClass('icon more-alt text-x32');

						dat+=img;

						u+='&filename='; u+=f.name||'';

						u+='&size='; u+=f.size||'';



						var itms = it.parentNode, off = it.offset();


						// itms.scrollTop = off.top - off.height;

						G.UI.Scroll.Slide(off.top - off.height, false, itms);


						h = o.Service.Open(u,{

							data : dat

							,progress : function(ev){

								if(o.cancelImports===true){o._cancelImports();return false;}

								if(ev){

									if(ev.lengthComputable===true){

										var h = 'Traitement... ';

										h+= ((ev.loaded/ev.total) * 100).virgule(1);

										Ho.wait(h);

										return false;

									}

								}

								Ho.wait('Traitement... ');

							}

							,success : function(rec){

								var r = rec.response, imp = rec.imported||{}, re = imp.response||false;

								if(r==true && re=='import.success'){

									per.replaceClass('text-x16', 'text-x48 text-thin').html('100%');

									th.replaceClass('more-alt', 'check');

									o.tmpLimit++;

								}

								else{

									Ho.error('Impossible d\'enregistrer', 'close');

								}


							}

							,fail : function(){

								Ho.error('Echec lors de l\'enregistrement', 'close');

							}

							,error : function(){

								Ho.error('Erreur lors de l\'enregistrement');

							}

							,loadend : function(){

								o._loadNextFile(k);

							}

						});

						o.currentObjectLoad = h.ajax;

					});
					

					o.currentObjectLoad = R;

					R.readAsDataURL(f);


				}

				else{

					GToast('Donnée Introuvale').error();

				}

				return o;

			})



			.dynamic('_maxu', function(p){

				var o = this,bx=o.bx,p=p||false, cuh = 'gui flex center col-0', cctnr = 'disable';

				if(p===false){

					bx.uh.addClass(cuh);

					bx.ctnr.addClass(cctnr);

					bx.ttl.html('Importation');

					bx.icnl

						.cn('gui icon arrow-left x32-w padding-lr-x8 _h10 bg-primary-l flex center gui-transition cursor-pointer')

						.on('click', function(){

							var typ = typeof o.currentObjectLoad;

							o.cancelImports = true;

							if(isObj(o.currentObjectLoad)){

								var cOl = o.currentObjectLoad;

								if(isFunc(cOl.abort)){

									cOl.abort();

									G(function(){o._maxu(true);}).timeout(100);

								}

							}


						})

					;

				}

				else{

					bx.icnl.cn('_w0 gui-transition');

					o.cancelImports = false;

					bx.ctnr.removeClass(cctnr);

					bx.uh.removeClass(cuh).html('');

					o.__Tools().__Title().__Import().__Choose()._Uha();

				}

				return o;

			})



			.dynamic('_titleLb', function(){

				var o = this,t=o.type,r=' fichier ';

				if(t=='doc'){r = ' document ';}

				else{r = t;}

				return r;

			})


			.dynamic('_Uha', function(){

				var o = this,bx = o.bx, s = o._Uha_||false;

				if(s===false){

					bx.Uh.addClass('open');

					o._Uha_ = true;

				}

				else{

					bx.Uh.removeClass('open');

					o._Uha_ = false;

				}

				return o;

			})


			.dynamic('_tool', function(tl){

				var o = this,bx = o.bx;

				if(isObj(bx.tls) && isObj(tl)){

					var k0 = bx._tls.len()
				
						, k = tl.name || k0

						, lb = (tl.label||'').toString()
				
						,t

						,fc = focus || false
				
						,clck = tl.click||null
				
					;


					t = bx.tls.create({tag:'button',cn:'tool button cursor-pointer'})

						.html((lb.isEmpty()) ? '#' : lb)

						.on('click', clck, o)

					;

					if(fc){t.addClass('active')._focus();}

					bx._tls[k] = t;

				}

				return o;

			})


			.dynamic('_titleFc', function(){

				var o = this,r='';

				if(o.choose){r = 'sélectionner parmi ';}

				return r;

			})


			.dynamic('open', function(){

				var o = this;

				o.Awk.show();

				return o;

			})


			.dynamic('close', function(){

				var o = this, bdy = o.oBody;

				o.Awk.close();

				return o;

			})

		;


	});

	});

});


})(window,document,navigator);
