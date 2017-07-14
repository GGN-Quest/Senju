/* GougnonJS.Terminal, version : 0.1, update : 160903#2209, Copyright GOBOU Y. Yannick 2016 */

<?php $this_ = $this; Gougnon::clientsRefererControlAccess('-deny', ['all'], ['domaine'], function($code) use($this_) {echo "alert('Vous n\'êtes pas autorisé à utiliser cette API.');"; $this_->Register->close(); }); echo "\n"; ?>

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GTerminal 0.1 ');return false;}



	API=G.API({

		name:'Terminal'
		
		,static:{
			
			version:'0.1 nightly 170701.2214'

			, Get : false

			, isReady : false

			, Statut : false

			, isEnter : false

			, ElD : {}

			, bx : {}

			, Mode : {

				Write : {

					Prefix : 'console:write///'

				}

			}

			, His : []

			, Service : {

				name : 'ggn.terminal'

				, title : 'GGN Terminal Sense'

				, object : false

				, Init : function(){return this.object||G.COMService(this.name).Init({Title:this.title, HideError:true});}

			}


			, GetCMDFromData : function(data){

				var r = false;

				G.foreach(data.split('&'), function(d){

					var s = d.split('=');

					if(s[0].lower() == 'cmd'){r = s[1]||'';}

				});

				return r;

			}


			, Inits : {

				Evts : 'Start Stop Open Close Exit LogOut ModExit Clean Wait Success Fail Error Load Bugs'

			}

			, Wait : {

				UI : false

				, EID : '.ui-header-modules-progress-bar'

				, cLine : false

				, Begin : function(){

					var w = G(this.EID);

					if(isObj(w)){

						this.UI = GUI.Loading.WaitBar().UI;

						this.UI.addClass('col-0 _h10 opacity-x30 gui-fx');

						w.append(this.UI);

					}

				}

				, End : function(){

					var w = G(this.EID);

					if(isObj(w)){

						this.UI.opacity(0.001);

						G(function(){w.html(''); }).timeout(350);

					}


				}

			}


			, Graph : {}


			, FormatHTMLContent : function(txt){

				var o=this , txt = txt || '';

				if(isStr(txt)){

					/* Icone */
					G.foreach(o.Graph.Icon, function(ic){

						var ptt = '__Graph:Icn:'

							, ht = '<span class="gui icon iconx '

						;

						ptt+=(ic[0]).ucfirst(); ptt+='__';

						ht+=(ic[1]); ht+=' margin-lr-x8">'; ht+=ic[2]; ht+='</span>';

						txt = txt.replace(ptt, ht);

					});

					var m = txt.match(/__Graph:Icn:(.*)__/i);

					if(m){

						var pt = '__Graph:Icn:', tx = '<span class="gui iconx margin-lr-x8">';

						pt+=m[1]; pt+='__';

						tx+=m[1]; tx+='</span>';

						txt = txt.replace(pt, tx);
						
					}

				}

				return txt;

			}


			, UI : {

				Wndoo : function(Fn,Cf){

					var Cf = Cf||{}, Ob;

					Cf.hote = Cf.hote || G('#terminal-area');

					Cf.depth = Cf.depth || 'blur';

					Cf.width = Cf.width || '480px';

					Cf.height = Cf.height || '192px';


					Ob = GUI.WndooAwake(Fn||G.F(), Cf);

					Ob.UI.bx.h.removeClass('bg-primary').addClass('');

					Ob.UI.bx.cls.attrib('ui-icon','lens');

					Ob.UI.bx.ctn.removeClass('column center full');

					Ob.UI.bx.ttl.addClass('align-left');

					Ob.ttl = Ob.UI.bx.ttl.create({cn:'text-x16 text-left'}).html('GGN.Terminal.Rk');

					Ob.lttl = Ob.UI.bx.ttl.create({cn:'text-x12 text-left'});

					Ob.UI.bx.icnl.addClass('text-x28').attrib('ui-icon', 'texture');


					return Ob;

				}

				, Process : function(Cf){

					var o =this, Ob = o.Wndoo(function(_UI){}, Cf);


					Ob.ttl.html('GGN.Terminal.Rk');

					Ob.lttl.html('Procédures');

					Ob.UI.bx.icnl.addClass('color-primary').attrib('ui-icon', 'memory');

					Ob.UI.bx.ctn.replaceClass('row', 'column');

					Ob.Awk.show();

					return Ob;

				}

				, Alert : function(txt, tl, ic){

					var o =this, Ob = o.Wndoo(function(_UI){

						})

						, tl = tl || ''

						, ic = ic || 'warning'
					;

					Ob.ttl.html('GGN.Terminal.Rk - Alerte');

					Ob.lttl.html(tl);

					Ob.UI.bx.icnl.addClass('color-warning-p').attrib('ui-icon', 'warning');

					Ob.icns = Ob.UI.bx.ctn.create({cn:'padding-tb-x24 padding-l-x24 x64-w gui flex center ss-col-16'});

					Ob.icn = Ob.icns.create({cn:'x64 color-primary'}).attrib('ui-icon', ic);

					Ob.ctn = Ob.UI.bx.ctn.create({cn:'padding-lr-x24 padding-b-x24 ss-col-16'}).html(txt);

					Ob.Awk.show();

					return Ob;

				}

			}


		}
		

		,constructor:function(){
		
			var o=this;

			o.Stc = o.STATIC;

			o.Event = G.Event(o);

			
		}

	})

	.create();




	API

	.static('ElDs', function(){

		var o = this;

		o.xAreaScroll = false;

		o.bx.cform = G('#terminal-area-cmds-form');

		o.bx.cmd = G('.terminal-cmd-input');

		o.bx.xarea = G('#terminal-area').on('scroll', function(){o.xAreaScroll = true; });

		o.bx.carea = G('#terminal-area-cmds');

		o.bx.viewer = G('#terminal-area-cmds-viewer');

		o.bx.prelt = G('#terminal-preloader-tmp');


		o.bx.mods = G('.ui-header-modules');

		o.bx.mod0 = G('.ui-header-module-0');

		o.bx.mod = o.bx.mod || o.bx.mods.create({cn:'ui-header-modules-container text-x26 text-upper text-spacing-normal cursor-default gui flex center'});

		return o;

	})

	.static('Exec', function(cmd,ds){

		var o=this,dat='',f=o.Composer||false, ds=ds||false;

		if(f){dat+=f.strToSend('cmd');}

		dat+='&cmd='; dat+=cmd;

		o.Submit(dat,ds);

		return o;

	})

	.static('CurrentCmd', function(){

		var o=this; return o.His[o.His.length - 1];

	})

	.static('SetCursor', function(cmd,ds){

		var o = this, vwr = o.bx.viewer;

		if(o.xCursor===false){
			
			o.xCursor = vwr.create({cn:'bloc color-text'});

		}

		o.ScrollDown();

		return o;
	})

	.static('Status', function(d){

		var o = this, d = d||false, vf=false;

		if(isStr(d)){o.bx.mod.html(d); vf=true;}

		if(isObj(d)){

			var icn,lab,clr, md =o.bx.mod;

			if(isStr(d.icon||false)){icn = md.create({cn:'gui iconx'}).html(d.icon||'keyboard_arrow_right'); }

			if(isStr(d.label||false)){lab = md.create({cn:''}).html(d.label); }

			if(isStr(d.color||false) && icn){

				var cl = 'color-';

					cl+=d.color;

				clr = icn.addClass(cl);

			}

			vf=true;

		}

		if(vf){o.bx.mod0.addClass('disable'); }

		return o;
	})

	.static('Console', function(txt,apd){

		var o = this, txt = txt||false, bxc = o.bx.viewer, bx = o.xCursor||bxc, apd = apd||false;

		if(o.isReady){bxc.addClass('padding-t-x4 padding-b-x32 padding-lr-x24'); }

		if(isString(txt)){

			var ne = bx.create({cn:'line color-text-d'});

			if(apd==true){ne.append(txt);}

			else{ne.html(o.FormatHTMLContent(txt));}

		}

		if(apd==true && isObj(txt)){bx.append(txt);}

		o.ScrollDown();

		return o;
	})

	.static('ScrollDown', function(data, ds){

		var o=this;

		G(function(){o.bx.xarea.scrollTop = o.bx.xarea.scrollHeight; }).timeout(10);

		return o;

	})


	.static('SetFollowUp', function(cmd){

		var o = this, cmd = cmd||'', FUp = o.FollowUp||false;


		if(isObj(FUp)){

			G.foreach(FUp, function(val, nm){

				var vr = '$';

				vr+=nm;

				vr+='';

				cmd = cmd.replace(vr, val);

			});

		}

		return cmd;

	})

	.static('ToLine', function(cmdline){

		var o=this, ln = G('body').create({cn:'gui flex row cmd-line'}), icn,lb,tls,cpy,refsh,sync;

		icn = ln.create({cn:'gui iconx x32'}).html('keyboard_arrow_right');

		tls = ln.create({cn:'gui flex row center padding-r-x8 color-text-d'});

			sync = o.Wait.cLine || tls.create({cn:'curcor-default gui iconx text-x16 padding-x4 gui loading circle'}).html('sync');

			refsh = tls.create({cn:'cursor-pointer gui iconx text-x16 padding-x4'}).html('refresh')

				.on('click', function(){o.Exec(o.CurrentCmd()); })

			;

			cpy = tls.create({cn:'cursor-pointer gui iconx text-x16 padding-x4'}).html('content_copy');

		lb = ln.create({cn:'color-text text-x18'}).html(cmdline);

		o.Wait.cLine = sync;

		o.Console(ln, true);

		return o;

	})

	.static('_Focus', function(data, ds){

		var o=this , f = o.bx.cform , fcmd = f['cmd'] ;

		if(fcmd){

			G(function(){fcmd.focus(); }).timeout(100);

		}

		return o;

	})

	.static('_Blur', function(data, ds){

		var o=this , f = o.bx.cform , fcmd = f['cmd'] ;

		if(fcmd){

			G(function(){fcmd.blur(); }).timeout(100);

		}

		return o;

	})

	.static('Submit', function(data, ds){

		var o=this, Bx = o.bx

			, Serv = o.Service.Init()
			
			, cmd = (unescape(o.GetCMDFromData(data)))

			, cmds = o.His

			, ds = ds||false

			, f = o.bx.cform

			, fcmd = f['cmd']

		;

		cmd = cmd.replace('/+/', ' ');

		if(ds===false){

			o.His[cmds.length] = cmd;
			
		}

		cmd = o.SetFollowUp(cmd);


		var MdWrite = cmd.substr(0, (o.Mode.Write.Prefix).length);

		if(MdWrite == o.Mode.Write.Prefix){

			var wcnsl = cmd.substr((o.Mode.Write.Prefix).length||0);

			o.Console( wcnsl );

			// if(fcmd){fcmd.value = '';}

			o.CloseExec(cmd);

			return false;

		}

		if(cmd == 'console:close'){

			o.Console('__Graph:Icn:Warning__ Fermeture de la fenêtre');

			window.close();
			
			return false;

		}

		if(cmd == 'console:standby'){

			o.Status = false;

			if(fcmd){fcmd.value = '';}

			o.Console('<span class="gui opacity-x50">__Graph:Icn:Pause__ En attente du traitement...</span> ');
			
			return false;

		}


		if(cmd == 'console:standout'){

			o.Status = true;

			if(fcmd){fcmd.value = '';}

			o.ResetStatusMecanic();

			o.Console('<span class="gui opacity-x50">__Graph:Icn:Play__ Reprise du traitement</span>');
			
			return false;

		}



		if(cmd == 'console:out' || cmd == 'console:logout'){

			location.href = './logout?complete';

			o.CloseExec(cmd);
			
			return false;

		}



		if(cmd == 'console:exit'){

			location.href = '<?php $BootOn = HTTP_HOST; ?>';

			o.CloseExec(cmd);
			
			return false;

		}




		if(cmd == 'console:follow.up/start'){

			o.FollowUp = [];

			o.CloseExec(cmd);

			return false;

		}

		if(cmd == 'console:follow.up/stop'){

			o.FollowUp = false;

			o.CloseExec(cmd);

			return false;

		}




		if(cmd == 'module:exit' || cmd == 'mod:exit'){


			o.Status('Aucun Module associé');

			o.Console('__Graph:Icn:ExitToApp__Détachement du module');

			if(fcmd){fcmd.value = '';}

			o.CloseExec(cmd);

			return false;

		}


		if(cmd == 'instance:free'){

			o.Statut = false;

			o.InstanceUsed = false;

			o.ResetMacro();

			o.Exec('cmd-input:unlock', true);

			return false;

		}

		if(cmd == 'instance:occupies'){

			o.Statut = true;

			o.Exec('cmd-input:lock', true);

			return false;

		}

		if(cmd == 'cmd-input:lock'){

			o.bx.cform.addClass('disable');

			return false;

		}

		if(cmd == 'cmd-input:unlock'){

			o.bx.cform.removeClass('disable');

			if(isObj(o.Wait.cLine)){

				o.Wait.cLine.remove();

				o.Wait.cLine = false;
			}

			o._Focus();

			return false;

		}

		if(cmd == 'console:clean'){

			o.bx.viewer.html('');

			if(fcmd){fcmd.value = '';}

			o._Focus();

			o.CloseExec(cmd);

			return false;

		}



		o.Wait.Begin();

		if(!o.Mod){

			if(isFunction(o.SetCursor||'')){

				o.SetCursor(o);

			}

		}

		data+='&module=';

		data+=o.Mod || '';

		o.Exec('instance:occupies', true);


		if(o.Macros.length == 0){o.ToLine(cmd); }


		Serv.Open('do.exec', {

			data : data

			, success : function(rec){

				
					var t = rec.response || false

						, HasMacro = o.MacroStatut||false

					;

					if(isObj(rec.mod||false)){

						if(rec.mod.Key){

							o.Status(rec.mod.Name || rec.mod.Key);

							o.Mod = rec.mod.Key;

						}

						if(!rec.mod.Name){

							o.Status('').Status({icon:'warning', color:'warning-', label:'Commande introuvable'});

							o.Mod = false;

						}

					}


					if(isObj(rec.executes||false)){

						var Exec = rec.executes;

						o.MergeScript(Exec.Script).MergeProcess(Exec.Process).MergeSequence(Exec.Sequence);

						if(!o.InstanceUsed){

							// console.log('StateMarco', Exec.Cmd)

							o.StateMacro(Exec.Cmd);

						}

						if(rec.mod.Key){

							o.PlayMacro();

						}

					}


					if(isObj(rec.console||false)){

						if(isObj(rec.console.Line)){

							var endtm = rec.console.Line.length * 60;

							G.foreach(rec.console.Line, function(line, k){

								G(function(){

									o.Console(line);

								}).timeout(k*1*60);


							});

						}

					}
					

					if(isObj(rec.instance||false) && HasMacro === false){

						var inst = rec.instance[0]||{'Used':false};

						if(!inst.Used){

							o.Exec('instance:free', true);

						}

						if(inst.Used){o.Exec('instance:occupies', true); }

						o.InstanceUsed = inst.Used;

					}

					if(f){if(isFunction(f.reset||false)){f.reset();}}


			}

			, fail : function(){

				o.Status('').Status({icon:'warning', color:'warning-l', label:'Service introuvable'});

				o.Exec('instance:free', true);

			}

			, error : function(){

				o.Status('').Status({icon:'error', color:'error-l', label:'Erreur de connexion'});
				
				o.Exec('instance:free', true);

			}

			, load : function(){

				o.bx.cform['cmd'].focus();

				o.Wait.End();


			}

			, bugs : function(response, error, obj){
				
				o.Exec('instance:free', true);

				o._Blur();

				o.UI.Alert(response, 'Erreur observée', 'bug_report');

				o.Console('__Graph:Icn:Bug__ Erreur observée');

				// console.log('bugs', response, error, obj);

			}

		});


		return o;

	})



	.static('CloseExec', function(cmd){

		var o = this;

		G(function(){o.PlayMacro(); }).timeout(10);

		return o;

	})


	.static('xMacro', 0)

	.static('MacroStatus', false)

	.static('Macros', [])

	.static('PlayMacro', function(){

		var o = this;

		o.SetMacros(o.xMacro);

		return o;

	})

	.static('SetMacros', function(K){

		var o = this, K = K||0;


		if(o.Macros[K]){

			var m = o.Macros[K];

			o.MacroStatut = true;

			G(function(){

				var cmd = m[K]||false;

				if(o.Statut===true){

					G(function(){

						o.Exec( o.SetFollowUp(cmd) );

					}).timeout(10);

				}

				else{

					GScript.check(function(){

						return (o.Statut===false) ? undefined : true;

					}, function(){

						G(function(){

							o.Exec( o.SetFollowUp(cmd) );

						}).timeout(10 * (K||1));

					});
					

				}


			}).timeout(10);


			o.xMacro = (K * 1) + 1;

		}

		else{

			o.ResetMacro();

		}

		return o;

	})

	.static('ResetMacro', function(){

		var o = this;

		o.xMacro = 0;

		o.MacroStatut = false;

		o.Macros = [];

		o.Statut = true;

		o.Exec('cmd-input:unlock', true);

		return o;

	})

	.static('StateMacro', function(Cmd){

		var o = this;

		if(isObj(Cmd||'')){

			o.Macros = Cmd;
			
		}

		return o;

	})

	.static('MergeScript', function(Scr){

		var o = this;

		if(isObj(Scr||'')){
			
			G.foreach(Scr, function(C){

				G.foreach(C, function(Code){

					var Cod = "(function(){";

					Cod += Code;

					Cod += "})(GTerminal);";

					GScript.exec(Cod);

				});

			});

		}

		return o;

	})




	// .static('InitProcessStatus', false)

	.static('ProcessUI', function(){

		var o=this, Ob = o.UI.Process({

				hote : G('body')

				, width : '64vw'

				, height : '72vh'

			})

			, f = o.bx.cform||false

		;


		Ob.Awk.event.add('close', function(){

			if(f){f.cmd.focus();}

		});


		o.ProcessForm = Ob.UI.bx.ctn.create({tag:'form',cn:'ui-items-box col-0 gui flex column'})

			.attrib('action', '#')

			.attrib('method', 'post')

			.on('submit', function(){

				var f = this, els = f.elements, a = [], out = o.CurrentCmd(), save = false;

				G.foreach(els, function(el){

					if(isStr(el.name||false) && isStr(el.type||false) && isStr(el.value||false)){

						var v = '"', sv = el.attrib('save-cmd');

						v+=el.value||'';

						v += '"';

						if(sv){save = true;}

					}

					a[a.length] = v;

				});

				out+=" ";

				out+=a.join(' ');

				Ob.Awk.close();

				o.Exec(out);

				// G(function(){o.Bx.corps.scrollTop = o.Bx.corps.scrollHeight; }).timeout(100);

				return false;

			})

		;


		var list = o.ProcessForm.create({cn:'list col-16 gui flex column'});

		o.ProcessContent = list.create({cn:'prc-content col-16 gui flex column'});

		// o.InitProcessStatus = true;

		// G(function(){o.Bx.corps.scrollTop = 1; }).timeout(500);


		// o.ProcessContent.html('');


		return o;

	})




	.static('MergeProcess', function(Procs){

		var o = this;

		if(isObj(Procs||'')){

			var len = Procs.len();

			if(len > 0){

				o.ProcessUI();

				G.foreach(Procs, function(bPrc){

					G.foreach(bPrc, function(Prc, PrcKey){

						var Proc = o.Process[PrcKey] || false;

						if(isFunction(Proc.Apply||'')){Proc.Apply(Prc, o);}

					});

				});

			}

		}

		return o;

	})




	.static('MergeSequence', function(Seqs){

		var o = this;

		if(isObj(Seqs||'')){

			var len = Seqs.len();

			if(len > 0){

				G.foreach(Seqs, function(Seq, k){

					var Se = Seq[k], SQ = o.Sequence[Se.type||'']||false;

					if(SQ){

						if(isFunction(SQ.Apply||'')){SQ.Apply(Se, o);}

					}


				});


			}


		}

		return o;

	})



	.static('TriggerInit', function(){

		var o = this.ElDs();

		G(function(){

			o.Wait.Begin();

			o.bx.prelt.html('Initialisation en cours...');

			GScript.check('GTerminal.Process', function(){

				o.bx.prelt.html('Chargment des Processuces...');
				
				GScript.check('GTerminal.Sequence', function(){

					o.bx.prelt.html('Chargment des Séquences...');
					
					GScript.check('GTerminal.Graph.Icon', function(){

						o.bx.prelt.html('Chargment des Icons...');

						G(function(){

							o.bx.prelt

								.html('<div class="gui iconx x32">check</div>')

								.animation({

									from : {'transform': 'scale(1)', 'opacity':'1'}

									, to : {'transform': 'scale(2)', 'opacity':'0.001'}

								}, 150, 'ease-out'

								, function(){

									o.bx.cform.removeClass('disable');

									o.bx.prelt.remove();
									
									o.Initialize();

									G(function(){

										o.Wait.End();

										o.bx.cform['cmd'].focus();

										o.isReady = true;

									}).timeout(1000);

								})

							;

						}).timeout(250);

					});
				
				});
			
			});


		}).timeout(1000);


		return o;

	})



	.static('Init', function(){

		var o = this.ElDs();


		G.Gabarit.Ajax.Capture = true;

		G.Gabarit.Ajax.Target = '#ggn-sheet-container';

		G.Gabarit.Ajax.ActiveHistory = true;

		G.Gabarit.Ajax.Events.add('wait', function(){o.Wait.Begin(); });

		G.Gabarit.Ajax.Events.add('wait.end', function(){

			G(function(){

				o.Wait.End();

				GApp.FloatingMenu.Show();

			}).timeout(500);

		});


		GScript

			.package('ggn.terminal.process')

			.package('ggn.terminal.sequence')

			.package('ggn.terminal.graph.icon')

		;


		GEvent(window).listen('load', function(){

			o.TriggerInit();

		});


		return o;

	})



	.static('Initialize', function(){

		var o = this;

		if(!'KeyShot' in G){GToast('< KeyShot > est introuvable!!').error();}


		GAction('handler:Terminal.Cmd').listen('click', function(e){

			var cmd = e.attrib('terminal-cmd') || false;

			if(isStr(cmd)){

				o.Exec(cmd);

			}

		});



		G('#terminal-area-cmds-form').on('submit', function(ev){

			var f= this, e = f['cmd'];

			o.Submit(f.strToSend());

			return false;

		});




		return o;

	})

	;


	return G.Terminal;

})(window,document,navigator).Init();
