/* GougnonJS.Gabarit.SnowDark, version : 0.1, update : 160922#0006, Copyright GOBOU Y. Yannick 2016 */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec G.SnowDark 0.1 ');return false;}


	API=G.API({

		name:'SnowDark'

		,static:{
			
			version:'0.1 nightly, Fev 2017, 170228.1630'

		}

		,constructor:function(){
		
			var o=this;
		
				o.args = arguments[0]||[];
		
				o.Box = o.args[0]||[];
		
				o.event = G.Event(o);
		
		}

	}).create();


	API

		.static('Trigger', function(){
			
			var o = this;
				
				
			GAction('detecting:*[ggn-snowdark-datetime="format"]').assign(function(){

				var tag = this, val = tag.html().inner * 1000, date;

				if(isNaN(val)){tag.html('Not supported');}

				else{

					date = new Date(val);

					tag.html(date.fromFormat(tag.attrib('snowdark-date-format')||'d-m-Y'));

				}

			});


			GAction('detecting:*[ggn-snowdark-string="ucfirst"]').assign(function(){this.html((this.html().inner).ucfirst());});

			GAction('detecting:*[ggn-snowdark-string="ucwords"]').assign(function(){this.html((this.html().inner).ucwords());});

			GAction('detecting:*[ggn-snowdark-string="upper"]').assign(function(){this.html((this.html().inner).upper());});

			GAction('detecting:*[ggn-snowdark-string="lower"]').assign(function(){this.html((this.html().inner).lower());});


			GAction('detecting:[ggn-snowdark-text]').assign(function(){this.html(this.attrib('ggn-snowdark-text'));});



			if(GAction.Detecting.Status === false){ GAction.Detecting.Trigger(); }
				
			return o;

		})

	;

	
	GEvent(A).listen('load', function(){G.SnowDark.Trigger();});


})(window,document,navigator);