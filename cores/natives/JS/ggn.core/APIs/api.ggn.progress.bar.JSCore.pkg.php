/*
	GougnonJS.Progress.Bar,
	version : 0.1 	
	update : 150323.1618
	Copyright 2014 GOBOU Y. Yannick
*/
(function(A,P,I){var API;if(!Gougnon.support('nightly 0.1,update 141211.1448')){alert('La version de GougnonJS n\'est pas compatible avec Progress.Bar 0.1 <Gougnon.JS.Framework/0.1,update 141211.1448>');return false;}API=G.API({name:'ProgressBar',static:{version:'0.1',versionUpdate:'150323.1618',APCs:{},events:'play inc dec pause stop wait done seek seeker seekend cache cacheend cachedone work workend workdone',varsinit:'min max timeline value row activeSeek animation cacheAnimation workAnimation size'}

	,constructor:function(){

		var o=this;o.static=G.ProgressBar;

		o.args=arguments[0]||[];

		o.instance=o.args[0]||false;

		o.hote=G(o.instance)||false;

		o.event=G.Event();

		o.callBack={};o.APC={};

	}})


.create();

API.dynamic('_work',function(){var o=this,l=arguments[0]||0;if(typeof (l*1)==='number'){l=(l<=0)?0:((l>100)?100:l);var p=l;p+='%',anim=(o.workAnimation===false)?false:(o.workAnimation||o.animation||false);if(anim===true){}else{o.workBar.css({width:p});}o.workValue=l;o.event.detect('work',[o]);if(typeof o.onWork=='function'){o.onWork(l);}o._workdone();}});

API.dynamic('_workdone',function(){var o=this,l=arguments[0]||0;if(o.workValue>=100){o.event.detect('workdone',[o]);if(typeof o.onWorkdone=='function'){o.onWorkdone(l);}}});

API.dynamic('work',function(){var o=this,l=arguments[0]||0;if(typeof (l*1)==='number'){l=(l<=0)?0:((l>100)?100:l);var anim=(o.workAnimation===false)?false:(o.workAnimation||o.animation||false);if(anim===true){var ann='';ann+=o.workValue;ann+='->';ann+=l;ann+=':%'; o.APC['Work.Bar']=o.workBar.animation({width:{value:ann ,hit:function(){},done: function(){o._work(l);if(this.level<100){o.event.detect('workend',[o]);if(typeof o.onWorkend=='function'){o.onWorkend(l);}}}}},{timeline:o.timeline});}else{o._work(l);o.event.detect('workend',[o]);if(typeof o.onWorkend=='function'){o.onWorkend(l);}}}});

API.dynamic('_cache',function(){var o=this,l=arguments[0]||0;if(typeof (l*1)==='number'){l=(l<=0)?0:((l>100)?100:l);var p=l;p+='%',anim=(o.cacheAnimation===false)?false:(o.cacheAnimation||o.animation||false);if(anim===true){}else{o.cacheBar.css({width:p});}o.cacheValue=l;o.event.detect('cache',[o]);if(typeof o.onCache=='function'){o.onCache(l);}o._cachedone();}});

API.dynamic('_cachedone',function(){var o=this,l=arguments[0]||0;if(o.cacheValue>=100){o.event.detect('cachedone',[o]);if(typeof o.onCachedone=='function'){o.onCachedone(l);}}});

API.dynamic('cache',function(){var o=this,l=arguments[0]||0;if(typeof (l*1)==='number'){l=(l<=0)?0:((l>100)?100:l);var anim=(o.cacheAnimation===false)?false:(o.cacheAnimation||o.animation||false);if(anim===true){var ann='';ann+=o.cacheValue;ann+='->';ann+=l;ann+=':%'; o.APC['Cache.Bar']=o.cacheBar.animation({width:{value:ann ,hit:function(){var ll=this.level;} ,done: function(){o._cache(l); if(this.level<100){o.event.detect('cacheend',[o]); if(typeof o.onCacheend=='function'){o.onCacheend(l);} } } }},{timeline:o.timeline});}else{o._cache(l);o.event.detect('cacheend',[o]);if(typeof o.onCacheend=='function'){o.onCacheend(l);}}}});

API.dynamic('activeSeekValue',function(evt){var o=this;var e=G(evt).source(),m=GMouse(evt).position(),nd=GScreen(e).coordinate(),l=0;l=G(Math.abs(m.x-nd.x)).purcent(o.hote.Offset().width)*1;l=(isNaN(l))?null:Math.round(l);return l;});

API.dynamic('_activeSeek',function(){var o=this;if(o.activeSeek===true){var Ev=GEvent(o.hote);o.hote.css({cursor:'pointer'});Ev.listen('mouseup',function(evt){var l=o.activeSeekValue(evt);o.event.detect('seeker',[o,l]);if(typeof o.onSeeker=='function'){o.onSeeker(l);}});}});

API.dynamic('box',function(){return this.hote||false;});

API.dynamic('levelBox',function(){return this.pureBar||false;});

API.dynamic('cacheBox',function(){return this.cacheBar||false;});

API.dynamic('textBox',function(){return this.textBar||false;});

API.dynamic('workBox',function(){return this.workBar||false;});

API.dynamic('getBar',function(){var o=this,p=arguments[0]||false;if(p=='Work.Bar'){return o['workBar'];}if(p=='Cache.Bar'){return o['cacheBar'];}else{return o['pureBar'];}return o;});

API.dynamic('getValue',function(){var o=this,p=arguments[0]||false;if(p=='Work.Bar'){return o.workValue;}if(p=='Cache.Bar'){return o.cacheValue;}else{return o.value;}return o;});

API.dynamic('label',function(){var o=this,H=o.hote,pB=o.pureBar,tB=o.textBar,cB=o.cacheBar,wB=o.workBar,ar=arguments[0]||false,prt=arguments[1]||'Pure.Bar';if(typeof ar=='string'){var ho=H.Offset(),hm='';hm+='<div style="width:';hm+=ho.width;hm+='px';hm+=';height:';hm+=ho.height;hm+='px';hm+=';" gui-api-progress="label.bar">';hm+='<div style="width:';hm+=ho.width;hm+='px';hm+=';height:';hm+=ho.height;hm+='px';hm+=';" gui-api-progress="label.bar:text">';hm+=ar.replace(/_n_/gi,o.getValue(prt));hm+='</div>';hm+='</div>';tB.html(hm);cB.html(hm);pB.html(hm);wB.html(hm);}});

API.dynamic('initIDSObjects',function(){var o=this,H=o.hote,He=H;o._pB=He.id;o._pB+='-ggn-Progress-Purcent-box';o._cB=He.id;o._cB+='-ggn-Progress-Cache-box';o._tB=He.id;o._tB+='-ggn-Progress-Text-box';o._wB=He.id;o._tB+='-ggn-Progress-Work-box';});

API.dynamic('initBarObjects',function(){var o=this,H=o.hote;o.initIDSObjects();o.textBar=H.create({id:o._tB,tag:'div'});o.cacheBar=H.create({id:o._cB,tag:'div'});o.pureBar=H.create({id:o._pB,tag:'div'});o.workBar=H.create({id:o._wB,tag:'div'});});

API.dynamic('initVars',function(){var o=this;var varsinit=o.static.varsinit.split(' ') ,events=o.static.events.split(' ');G.foreach(events,function(v){var _n='on';_n+=v.ucfirst();o[_n]=o[_n]||o.cfg[v]||G.F();});G.foreach(varsinit,function(v){o[v]=o[v]||o.cfg[v]||false;});o.value=o.value||0;o.cacheValue=o.cacheValue||0;o.min=(typeof o.min=='number')?((o.min>=0)?o.min:0):0;o.max=(typeof o.max=='number')?((o.max<=100)?o.max:100):100;o.ecart=Math.abs(o.max-o.min);o.row=o.row||(G(1).purcent(o.ecart).virgule(1));o.animation=(o.animation===false)?false:true;o.cacheAnimation=(o.cacheAnimation===false)?false:true;o.workAnimation=(o.workAnimation===false)?false:true;o.timeline=(typeof o.timeline!='number')?200:o.timeline;o.unit=(100/o.row).virgule(1);});

API.dynamic('Setup',function(){var o=this,args=arguments;if(typeof o.hote!='object'){return o;}var H=o.hote,He=H,pB,cB,tB,wB;o.initBarObjects();cB=o.cacheBar;tB=o.textBar;pB=o.pureBar;wB=o.workBar;o.cfg=args[0];o.initVars();H.ui('api','ggn.progress');H.ui('api-progress','ggn.progress.bar');cB.ui('api-progress','cache.bar');tB.ui('api-progress','text.bar');pB.ui('api-progress','purcent.bar');wB.ui('api-progress','work.bar');He.draggable=true;o.level=0;if(o.size!==false){var sz=o.size;sz+='px';o.hote.css({width:sz});}o._activeSeek();o.cache(0);o.work(0);o.seek(o.value);return o;});

API.dynamic('_seek',function(l){var o=this;if(typeof l=='number'){var anim=o.animation||false;l=(l<=0)?0:((l>100)?100:l);l0=l;l0+='%'; if(anim===true){} if(anim!==true){o.pureBar.css({width:l0});} o.value=l; o.event.detect('seek',[o]); if(typeof o.onSeek=='function'){o.onSeek(l);} o._done(); } });

API.dynamic('process',{});

API.dynamic('_done',function(){var o=this; if(o.value>=100){o.event.detect('done',[o]); if(typeof o.onDone=='function'){o.value=100; o.onDone(); } } });

API.dynamic('seek',function(l){l*=1;var o=this,mme,ty,a=arguments,l0,l1,l; if(typeof o.level!='number'){return false;} if(typeof l!='number'){return false;} var anim=((a[1]===false)?false:(o.animation||false)); l=a[0];l=(l<=0)?0:((l>100)?100:l); if(anim===true){var ann='';ann+=o.value;ann+='->';ann+=l;ann+=':%'; o.APC['Pure.Bar']=o.pureBar.animation({width:{value:ann ,hit:function(){} ,done: function(){o.value=l;o._seek(l); if(this.level<100){o.event.detect('seekend',[o]); if(typeof o.onSeekend=='function'){o.onSeekend(l);} } } }},{timeline:o.timeline});} if(anim!==true){o._seek(l);o.event.detect('seekend',[o]);if(typeof o.onSeekend=='function'){o.onSeekend(l);}} });

API.dynamic('inc',function(){var o=this ,prt=arguments[0]||'Pure.Bar';if(prt=='Work.Bar'){o.work(o.workValue+o.unit);}else{if(prt=='Cache.Bar'){o.cache(o.cacheValue+o.unit);}else{o.seek(o.value+o.unit);}}o.event.detect('inc',[o]);o.onInc();return o;});

API.dynamic('dec',function(){var o=this,prt=arguments[0]||'Pure.Bar';if(prt=='Work.Bar'){o.work(o.workValue-o.unit);}else{if(prt=='Cache.Bar'){o.cache(o.cacheValue-o.unit);}else{o.seek(o.value-o.unit);}}o.event.detect('dec',[o]);o.onDec();return o;});

API.dynamic('animProcess',{});

API.dynamic('animate',function(){var o=this,a=arguments[0]||false,p,prt=arguments[1]||'Pure.Bar';o.event.detect('play',[o]);o.onPlay();if(typeof a=='object'){var an='';a.from=(typeof a.from=='number')?((a.from<0)?0:a.from):0;a.to=(typeof a.to=='number')?((a.to>100)?100:a.to):100;an+=a.from;an+='->';an+=a.to;an+=':%';var apc=''; o.APC['Pure.Bar']=o.getBar(prt).animation({width:{value:an ,hit:function(){var ll=this.level;if(prt=='Work.Bar'){o._work(ll);return false;}if(prt=='Cache.Bar'){o._cache(ll);return false;}else{o._seek(ll);}} ,done: function(){if(prt=='Work.Bar'){o.workValue=a.to;o._work(a.to);o.event.detect('workend',[o]);if(typeof o.onWorkend=='function'){o.onWorkend(a.to);}return false;}if(prt=='Cache.Bar'){o.cacheValue=a.to;o._cache(a.to);o.event.detect('cacheend',[o]);if(typeof o.onCacheend=='function'){o.onCacheend(a.to);}return false;}else{o.value=a.to;o._seek(a.to);o.event.detect('seekend',[o]);if(typeof o.onSeekend=='function'){o.onSeekend(a.to);}}} }},{timeline:o.timeline});}return o;});

API.dynamic('_action',function(){var o=this,args=arguments,bar=args[0]||false,a=args[1]||false;if(typeof bar=='string'&&typeof a=='string'){var apc=(typeof o.APC[bar]=='object')?o.APC[bar].animatesControllers:false;prc=apc[0]||false;if(typeof prc=='object'){if(typeof prc[a]=='function'){var _n='on';_n+=a.ucfirst();o.event.detect(a,[o]);if(typeof o[_n]=='function'){o[_n]();}prc[a]();}}}return o;});

API.dynamic('play',function(){var o=this;o._action(arguments[0]||'Pure.Bar','play');return o;});

API.dynamic('pause',function(){var o=this;o._action(arguments[0]||'Pure.Bar','pause');return o;});

API.dynamic('stop',function(){var o=this;o._action(arguments[0]||'Pure.Bar','stop');o.value=o.animProcess.from;return o;});

API.dynamic('restart',function(){var o=this;o.value=o.animProcess.from;o._action(arguments[0]||'Pure.Bar','restart');return o;});

})(window,screen,navigator);