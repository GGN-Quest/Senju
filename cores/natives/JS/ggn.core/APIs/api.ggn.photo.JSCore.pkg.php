/* GougnonJS.Photo, version : 0.1, update : 160408#1106, Copyright GOBOU Y. Yannick 2015 */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GPhoto 0.1 ');return false;}

	
	if(!G['COM']){GScript.package('ggn.com');}


GScript.check('GCOM', function(){

	API=G.API({

		name:'Photo'
		
		,static:{

			version:'0.1 nightly, Avril 2016, 160419.1753'

			, Viewer : undefined

			, Service : {

				Name : 'ggn.photo'

				, Title : 'GGN Photo'

				, Obj : false

				, Init : function(){return this.Obj||GCOMService(this.Name).Init({Title:this.Title});}

			}

			, Filter : function(C){

				var C = C||{}, ret='',p=[];

				C.mode = C.mode||'-gd';


				if(typeof C['resize'] == 'undefined'){

					C.resize = true;
					
					C.resizeby = C.resizeby||'0';

				}

				// C.rogner = C.rogner||'0';

				// C.scale = C.scale||'100';

				C.quality = C.quality||'-high';

				G.foreach(C,function(v,k){

					if(k=='resize' && v != true){return false;}

					var vp = k;

						vp+='=';

						vp+=v;

					p[p.length] = vp;

				});

				ret += p.join('&');

				return ret;

			}

			, Legend : function(en,txt){

				var o=this, _o={};

				_o.service = o.Service.Init();

				_o.entity = en||false;

				_o.text = txt||false;


				_o.Change = function(){

					var _o=this,h,dat='entity=',toast;

					dat+=encodeURIComponent(_o.entity||'');

					dat+='&data=';dat+=escape(_o.text||'');


					toast = GToast({

						title : 'Légende de photo'

						, text : 'Enregistrement en cours...'

						, delay : 3000

					}).wait();


					h = _o.service.Open('legend', {

						data : dat

						,success : function(rec){

							toast.close();

							var t = rec.treat||false;

							if(isObj(t)){

								var res = t.set || false;

								if(res == true ) {

									toast.success()._text('Enregistré avec succès'); 

									return false; 													

								} 

							}

							toast.close().warning()._text('Echec');

						}

						, fail : function(){

							toast.close().warning()._text('Echec');

						}

						, error : function(){

							toast.close().error()._text('Erreur');

						}


					});


					return _o;

				};

				return _o;

			}
			
		}

		,constructor:function(){
		
			var o=this;

			o.Stc = o.STATIC;

			o.event = G(o);

		}

	})

		.create()


	;





	// };



});



})(window,document,navigator);
