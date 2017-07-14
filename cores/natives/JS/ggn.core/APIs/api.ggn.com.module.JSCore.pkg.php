/* GougnonJS.COM.Module, version : 0.1, update : 150428#1459, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var API;

if(!Gougnon.support('nightly 0.1.150527')){alert('La version de GougnonJS n\'est pas compatible avec COMModule 0.1.150527'); return false; }

if(!isFunction(G.COM||null)){GScript.package('ggn.com.initialize');}

GScript.check('G.COM', function(){

	API=G.API({
		name:'COMModule'
		,static:{
			version:'0.1'
			,Pkg:'ggn.com.module'
			,Host:'<?php echo HTTP_HOST; ?>com.modules/'
			,LoadVars:'handler load'
			,LoadEvents:'load'
		}
		,constructor:function(){
			var o=this;
			o.static=G.COMModule;
			o.args=arguments[0]||[];
			o.name=o.args[0]||false;
			o.event=G.Event(o);
		}
	}).create();

	

	API.dynamic('Load', function(pkg){var o=this;
		o.pkgName = [o.static.Pkg,".",o.name].join('');
		G.foreach(o.static.LoadVars.split(' '), function(v){o[v]=pkg[v]||false;},false,false,'.');
		G.foreach(o.static.LoadEvents.split(' '), function(v){var n=['On',v.ucfirst()].join('');o[n]=pkg[v]||G.F();},false,false,'.');

		GScript.package(o.pkgName);
		GScript.check(o.handler, function(){
			if(isFunction(o.OnLoad||null)){o.OnLoad();}
		});

		return o;
	});


	GCOM.Module = G.COMModule;
});


})(window,screen,navigator);