'create/gpk' : {

	Leave : function(o_){

		G(function(){

			o_.Exec('instance:free');
			
			o_.Exec('console:standout');

		}).timeout(500);

	}

	, Apply : function(Seq, o_){

		var o = this, Ter=o_.T,jx,pb,tb,tby,lb,pgr, config, url,tlb,tpr, pr, prl, prr, _bx={}

			, Do = Seq.Do || false

			, name = Seq.name || false

			, type = Seq.ptype || false

			, paths = Seq.paths || ''

			, sources = Seq.sources || ''

			, version = Seq.version || ''

			, tables = Seq.tables || false

			, date = Seq.date || false
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

		config += '&paths='; config += paths;

		config += '&sources='; config += sources;

		config += '&version='; config += version;

		config += '&path='; config += paths;

		config += '&download-this=1';


		if(isStr(date)){

			config += '&date='; config += date;
			
		}

		if(isStr(tables)){

			config += '&tables='; config += tables;
			
		}

		// console.log('Craete GPK Config ///\n', config)
		// console.log('Creation de GPK \n-', Do, '\n-', name, '\n-', type, '\n-', paths, '\n-', sources, '\n-', date, '\n- config : ', config)


		if(isObj(prl)){

			var tprr = '<span class="color-text-d">';

				tprr += name;

				tprr += '</span>';
				

			lb.html('Initialisation...');

			prl.html('Connexion...');

			prr.html(tprr);

			pb.css({height:'4px'});
			
		}


		bxc.scrollTop = bxc.scrollHeight;


		jx = GAjax({

			URI : url

			, mode : 'POST'

			, data : config

			, success : function(){

				var dat = this.xhr.responseText, Obj;

				console.log('Reponse du serveur ///\n ', dat);

				o.Leave(o_);

				if(isObj(tb)){

					lb.html('Package crée avec succès');

					prl.html('Terminé.');

					tb.addClass('success').removeClass('warning').removeClass('error');

					tb.css({width:'100%'});

				}
				
			}

			, progress : function(e){

				if(e){

					if(e.lengthComputable){

						var p = (e.loaded / e.total).virgule(1) * 100;

						if(isObj(tb)){

							// tb.removeClass('success').removeClass('warning').removeClass('error');

							lb.html('Création du package...');

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
