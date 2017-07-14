<?php global $GLANG; ?>/* GougnonJS.GabaritNavTab, version : 0.1, update : 160122#1050, Copyright GOBOU Y. Yannick 2015 */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GGabaritNavTab 0.1 ');return false;}


	API=G.API({

		name:'GabaritNavTab'

		,static:{
			
			version:'0.1 nightly, Nov 2016, 161129.1437'
			

		}

		,constructor:function(){
		
			var o=this;
		
				o.args = arguments[0]||[];
		
				o.Box = o.args[0]||[];
		
				o.event = G.Event(o);
		
		}

	}).create();


	API.static('Init', function(){

		var o=this;


			GAction('handler:Gabarit.Nav.Tab').listen('focus',function(e,ev){

				if(isObj(e)){


					var k = e.attrib('tab-key')

						, p = false

						, path = G.browseHTMLElementPath(e, function(e){

							var n = e.attrib('gabarit-nav-tab');

							if(isStr(n) && p == false){p = e;}

							return n;

						}).reverse()

					;

					if((!isNaN(k) || isStr(k)) && isObj(p)){

						var name = p.attrib('gabarit-nav-tab'), sel = '[gabarit-nav-tab="', ctn, selk='', selprn='', ctns, ctk

							sel += name;

							sel += '"] ';

							selk += sel;
							
							selprn += sel;

							sel += ' .items-container ';

							sel += '[tab-content="';

							sel += k;

							sel += '"]';

						ctn = G(sel);


						if(isObj(ctn)){

							ctns = G(selprn).child('[tab-content]');

							ctk = G(selprn).child('[tab-key]');

							if(isObj(ctns)){G.foreach(ctns, function(ct,no){ct.removeClass('actived'); }); }

							if(isObj(ctk)){G.foreach(ctk, function(ct,no){ct.removeClass('actived'); }); }

							ctn.addClass('actived');

							e.addClass('actived');

						}


					}

				}

			});


		return o;
	})

	;

	return G.GabaritNavTab;


})(window,document,navigator).Init();
