/* GougnonJS.Application.Initialize, version : 0.1, update : 150428#1459, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GApps 0.1 '); return false; }

	API=G.API({
		name:'Apps'
		,static:{
			version:'0.1'
			,events:''
			,varsinit:''
			,Mounted:[]
			,Element:{
				Sheet:false
				,NavBar:false
				,StatusBar:false
				,SplashScreen:false
				,Main:false
			}
		}
		,constructor:function(){
			var o=this;
			o.static=G.Apps;
			o.args=arguments[0]||[];
			o.instance=o.args[0]||false;
			o.event=G.Event(o);
			o.callBack={};
		}
	}).create();


	
	API.static('GetAppURL', function(){
		var s=G.DOC.location.href.split('?')[0]
			,s1=s.split('/') ,so, r=[],rs='';

		for(x=0; x<s1.length; x++){
			if(!s1[x].isEmpty()){
				r[r.length]=s1[x];
			}
		}

		rs=r.join('/').replace('http:/', 'http://');
		so=rs.substr(-1);

		if(so=='#'){return rs.substr(0,rs.length-1);}
		else{return rs;}
	});

	API.static('InitializeElementObjects', function(){var o=this;
		o.Element.Sheet = G('#gapps-sheet');
		o.Element.NavBar = G('#gapps-nav-bar');
		o.Element.StatusBar = G('#gapps-status-bar');
		o.Element.SplashScreen = G('#gapps-splash-screen');
		o.Element.Main = G('#gapps-body-main');
		return o;
	});

	API.static('Initialize', function(){var o=this;
		return o.InitializeElementObjects();
	});




	return G.Apps;
})(window,screen,navigator).Initialize();