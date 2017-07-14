<?php if(isset($this->Register) && isset($this->Register->USER) && is_array($this->Register->USER) && isset($this->Register->USER['ACCOUNT_TYPE']) && $this->Register->USER['ACCOUNT_TYPE'] >= 2){ ?>/* GougnonJS.BookingAdmin, version : 0.1, update : 160930#0804, Copyright GOBOU Y. Yannick 2016 */


(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GBookingAdmin 0.1 ');return false;}

	API=G.API({

		name:'BookingAdmin'

		,static:{
			
			version:'0.1 nightly, Sept 2016, 160930.0804'

			, Bx : {}

			, iD : {

				Opt : '.header-options'

				, Wait : '#com-waiting'

			}

			, Reg:[]

			, Service : {

				Obj : false

				, State : function(){

					this.Obj = this.Obj||G.COM.Service('ggn.booking').Init({Title:'GGN Booking',HideError:false});

					return this.Obj;

				}

			}

			, ToastObj : false

			, Toast : function(txt){

				var o = this, txt=txt||'...';

				o.ToastObj = GToast({

					title : 'GGN.Booking'

					, icon : 'book'

					, text : txt

					, delai : 3000

				});

				return o.ToastObj;

			}

		}

		,constructor:function(){
		
			var o=this;
		
				o.args = arguments[0]||[];
		
				o.event = G.Event(o);
		
		}

	}).create();


	API

		.static('Initialize', function(){

			var o = this, wait;

			o.Bx.Wait = G(o.iD.Opt).create({cn:'gui loading pulsar x32 margin-r-x16'}).html('<div class="bullet"></div>');


			G.Gabarit.Ajax.Capture = true;

			G.Gabarit.Ajax.Target = '#ggn-sheet-container';

			G.Gabarit.Ajax.ActiveHistory = true;

			G.Gabarit.Ajax.Events.add('wait', function(){o.Bx.Wait.opacity(0.99);});

			G.Gabarit.Ajax.Events.add('wait.end', function(){G(function(){o.Bx.Wait.opacity(0.001); }).timeout(150); });



			GAction('handler:GGN.Booking.Admin.Update.Available').listen('focus change', function(e,ev){

				var nm = e.attrib('name')||false, val = e.value||false

					,dat='ggn-registry-token-exception='

				;

				if(!nm){return false;}

				dat+=o.Reg[0]; dat+='&ggn-registry-token-exception-key='; dat+=o.Reg[1];

				o.Bx.Wait.opacity(0.99);

				var service = o.Service.State();

					dat += '&nm='; dat += nm;

					dat += '&val='; dat += val;
				


				service.Open("update.availables", {

					data : dat

					, success : function(obj){

						var r = obj['response']||false;

						if(r===true){

							// o.Toast('Mise à jour effectué avec succès').success();

						}

						else{o.Toast('Erreur lors de la mise à jour').error();}

					}

					, fail : function(){o.Toast('Echec lors du chargement...').warning(); }

					, error : function(){o.Toast('Erreur').error(); }

					, loadend : function(){o.Bx.Wait.opacity(0.001);}

				});


			});


			GEvent(window).listen('load', function(){

				o.Bx.Wait.opacity(0.001);

			});


			return o;

		})


	;

	G.BookingAdmin.Initialize();

})(window,document,navigator);

<?php } ?>