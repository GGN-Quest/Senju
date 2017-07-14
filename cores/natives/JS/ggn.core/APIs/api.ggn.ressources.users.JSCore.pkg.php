/* GougnonJS.Ressources.Users, version : 0.1, update : 160408#1106, Copyright GOBOU Y. Yannick 2015 */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GRessources.Users 0.1 ');return false;}

	G.Script.package('ggn.ressources').check('GRessources', function(){

		API=G.API({

			name:'RessourcesUsers'
			
			,static:{
				
				version:'0.1 nightly, Avril 2016, 160408.1104'

				, parentObject : G.Ressources||false

				, Instance : []
				
				, open : function(Typ, Cfg, CB){

					var o = this

						, Cfg = Cfg || {}

						, Typ = Typ || '*'
					
						, CB = CB||false

						, Rsrc

					;


					Cfg.user = true;

					Rsrc = o.parentObject(Typ,Cfg)

					Rsrc.open();

					Rsrc.event.add('done', function(a){

						var a=a||{}, cbOb='GRsrc_';

						cbOb += CB;

						A[cbOb] = a[0]||false;

						if(typeof A[CB] == 'function'){

							A[CB](a[1]||[],Typ);						

						}

						else{

							A[CB] = a[1]||[];

						}
						

					});

					

					o.Instance = Rsrc;

					return o;

				}

			}

			,constructor:function(){
			
				var o=this;

					o.Stc = o.STATIC;

					o.event = G.Event(o);
			
			}

		})

		.create()


		.static('Listeners', function(){

			var o=this;
				
				GAction('handler:Ressources.Users.Images').listen('click touchstart',function(e,ev){

					if(GEvent(ev).isLeftClick()){

						var ge = G(e)

							, usr = ge.attrib('rsrc-users') || false

							, chuz = ge.attrib('rsrc-choose') || 'true'

							, mu = ge.attrib('rsrc-multiple') || 'true'

							, imp = ge.attrib('rsrc-import') || 'true'

							, mid = ge.attrib('rsrc-mid') || ''

							, cnfd = ge.attrib('rsrc-confidentiality') || 'private'

							, wkfrmpr = ge.attrib('rsrc-awake-from') || ge

							, cbdat = ge.attrib('rsrc-callback-data') || 'GRessourcesUsersCallBackData'

						;


						o.open(

							'image'

							,{

								choose : (chuz=='true') ? true: chuz

								,multiple : (mu=='true') ? true: false

								,importTo : (imp=='true') ? true: false

								,confidentiality : cnfd

								,MId : mid

								, Awk : {

									from : (isStr(wkfrmpr)) ? ge.etiq(wkfrmpr) : wkfrmpr

								}

							}

							, cbdat

						);

					}

				});



			return o;
		})


		;

		G.Ressources.Users = G.RessourcesUsers.Listeners();

	});



})(window,document,navigator);
