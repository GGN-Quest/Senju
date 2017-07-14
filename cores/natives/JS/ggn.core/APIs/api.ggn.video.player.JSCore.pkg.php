/* GougnonJS.Video.Player, version : 0.1, update : 150428#1459, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var API;

if(!Gougnon.support('nightly 0.1.150527')){alert('La version de GougnonJS n\'est pas compatible avec GVideo 0.1.150527'); return false; }





if(typeof GVideo=='undefined'){GScript.package('ggn.video');}

GScript.check('GVideo', function(){


	API=G.API({
		name:'VideoPlayer'
		,static:{
			version:'0.1'
			,vars:'mode volumeItem volume autoplay'
			,elms:'controller-pad menu-box menu-pad menu-share controller-box control play-pause duration duration-current duration-total shuffle loop fullscreen volume volume-audio slider-informer slider-box logo-tv screen-pad screen-hide video-status screen-box screen-video'
			// ,elms:'controller-pad menu-box menu-pad menu-share controller-box control play-pause duration duration-current duration-total shuffle loop volume slider-box slider-cache slider-loaded slider-pointer logo-tv screen-pad screen-hide screen-box screen-video'
		}
		,constructor:function(){
			var o=this;
			o.static=G.VideoPlayer;
			o.args=arguments[0]||[];
			o.player=G(o.args[0])||{};
			o.event=G.Event(o);
		}
	}).create();

	

	API.dynamic('init', function(cfg){var o=this;
		G.foreach(o.static.vars.split(' '), function(v){cfg[v]=cfg[v]||false;});
		o.config=cfg;
		o.video=false;
		o.volumeLevelCallBack=false;
		o.warning=GAwake.Confirm(o.player).init({width:360,height:200});
		o.wait=GAwake.Waiting(o.player).init({width:320,height:150, title:'Pateintez', label:'Initialisation de la video...'});

		o.wait.show();

		return o._els()._video()._actions()._events();
	});


	API.dynamic('getCompatibilities', function(cfg){var o=this,v=o.video.instance.element;
		
		// G.foreach(o.video.canPlayTypes, function(cdc,cdn){
			
		// });

	});


	API.dynamic('_els', function(){var o=this;
		o.el={};
		G.foreach(o.static.elms.split(' '),function(v){var nv='#',n=(v).replace(/-([a-z].*)$/g,function(x){return x.substr(1).ucfirst();});nv+=v;o.el[n]=o.player.children(nv)||false;});

		o.progress = GProgressBar('#slider-box').Setup({version:"0.1"
			,row:1000
			,activeSeek:true
		});

		o.progress.pointer = o.progress.pureBar.createElement({id:'slider-pointer'});
		o.progress.cache(100);

		return o;
	});


	API.dynamic('_video', function(){var o=this;
		if(isObject(o.el||false)){
			if(isObject(o.el.screenVideo||false)){
				o.video=GVideo(o.el.screenVideo).init(':ops.player');
				o.updateDuration(true);
				o.getCompatibilities();

				if(!o.video.muted()){
					o.toggleMute();
				}

				o.volume(3);

				// o.video.instance.preload = 'auto';

			}
		}
		return o;
	});


	API.dynamic('_isPlaying', false);
	API.dynamic('_actions', function(){var o=this;
		if(isObject(o.el||false) && isObject(o.video||false)){
			
			if(isObject(o.el.playPause||'')){
				o.el.playPause.click(function(ev){var clk=G(ev).clickType();
					if(clk=='mouse.click.left'){
						o.playPause();
					}
				});
			}

			if(isObject(o.el.loop||'')){
				o.el.loop.click(function(ev){var clk=G(ev).clickType();
					if(clk=='mouse.click.left'){
						o.toggleLoop();
					}
				});
			}

			if(isObject(o.el.fullscreen||'')){
				o.el.fullscreen.click(function(ev){var clk=G(ev).clickType();
					if(clk=='mouse.click.left'){
						o.toggleFullscreen();
					}
				});
			}

			if(isObject(o.el.shuffle||'')){
				o.el.shuffle.click(function(ev){var clk=G(ev).clickType();
					if(clk=='mouse.click.left'){
						o.toggleShuffle();
					}
				});
			}

			if(isObject(o.el.controllerPad||'')){
				o.el.controllerPad.click(function(ev){var e=G(ev).source(),ge=G(e),clk=G(ev).clickType();
					if(clk=='mouse.click.left'&&ge.prop('id')==this.id){
						o.playPause();
					}
				});
			}

			if(isObject(o.el.volumeAudio||'')){
				o.el.volumeAudio.click(function(ev){var clk=G(ev).clickType();
					if(clk=='mouse.click.left'){
						o.toggleMute();
					}
				});
			}


			GAction('handler:volume.manager').listen('click', function(e){
				var ge=G(e), vol=ge.attrib('ggn-video-player-volume-set')||false;
				if(vol){
					o.volume(vol);
					// vol/=100;
					// ge.addClass('level');
					// o.video.volume(vol);
					// if(isObject(o.volumeLevelCallBack||'')){
					// 	o.volumeLevelCallBack.removeClass('level');
					// }
					// o.volumeLevelCallBack = ge;
				}
			});


		}

		G(document).contextmenu(function(){
			return false;
		});

		return o;
	});

	API.dynamic('_events', function(){var o=this;
		if(isObject(o.el||false) && isObject(o.video||false)){
			if(isObject(o.video.event||false)){
				var sitmer=false;
				
				o.el.sliderInformer.cn('no _left');
				o.el.sliderInformer.css({display:'none'});

				o.progress.onSeeker=function(p){
					var t=p.unPercent(o.video.duration());
					o.video.currentTime(t);
				};

				o.progress.hote.mouseenter(function(evt){
					var ge=o.el.sliderInformer;
					ge.css({display:'block'});

					if(isFunction(sitmer.clearOut||'')){sitmer.clearOut();}
					sitmer=G(function(){ge.replaceClass('no','overview');}).timeout(1);
						
				});
				
				o.progress.hote.mouseout(function(evt){
					var ge=o.el.sliderInformer;
					ge.replaceClass('overview','no');
					
					if(isFunction(sitmer.clearOut||'')){sitmer.clearOut();}
					sitmer=G(function(){ge.css({display:'none'});}).timeout(300);
				});

				o.progress.hote.listen('mousemove|mouseover',function(evt){
					var e=G(evt).source(),g=G(this),m=GMouse(evt).position(),l=o.progress.activeSeekValue(evt),ge=o.el.sliderInformer
						,t=o.ghms(l.unPercent(o.video.duration()).virgule(1))
						,of=g.offset()
						,w=of.width
						,mw=w/2
						,x
						;

					if(mw<m.x){
						x=m.x-ge.offset().width;
						ge.replaceClass('_right', '_left');
					}

					if(mw>=m.x){
						x=m.x;
						ge.replaceClass('_left', '_right');
					}

					x+='px';
					if(isObject(t)){ge.html(o.timeFormat(t));}
					ge.css({left:x});

				});

				o.video.onVolumechange(function(){});

				o.video.onLoadedmetadata(function(){});

				o.video.onAbort(function(){
					o.wait.close();
					o.warning.message('Echec', 'Le chargement de la vidéo à echouée');
				});
				
				o.video.onError(function(){
					o.wait.close();
					o.warning.message('Erreur', 'Une erreur a été observée lors du chargement de la video');
				});
				
				o.video.onEmptied(function(){
					o.wait.close();
					o.warning.message('Erreur', 'Aucun vidéo detectée');
				});
				
				o.video.onWaiting(function(){
					o.uiStatus('waiting');
				});
				
				o.video.onPlaying(function(){
					o.uiStatus('playing');
				});

				o.video.onPause(function(){
					o.uiStatus('pause');
				});


				o.video.onEnded(function(){
					o.el.playPause.cn('item re-play');
					o.el.playPause.cn('item re-play');
					o._isPlaying=false;
					o.uiStatus('re-play');

					G(function(){
						if(o.loopStatus){
							o.iPlay();
						}
					}).timeout(1000);

				});

				o.video.onProgress(function(){
					o.uiUpdateCacheSlider();
				});

				o.video.onTimeupdate(function(){
					o.uiUpdateLoadedSlider();
				});

				o.video.onDurationchange(function(){
					o.uiUpdateTotalDuration().uiUpdateCurrentDuration();
				});

				o.video.onSeeked(function(){
					o.uiUpdateTotalDuration().uiUpdateCurrentDuration();
				});

				o.video.onSeeked(function(){
					o.uiUpdateTotalDuration().uiUpdateCurrentDuration();
				});


				GScript.check(function(){var b=o.video.buffered()||{},r=undefined;try{r=b.end(0);}catch(e){};return r;}, function(){
					o.wait.close();

					G(function(){
						if(o.config.autoplay==true){
							o.iPlay();
						}
					}).timeout(500);

				});

				
				GEvent(document).listen('webkitfullscreenchange|mozfullscreenchange|fullscreenchange|MSFullscreenChange',function(){
					var ge=o.el.fullscreen,s=!o.iFullscreenStatus();
					if(s){
						ge.addClass('exit');
					}
					else{
						ge.removeClass('exit');
					}
				});
				

			}
		}


		return o;
	});






	API.dynamic('checkBuffered', function(){var o=this;

		if(isObject(o.video||'')){
			var b=o.video.buffered();
			if(isFunction(b.end||'')){
				var r=false;
				try{r=b.end(0);} catch(e){}
				return (r==false)?false:b;
			}
		}

		return false;
	});

	API.dynamic('level', function(){var o=this;
		return o.video.currentTime().purcent(o.video.duration()).virgule(1);
	});

	API.dynamic('getlevel', function(n){var o=this;
		return n.purcent(o.video.duration()).virgule(1);
	});

	API.dynamic('cacheLevel', function(){var o=this,check=o.checkBuffered()||false;
		return (check)?check.end(0).purcent(o.video.duration()).virgule(1):0;
	});






	API.dynamic('iPlay', function(){var o=this;
		o.pause().playPause();
		return o;
	});

	API.dynamic('playPause', function(){var o=this;
		if(!o._isPlaying){o.play();}
		else{o.pause();}
		o._isPlaying=!o._isPlaying;
		return o;
	});

	API.dynamic('play', function(){var o=this,ge=o.el.playPause;
		ge.cn('item pause');
		o.updateDuration();
		o.video.play();
		return o;
	});

	API.dynamic('pause', function(){var o=this,ge=o.el.playPause;
		ge.cn('item play');
		o.video.pause();
		return o;
	});


	API.dynamic('shuffleStatus', false);
	API.dynamic('shuffle', function(){var o=this,a=arguments;
		o.shuffleStatus=!((isBoolean(a[0]||''))?a[0]:false);
		o.toggleShuffle();
		return o;
	});
	API.dynamic('toggleShuffle', function(){var o=this,ge=o.el.shuffle,loo=o.shuffleStatus;
		if(!loo){ge.replaceClass('disable','enable');}
		else{ge.replaceClass('enable','disable');}
		o.shuffleStatus=!o.shuffleStatus;
		return o;
	});



	API.dynamic('loopStatus', false);
	API.dynamic('loop', function(){var o=this,a=arguments;
		o.loopStatus=!((isBoolean(a[0]||''))?a[0]:false);
		o.toggleLoop();
		return o;
	});
	API.dynamic('toggleLoop', function(){var o=this,ge=o.el.loop,loo=o.loopStatus;
		if(!loo){ge.replaceClass('disable','enable');}
		else{ge.replaceClass('enable','disable');}
		o.loopStatus=!o.loopStatus;
		return o;
	});




	API.dynamic('toggleFullscreen', function(){var o=this,ge=o.el.fullscreen,fllsc=o.iFullscreenStatus();
		if(fllsc){
			o.requestFullscreen();
		}
		else{
			o.exitFullscreen();
		}

		return o;
	});

	API.dynamic('fullscreenStatus', false);
	API.dynamic('iFullscreenStatus', function(){var o=this,d=document;
		return !d.fullscreenElement && !d.mozFullScreenElement && !d.webkitFullscreenElement && !d.msFullscreenElement;
	});

	API.dynamic('fullscreenMomentTimer', 0*1);
	API.dynamic('fullscreenMomentToggle', function(){var o=this,d=document,ge=o.player,fllsc=o.fullscreenStatus;
		
		if(fllsc===true){

			GEvent(ge.element).listen('mouseleave',function(){
				ge.removeClass('fullscreen');
				ge.element.onmousemove=null;
			});

			GEvent(document).listen('mousemove',function(){
				
				if(!o.fullscreenStatus){return false;}
				ge.removeClass('fullscreen');

				if(isFunction(o.fullscreenMomentTimer.clearOut||'')){o.fullscreenMomentTimer.clearOut();}
				o.fullscreenMomentTimer=G(function(){
					ge.addClass('fullscreen');
				}).timeout(3000);

			});

		}
		else{
			ge.removeClass('fullscreen');
			ge.element.onmousemove=null;
		}


	});

	API.dynamic('requestFullscreen', function(){var o=this,ge=o.player.element,fllsc=o.iFullscreenStatus();

		if(fllsc==true){
			if(ge.requestFullscreen) {
			  ge.requestFullscreen();
			} 
			else if (ge.msRequestFullscreen) {
			  ge.msRequestFullscreen();
			} 
			else if (ge.mozRequestFullScreen) {
			  ge.mozRequestFullScreen();
			} 
			else if (ge.webkitRequestFullscreen) {
			  ge.webkitRequestFullscreen();
			}
			o.fullscreenStatus=true;
			o.fullscreenMomentToggle();
		}


		// alert([ge, typeof ge, o.video, o.iFullscreenStatus()].join('\n'));

		return o;
	});

	API.dynamic('exitFullscreen', function(){var o=this,ge=document,fllsc=o.iFullscreenStatus();

		if(fllsc==false){
			if(ge.exitFullscreen) {
			  ge.exitFullscreen();
			} 
			else if (ge.msExitFullscreen) {
			  ge.msExitFullscreen();
			} 
			else if (ge.mozCancelFullScreen) {
			  ge.mozCancelFullScreen();
			} 
			else if (ge.webkitExitFullscreen) {
			  ge.webkitExitFullscreen();
			}
			o.fullscreenStatus=false;
			o.fullscreenMomentToggle();
		}

		return o;
	});




	API.dynamic('muteStatus', false);
	API.dynamic('mute', function(){var o=this,a=arguments;
		o.muteStatus=!((isBoolean(a[0]||''))?a[0]:false);
		o.toggleMute();
	});
	API.dynamic('toggleMute', function(){var o=this,ge=o.el.volumeAudio,loo=o.muteStatus;
		if(!loo){
			ge.cn('vol-icon on');
			o.video.muted(false);
		}
		else{
			ge.cn('vol-icon off');
			o.video.muted(true);
		}
		o.muteStatus=!o.muteStatus;
	});

	API.dynamic('volume', function(n){var o=this,a=arguments,ge=G(['#volume-level-',n].join(''));

		if(a[0]&&isObject(ge||'')){
			n*=2;
			n/=10;
			ge.addClass('level');
			o.video.volume(n);
			if(isObject(o.volumeLevelCallBack||'')){
				o.volumeLevelCallBack.removeClass('level');
			}
			o.volumeLevelCallBack = ge;
		}

		return o.video.volume();
	});


	API.dynamic('ghtm', function(t,dv){var o=this,nt=-1;
		while(t>dv){t=t/dv; nt++;}
		return nt;
	});


	API.dynamic('ghms', function(tme){var o=this
		,h=Math.floor(o.ghtm(tme,60))
		,m= Math.abs( Math.floor( (tme/60)-(h*60) ) )
		,s=Math.floor((tme)-(m*60)-(h*60*60))
		;

		m+=(60-s<=0)?(60-s):0;
		h+=(60-m<=0)?(60-m):0;

		h=(60-h<=0)?0:h;
		m=(60-m<=0)?0:m;
		s=(60-s<=0)?0:s;

		return [h,m,s];
	});

	API.dynamic('timeFormat', function(t){
		return (isObject(t)) ? [(t[0]>0?t[0].zeroBefore(2):''),((t[0]>0)?':':'') ,t[1].zeroBefore(2),':' ,t[2].zeroBefore(2)].join(''):'NaN';
	});


	API.dynamic('uiUpdateTotalDuration', function(){var o=this,ge=o.el.durationTotal,tme=o.video.duration()
			,t=o.ghms(tme)
			,h=t[0]
			,m= t[1]
			,s=t[2]
			,ctn='/ '
			;

		o.totalMinute=m;
		o.totalHour=h;
		o.totalSeconde=s;

		ctn+=o.timeFormat(t);
		ge.html(ctn);
		return o;
	});

	API.dynamic('uiUpdateCurrentDuration', function(){var o=this,ge=o.el.durationCurrent,tme=o.video.currentTime()
			,t=o.ghms(tme)
			,h=t[0]
			,m=t[1]
			,s=t[2]
			;

		h+=':';

		// console.log([tme, h, m ,s].join(' - '));

		o.currentMinute=m;
		o.currentHour=h;
		o.currentSeconde=s;

		ge.html(o.timeFormat(t));
		return o;
	});

	API.dynamic('updateDuration', function(){var o=this,a=arguments,r=a[0]||false;
		
		if(r===true){
			o.uiUpdateTotalDuration().uiUpdateCurrentDuration();
		}
		else{
			o.video.onTimeupdate(function(){
				if(o._isPlaying===true){
					o.uiUpdateTotalDuration().uiUpdateCurrentDuration();
				}
			});
		}


	});



	API.dynamic('uiUpdateSlider', function(){var o=this;
		return o.uiUpdateLoadedSlider().uiUpdateCacheSlider();
	});

	API.dynamic('uiUpdateLoadedSlider', function(){var o=this,ge=o.el.sliderLoaded,p=o.level();
		// p+='%';
		// ge.css({width:p});
		o.progress.seek(p);
		return o;
	});

	API.dynamic('uiUpdateCacheSlider', function(){var o=this,ge=o.el.sliderCache,p=o.cacheLevel();
		// p+='%';
		// ge.css({width:p});
		o.progress.cache(p);
		return o;
	});


	API.dynamic('uiStatus', function(){var o=this,ge=o.el.videoStatus,a=arguments,act=a[0]||false, c,h;
		ge.cn('no');

		if(act=='waiting'){
			c='waiting';
			h='<div class="gui loading circle x32 light"></div>';
		}

		if(act=='playing'){
			c='playing';
			h='';
			G(function(){ge.cn('no');}).timeout(300);
		}

		if(act=='pause'){
			c=act;
			h='';
		}

		if(act=='re-play'){
			c='replay';
			h='';
		}


		if(isString(c)){ge.cn(c);}
		if(isString(h)){ge.fullSpace(['<center>',h,'</center>'].join(''));}

		ge.absCenterOf(G(ge.element.parentNode));
		GEvent(window).listen('resize',function(){
			ge.absCenterOf(G(ge.element.parentNode));
		});
		
		return o;
	});



	GVideo.Player = G.VideoPlayer;

});


})(window,screen,navigator);