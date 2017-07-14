/*
	GGN Awake Confirm
	Gougnon.Awake.Confirm
		, version : 0.1
		, update : 150219.1139
	Copyright GOBOU Y. Yannick 2016
*/
(function(G,gAPI){

	var api = gAPI({
		
		name:'AwakeConfirm'

		, static : {

			version:'0.1'

			, Objects : []

		}

		, constructor : function(){

			var o = this;

			o.Stc = o.STATIC;

			o.K = o.Stc.Objects.len();

			o.text = (o.ARGS[0]||false);

			o.cfg = G(o.ARGS[1]||false);

			o.btns = G(o.ARGS[2]||false);

			o._btns = {OK:{label:"Ok",click:G.F(),focus:true}};


			o.cfg.hote = isObject(o.cfg.hote) ? o.cfg.hote : G('body');

			o.cfg.depth = o.cfg.depth || 'blur';

			o.bx = {};

			o._iEl()._buttons();


			o.awk = GAwake(
				o.bx.p
				, o.cfg
			);


			o.Stc.Objects[o.K] = o;

		}


	}).create();
	

	api

		.dynamic('_iEl', function(ar){

			var o = this,bx=o.bx||{};


			bx.lform = bx.lform || o.cfg.hote.create({tag:'form'})

				.attrib('action','#')

				.attrib('method','POST')

				.on('submit',function(){return false;})

			;

			bx.p = bx.p || bx.lform.create({tag:'form',cn:'awk-confirm gui flex full column bg-dark text-center'});

				bx.ttl = bx.ttl || bx.p.create({cn:'title text-center text-x16 padding-tb-x12 padding-lr-x16 gui-fx text-ellipsis'});

				bx.ctn = bx.ctn || bx.p.create({cn:'content disable-scrollbar enable-y-auto-scrollbar color-light text-left'});

				bx.btn = bx.btn || bx.p.create({cn:'buttons gui flex row'});


				if(isStr(o.text)){

					bx.btn.html(o.text);

				}

			bx.btns = [];

			o.bx = bx;

			return o;

		})

		.dynamic('_buttons', function(btns,md){

			var o = this,bx = o.bx,btns=btns||o._btns||false,md=md||false;

			if(md===false){

				bx.btn.html('');			

			}

			if(isObject(btns)){

				var lf = false, gde = G.getDocElement();

				bx.lform.focus();

				G.foreach(btns,function(b,n){

					var i = 'ggn-awake-confirm-', bt;

						i+=o.K;

						i+='-buttons-item-';

						i+=n;

					bt = bx.btn.create({tag:'button',cn:'button color-light cursor-pointer',id:i})

						.attrib('type', ((b.focus) ? 'submit' : 'button') )

						.html(b.label||'')

					;



						bt.on('click',function(ev){

							if(isFunc(b.click||'')){

								if(b.click(ev,o)===false){return false;}

							}
								
							o.awk.close();

							return false;

						});

						if(isBool(b.focus||'')){
 
 							if(b.focus===true){

 								if(isObj(lf)){

 									lf.removeClass('active');

 									lf.attrib('type', 'button');

 								}



 								bt._focus();

 								bt.addClass('active');

 								bt.on('blur', function(){bt.removeClass('active');});

 								lf = bt;

 							}

						}


					bx.btns[n] = bt;
						
				},false,false,{});

			}


			return o;

		})

		.dynamic('message', function(t,c,b){

			var o = this,bx = o.bx,t=t||false,c=c||false,b=b||false;

			if(isString(t)){bx.ttl.html(t);}

			if(isObj(t)){bx.ttl.append(t);}


			if(isString(c)){bx.ctn.html(c); }

			if(isObj(c)){bx.ctn.append(c); }


			if(isObj(b)){o._buttons(b);}

			o.awk.show();

			return o;

		})

	;


})(G,GAPI);

