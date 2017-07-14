/* GougnonJS.Terminal, version : 0.1, update : 160903#2209, Copyright GOBOU Y. Yannick 2016 */

<?php $this_ = $this; Gougnon::clientsRefererControlAccess('-deny', ['all'], ['domaine'], function($code) use($this_) {echo "alert('Vous n\'êtes pas autorisé à utiliser cette API.');"; $this_->Register->close(); }); echo "\n"; ?>

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GTerminal 0.1 ');return false;}



	API=G.API({

		name:'Terminal'
		
		,static:{
			
			version:'0.1 nightly, Août 2016, 160811.2333'

			, Get : false

			, Mode : {

				Write : {

					Prefix : 'console:write///'

				}

			}

			, Service : {

				name : 'ggn.terminal'

				, title : 'GGN Terminal'

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


					// txt = txt.match(/__Graph:Icn:(.*)__/, "<span class=\"gui iconx\">$1</span>");

				}

				return txt;

			}


		}
		

		,constructor:function(){
		
			var o=this;

				o.Stc = o.STATIC;

				o.T = o.ARGS[0] || false;

				o.Config = o.ARGS[1] || {};
				
				o.Composer = false;

				o.Event = G.Event(o);

				o.Status = true;

				o._cmds = [];

				o.CurrentModule = '';

				o.InstanceUsed = false;

				o.FollowUp = false;



				GAction('handler:Terminal.Cmd').listen('click', function(e){

					var cmd = e.attrib('terminal-cmd') || false;

					if(isStr(cmd)){

						o.Exec(cmd);

					}

				});

				

			var Evts = o.Config['Events'] || {};

			G.foreach(o.Stc.Inits.Evts.split(' '), function(k){var nn = 'On'; nn+=k; o[k] = (isFunction(Evts[k]||false)) ? Evts[k] : G.F(); });
			
		}

	})

	.create();



	GScript

		.package('ggn.terminal.process')

		.package('ggn.terminal.sequence')

		.package('ggn.terminal.graph.icon')

	;



	API

	.dynamic('Exec', function(cmd,ds){

		var o=this,dat='',f=o.Composer||false, ds=ds||false;

		if(f){dat+=f.strToSend('cmd');}

		dat+='&cmd='; dat+=cmd;

		o.Submit(dat,ds);

	})


	.dynamic('CurrentCmd', function(){

		var o=this; return o._cmds[o._cmds.length - 1];

	})


	.dynamic('StatusMecanicTriggered', false)

	.dynamic('ResetStatusMecanic', function(){

		var o = this;

		o.StatusMecanicTriggered = false;

	})




	.dynamic('SetFollowUp', function(cmd){

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



	.dynamic('Submit', function(data, ds){

		var o=this

			, Serv = o.Stc.Service.Init()
			
			, cmd = (unescape(o.Stc.GetCMDFromData(data))).lower()
			
			, f = o.Composer||false
			
			, fcmd = f.cmd||false

			, cmds = o._cmds

			, ds = ds||false

		;

		cmd = cmd.replace('/+/', '');



		if(ds===false){

			o._cmds[cmds.length] = cmd;
			
		}
		

		cmd = o.SetFollowUp(cmd);

			
		if(isObj(o.T)){

			var MdWrite = cmd.substr(0, (o.Stc.Mode.Write.Prefix).length);


			if(MdWrite == o.Stc.Mode.Write.Prefix){

				o.T.Console( cmd.substr((o.Stc.Mode.Write.Prefix).length||0) );

				if(fcmd){fcmd.value = '';}

				o.CloseExec(cmd);

				return false;

			}


			if(cmd == 'console:close'){

				o.T.Console('__Graph:Icn:Warning__ Fermeture de la fenêtre');

				window.close();
				
				return false;

			}



			if(o.T.Started === false || cmd == 'interface:open'){

				o.T.Start(o,cmd);

				o.OnStart(cmd);

				if(cmd == 'interface:open'){

					o.OnOpen(o);

					if(fcmd){fcmd.value = '';}

					o.CloseExec(cmd);

					return false;

				}

				o.T.Started = true;


			}



			if(cmd == 'interface:close'){

				o.T.Close(o);

				o.OnClose();

				if(fcmd){fcmd.value = '';}

				o.T.Started = false;

				o.CloseExec(cmd);

				return false;

			}


			if(cmd == 'console:standby'){

				o.Status = false;

				if(fcmd){fcmd.value = '';}

				o.T.Console('<span class="gui opacity-x50">__Graph:Icn:Pause__ En attente du traitement...</span> ');

				// o.CloseExec(cmd);
				
				return false;

			}


			if(cmd == 'console:standout'){

				o.Status = true;

				if(fcmd){fcmd.value = '';}

				o.ResetStatusMecanic();

				o.T.Console('<span class="gui opacity-x50">__Graph:Icn:Play__ Reprise du traitement</span>');

				// o.CloseExec(cmd);
				
				return false;

			}



			if(cmd == 'console:out' || cmd == 'console:logout'){

				o.OnLogOut();

				// o.OnStop();

				o.CloseExec(cmd);
				
				return false;

			}



			if(cmd == 'console:exit'){

				o.OnExit();

				// o.OnStop();

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


				o.T.ModExit(o);

				o.OnModExit();

				if(fcmd){fcmd.value = '';}

				o.CloseExec(cmd);

				return false;

			}



			if(cmd == 'instance:free'){

				o.InstanceUsed = false;

				o.ResetMacro();

				o.Exec('cmd-input:unlock', true);

				// o.CloseExec(cmd);

				return false;

			}


			if(cmd == 'instance:occupies'){

				o.Exec('cmd-input:lock', true);

				// o.CloseExec(cmd);

				return false;

			}




			if(cmd == 'cmd-input:lock'){

				if(fcmd){if(isFunction(fcmd.attrib)){fcmd.attrib('disabled','disabled');} }

				return false;

			}


			if(cmd == 'cmd-input:unlock'){

				if(fcmd){if(isFunction(fcmd.attrib)){fcmd.removeAttrib('disabled');} }

				return false;

			}




			if(cmd == 'console:clean'){

				o.T.Clean(o);

				o.OnClean();

				if(fcmd){fcmd.value = '';}

				o.CloseExec(cmd);

				return false;

			}



			// o.T.sWait(o);

			o.OnWait();


			if(!o.CurrentModule){

				if(isFunction(o.T.InitConsolePlace||'')){

					o.T.InitConsolePlace(o);

				}

			}			


			data+='&module=';

			data+=o.CurrentModule || '';

			
			o.Exec('instance:occupies', true);



			var MiniWait = false;


			if(isObj(o.T.CurrentConsolePlace||false)){

				MiniWait = o.T.CurrentConsolePlace.create();

				if(isObj(MiniWait)){

					MiniWait.html('<div class="padding-tb-x8 padding-lr-x12 gui flex row wrap"><div class="gui loading circle x16 margin-r-x12"></div> Traitement...</div>');

					G(function(){o.T.Bx.corps.scrollTop = o.T.Bx.corps.scrollHeight; }).timeout(10);

				}

			}


			Serv.Open('do.command', {

				data : data

				, success : function(rec){


					var t = rec.response || false

						, T = o.T

						, HasMacro = o.MacroStatus||false

					;

					if(isObj(rec.mod||false)){

						if(rec.mod.Key){

							T.Status('', false, true).title = '';

							T.ModStatus(rec.mod.Name || rec.mod.Key);

							o.CurrentModule = rec.mod.Key;

						}

						if(!rec.mod.Name){

							T.Status('warning').title = 'Attention : Commande introuvable';

							o.CurrentModule = false;

						}

					}


					if(isObj(rec.executes||false)){

						var Exec = rec.executes;

						o.MergeScript(Exec.Script).MergeProcess(Exec.Process).MergeSequence(Exec.Sequence);

						if(!o.InstanceUsed){

							o.StateMacro(Exec.Cmd);

						}

						if(rec.mod.Key){

							o.PlayMacro();

						}

					}


					if(isObj(rec.console||false)){

						if(isObj(rec.console.Line)){

							var endtm = rec.console.Line.length * 60, bxc = T.Bx.console;

							G.foreach(rec.console.Line, function(line, k){

								G(function(){

									T.Console(line);

									o.T.Bx.corps.scrollTop = o.T.Bx.corps.scrollHeight;

								}).timeout(k*1*60);


							});

							G(function(){o.T.Bx.corps.scrollTop = o.T.Bx.corps.scrollHeight; }).timeout(50);

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

					o.Exec('instance:free', true);

					o.OnFail();

				}

				, error : function(){

					o.Exec('instance:free', true);

					o.OnError();

				}

				, load : function(){

					if(isObj(MiniWait)){MiniWait.remove();}

					// o.T.cWait();

					o.OnLoad();

				}

				, bugs : function(response, error, obj){

					o.Exec('instance:free', true);

					o.OnBugs(response, error, obj);

				}

			});


			return false;

		}

			
		return o;
	})




	.dynamic('CloseExec', function(cmd){

		var o = this, hMacro = o.MacroStatus||false;

		G(function(){

			o.PlayMacro();

		}).timeout(10);

		return o;

	})



	.dynamic('CurrendMacro', 0)

	.dynamic('MacroStatus', false)

	.dynamic('Macros', [])

	.dynamic('PlayMacro', function(){

		var o = this;

		o.TriggerMacro(o.CurrendMacro);

		return o;

	})

	.dynamic('TriggerMacro', function(K){

		var o = this, K = K||0;


		if(o.Macros[K]){

			var m = o.Macros[K];

			o.MacroStatus = true;

			G(function(){

				var cmd = m[K]||false;

				if(o.Status===true){

					G(function(){

						o.Exec( o.SetFollowUp(cmd) );

					}).timeout(10 );

				}

				else{

					GScript.check(function(){

						return (o.Status===false) ? undefined : true;

					}, function(){

						G(function(){

							o.Exec( o.SetFollowUp(cmd) );

						}).timeout(10 * (K||1));

					});
					

				}


			}).timeout(10);


			o.CurrendMacro = (K * 1) + 1;

		}

		else{

			o.ResetMacro();

		}

		return o;

	})

	.dynamic('ResetMacro', function(){

		var o = this;

		o.CurrendMacro = 0;

		o.MacroStatus = false;

		o.Macros = [];

		o.Status = true;

		return o;

	})

	.dynamic('StateMacro', function(Cmd){

		var o = this;

		if(isObj(Cmd||'')){

			o.Macros = Cmd;
			
		}

		return o;

	})




	.dynamic('MergeScript', function(Scr){

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




	.dynamic('InitProcessStatus', false)

	.dynamic('InitProcessBox', function(){

		var o = this, ht = o.T.Bx.process, f = o.Composer||false, fce = o.T.Bx.face;

			fce.addClass('stand-by');

			ht.removeClass('prc-close');

		if(!o.InitProcessStatus){

			o.ProcessBar = ht.create({cn:'prc-title text-x16 gui flex row'});

			o.ProcessClsBox = o.ProcessBar.create({cn:'prc-closer align-left x64 gui flex center cursor-pointer'})

				.html('<span class="gui icon iconx text-x32">close</span>')

				.on('click', function(){

					ht.addClass('prc-close');

					if(f){f.cmd.focus();}

					fce.removeClass('stand-by');

					G(function(){o.T.Bx.corps.scrollTop = o.T.Bx.corps.scrollHeight; }).timeout(100);

				})

			;

			o.ProcessTitle = o.ProcessBar.create({cn:'text-x28 col-0 text-upper padding-tb-x16 padding-r-x28'})

				.html('Procedure')

			;




			o.ProcessForm = ht.create({tag:'form',cn:'col-0 gui flex column'})

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

					o.ProcessClsBox.click();

					o.Exec(out);

					G(function(){o.T.Bx.corps.scrollTop = o.T.Bx.corps.scrollHeight; }).timeout(100);

					return false;

				})

			;

			o.ProcessContent = o.ProcessForm.create({cn:'prc-content col-0'});

			o.InitProcessStatus = true;

			G(function(){o.T.Bx.corps.scrollTop = 1; }).timeout(500);

		}


		o.ProcessContent.html('');


		return o;

	})




	.dynamic('MergeProcess', function(Procs){

		var o = this;

		if(isObj(Procs||'')){

			var len = Procs.len();

			if(len > 0){

				o.InitProcessBox();

				G.foreach(Procs, function(bPrc){

					G.foreach(bPrc, function(Prc, PrcKey){

						var Proc = o.Stc.Process[PrcKey] || false;

						if(isFunction(Proc.Apply||'')){Proc.Apply(Prc, o);}

					});

				});

			}

		}

		return o;

	})




	.dynamic('MergeSequence', function(Seqs){

		var o = this;

		if(isObj(Seqs||'')){

			var len = Seqs.len();

			if(len > 0){

				G.foreach(Seqs, function(Seq, k){

					var Se = Seq[k], SQ = o.Stc.Sequence[Se.type||'']||false;

					if(SQ){

						if(isFunction(SQ.Apply||'')){SQ.Apply(Se, o);}

					}


				});


			}


		}

		return o;

	})


	;



})(window,document,navigator);
