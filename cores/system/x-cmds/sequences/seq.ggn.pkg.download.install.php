'download:install/gpk' : {

	Server : 'http://packages.gougnon.com/download/'

	, Leave : function(o_){

		G(function(){

			o_.Exec('instance:free');
			
			o_.Exec('console:standout');

		}).timeout(500);

	}

	, DetectHost : function(server){

		var o = this, host = (isStr(server)) ? server : (o.Server || '%localhost%');

		if((server).lower() == '%localhost%'){host = "<?php echo HTTP_HOST; ?>download/";}

		return host;

	}

	, Apply : function(Seq, o_){

		var o = this, Ter=o_.T||false,jx,pb,tb,tby,lb,lt,pgr, u, ur,tlb,tpr, pr, prl, prr, _bx={}

			, key = Seq.key || false

			, version = Seq.version || 'latest'

			, server = o.DetectHost(Seq.server || o.Server || '%localhost%')

			, DoOnly = Seq.downloadOnly || false

		;

		o_.Exec('console:standby');


		if(isObj(Ter)){

			var bxc = Ter.Bx.console, bx = Ter.CurrentConsolePlace || Ter.Bx.console;

				_bx.bx = bx;

				_bx.pgr = pgr = bx.create({cn:'progress-box gui-fx'});

					_bx.lt = lt = pgr.create({cn:'progress-title gui-fx text-ellipsis'});

					_bx.lb = lb = pgr.create({cn:'progress-label gui-fx text-ellipsis'});

					_bx.pb = pb = pgr.create({cn:'progress-bar gui-fx'});

					_bx.tb = tb = pb.create({cn:'track-bar gui-fx gui flex row wrap'});

						_bx.tby = tby = tb.create({cn:'gui pos-relative align-right track-label gui-fx flex center'})

					_bx.pr = pr = pgr.create({cn:'progress-status gui-fx gui flex row'});

						_bx.prl = prl = pr.create({cn:'align-left'});

						_bx.prr = prr = pr.create({cn:'align-right'});

			;


		}


		o._bx = _bx;


		u = server;

		u += key;

		u += '/version:';

		u += version;

		// u += '.gpk?ver';


		ur = "<?php echo HTTP_HOST; ?>ggn.downloader?type=gpk";


		tlb = 'Connexion à <span class="color-primary-l">';

		tlb += u;

		tlb += '</span>';



		if(isObj(lb)){lb.html(tlb);}


		G(function(){

			o.GetFileInfo(u, function(Res){

				Res.URL = u;

				o.DownloadPkg(Res, o_, DoOnly);

				bxc.scrollTop = bxc.scrollHeight;

			});

		}).timeout(500);


		// console.log('Sequence :', Seq);



	}


	, ReadManifest : function(Res, Fn, o_){

		var o = this, _bx = o._bx, ur0 = "<?php echo HTTP_HOST; ?>ggn.installer?do=init&src=", src = "user-downloads://.gpk/", Fn = isFunction(Fn) ? Fn : G.F(), jx, o_ = o_||{}

			, pgr = _bx.pgr, lb = _bx.lb,  lt = _bx.lt, pb = _bx.pb, tb = _bx.tb, tby = _bx.tby, pr = _bx.pr, prl = _bx.prl, prr = _bx.prr;

		;


		src += Res.filename;

		ur0 += src;


		G(function(){

			if(isObj(lb)){
			
				var tprr = '<span class="color-primary-l">';

					tprr += Res.filename;

					tprr += '</span>';

				lb.html('Lecture du manifest...');

				prl.html('Patientez...');

				prr.html(tprr);

				pb.css({height:'1px'});


				G(function(){


					jx = GAjax({

						URI : ur0

						, success : function(){

							var dat = this.xhr.responseText, Obj;

							// console.log('Manifest //', ur0, ' / \n / \n', dat);

							try{

								var Obj = JSON.parse(dat), res = Obj.Response||false, MObj = Obj.Manifest;

								if(res == 'init.success'){

									// tb.addClass('success');

									G(function(){

										if(isObj(pb)){

											pb.css({height:'4px'});

											tb.css({width:'0%'});

										}

										G(function(){Fn(Res, MObj, o_); }).timeout(500);

									}).timeout(256);

								}

								else{

									o.Leave(o_);

									if(isObj(lb)){lb.html('<span class="gui icon iconx color-error-p">error</span> Erreur : impossible de lire le manifest'); }

								}



							}
							
							catch(e){

								o.Leave(o_);

								if(isObj(lb)){lb.html('<span class="gui icon iconx color-error-p">error</span> Erreur : la reponse du serveur est introuvable'); }

							}

						}

						, error : function(){

							tb.addClass('error');

							o.Leave(o_);

							if(isObj(lb)){lb.html('<span class="gui icon iconx color-error-p">error</span> Erreur : impossible de se connecter au "Installer"'); }

						}

						, fail : function(){

							tb.addClass('warning');

							o.Leave(o_);

							if(isObj(lb)){lb.html('<span class="gui icon iconx color-warning-p">warning</span> Echec : Le "Installer" est introuvable'); }

						}

					}).XHR()

						.send()

					;

				}).timeout(256);



			}

		}).timeout(1962);


	}


	, InstallPkgCaches : function(Res, caches, k, o_, Fn){

		var o = this, _bx = o._bx, ur0, jx, o_ = o_ || {}

			, pgr = _bx.pgr, lb = _bx.lb, lt = _bx.lt, pb = _bx.pb, tb = _bx.tb, tby = _bx.tby, pr = _bx.pr, prl = _bx.prl, prr = _bx.prr

			, cache = caches[k] || false

			, ur0 = "<?php echo HTTP_HOST; ?>ggn.installer?do=install:cache&download-this=true&src="

			, src = "user-downloads://.gpk/"

			, Fn = isFunction(Fn) ? Fn : G.F()

			, lim = caches.length

			, k0 = k+1

			, jx

		;



		if(cache){

			src += Res.filename;

			ur0 += src;

			ur0 += '&cache=';

			ur0 += k;


			// console.log('Installation du cache ', k, cache, ur0);


			jx = GAjax({

				URI : ur0

				, headers : {

					'Content-Type' : 'application/octet-stream'

					, 'Cache-Control' : 'no-cache'

					, 'X-Requested-With' : 'XMLHttpRequest'

				}

				, success : function(){

					var dat = this.xhr.responseText

						, pct = (k0 / lim).virgule(1)  * 100

					;

					// console.log('Install Cache Now - ', dat, '\n////////////////////////\n -', pct);


					G(function(){

						o.InstallPkgCaches(Res, caches, k0, o_, Fn);

					}).timeout(100);


					if(isObj(tb)){

						var tprl = '';

						tprl += k0;

						tprl += ' sur ';

						tprl += caches.length;


						pct+='%';

						tb.css({'width' : pct});

						prl.html(tprl);

					}

				}

				, progress : function(e){

					if(e){

						if(e.lengthComputable){

							var p = (e.loaded / e.total).virgule(1) * 100;

							if(isObj(tby)){

								p+='%';

								tby.html(p).addClass('show');

							}
							
						}

					}


				}

				, error : function(){

					tb.addClass('error');

					o.Leave(o_);

					if(isObj(lb)){lb.html('<span class="gui icon iconx color-error-p">error</span> Erreur : impossible de se connecter au "Installer"'); }

				}

				, fail : function(){

					tb.addClass('warning');

					o.Leave(o_);

					if(isObj(lb)){lb.html('<span class="gui icon iconx color-warning-p">warning</span> Echec : Le "Installer" est introuvable'); }

				}



			}).XHR().send();


		}

		else{

			// console.log('Fin de l\'installation');

			if(isObj(tby)){tby.removeClass('show');}

			Fn(Res, o_);

		}


	}



	, installSQL : function(fNm, Fn){

		var o = this

			, ur0 = "<?php echo HTTP_HOST; ?>ggn.installer?do=install:sql:queries&download-this=1&src="

			, src = "user-downloads://.gpk/"

			, u0

			, _bx = o._bx||{}
			
			, jx
			
			, Fn=isFunction(Fn||'') ? Fn : G.F()

		;



		src += fNm||'';

		ur0 += src;


		var tlb = 'Installation les requête SQL <span class="color-primary-l">';

		tlb+=fNm;

		tlb+='</span>...';

		_bx.lb.html(tlb);

		_bx.prl.html('Un instant...');


		jx = GAjax({

			URI : ur0

			, mode : 'POST'

			, data : u0

			, crossDomaine : true

			, success : function(){

				console.log('Install SQL Querie ///', this.xhr.responseText)

				G(function(){Fn();}).timeout(1000);

			}

			, error : function(){

				tb.addClass('error');

				o.Leave(o_);

				if(isObj(_bx.lb)){_bx.lb.html('<span class="gui icon iconx color-error-p">error</span> Erreur : impossible de se connecter au serveur'); }

			}

			, fail : function(){

				tb.addClass('warning');

				o.Leave(o_);

				if(isObj(_bx.lb)){_bx.lb.html('<span class="gui icon iconx color-warning-p">warning</span> Echec : Nettoyeur introuvable'); }

			}

		})

			.XHR()

				.send()

		;



	}



	, CleanTmp : function(fNm, Fn){

		var o = this

			, ur0 = "<?php echo HTTP_HOST; ?>ggn.installer?do=clean:tmp&download-this=1&src="

			, src = "user-downloads://.gpk/"

			, u0

			, _bx = o._bx||{}
			
			, jx
			
			, Fn=isFunction(Fn||'') ? Fn : G.F()

		;



		src += fNm||'';

		ur0 += src;


		var tlb = 'Nettoyage des fichiers temporaires <span class="color-primary-l">';

		tlb+=fNm;

		tlb+='</span>...';

		_bx.lb.html(tlb);

		_bx.prl.html('Un instant...');


		jx = GAjax({

			URI : ur0

			, mode : 'POST'

			, data : u0

			, crossDomaine : true

			, success : function(){

				// console.log('Resultat ///', this.xhr.responseText);

				G(function(){Fn();}).timeout(1000);

			}

			, error : function(){

				tb.addClass('error');

				o.Leave(o_);

				if(isObj(_bx.lb)){_bx.lb.html('<span class="gui icon iconx color-error-p">error</span> Erreur : impossible de se connecter au serveur'); }

			}

			, fail : function(){

				tb.addClass('warning');

				o.Leave(o_);

				if(isObj(_bx.lb)){_bx.lb.html('<span class="gui icon iconx color-warning-p">warning</span> Echec : Nettoyeur introuvable'); }

			}

		})

			.XHR()

				.send()

		;



	}



	, DownloadPkg : function(Res, o_, DoOnly){

		var o = this, _bx = o._bx, ur0, u = Res.URL||false, jx, o_ = o_ || {}, DoOnly = DoOnly || false

			,pgr = _bx.pgr, lb = _bx.lb, lt = _bx.lt, pb = _bx.pb, tb = _bx.tb, tby = _bx.tby, pr = _bx.pr, prl = _bx.prl, prr = _bx.prr

		;

		Res.filename = Res.filename||false;


		// console.log('DownloadPkg ///', Res);
		

		if(isStr(Res.filename)){

			if(isObj(pb)){pb.css({height:'7px'});}

			G(function(){

				if(isObj(lb)){

					var tlb = 'Téléchargement de <span class="color-primary-l">';

						tlb += Res.filename;

						tlb += '</span>';

					lb.html(tlb);

				}


				ur0 = "<?php echo HTTP_HOST; ?>ggn.downloader?save=true&path=.gpk/&filename=";

				ur0+=Res.filename;

				ur0+='&version='; ur0+=Res.version||'false';


				var u0 = 'url=';

				u0 += encodeURIComponent(u);


				if(isObj(prl)){

					prl.html('Connexion...');

					prr.html(Res.sizeLabel||'Indéterminé');
					
				}



				jx = GAjax({

					URI : ur0

					, data : u0

					, mode : 'POST'

					, success : function(){

						var dat = this.xhr.responseText;


						if(DoOnly == true){

							o.Leave(o_);

							if(isObj(lb)){

								lb.html('Package téléchargé avec succès.');

								prl.html('<span class="gui icon iconx color-success-p">check</span>');
							}
						

						}


						if(DoOnly == false){

							if(isObj(lb)){lb.html('Terminé.');}

							o.ReadManifest(Res, function(Res, MObj, o_){

								var M = MObj|| {}

									, name = M.name || false

									, type = M.type || false

									, time = M.time || false

									, caches = M.caches || false

								;


								if(isObj(caches)){

									if(isObj(lb)){

										var tprl = '';

										tprl += 0;

										tprl += ' sur ';

										tprl += caches.length;

										prl.html(tprl);

										lb.html('Installation des caches...');

									}

									var len = caches.len();

									if(len > 0){


										G(function(){

											o.InstallPkgCaches(Res, caches, 0, o_

												, function(Res, o_){
		
													o.installSQL(Res.filename, function(){

														o.CleanTmp(Res.filename, function(){

															if(isObj(pb)){

																prl.html('<span class="gui icon iconx color-success-p">check</span>');

																lb.html('Package installé avec succès');

															}

															o.Leave(o_);

														});

													});

												}

											);

										}).timeout(600);

									}

									else{

										o.Leave(o_);

										if(isObj(lb)){lb.html('<span class="gui icon iconx color-error-p">error</span> Erreur : Cache vide');}

									}

								}

								else{
									
									o.Leave(o_);

									if(isObj(lb)){lb.html('<span class="gui icon iconx color-error-p">error</span> Erreur : Aucune donnée cache retrouvé dans le package');}

								}





							}, o_);

						}

						
					}

					, progress : function(e){

						if(e){

							if(e.lengthComputable){

								var p = (e.loaded / e.total).virgule(1) * 100;

								if(isObj(tb)){

									p+='%';

									prl.html(p);

									// prr.html(Res.sizeLabel||e.total);

									tb.css({width:p});

								}
								
							}

						}


					}

					, error : function(){

						tb.addClass('error');

						o.Leave(o_);

						if(isObj(lb)){lb.html('<span class="gui icon iconx color-error-p">error</span> Erreur : impossible de se connecter au "Downloader"'); }

					}

					, fail : function(){

						tb.addClass('warning');

						o.Leave(o_);

						if(isObj(lb)){lb.html('<span class="gui icon iconx color-warning-p">warning</span> Echec : Le "Downloader" est introuvable'); }

					}

				}).XHR()

					.send()

				;



			}).timeout(500);

		}

		else{

			o.Leave(o_);

			if(isObj(lb)){lb.html('<span class="gui icon iconx color-error-p">error</span> Erreur : impossible de retrouver les informations du package'); }

		}



	}



	, GetFileInfo : function(u, Fn){

		var o = this

			, ur0 = "<?php echo HTTP_HOST; ?>ggn.downloader?do=get:info"

			, u0

			, _bx = o._bx||{}
			
			, jx
			
			, Fn=isFunction(Fn||'') ? Fn : G.F()

		;


		// console.log('Get ',u)


		u0 = 'url=';

		u0 += encodeURIComponent(u);


		var tlb = 'Recherche des informations : <span class="color-primary-l">';

		tlb+=u;

		tlb+='</span>';

		_bx.lb.html(tlb);



		jx = GAjax({

			URI : ur0

			, mode : 'POST'

			, data : u0

			, crossDomaine : true

			, success : function(){

				// console.log('Info / ', this.xhr.responseText);

				try{

					_bx.lb.html('Début du téléchargement...');

					Fn(JSON.parse(this.xhr.responseText));
					
				}

				catch(e){

					if(isObj(lb)){lb.html('<span class="gui icon iconx color-error-p">error</span> Erreur : retourné par le serveur'); }

				}

			}

			, error : function(){

				tb.addClass('error');

				o.Leave(o_);

				if(isObj(_bx.lb)){_bx.lb.html('<span class="gui icon iconx color-error-p">error</span> Erreur : impossible de se connecter au serveur'); }

			}

			, fail : function(){

				tb.addClass('warning');

				o.Leave(o_);

				if(isObj(_bx.lb)){_bx.lb.html('<span class="gui icon iconx color-warning-p">warning</span> Echec : Package introuvable'); }

			}

		})

			.XHR()

				.send()

		;



	}

}
