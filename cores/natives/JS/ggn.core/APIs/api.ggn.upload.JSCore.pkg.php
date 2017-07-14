/* GougnonJS.Windoo, version : 0.1, update : 140519#1820, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var api;

	if(!Gougnon.support('nightly 0.1')){
		alert('La version de GougnonJS n\'est pas compatible avec GAwake.Confirm 0.1 ');
		return false;
	}

	if(typeof GAwake!='function'){
		alert('Cette API a besoin de son API parente "GAwake" ');
		return false;
	}



	GAwake.Confirm = G.merge({}, {version:'0.1'});
	GAwake.Confirm = function(){return this;};



	api=G.API({
		name:'AwakeConfirm'
		,static:{
			version:'0.1'
			,objects:[]
			,varsini:'width height'
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
		o.name=o.instance.prop('id')|| ['GAwakeConfirm','Undefined',G(o.objects).KeyLength()].join('--');
		o.cfg={version:'0.1',cssSelectorName:'AwakeConfirm',locked:true};

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

			var t='',ttl=args[0]||'Attention',cnt=args[1]||'',btn=args[2]||{ok:{label:'ok',click:G.F(),focus:true}}
				,idt=[o.name,'title-cell'].join('--')
				, idc=[o.name,'content-cell'].join('--')
				, idbs=[o.name,'buttons-cell'].join('--')

				,cID=[]
				,cidr=0
				;

				t+='<div class="blk">';
					t+='<div class="cell title" id="';
						t+=idt;
					t+='">';
						t+=ttl;
					t+='</div>';
				t+='</div>';

				t+='<div class="blk">';
					t+='<div class="cell content" id="';
							t+=idc;
						t+='">';
							t+=cnt;
					t+='</div>';
				t+='</div>';

				t+='<div class="blk">';
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
								t+='<button class="button" id="';		
									t+=cID[n].id;
								t+='">';
									t+=lbl;
								t+='</button>';
								cidr++;
							});				
						}

					t+='</div>';
				t+='</div>';


		o.locker.content().html(t);
		o.titleBox = G(['#',idt].join(''));
		o.contentBox = G(['#',idc].join(''));
		o.buttonsBox = G(['#',idbs].join(''));

		o.locker.show();


		o.buttons={};
		var wcidr=Math.round(100/cidr);
		G.foreach(cID,function(v,n){
			var e = G(['#',v.id].join(''));
				if(typeof e!='object'){return false;}

				e.css({width:[wcidr,'%'].join('')});
				e.click(function(evt){
					if(typeof v.click=='function'){v.click(evt);}
					o.close();
				});

				if(typeof v.focus=='boolean'){if(v.focus==true){e.addClass('focus'); e.element.focus(); e.blur(function(){e.removeClass('focus'); }); }}

			o.buttons[n]=e;
		});



		return o;
	});




	api.dynamic('close',function(){var o=this;
		if(typeof o['locker']!='object'){return o;}
		if(typeof o.locker['close']!='function'){return o;}
		o.locker.close();
		return o;
	});





})(window,screen,navigator);