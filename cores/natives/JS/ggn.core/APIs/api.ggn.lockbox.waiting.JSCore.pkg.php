/* GougnonJS.Windoo, version : 0.1, update : 150311#1444, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var api;

	if(!Gougnon.support('nightly 0.1')){
		alert('La version de GougnonJS n\'est pas compatible avec GAwake.Waiting 0.1 ');
		return false;
	}

	if(typeof GAwake!='function'){
		alert('Cette API a besoin de son API parente "GAwake" ');
		return false;
	}





	api=G.API({
		name:'AwakeWaiting'
		,static:{
			version:'0.1'
			,objects:[]
			,varsini:'width height title label position'
			,evenini:'show lock close'

		}
		,constructor:function(){
			var o=this;
			o.static=G.AwakeWaiting;
			o.events=G.Event();
			o.args=arguments[0]||[];
			o.instance=o.args[0]||false;
			o.sheet=false;
			o.callBack={};
		}
	}).create();




	api.dynamic('init',function(){var o=this, args=arguments[0]||{};
		if(typeof o['instance']!='object'){return false;}
		o.name=o.instance.prop('id')|| ['GAwakeWaiting','Undefined',G(o.objects).KeyLength()].join('--');
		o.cfg={version:'0.1',cssSelectorName:'ggn-Awake-waiting-locker',locked:true};

		G.foreach(o.static.varsini.split(' '), function(v){o.cfg[v]=args[v]||false;});

		o.locker=GAwake(o.instance).init(o.cfg);
		o.locker.waintingClass=o;

		o.static.objects[o.name]=o;

		o.buttons=false;
		return o;
	});



	api.dynamic('show',function(){var o=this,args=arguments;
		if(typeof o['locker']!='object'){return o;}
		if(typeof o.locker['show']!='function'){return o;}

			var t='',ttl=args[0]||(o.cfg.title||'Chargement')
				,cnt=args[1]||['<div class="waiting"><div class="loading circle x32"></div><div class="label">',(o.cfg.label||'Patientez...'),'</div></div>'].join('')
				,btn=args[2]||{ok:{label:'ok',click:G.F(),focus:true}}
				,idf=[o.name,'form-box'].join('-')
				,idfc=[o.name,'form-content-box'].join('-')
				,idt=[o.name,'title-cell'].join('-')
				, idc=[o.name,'content-cell'].join('-')
				;

				t+='<div class="bl gui flex column">';

					if(o.cfg.height>=100){
						t+='<div class="blk align-top">';
							t+='<div class="cell title" id="';
								t+=idt;
							t+='">';
								t+=ttl;
							t+='</div>';
						t+='</div>';
					}


					t+='<div class="blk container">';
						t+='<div class="cell content" id="';
								t+=idc;
							t+='">';
								t+=cnt;
						t+='</div>';
					t+='</div>';

					t+='</div>';
				t+='</div>';


		o.locker.content().html(t);

		o.form = G(['#',idf].join(''));
		o.formContent = G(['#',idfc].join(''));
		o.titleBox = G(['#',idt].join(''));
		o.contentBox = G(['#',idc].join(''));

		o.locker.show();

		return o;
	});




	api.dynamic('close',function(){var o=this;
		if(typeof o['locker']!='object'){return o;}
		if(typeof o.locker['close']!='function'){return o;}
		o.locker.close();
		return o;
	});




	GAwake.Waiting = G.AwakeWaiting;



})(window,screen,navigator);