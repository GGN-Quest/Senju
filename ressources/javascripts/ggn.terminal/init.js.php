<?php if(!is_array($this->USER)){alert("Vous n'etes pas autorisé à utiliser ce script"); $this->close(); } if($this->USER['ACCOUNT_TYPE'] < 4){alert("Vous n'etes pas autorisé à utiliser ce script"); $this->close(); } ?>/* Copyright Yannick GOBOU, MyTerminal*/
(function(W,D){




	GScript.check('GCOMService', function(){




		var Composer = G('.cmd-composer');

		window.Terminal = {

			Started : false

			, Bx : {}

			, ErrorReg : []

			, CurrentMod : false

			

			, Init : function(){

				var o=this;

				o.Bx.face = G('.ter-face');

				o.Bx.header = G('header.app-header');

				o.Bx.mod = G('#cmd-mod');

				o.Bx.status = G('#cmd-mod-status');

				o.Bx.process = G('#process-tag');

				o.Bx.wait = G('#waiting');

				o.Bx.corps = G('#cmd-corps');

				o.Bx.console = G('.corps .console');

				o.Bx.cinput = G('#cmd-input');

				o.Bx.SSLLabel = G('#ggn-splash-screen-loader-label');

				return o;

			}


			// , sWait : function(){return this.Bx.wait.removeClass('disable'); }

			// , cWait : function(){return this.Bx.wait.addClass('disable'); }


			, ModExit : function(o_){

				var o = this, Bx = o.Bx;

				o.Status('', false, true).title = '';

				Bx.mod.html('Aucun Module associé');

				o_.CurrentModule = false;

				o.CurrentConsolePlace = false;

				o.Console('__Graph:Icn:ExitToApp__Détachement du module');

			}


			, ModStatus : function(txt){

				var o = this, Bx = o.Bx;

				Bx.mod.html(txt||false);

			}


			, Status : function(t, v, h){

				var cn = 'margin-t-x4 margin-lr-x8 gui icon iconx '

					, h = h || false

					, v = v || 'warning'

				;

				cn += 'color-';

				cn += t;

				cn += '-p ';

				cn += (h==true) ? 'disable ' : 'true ';

				return this.Bx.status.cn(cn).html(v);

			}


			, Start : function(){

				var o = this;

				o.Bx.face.replaceClass('fs', 'fu');

				o.Bx.header.replaceClass('col-0', 'x92-h');


				o.Bx.corps.removeClass('disable');

				G(function(){ 

					o.Bx.corps.addClass('gui flex start row wrap col-0'); 

				}).timeout(100);

				return o;

			}



			, Close : function(){

				var o = this;

				o.Bx.face.replaceClass('fu', 'fs');

				o.Bx.header.replaceClass('x92-h', 'col-0');

				o.Bx.corps.removeClass('gui flex start row wrap col-0').addClass('disable');

				return o;

			}



			, Clean : function(){

				var o = this;

				o.CurrentConsolePlace = false;

				o.Bx.console.html('');

				o.Console('<br>__Graph:Icn:Ok__Console nettoyée');

				return o;

			}


			, CurrentConsolePlace : false

			, InitConsolePlace : function(){

				var o = this, Bx = o.Bx.console;

				if(o.CurrentConsolePlace===false){
					
					o.CurrentConsolePlace = Bx.create({cn:'place'});

				}

			}

			, Console : function(txt, apd){

				var o = this, txt = txt||false, bxc = o.Bx.console, bx = o.CurrentConsolePlace||o.Bx.console, apd = apd||false;

				if(isString(txt)){

					var ne = bx.create({cn:'writing'});

					if(apd==true){ne.append(txt);}

					else{ne.html(GTerminal.FormatHTMLContent(txt));}

				}

				o.Bx.corps.scrollTop = o.Bx.corps.scrollHeight;

				return o;

			}


			, SplashScreen : function(){

				var o = this, P = [], ki = 0, lim, Fn;

				P[P.length] = ['GTerminal', 'Chargement du terminal...'];

				P[P.length] = ['GTerminal.Process', 'Chargement des processus...'];

				P[P.length] = ['GTerminal.Sequence', 'Chargement des séquences...'];

				P[P.length] = ['GTerminal.Graph.Icon', 'Chargement du Graph.Icon'];


				lim = P.length - 1;

				Fn = function(k){

					var ph = P[k]||false;

					if(k < lim && isObj(ph) ){

						o.Bx.SSLLabel.html(ph[1]||'Patientez...'); 

						GScript.check(ph[0], function(){

							G(function(){Fn(k+1);}).timeout(100);


						});
						
					}

					else{

						G(function(){

							GGNSplashScreenOut();

							Composer.cmd.focus();

						}).timeout(500);
						
						o.Bx.SSLLabel.html('Chargement terminé.');


					}

				};

				Fn(0);

			}

		};


		Terminal

			.Init()

			.SplashScreen()

		;




		var MyTerminal = GTerminal(Terminal);


		MyTerminal.Composer = Composer;

		MyTerminal.OnStart = function(cmd){
		};


		MyTerminal.OnOpen = function(){
		};

		MyTerminal.OnLogOut = function(){

			location.href = './logout?complete';

		};

		MyTerminal.OnExit = function(){

			location.href = '<?php echo HTTP_HOST; ?>';

		};

		MyTerminal.OnModExit = function(){
		};

		MyTerminal.OnClean = function(){

			this.T.Bx.console.scrollTop = 0;

		};

		MyTerminal.OnClose = function(){
		};

		MyTerminal.OnWait = function(){
		};

		MyTerminal.OnLoad = function(){
		};

		MyTerminal.OnFail = function(){

			Terminal.Console('__Graph:Icn:Warning__Le Service du terminal est introuvable');

		};

		MyTerminal.OnError = function(){

			window.Terminal.Console('__Graph:Icn:Error__Une Erreur a été observé lors de la connexion au service');

		};

		MyTerminal.OnBugs = function(response, error, obj){

			var T = window.Terminal

				, ek = T.ErrorReg.length

				, idk = 'terminal-bugs-reg-'

				, idki = '#'

				, msg = '__Graph:Icn:Error__Un Problème a été détecté lors de l\'excution de la commande. <button'

				, hmsg = ''

				, idb

			;


			idk+=ek;

			idk+='-box';

			idki+=idk;
			


			msg+=' bugs-key="';

			msg+=ek;

			msg+='" onclick="G(\'#';

			msg+=idk;

			msg+='\').toggle();" class="active">';

			msg+='Afficher le message d\'erreur ';

			msg+='</button>';


			hmsg+='<div id="';
			
			hmsg+=idk;

			hmsg+='" class="padding-x32 bg-dark-l box-rounded-normal margin-t-x12">';


				hmsg+='<div class="h2">Reponse Serveur<div>';

				hmsg+='<div class="text-x18 text-regular">';

					hmsg+=response;

				hmsg+='</div>';


			hmsg+='</div>';



			msg+=hmsg;



			Terminal.Console(msg);

			G(idki).hide();

			T.ErrorReg[ek] = arguments;

		};


		MyTerminal.OnSuccess = function(rec){

			var t = rec.response || false

				, T = Terminal 

				, Bx = T.Bx

			;

			if(isObj(rec.mod)){

				if(rec.mod.Key){

					T.Status('', false, true).title = '';

					Bx.mod.html(rec.mod.Key);

					o.CurrentModule = rec.mod.Key;

				}

				if(!rec.mod.Name){

					T.Status('warning').title = 'Attention : Commande introuvable';

					o.CurrentModule = false;

					f.reset();

				}

			}


			if(isObj(rec.console)){

				if(isObj(rec.console.Line)){

					var nlin = rec.console.Line.length;

					G.foreach(rec.console.Line, function(line, k){

						G(function(){

							Terminal.Console(line);

						}).timeout(k*1*1);


					});

					// G(function(){

					// 	Terminal.Console("writing");

					// }).timeout(nlin*1+10);


				}

			}
			

			f.reset();

		};


		GTerminal.Get = MyTerminal;


		Composer.on('submit', function(){

			var f = this

				, cmd = f.cmd.value

				, T = Terminal

				, MyT = MyTerminal

				, bcmd = '<div class="cmd-line">__Graph:Icn:ArrowRight__'

				, dat = f.strToSend()

			;

			bcmd+=cmd;

			bcmd+='</div>';

			T.Console(bcmd);

			return MyT.Submit(dat);

		});


		return false;

	});


})(window,document);