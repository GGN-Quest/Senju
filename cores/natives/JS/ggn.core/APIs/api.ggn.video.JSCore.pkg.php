/* GougnonJS.Video, version : 0.1, update : 150428#1459, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var API;

if(!Gougnon.support('nightly 0.1.150527')){alert('La version de GougnonJS n\'est pas compatible avec GVideo 0.1.150527'); return false; }



API=G.API({
	name:'Video'
	,static:{
		version:'0.1'
		// ,_methds:'addTextTrack canPlayType load play pause'
		,_props:'audioTracks autoplay buffered controller controls crossOrigin currentSrc currentTime defaultMuted defaultPlaybackRate duration ended error loop mediaGroup muted networkState paused playbackRate played preload readyState seekable seeking src startDate textTracks videoTracks volume'
		,_events:'abort canplay canplaythrough durationchange emptied ended error loadeddata loadedmetadata loadstart pause play playing progress ratechange seeked seeking stalled suspend timeupdate volumechange waiting'

		,_types:['video/ogg', 'video/mp4', 'video/webm']
		,_codecs:['video/ogg; codecs="theora, vorbis"', 'video/mp4; codecs="avc1.4D401E, mp4a.40.2"', 'video/webm; codecs="vp8.0, vorbis"']

	}
	,constructor:function(){
		var o=this;
		o.static=G.Video;
		o.args=arguments[0]||[];
		o.instance=G(o.args[0])||false;
		o.event=false;

		if(isObject(o.instance.element||'')){o.event=G.Event(o.instance.element);}

	}
}).create();



API.dynamic('init', function(m){var o=this,a=arguments,m=a[0]||'',sp=m.split(':'),mt=sp[1]||false;
	o.mode=mt;
	if(mt==''){} 
	else{
		if(isObject(o.instance.element||'')){
			o.canPlayTypes=o._canPlayTypes();
		}
		return o.__properties().__events();
	}


});



// API.dynamic('_methods', function(){var o=this;
// 	G.foreach(o.static._methds.split(' '), function(v){o[v]=function(){o.instance.element[v]();};});
// 	return o;
// });


API.dynamic('__properties', function(){var o=this;
	G.foreach(o.static._props.split(' '), function(v){o[v]=function(){var a=arguments; if(typeof a[0]!='undefined'){o.instance.element[v]=a[0];}return o.instance.element[v];};});
	return o;
});


API.dynamic('__events', function(){var o=this;
	if(isObject(o.event)){
		G.foreach(o.static._events.split(' '), function(v){var n='on';n+=v.ucfirst();
			o[n]=function(){var a=arguments,f=a[0]||false; o.event.listen(v,function(ev){if(isFunction(f||false)){f(ev);}},false); };
		});
	}
	return o;
});


API.dynamic('play', function(){var o=this;
	o.instance.element.play();
});

API.dynamic('pause', function(){var o=this;
	o.instance.element.pause();
});

API.dynamic('load', function(){var o=this;
	o.instance.element.load();
});

API.dynamic('canPlayType', function(cdc){var o=this;
	o.instance.element.canPlayType(cdc);
});

API.dynamic('_canPlayTypes', function(){var o=this,r=[],tps=o.static._types,cds=o.static._codecs;

	if(tps.length==cds.length){
		G.foreach(tps,function(tp,k){
			var cd=cds[k],td=tp,g;
			td+=';codecs="',td+=cd,td+='"';
			g=!o.instance.element.canPlayType(td);
			r[tp]=(g=="")?'no':g;
		});
		return r;
	}

	return false;
});





})(window,screen,navigator);