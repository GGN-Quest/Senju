/* GougnonJS.COM.Module.Gallery, version : 0.1, update : 150428#1459, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var API;

if(!Gougnon.support('nightly 0.1.150527')){alert('La version de GougnonJS n\'est pas compatible avec G.COM.Module.Gallery 0.1.150527'); return false; }

if(!isFunction(G.COMModule||null)){GScript.package('ggn.com.module');}

GScript.check('G.COMModule', function(){

	API=G.API({
		name:'COMModuleGallery'
		,static:{
			version:'0.1'
			, Path:'gallery/'
			, Instances:[]
			, LastInstance:false
		}
		,constructor:function(){
			var o=this;
			o.static=G.COMModuleGallery;
			o.args=arguments[0]||[];
			o.instance=o.args[0]||false;
			o.Hote=(isString(o.instance))?G(o.instance):o.instance;
			o.event=G.Event(o);
			o.callBack={};

			o.Key=o.static.Instances.length;
			o.static.Instances[o.Key]=o;
			o.static.LastInstance=o;
		}
	}).create();

	API.dynamic('Init', function(cfg){var o=this;
		o.Path = [G.COMModule.Host,o.static.Path].join('');
		o.Ukey=cfg.ukey;
		G.foreach(GAjax.events.split(' '), function(v){var n='On';n+=v.ucFirst();o[n]=cfg[v]||G.F();});

		o.UI=false;
		o.files=[];
		o.item=[];
		o.Reading=[];
		o.FileLoaded=[];

		return o;
	});

	API.dynamic('Load', function(){var o=this,a=arguments,u=a[0]||'',xh=a[1]||{},xr={};
		G.foreach(GAjax.xhrvars.split(' '), function(v){o[v]=xh[v]||G.F();},false,false,'.');
		G.foreach(GAjax.events.split(' '), function(v){var n='On';n+=v.ucFirst();o[n]=xh[v]||o[n]||G.F();xr[v]=xh[v]||o[n]||G.F();},false,false,'.');

		xr.ukey=xh.ukey||'';
		xr.URI=o.Path;xr.URI+=u;
		xr.data=[xh.data,'&ukey=',xh.ukey,'&ggn-com-module-instance-key=',o.Key].join('');
		xr.mode='POST';

		xr.success=function(){var o1=this;
			o.Hote.html(this.xhr.responseText).execScript();
			o1.OnSuccess=o.OnSuccess;o1.OnSuccess();
		};

		xr.fail=function(){var o1=this;
			o.Hote.fullSpace('<center><div class="alert-mini">Page introuvable</div></center>').execScript();
			o1.OnFail=o.OnFail;o1.OnFail();
		};

		xr.error=function(){var o1=this;
			o.Hote.fullSpace('<center><div class="alert-mini">Erreur lors du chargement</div></center>').execScript();
			o1.OnError=o.OnError;o1.OnError();
		};

		var jx=GAjax(xr).XHR().send();

		return o;
	});

	API.dynamic('eventHandler',function(n){var o=this, co=(typeof arguments[1]=='undefined')?null:arguments[1];
		// if(o.__getBeforeMethod()===false){return false;}

		if(typeof n!='string'){return false;}
		var nm='On'; nm+=n.ucFirst();
		o.event.detect(n.lower(),o,co);
		if(typeof o[nm]=='function'){
			o[nm](co);
		}
		return true;
	});



	API.dynamic('GetFormFiles',function(fles){var o=this;
		o.files=[];

		G.foreach(fles, function(v){
			if(typeof v!='object'){return false;}
			o.files.push(v);
		});
	});

	API.dynamic('GetInputFile', function(input){
		var o=this;

		if(isObject(input.files||null)){
			o.GetFormFiles(input.files);
			o.eventHandler('InitInputLoading'); 
			o.InputFileProcess(0);
		}

	});

	API.dynamic('InputFileProcess', function(k){
		var o=this,lim=o.files.length-1;

		if(!(k in o.Reading)){
			var r=o.LoadInputFile(k);
			G(function(){o.InputFileProcess(k);}).timeout(100);
		}
		else{
			var lded=o.Reading[k]||false;

			if(k<lim){
				if(!isObject(lded)){
					G(function(){o.InputFileProcess(k);}).timeout(100);
				}
				else{var nk=k+1;
					G(function(){o.InputFileProcess(nk);}).timeout(100);
				}
			}
			else{
				o.eventHandler('InputFilesComplete', o.files);
			}

		}

	});

	API.dynamic('LoadInputFile', function(k){
		var o=this, r=new FileReader(), fle=o.files[k];
		
		r.Evn = [];
		r.rank = k;
		r.filename = fle.name;
		r.size = fle.size;
		r.data = false;

		r.onloadstart=function(e){
			this.Evn['FileReadingStart']=e;
			o.eventHandler('FileReadingStart', this.rank); 
		};

		r.onload=function(e){
			this.data = e.target.result;
			this.Evn['FileReading']=e;
			o.eventHandler('FileReading', this.rank);
		};

		r.onloadend=function(e){
			this.data = e.target.result;
			this.Evn.FileReadingEnd=e;
			o.eventHandler('FileReadingEnd', this.rank);
			o.FileLoaded[this.rank]=e;
		};

		r.onprogress=function(e){
			this.Evn.Progress=e;
			o.eventHandler('FileReadingProgress', this.rank);
		};

		r.onabort=function(e){
			this.Evn.Abort=e;
			o.eventHandler('FileReadingAbort', this.rank);
		};

		r.onerror=function(e){
			this.Evn.Error=e;
			o.eventHandler('FileReadingError', this.rank); 
		};

		r.readAsDataURL(fle);
		o.Reading[k] = r;
		o.eventHandler('LoadInputFile',k);
		return r;
	});

	
	GStyle.package('ggn.com.module.gallery');
	GCOM.Module.Gallery = G.COMModuleGallery;

});


})(window,screen,navigator);