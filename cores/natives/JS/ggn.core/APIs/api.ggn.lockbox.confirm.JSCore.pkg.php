/* GougnonJS.Windoo, version : 0.1, update : 150311#1444, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var api;

	if(!Gougnon.support('nightly 0.1')){
		alert('La version de GougnonJS n\'est pas compatible avec GAwake.Confirm 0.1 ');
		return false;
	}

	if(typeof GAwake!='function'){
		alert('Cette API a besoin de son API parente "GAwake" ');
		return false;
	}



	api=G.API({
		name:'AwakeConfirm'
		,static:{
			version:'0.1'
			,objects:[]
			,varsini:'width height position'
			,evenini:'show lock close'

		}
		,constructor:function(){
			var o=this;
			o.static=G.AwakeConfirm;
			o.events=G.Event();
			o.args=arguments[0]||[];
			o.instance=o.args[0]||false;
			o.sheet=false;
			o.callBack={};
		}
	}).create();


	api.dynamic('init',function(){var o=this, args=arguments[0]||{};
		if(typeof o['instance']!='object'){return false;}

		o.name=['GAwakeConfirm','instance', o.static.objects.length].join('--');

		o.cfg={version:'0.1',cssSelectorName:'ggn-Awake-confirm-locker',locked:true};

		G.foreach(o.static.varsini.split(' '), function(v){o.cfg[v]=args[v]||false;});

		o.locker=GAwake(o.instance).init(o.cfg);
		o.locker.confirmClass=o;

		o.static.objects[o.name]=o;
		o.buttons=false;
		return o;
	});



	api.dynamic('message',function(){var o=this,args=arguments;
		if(typeof o['locker']!='object'){return o;}
		if(typeof o.locker['show']!='function'){return o;}

			var t='',ttl=args[0]||o.cfg.title||'Attention',cnt=args[1]||'',btn=args[2]||{ok:{label:'ok',click:G.F(),focus:true}}
				,idf=[o.name,'form-box'].join('-')
				,idfc=[o.name,'form-content-box'].join('-')
				,idt=[o.name,'title-cell'].join('-')
				, idc=[o.name,'content-cell'].join('-')
				, idbp=[o.name,'buttons-parent'].join('-')
				, idbs=[o.name,'buttons-cell'].join('-')

				,cID=[]
				,cidr=0
				;

				t+='<form method="post" id="';
					t+=idf;
				t+='" action="#" onSubmit="return (function(f){return false})(this);">';
					t+='<div class="bl gui flex column">';
						t+='<div class="blk align-top">';
							t+='<div class="cell title" id="';
								t+=idt;
							t+='">';
								t+=ttl;
							t+='</div>';
						t+='</div>';

						t+='<div class="blk container">';
							t+='<div class="cell content" id="';
									t+=idc;
								t+='">';
									t+=cnt;
							t+='</div>';
						t+='</div>';

						t+='<div class="blk align-bottom" id="';
							t+=idbp;
						t+='" >';

							t+='<div class="cell buttons" id="';
								t+=idbs;
								t+='">';


								if(typeof btn!='object'){
									cID['ok'] = {id:[idbs,'button','Ok'].join('-'), label:'Ok' ,click:G.F(), focus:true};
									t+='<div class="button" id="';		
										t+=cID[n].id;
									t+='">';
										t+=cID[n].label;
									t+='</div>';
									cidr++;
								}

								if(typeof btn=='object'){
									G.foreach(btn,function(v,n){
										if(typeof v!='object'){return false;}

										var nm=n.toString().lower();
										if(typeof v!='object'){return false;}
										var lbl=v['label']||'undefined';

										cID[n] = {id:[idbs,'button',n].join('-'), label:lbl, click:v['click']||G.F(), focus:v['focus']||false};

											if(nm=='submit'){
												t+='<input type="submit" class="button" id="';		
													t+=cID[n].id;
												t+='" value="';
													t+=lbl.addSlashes();
												t+='" />';
											}

											else{
												t+='<input type="button" class="button" id="';		
													t+=cID[n].id;
												t+='" value="';
													t+=lbl.addSlashes();
												t+='" />';
											}

										cidr++;
									});				
								}

							t+='</div>';
						t+='</div>';
					t+='</div>';
				t+='</form>';


		o.locker.content().html(t);

		o.form = G(['#',idf].join(''));
		o.formContent = G(['#',idfc].join(''));
		o.titleBox = G(['#',idt].join(''));
		o.contentBox = G(['#',idc].join(''));
		o.buttonsPBox = G(['#',idbp].join(''));
		o.buttonsBox = G(['#',idbs].join(''));

		o.locker.show();


		o.buttons={};
		var wcidr=Math.round(100/cidr);

		if(cidr>0){
			G.foreach(cID,function(v,n){
				var e = G(['#',v.id].join(''));
					if(typeof e!='object'){return false;}

					e.css({width:[wcidr,'%'].join('')});
					e.click(function(evt){
						if(typeof v.click=='function'){if(v.click(evt,o)===false){return false;}}
						o.close();
					});

					if(typeof v.focus=='boolean'){if(v.focus==true){e.addClass('active'); e.element.focus(); e.blur(function(){e.removeClass('active'); }); }}

				o.buttons[n]=e;
			});
		}

		return o;
	});

	api.dynamic('close',function(){var o=this;
		if(typeof o['locker']!='object'){return o;}
		if(typeof o.locker['close']!='function'){return o;}
		o.locker.close();
		return o;
	});




	GAwake.Confirm = G.AwakeConfirm;



})(window,screen,navigator);