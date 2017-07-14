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



		var form = G('[name="accountPasswordForm"]');


		form.on('submit', function(){

			var f = this

				, Serv = Idn.Service.Instance()

				, toast = GToast({

					title : 'Changement de mot de passe'

					,text : 'Patientez...'

					,delay : null

					,permanent : true

				}).wait()

			;



			Serv.Open('update.password', {

				data : f.strToSend()

				, success : function(rec){

					console.log(JSON.stringify(rec));

					toast.close();

					var r = rec.response, t = rec.treat||{}, u = t.update||false;

					if(u === true){

						toast.success()._text('Effectué avec succès<br>Veuillez vous connecter avec votre nouveau mot de passe')._delay(3000);

						G(function(){
						
							var u = 'logout?next=';
						
								u+=encodeURIComponent(location.href);
						
							location.href = u;
						
						}).timeout(3500);

					}

					else{

						if(r=='is.same'){

							toast.error()._text('Vous devez indiquer un nouveau mot de passe')._delay(5000);

						}

						else{

							if(r=='is.different'){

								toast.error()._text('Veuillez correctement confirmer le nouveau mot de passe')._delay(5000);

							}

							else{

								if(r=='password.failed'){

									toast.error()._text('Veuillez indiquer correctement votre mot de passse actuel')._delay(5000);

								}

								else{

									toast.error()._text('Echec lors du traitement')._delay(3000);

								}

							}

						}

					}

				}

			});

			return false;

		});


	});



})(window,document);