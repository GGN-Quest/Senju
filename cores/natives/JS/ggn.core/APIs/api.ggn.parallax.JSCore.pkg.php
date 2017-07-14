/* GougnonJS.Gabarit.Parallax, version : 0.1, update : 160922#0006, Copyright GOBOU Y. Yannick 2016 */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GGabarit 0.1 ');return false;}


	API=G.API({

		name:'Parallax'

		,static:{
			
			version:'0.1 nightly, 170315.0928'

			, Scope : []

			// , Detector : []

			, Directives : 'toggle visible invisible before-visible after-visible desc-enter desc-leave asc-enter asc-leave'

			, aoin : false

			, aolv : false

		}

		,constructor:function(){
		
			var o=this;
		
				o.args = arguments[0]||[];
		
				o.Box = o.args[0]||[];
		
				o.event = G.Event(o);
		
		}

	}).create();


	API

		.static('Trigger', function(ev){
			
			var o = this, Dir = o.Directives.split(' ');


			if(Dir.length){

				G.foreach(Dir, function(dir){

					var at = 'ggn-parallax-'; at += dir;

					var att = 'detecting:*['; att += at; att += ']';


					GAction(att).assign(function(){

						var val = this.attrib(at);

						o.StateScroll(this, dir, val);

					});

				}, false, false, '.');

			}


			if(GAction.Detecting.Status === false){ GAction.Detecting.Trigger(); }


			G(function(){

				o.OnScroll(false);

				GEvent(window).listen('scroll', function(ev){o.OnScroll(ev);});
				
			}).timeout(1000);


			return o;

		})


		.static('OnScroll', function(ev){
			
			var o = this, scope = o.Scope, ev = ev||false;

			if(isObj(ev)){}

			G.foreach(scope, function(Func){Func(ev);}, false, false, G.F());

			return o;

		})


		.static('ToggleCn', function(e, Cne, Cnl){
			
			var o = this

				, e = e || false

				, Cne = Cne || false

				, Cnl = Cnl || false

			;

			if(isObj(e)){

				if(isStr(Cne)){e.addClass(Cne);}

				if(isStr(Cnl)){e.removeClass(Cnl);}

			}

			return o;

		})


		.static('StateScroll', function(El, dir, val){
			
			var o = this

				, scope = o.Scope

				, body = G.getDocElement()

			;


			if(dir == 'desc-leave'){

				o.Scope[scope.length] = function(ev){

					var Y = body.scrollTop

						, ofs = El.offset()

							, oY0 = ofs.top

							, oY1 = (ofs.top + ofs.height)

						, xval = val.split(':')

					;

					if(Y > oY1){

						o.ToggleCn(El, xval[0]||false, xval[1]||false);

						console.log('StateScroll ///', 'desc-leave', Y);

					}


				};


			}



			return o;

		})


	;



	
	GEvent(A).listen('load', function(ev){

		G.Parallax.Trigger(ev);

	});


})(window,document,navigator);