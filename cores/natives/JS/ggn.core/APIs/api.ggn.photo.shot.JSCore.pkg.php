/* GougnonJS.PhotoShot, version : 0.1, update : 170112.0029, Copyright GOBOU Y. Yannick 2015 */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GPhotoShot 0.1 ');return false;}


	API=G.API({

		name:'PhotoShot'

		,static:{
			
			version:'0.1 nightly, Jan 2017, 170112.0029'

			, Viewer : {

				version : '0.1'

				, Hote : false

				, Reg : []

				, Bx : false

				, Service : {

					Obj : false

					, State : function(){

						this.Obj = this.Obj||G.COM.Service('ggn.photoshot').Init({Title:'GGN PhotoShot',HideError:true});

						return this.Obj;

					}

				}

				, Build : function(){


					var o = this, Body=G('body'), H = o.Hote||Body.create({cn:'ggn-photoshot-viewer vw10 vh10 gui pos-fixed bg-dark'}), Bx = {};

					H.css({'z-index':'100', 'top':'0px', 'left':'0px'});

					Bx.Sheet = H.create({cn:'gui flex column w-inherit h-inherit'});

						Bx.Head = Bx.Sheet.create({cn:'gui flex row'});

							Bx.Closer = Bx.Head.create({cn:'closer h1 padding-x16 color-error-p gui flex center cursor-pointer'})

								.html('<span class="gui iconx">close</span>')

								.on('click', function(){o.Close(); })

							;

							Bx.Title = Bx.Head.create({cn:'title h1 padding-tb-x12 padding-lr-x16 color-light col-0 text-ellipsis'}).append('Album Photo');

							Bx.Tools = Bx.Head.create({cn:'tools align-right padding-x12 color-light-d gui flex row'});

								Bx.Prev = Bx.Tools.create({cn:'tool prev padding-lr-x8 cursor-pointer'}).html('<span class="gui iconx x32">arrow_back</span>');

								Bx.Next = Bx.Tools.create({cn:'tool next padding-lr-x8 cursor-pointer'}).html('<span class="gui iconx x32">arrow_forward</span>');


						Bx.Container = Bx.Sheet.create({cn:'container gui flex column start wrap disable-y-scrollbar enable-x-auto-scrollbar color-light col-0'}).html('');


					Bx.Details = H.create({cn:'details disable gui pos-absolute flex column w-inherit h-inherit bg-dark-d bg-abs-center bg-full-x-size sm-bg-full-y-size'}).css({'top':'0px','left':'0px'});

						Bx.DPrev = Bx.Details.create({cn:'browser prev gui pos-absolute padding-x16 cursor-pointer color-light gui-fx'}).html('<span class="gui iconx text-x26">arrow_back</span>');

						Bx.DNext = Bx.Details.create({cn:'browser next gui pos-absolute padding-x16 cursor-pointer color-light gui-fx'}).html('<span class="gui iconx text-x26">arrow_forward</span>');

						Bx.DCloser = Bx.Details.create({cn:'closer pos-absolute padding-x16 color-light gui-fx gui flex center cursor-pointer'})

							.html('<span class="gui iconx x32">close</span>')

							.on('click', function(){o.CloseDetails(); })

						;

						Bx.Infos = Bx.Details.create({cn:'infos gui pos-absolute _w10'}).css({'bottom':'0px','left':'0px'});

							Bx.DSpace = Bx.Infos.create({cn:'x64-h'}).html('&nbsp;');

							Bx.DTitle = Bx.Infos.create({cn:'title color-light h1 padding-t-x64 padding-lr-x16'});

							Bx.DAbout = Bx.Infos.create({cn:'about color-light-d text-x16 padding-b-x16 padding-lr-x16'});





					o.Overflow = {'x' : Body.css('overflow-x'), 'y' : Body.css('overflow-y') };

					G('body').css({'overflow-x' : 'hidden', 'overflow-y' : 'hidden'});

					GMouse(Bx.Container).wheel(function(ev){

						GEvent(ev).prevent(true).stop();

						Bx.Container.scrollLeft = Bx.Container.scrollLeft - (this._delta);

					});


					o.Bx = Bx;

					o.Hote = H;

					return o;

				}

				, ToastObj : false

				, Toast : function(txt){

					var o = this, txt=txt||'...';

					o.ToastObj = GToast({

						title : 'GGN.PhotoShot'

						, icon : 'image'

						, text : txt

						, delai : 3000

					});

					return o.ToastObj;

				}

				, Close : function(){

					var o = this,Bx=o.Bx;

					if(isObj(o.Hote||'')){ o.Hote.remove(); o.Hote = false; }

					if(isObj(o.Overflow||'')){

						G('body').css({'overflow-x' : o.Overflow.x, 'overflow-y' : o.Overflow.y});

					}

					return o;

				}

				, Clear : function(){

					var o = this,Bx=o.Bx;

					if(isObj(o.Bx.Sheet||'')){o.Bx.Sheet.remove();}

					return o;

				}

				, Load : function(key, pg){

					var o = this,Bx=o.Bx,key=key||false,pg=pg||0,u=G.domain;

					if(isObj(o.Hote) && isStr(key)){

						pg = (pg < 0) ? 0 : pg;

						var service = o.Service.State(), dat = 'ggn-registry-token-exception=';

							dat += o.Reg[0]; dat+='&ggn-registry-token-exception-key='; dat+=o.Reg[1]

							dat += '&open='; dat += key;

							dat += '&pg='; dat += pg;


						Bx.Container.html('<div class="gui loading circle x64"></div>').replaceClass('start', 'center');

						// o.Toast('Chargement...').wait();

						service.Open("viewer.data", {

							data : dat

							, success : function(obj){

								Bx.Container.html('').replaceClass('center', 'start');

								var res = obj.response||false, Data = obj.Data||{}, Images = Data.Images||[];

								o.Items(key, pg, Data);

							}

							, fail : function(){o.Toast('Echec lors du chargement...').warning(); }

							, error : function(){o.Toast('Erreur').error(); }

						});


					}

					else{

						o.Toast('Clé introuvable').error();

					}


					return o;

				}

				, Show : function(key, pg){

					var o = this,Jx;


					o.Clear().Build();

					if(isObj(o.Hote)){

						o.Load(key||false, pg||false);


						if('KeyShot' in G){

							try{

								var Esc = GKeyShot(function(){o.Close();}).key('ESCAPE');

								GEvent(G.DOC).listen('keypress', function(ev){Esc.detect(ev, false);},true);

							}
							catch(e){}

						}


					}

					else{

						o.Toast('Impossible d\'initialiser l\'élément HTML').error();

					}

					return o;

				}


				, Items : function(key, pg, Data){

					var o = this, Bx = o.Bx, key = key||false, pg=pg||0, Data=Data||false;

					if(isStr(key) && isObj(Data)){

						Bx.Next.on('click', function(){

							o.Load(key, pg+1);

						});

						Bx.Prev.on('click', function(){

							o.Load(key, pg-1);

						});

						if(Data.Images.length <= 0){

							o.Toast('Plus aucune photo').warning();

							o.Load(key, pg-1);

						}

						if(Data.Images.length > 0){

							G.foreach(Data.Images, function(image, k){

								var IT = Bx.Container.create({cn:'item gui bg-dark-d margin-x4 x256 pos-relative gui-fx cursor-pointer disable-scrollbar'}).attrib('tabindex', '0')

									, loader = IT.create({cn:'pos-absolute _w10 _h10 gui flex center'}).css({'top':'0px', 'left':'0px'}).html('<div class="gui loading circle x32"></div>')

									, item = IT.create({cn:'pos-absolute _w10 _h10 gui bg-abs-center bg-full-y-size'}).css({'top':'0px', 'left':'0px'})

									, shadow = IT.create({cn:'over-tag gui flex center gui-fx pos-absolute'}).css({'top':'0px', 'left':'0px'}).html('<div class="gui iconx x64 gui-fx"></div>')

									, bg = 'url(' 
								;

								bg += Data.URL;

								bg += image['src'];

								bg += '?mode=-gd&width=320&height=320&quality=-high&resize=true&resizeby=-height';

								bg += ')';


								item.css({'background-image' : bg});


								IT.on('click', function(){

									var u = Data.URL;

									u+=image['src'];

									o.Details({src : u, title : image['title'], about : image['about']}, k, Data);

								});

							});


						}
						

					}


				}



				, Details : function(detail, k, Data){

					var o = this, Bx = o.Bx,src='url(';

					Bx.Details.removeClass('disable');

						src+=detail['src'];

						src+=')';

					Bx.Details.css({'background-image':src});

					Bx.DTitle.html((detail['title']).ucfirst());

					Bx.DAbout.html((detail['about']).ucfirst());


					Bx.DNext.on('click', function(){

						var nk = k*1+1, image=Data.Images[nk]||false;

						if(image){

							var u = Data.URL;

							u+=image['src'];

							o.Details({src : u, title : image['title'], about : image['about']}, nk, Data);

						}

						else{

							o.Toast('Limite atteinte').info();

						}

					});

					Bx.DPrev.on('click', function(){

						var nk = k*1-1, image=Data.Images[nk]||false;

						if(image){

							var u = Data.URL;

							u+=image['src'];

							o.Details({src : u, title : image['title'], about : image['about']}, nk, Data);

						}

						else{

							o.Toast('Limite atteinte').info();

						}

					});


				}


				, CloseDetails : function(){

					var o = this, Bx = o.Bx;

					Bx.Details.addClass('disable');

				}


			}
			

		}

		,constructor:function(){
		
			var o=this;
		
				o.args = arguments[0]||[];
		
				o.Box = o.args[0]||[];
		
				o.event = G.Event(o);
		
		}

	}).create();


	API

		.static('Init', function(){

			var o=this;


			GScript.check('GCOMService', function(){

				GAction('handler:PhotoShot.Viewer').listen('click',function(e,ev){

					var gev= GEvent(ev);

					if(gev.isLeftClick()){

						gev.prevent(true);

						var key = e.attrib('photoshot-key')||false, title = e.attrib('photoshot-title')||false, viewer;

						viewer = o.Viewer.Show(key, 0);

						if(isStr(title)){

							viewer.Bx.Title.html(title);

						}

					}

				});

			});


			return o;
		})

	;

	return G.PhotoShot;


})(window,document,navigator).Init();
