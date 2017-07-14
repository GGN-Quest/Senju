/* GougnonJS.COM.Initialize, version : 0.1, update : 150428#1459, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec COM 0.1 '); return false; }

	API=G.API({
		name:'COM'
		,static:{
			version:'0.1'
			,Module:false
			,Service:false
		}
		,constructor:function(){
			var o=this;
			o.static=G.COM;
			o.args=arguments[0]||[];
			o.instance=o.args[0]||false;
			o.event=G.Event(o);
		}
	}).create();


	
	API.static('Initialize', function(){var o=this;
		
		return o;
	});




	return G.COM;
})(window,screen,navigator).Initialize();