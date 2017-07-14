 (function(G,gAPI){

	"use strict";


	var api = gAPI({

		name : 'PKGMan'

		, static : {

			version : '0.1'

			, Var : {

				Item : ''

			}

			, Service:{

				Name:'ggn.pkg.man'

				,Title:'GPK Manager Service'

				,Object:false

				,Init : function(){ var i=this; return i.Object || G.COM.Service(i.Name).Init({Title:i.Title, HideError:false}); }

			}


		}

		, constructor : function(){

			this.Stc = this.STATIC;

			var o = this;

			o.instance = o.ARGS[0]; 

			// G.foreach(o.Stc.Var.Item.split(' '),function(v,k){it[v]=c[v]||false;},false,false,'.');

		}

	})

	.create()

		.static('CreatePkg', function(pkgname, about, type, succ){

			var o = this, srv = o.Service.Init(), dat = 'pkgname=', succ = isFunc(succ) ? succ : G.F();


			dat += escape(pkgname);

			dat += '&about='; dat += escape(about);

			dat += '&type='; dat += escape(type);


			srv.Open('pkg.create', {

				data : dat

				, success : function(rec){

					if(rec.response===true){

						succ(rec);

					}

					else{

						GToast('Erreur lors de la tentative de création du projet').error();

					}


				}

			})

			return o;

		})

	;

	

})(G,GAPI);