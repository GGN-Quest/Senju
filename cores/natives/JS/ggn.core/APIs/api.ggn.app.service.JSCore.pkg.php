<?php global $GLANG; ?>/* GougnonJS.AppService, version : 0.1, update : 161110#0838, Copyright GOBOU Y. Yannick 2015 */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GAppService 0.1 ');return false;}


	if(!G['UI']){GScript.package('ggn.ui');}


	API=G.API({

		name:'AppService'

		,static:{
			
			version:'0.1 nightly, 170530.1034'

		}

		,constructor:function(){
		
			var o=this;
		
			o.args = arguments[0]||[];

			o.Name = o.args[0] || false;

			o.Token = o.args[1] || '';

			o.Host = o.args[2] || G.domain || "<?php echo HTTP_HOST; ?>";
	
			o.event = G.Event(o);
		
		}

	}).create();


	API

		.dynamic('Open', function(method, data, cfg){

			var o = this, jx, uri = o.Host, data = (isStr(data||false)) ? data : null

				, cfg = cfg || false

				, method = method || ''

			;


			cfg.success = (isFunction(cfg.success||'') ? cfg.success : G.F());

			cfg.loadend = (isFunction(cfg.loadend||'') ? cfg.loadend : G.F());

			cfg.fail = (isFunction(cfg.fail||'') ? cfg.fail : (function(){GToast('Impossible de retrouver la page demandée').warning();}) );

			cfg.error = (isFunction(cfg.error||'') ? cfg.error : (function(){GToast('Erreur lors la tentative de connexion').error();}) );


			uri += '/app/';

			uri += o.Name;

			uri += '/';

			uri += method;

			uri += '?gapp-token=';

			uri += o.Token;



			jx = GAjax({

				URI : uri

				, mode : 'POST'

				, headers : {

					'X-Requested-Width' : 'XMLHttpRequest'

					, 'X-Requested-Gapp' : 'App.Service.Methods'

				}

				, data : data

				, success : function(){

					// console.log('xHR', this.xhr.responseText)

					try{

						var json = JSON.parse(this.xhr.responseText);

						if(isObj(json)){cfg.success(json, this, o);}

						else{cfg.error('ExSrv.CntNSupp', this, o);}

					}

					catch($e){cfg.error('ExSrv.AppCnt', this, o);}

				}

				, fail : function(){cfg.fail(false, this, o);}

				, error : function(){cfg.error(false, this, o);}

				, loadend : function(){cfg.loadend(false, this, o);}

			})

				.XHR()

				.send()

			;


		})

		.static('Init', function(){



		})

	;


	return GAppService;

})(window,document,navigator).Init();
