/* GougnonJS.Live, version : 0.1, update : 151202#1307, Copyright GOBOU Y. Yannick 2015 */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GLive 0.1 ');return false;}


	API=G.API({

		name:'Live'

		,static:{

			version:'0.1 nightly 151202.1307'

			,REC:false

			,isReady:false

			,Working:false

			,_StandBy:false


			,_R:[]

				,_RCBS:[]

				,_RCBW:[]

				,_RCBF:[]

				,_RCBE:[]

				,_RCBL:[]

				,_RCBLE:[]


			,_iR:[]

			,Service:{

				Name:'ggn.live.exchange'

				,Title:'GGN Live Exchange'

				,Object:false

			}

			,instance:function(){var i=this.Service; return i.Object||G.COM.Service(i.Name).Init({Title:i.Title});}

			,Config:{

				key:false

				,timer:3000

				,data:false

				,wait:G.F()

				,success:G.F()

				,fail:G.F()

				,error:G.F()

				// ,ResetRequest:true

			}

			,Ready:function(f){

				var o=this;

				GScript.check(function(){return o.isReady===true?true:undefined;}, function(){ f(o); });

			}


			,Receive:false

			,D:function(a){

				var r=[];

				if(isObject(a||'')){

					G.foreach(a,function(v,n){r[r.length]=[n,v.toString().escape()].join('=');},false,false,'.');

				}

				return r;

			}

			,_BuildRequest:function(a){

				var r=[],o=this,cfg=o.Config;

				if(isString(cfg.Data||false)){r[0] = cfg.Data;}

				if(isObject(o._iR||'')){r[r.length] = o.D(o._iR).join('&');}

				if(isObject(o._R||'')){r[r.length] = o.D(o._R).join('&');}

				return r;

			}

			,Request:function(n,d,cbw,cbs,cbf,cbe,cbl,cble){

				var o=this;

				o._R[n] = d || false;

				o._RCBW[n] = cbw || false;

				o._RCBS[n] = cbs || false;

				o._RCBF[n] = cbf || false;

				o._RCBE[n] = cbe || false;

				o._RCBL[n] = cbl || false;

				o._RCBLE[n] = cble || false;

			}

			,iRequest:function(n,d){

				var o=this;

					o._iR[n] = d;

			}

			,ResetAttempt:function(){

				var o=this;

				if(!isNaN(o.LoopTimer||false)){G(o.LoopTimer).clearOut();}

				if(isObject(o.Handler||false)){o.Handler.ajax.xhr.abort();}

				// if(o.Working==true){return false;}

				// if(o.Handler.ajax.working==true){return false;}

				o.Send();

				return o;

			}

			,ResetRequests:function(){

				var o=this;

				o._R=[];

				o._RCBW =  [];

				o._RCBS =  [];

				o._RCBF =  [];

				o._RCBE = [];

				o._RCBL =  [];

				o._RCBLE =  [];

				return o;

			}

			,ResetIRequests:function(){

				var o=this;

				o._iR=[];

				return o;

			}

			,StandBy:function(){

				var o=this;

				o._StandBy = true;

				return o;

			}

			,_Loop:function(){

				var o=this,cfg=o.Config;

				window.requestAnimationFrame(function(){

					o.LoopTimer = G(function(){o.Send();}).timeout(cfg.Timer||5000);

				});

			}

			,Send:function(){

				var o=this, r=o._BuildRequest(), h=o.instance(),cfg=o.Config;

				o.Working=true;


				if(isString(cfg.Key||false) && o._StandBy===false){

					h.Open(cfg.Key, {

						data:r.join('&')

						,wait:function(){

							o.event.detect('wait',[o]);

							if(isObj(o._RCBW||'')){G.foreach(o._RCBW, function(fc){fc(o);},false,false,G.F());}

							if(isFunction(cfg.Wait||false)){cfg.Wait(o);}

						}

						,success:function(obj,ev){

							var res=obj.response;

							if(res==true){

								o.event.detect('receive',[obj,o,ev]);

								if(isObj(o._RCBS||'')){G.foreach(o._RCBS, function(fc){fc(obj,o,ev);},false,false,G.F());}

								if(isFunc(o.Receive||'')){o.Receive(obj,ev);}

								o.Working=false;

							}

							else{}

						}

						,fail:function(ev){

							o.event.detect('fail',[o]);

							if(isObj(o._RCBF||'')){G.foreach(o._RCBF, function(fc){fc(o,ev);},false,false,G.F());}

							if(isFunction(cfg.Fail||false)){cfg.Fail(o,ev);}

						}

						,load:function(ev){

							o.event.detect('load',[o]);

							if(isObj(o._RCBL||'')){G.foreach(o._RCBL, function(fc){fc(o,ev);},false,false,G.F());}

							if(isFunction(cfg.Load||false)){cfg.Load(o,ev);}

						}

						,loadend:function(ev){

							o.event.detect('loadend',[o]);

							if(isObj(o._RCBLE||'')){G.foreach(o._RCBLE, function(fc){fc(o,ev);},false,false,G.F());}

							if(isFunction(cfg.Loadend||false)){cfg.Loadend(o,ev);}

							o._Loop();

						}

						,error:function(ev){

							o.event.detect('error',[o]);

							if(isObj(o._RCBE||'')){G.foreach(o._RCBE, function(fc){fc(o,ev);},false,false,G.F());}

							if(isFunction(cfg.Error||false)){cfg.Error(o,ev);}

						}


					});


					o.Handler = h;

				}

				else{

					o._Loop();

				}


			}


		}


		,constructor:function(){

			var o=this;

			o.Stc = o.STATIC;

			o.Stc.event = o.Stc.event || G.Event(o);

			if(isObject(o.ARGS[0]||'')){

				G.foreach(o.ARGS[0], function(c,n){

					if(isStr(n)){

						o.Stc.Config[n.ucfirst()] = typeof c=='undefined'?false:c;

					}

				});

			}



		}


	}).create();



	API.static('Initialize', function(){

		var o=this;

			o.event = G.Event(o);


		G(function(){

			GScript.check("GCOMService",function(){

				o.isReady=true;

				o.Send();

			});

		}).timeout(1962);


	})

	;


	return GLive;

})(window,screen,navigator).Initialize();

