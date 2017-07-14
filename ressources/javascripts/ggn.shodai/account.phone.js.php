/* Blog for Thème, Copyright GOBOU Y. Yannick 2016 */

(function(W,D){

	"use strict";



	GScript.check('GCOMService', function(){
		

		var Idn = {

			Version : '0.1'

			, Service : {

				name : 'ggn.user'

				,title : 'GGN User COM'

				,Instance : function(){return this.object||G.COM.Service(this.name).Init({Title:this.title});}

			}

		};



		var form = G('[name="accountPhonesForm"]');


		form.on('submit', function(){

			var f = this

				, Serv = Idn.Service.Instance()

				, toast = GToast({

					title : 'Mise à jour de vos numéros mobile'

					,text : 'Chargement...'

					,delay : null

					,permanent : true

				}).wait()

			;



			Serv.Open('update.phones', {

				data : f.strToSend()

				, success : function(rec){

					toast.close();

					var t = rec.treat||{}, u = t.update||false;

					if(u === true){

						toast.success()._text('Effectué avec succès')._delay(3000);

						G(function(){history.go(0); }).timeout(3000);

					}

					else{

						toast.error()._text('Echec lors du traitement')._delay(3000);

					}

				}

			});

			return false;

		});


	});



})(window,document);