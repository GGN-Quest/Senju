'init/transmute' : {

	Leave : function(o_){

		G(function(){

			o_.Exec('instance:free');
			
			o_.Exec('console:standout');

		}).timeout(500);

	}


	, Service : {

		name : 'ggn.transmute'

		, title : 'GGN Transmute'

		, object : false

		, Init : function(){return this.object||G.COMService(this.name).Init({Title:this.title, HideError:true});}

	}


	, Apply : function(Seq, o_){


		var o = this, Ter=o_.T||false,jx,pb,tb,tby,lb,lt,pgr, u, ur,tlb,tpr, pr, prl, prr, _bx={}, u0

			, from = Seq.from || false

			, output = Seq.output || ''

			, mode = Seq.mode || '-only'

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


		ur = "<?php echo HTTP_HOST; ?>ggn.transmutator?";


		u0 += 'from='; ur += from; 

		u0 += '&output='; ur += output; 

		u0 += '&mode='; ur += mode; 

		u0 += '&do=init'; 



		tlb = 'Connexion à au service';

		if(isObj(lb)){lb.html(tlb);}


		var Serv = o.Service.Init();


		Serv.Open('init', {

			data : u0

			, success : function(){

				console.log('Info / ', this.xhr.responseText);

			}

			, error : function(){

				o.Leave(o_);

				tb.addClass('error');

				if(isObj(_bx.lb)){_bx.lb.html('<span class="gui icon iconx color-error-p">error</span> Erreur : impossible de se connecter au serveur'); }

			}

			, fail : function(){
				
				o.Leave(o_);

				tb.addClass('warning');

				if(isObj(_bx.lb)){_bx.lb.html('<span class="gui icon iconx color-warning-p">warning</span> Echec : Impossible de retrouver le service'); }

			}

		});




	}




}
