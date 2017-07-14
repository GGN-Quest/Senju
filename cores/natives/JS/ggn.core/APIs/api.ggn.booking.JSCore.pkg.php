<?php if(isset($this->Register) && isset($this->Register->USER) && is_array($this->Register->USER) && isset($this->Register->USER['ACCOUNT_TYPE']) && $this->Register->USER['ACCOUNT_TYPE'] >= 2){ ?>/* GougnonJS.Booking, version : 0.1, update : 160930#0804, Copyright GOBOU Y. Yannick 2016 */


(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GBooking 0.1 ');return false;}

	API=G.API({

		name:'Booking'

		,static:{
			
			version:'0.1 nightly, Sept 2016, 160930.0804'

			, Service : {

				Obj : false

				, Data : false

				, Reg : []

				, State : function(){

					this.Obj = this.Obj||G.COM.Service('ggn.booking').Init({Title:'GGN Booking',HideError:true});

					return this.Obj;

				}

				, Update : function(){

					var o = this, service = o.State(),dat='ggn-registry-token-exception=';

						dat+=o.Reg[0]; dat+='&ggn-registry-token-exception-key='; dat+=o.Reg[1];
						
					service.Open("get.availables", {

						data : dat

						, success : function(obj){

							var r = obj['response']||false;

							if(r===true){o.Data = obj['Data']||false;}

							else{o.Toast('Erreur lors de la mise à jour').error();}

						}

						, fail : function(){GToast('Echec lors du chargement...').warning(); }

						// , error : function(){GToast('Erreur').error(); }

						, loadend : function(){G(function(){ o.SetUpdate(); }).timeout(100);G(function(){ o.Update(); }).timeout(5000);}

					});

					return o;
					
				}

				, SetUpdate : function(){

					var o=this,Data=o.Data;

					if(Data){

						var nodes = G('[booking-product-avail-view]').__NODE_LIST__;

						if(nodes.length > 0){

							G.foreach(nodes, function(v){

								if(v.attrib){

									var nm = v.attrib('booking-product-avail-view'), avail=Data[nm]||0;

									v.html(avail.toString());

								}

							});

						}

						o.Data = false;
					}

					return o;

				}

			}

			, Elms : function(){

				var o = this, Body=G('body'), H = o.Hote||Body.create({cn:'vw10 vh10 gui pos-fixed bg-dark flex column'}), Bx = {};

					H.css({'z-index':'100', 'top':'0px', 'left':'0px'}).removeClass('disable');

					Bx.Thumb = H.create({cn:'gui flex thumb pos-rel w-inherit vh5-max _h10 bg-dark-d bg-abs-center bg-full-x-size'});

						Bx.Close = Bx.Thumb.create({cn:'gui pos-abs bg-dark x64 flex center cursor-pointer'}).css({'bottom':'0px','left':'0px'}).html('<div class="gui iconx x48 color-error-p">close</div>').on('click', function(){

							H.addClass('disable');

						});

					Bx.Details = H.create({cn:'gui flex column details col-0 color-light'});

						Bx.Title = Bx.Details.create({cn:'title h1 text-ellipsis padding-lr-x32 padding-t-x16'});

						Bx.Loc = Bx.Details.create({cn:'location text-x16  padding-lr-x32'});

						Bx.About = Bx.Details.create({cn:'about text-x16  padding-lr-x32'});

						Bx.Nume = Bx.Details.create({cn:'numeric-bar text-x16 gui flex row wrap padding-lr-x32 padding-t-x8 padding-b-x32'});

							// Bx.CLength = Bx.Nume.create({cn:'len text-x32 text-thin  padding-x16'});

							// Bx.Plat = Bx.Nume.create({cn:'plat text-x32 text-thin  padding-x16'});

							Bx.Price = Bx.Nume.create({cn:'plat text-x32 text-thin col-0'});

						Bx.Info = Bx.Details.create({cn:'col-0 padding-x32 gui flex row bg-dark-l'})

							.html('<div class="x86"><div class="gui iconx x64">info</div></div> <div class="col-0 text-x18 text-left padding-x12">Veuillez nous contacter aux :<br> (+225) 22 42 82 18 <br> (+225) 05 22 22 22<br> songonpark@hotmail.com</div>')

						;



				o.Bx = Bx;

				return o;

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

			var o = this;


			GAction('handler:GGN.Booking.Product.Show').listen('focus click', function(e,ev){

				var nm = e.attrib('product-name')||false, th = e.attrib('product-thumb')||'', Bx ,thbg='url(';

				o.Elms();

				Bx = o.Bx;

				var p = e.parentNode.parentNode

					, ttl = p.child('.title')[0].html().inner

					, loc = p.child('.location')[0].html().inner

					, abo = p.child('.about')[0].html().inner

					// , len = p.child('.bklength')[0].html().inner

					// , pla = p.child('.plat')[0].html().inner

					, pri = p.child('.price')[0].html().inner

				;



				Bx.Title.html(ttl);

				Bx.Loc.html(loc);

				Bx.About.html(abo);

				// Bx.CLength.html(len);

				// Bx.Plat.html(pla);

				Bx.Price.html(pri);



				thbg+=th; thbg+='?';

				Bx.Thumb.css({'background-image':thbg});

				// Bx.Title.html(ttl);


			});


			GEvent(window).listen('load', function(){

				G(function(){

					o.Service.Update();

				}).timeout(1000);
				
			});

			return o;

		})


	;

	G.Booking.Initialize();

})(window,document,navigator);

<?php } ?>