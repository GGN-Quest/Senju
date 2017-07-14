/* GougnonJS.Windoo, version : 0.1, update : 150311#1444, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var api;

	if(!Gougnon.support('nightly 0.1')){
		alert('La version de GougnonJS n\'est pas compatible avec GAwake.Windoo 0.1 ');
		return false;
	}

	if(typeof GAwake!='function'){alert('Cette API a besoin de son API parente "GAwake" '); return false; }
	if(typeof GAwakeConfirm!='function'){alert('Cette API a besoin de son API parente "GAwakeConfirm" '); return false; }





	api=G.API({
		name:'AwakeWindoo'
		,static:{
			version:'0.1'
			,objects:[]
			,varsini:'width height title position'
			,evenini:'show lock close'

		}
		,constructor:function(){
			var o=this;
			o.static=G.AwakeWindoo;
			o.events=G.Event();
			o.args=arguments[0]||[];
			o.instance=o.args[0]||false;
			o.sheet=false;
			o.callBack={};
		}
	}).create();




	api.dynamic('init',function(){var o=this, args=arguments[0]||{};
		if(typeof o['instance']!='object'){return false;}
		o.name=o.instance.prop('id')|| ['GAwakeWindoo','Undefined',G(o.objects).KeyLength()].join('--');
		o.cfg={version:'0.1',cssSelectorName:'ggn-Awake-windoo-locker',locked:true};

		G.foreach(o.static.varsini.split(' '), function(v){o.cfg[v]=args[v]||false;});

		o.windoo=GAwake(o.instance).init(o.cfg);
		o.windoo.windooClass=o;

		o.static.objects[o.name]=o;
		return o;
	});



	api.dynamic('show',function(){var o=this,args=arguments;
		if(typeof o['windoo']!='object'){return o;}
		if(typeof o.windoo['show']!='function'){return o;}


			var t='',ttl=args[1]||o.cfg.title||'',cnt=args[0]||''
				,idf=[o.name,'form-box'].join('-')
				,idfc=[o.name,'form-content-box'].join('-')
				,idt=[o.name,'title-cell'].join('-')
				, idc=[o.name,'content-cell'].join('-')
				, idbc=[o.name,'button-closer'].join('-')
				;

					t+='<div class="bl gui flex column">';
						t+='<div class="blk header align-top">';
							t+='<div class="cell title" id="';
								t+=idt;
							t+='">';
								t+='<div class="closer" id="';
									t+=idbc;
								t+='">';
									t+='Fermer';
								t+='</div>';

								t+=ttl;

							t+='</div>';
						t+='</div>';

						t+='<div class="blk body container">';
							t+='<div class="cell content" id="';
									t+=idc;
								t+='">';
									t+=cnt;
							t+='</div>';
						t+='</div>';

					t+='</div>';


		o.windoo.content().html(t);

		o.form = G(['#',idf].join(''));
		o.formContent = G(['#',idfc].join(''));
		o.titleBox = G(['#',idt].join(''));
		o.contentBox = G(['#',idc].join(''));
		o.CloserBox = G(['#',idbc].join(''));

		o.CloserBox.click(function(){o.close();});

		o.windoo.event.add('show', function(){o.respectLayout();});
		GEvent(window).listen('resize', function(){o.respectLayout();});

		o.windoo.show();
		return o;
	});




	api.dynamic('respectLayout',function(){var o=this;
		var gh=o.windoo.content().offset().height,h=gh-o.titleBox.offset().height;h+='px';
		o.contentBox.css({height:h});
		return o;
	});




	api.dynamic('close',function(){var o=this;
		if(typeof o['windoo']!='object'){return o;}
		if(typeof o.windoo['close']!='function'){return o;}


		o.windoo.close();
		return o;
	});




	GAwake.Windoo = G.AwakeWindoo;



})(window,screen,navigator);