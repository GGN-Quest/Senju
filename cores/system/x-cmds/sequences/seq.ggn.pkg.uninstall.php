'uninstall/gpk' : {

	Leave : function(o_){

		G(function(){

			o_.Exec('instance:free');
			
			o_.Exec('console:standout');

		}).timeout(500);

	}

	, Apply : function(Seq, o_){

		var o = this, Ter=o_.T,jx,pb,tb,tby,lb,pgr, config, url,tlb,tpr, pr, prl, prr, _bx={}

			, Do = 'uninstall'

			, name = Seq.name || ''

			, type = Seq.appType || ''

		;

		o_.Exec('console:standby');


		if(isObj(Ter)){

			var bxc = Ter.Bx.console, bx = Ter.CurrentConsolePlace || Ter.Bx.console;

				_bx.bx = bx;

				_bx.pgr = pgr = bx.create({cn:'progress-box gui-fx'});

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



		url = "<?php echo HTTP_HOST; ?>ggn.packages?do=";

		url += Do;


		config = 'name='; config += name;

		config += '&type='; config += type;



		if(isObj(prl)){

			var tprr = '<span class="color-primary">';

				tprr += (type).ucFirst();

				tprr += '/';

				tprr += name;

				tprr += '</span>';
				

			lb.html('Debut de la Désinstallation...');

			prl.html('Connexion...');

			prr.html(tprr);

			pb.css({height:'4px'});
			
		}


		bxc.scrollTop = bxc.scrollHeight;


		jx = GAjax({

			URI : url

			, headers : {

				'X-Requested-With' : 'XMLHttpRequest'

			}

			, mode : 'POST'

			, data : config

			, crossDomaine : true

			, success : function(){

				var res = false, Obj = {}, dat = this.xhr.responseText;




				try{Obj = JSON.parse(dat), res = Obj.response||false;}

				catch(e){}


					if(isObj(tb)){

						tb.css({width:'100%'});

						prl.html('Terminé.');


						if(res == 'uninstall.success'){

							if(isObj(o_.FollowUp)){

								o_.FollowUp[0] = name;

							}

							lb.html('Package Désinstallé avec succès');

							tb.addClass('success').removeClass('warning').removeClass('error');

						}

						else{

							tb.addClass('error').removeClass('warning').removeClass('success');

							if(res == 'uninstall.failed'){

								lb.html('Echec');

							}

							else{

								lb.html('Désinstalleur introuvable');

							}

						}

					}

					o.Leave(o_);


				
			}

			, progress : function(e){

				if(e){

					if(e.lengthComputable){

						var p = (e.loaded / e.total).virgule(1) * 100;

						if(isObj(tb)){

							// tb.removeClass('success').removeClass('warning').removeClass('error');

							lb.html('Désinstallation...');

							p+='%';

							prl.html(p);

							tb.css({width:p});

						}
						
					}

				}


			}

			, error : function(){

				tb.addClass('error').removeClass('warning').removeClass('success');

				o.Leave(o_);

				if(isObj(lb)){lb.html('<span class="gui icon iconx color-error-p">error</span> Erreur : impossible de se connecter au serveur'); }

			}

			, fail : function(){

				tb.addClass('warning').removeClass('success').removeClass('error');

				o.Leave(o_);

				if(isObj(lb)){lb.html('<span class="gui icon iconx color-warning-p">warning</span> Echec : Le serveur est introuvable'); }

			}

		}).XHR()

			.send()

		;




	}


}
