/* GougnonJS.COM.Service, version : 0.1, update : 151201#1835, Copyright GOBOU Y. Yannick 2014 */

<?php global $GRegister; $GRegister->UseCaches = false; $this_ = $this; Gougnon::clientsRefererControlAccess('-deny', ['all'], ['domaine'], function($code) use($this_) {echo "alert('Vous n\'êtes pas autorisé à utiliser cette API.');"; $this_->Register->close(); }); echo "\n"; ?>

(function(A,P,I){var API;

if(!Gougnon.support('nightly 0.1.160812.1212')){alert('La version de GougnonJS n\'est pas compatible avec COMService 0.1.150527'); return false; }

if(!isFunction(G.COM||null)){GScript.package('ggn.com.initialize');}


GScript.check('G.COM', function(){

	if(!('COMService' in G)){

		API=G.API({

			name:'COMService'

			,static:{

				version:'0.1'

				,Pkg:'ggn.com.service'

				,Host:'<?php echo HTTP_HOST; ?>'

				,XHRVars:[GAjax.xhrvars,' '].join('')

				,EventsVar:[GAjax.events, ' bugs'].join('')

				,Toast:false

				, fURL : function(url){

					var sl = url.toString().substr(-1), u = url;

					u+=sl=='/' ? '' : '/'

					return u;

				}

				, VAR : {

					'CF_RTIME' : 'GGN_COM_SERVICE_COUNT_FAIL_REMAINING_TIME'

				}

				, CF_GetTime : function(){

					var o = this, Sto = sessionStorage;

					if(Sto.getItem(o.VAR.CF_RTIME)){

						var v = Sto.getItem(o.VAR.CF_RTIME), d = new Date();

						d.setTime(v);

						return d;

					}

					else{return false;}

				}

			}

			,constructor:function(){

				var o=this;

				o.Stc=o.STATIC;

				o.args=arguments[0]||[];

				o.name=o.args[0]||false;

				o.event=G.Event(o);

				o.ajax=false;

			}

		}).create();

		

		API.dynamic('Init', function(){var o=this,a=arguments,Opt=a[0]||{};

			Opt.Title=Opt.Title||'GGN COM SERVICE';
			
			o.Path='com.services/';

			o.Path+=o.name;

			o.Path+='/';

			o.Opt=Opt;

			o.Opt.HideError = o.Opt.HideError || false;
			
			return o;

		});
		

		API.dynamic('Open', function(u,xh,dmn,gt){var o=this,a=arguments,u=u||'',xh=xh||{},dmn=dmn||false,xr={};
			
			G.foreach(o.Stc.XHRVars.split(' '), function(v){

				o[v]=xh[v]||false;

				xr[v]=xh[v]||false;

			},false,false,'.');


			xh.sData = xh.sData||false;

			
			G.foreach(o.Stc.EventsVar.split(' '), function(v){var n='On';n+=v.ucFirst();

				o[n]=xh[v]||G.F();

				xr[v]=xh[v]||G.F();

			},false,false,'.');


			xr.URI=o.Stc.fURL(dmn||o.Stc.Host);

			xr.URI+=o.Path;

			xr.URI+=u;
			

			xr.data+='&ggn-registry-token='; xr.data+=escape("<?php echo \RegisterSecure::Token(); ?>");
			

			xr.mode='POST';

			xr.crossDomaine=true;


			if(o.Opt.HideError==false){

				o.Stc.Toast = GToast({title : o.Opt.Title, text : 'Connexion...', delay : 3000}).wait(true);

				o.Stc.Toast.close();

			}

			o.type=((isString(o.type)?o.type:false)||'-normal').lower();

			xr.success=function(evt){var o1=this,xhr=this.xhr, r=xhr.responseText, h='';

				// console.log(r);

				if(o.Opt.HideError==false){ o.Stc.Toast.close();}

				try{
					var obj=JSON.parse(r);

					if(isObject(obj)){

						var res=obj.response, tk = obj.GGN_REGEDIT_ACCEPT_TOKEN;

						if(res=='require.login'){

							h+=('Vous devez être connecté pour acceder à ce service');

							location.href = ['<?php echo _GGN::setvar(_GGN::varn("LOGIN_PAGE")) . "?next=',escape(location.href),'"; ?>'].join('');

						}

						else if(res=='data.encoding.not.supported'){h+=('L\'encodage des caratères retournés n\'est pas valide');}

						else if(res=='data.not.found'){h+=('Aucune donnée détecté pour traitement');}

						else if(res=='query.fail'){h+=('Echec lors de l\'execution de la requette');}


					}

					else{

						h+=('Le retour du service n\'est pas valide');
						
					}

					G(function(){

						if(res=='try.over'){

							var cf = obj.CountingFailures, dt = new Date(),h='',d='';

								dt.setSeconds( cf.TimeRemaining );


							if(o.Opt.HideError===false){

								d+=dt.getHours(); d+=":";

								d+=dt.getMinutes(); d+=":";

								d+=dt.getSeconds(); d+="";

								h+=('Nombre de tentative épuisée, Votre prochaine tentative à ');

								h+=d;

								GToast(h)._delay(10000).error();
								
							}

							sessionStorage.setItem(o.Stc.VAR.CF_RTIME, dt.getTime() );

						}

						if(!tk){

							if(tk===false){GToast('Echec du Jéton d\'autorisation, veuillez actualiser la page...')._delay(10000).error();}

							if(tk===null){GToast('Aucun du Jéton d\'autorisation, veuillez actualiser la page...')._delay(10000).error();}

							history.go(0);

							return false;

						}

						o1.OnSuccess=o.OnSuccess;o1.OnSuccess(obj,evt);

					}).timeout(1);

					
				}

				catch(e){

					console.log('GGN.COM.Service Error ///', e.message);

					xr.bugs(r, e, o);

					h+=('Une erreur a été detecté lors de l\'ouverture du service');

				}

				if(!h.isEmpty() && o.Opt.HideError===false){

					if(o.Opt.HideError==false){o.Stc.Toast.error()._text(h);}

				}
				

			};

			xr.fail=function(){var o1=this;

				if(o.Opt.HideError===false){

					if(o.Stc.Toast){o.Stc.Toast.close();}

					o.Stc.Toast.warning()._text('Service introuvable');

				}

				o1.OnFail=o.OnFail;o1.OnFail();

			};

			xr.error=function(){var o1=this;

				if(o.Opt.HideError===false){

					if(o.Stc.Toast){o.Stc.Toast.close();}

					o.Stc.Toast.error()._text('Erreur lors du chargement du service');

				}

				o1.OnError=o.OnError;o1.OnError();

			};


			var jx=GAjax(xr).XHR().send(xh.sData);

			o.ajax = jx;
			
			return o;
		});


		window.GCOM.Service = G.COMService;
		
		window.G.COM.Service = G.COMService;
	
	}

});


})(window,screen,navigator);