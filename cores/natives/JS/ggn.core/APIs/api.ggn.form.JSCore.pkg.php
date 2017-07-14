/* GougnonJS.Form, version : 0.1, update : 150428#1459, Copyright GOBOU Y. Yannick 2014 */
(function(A,P,I){var API;

if(!Gougnon.support('nightly 0.1.150527')){alert('La version de GougnonJS n\'est pas compatible avec Form 0.1.150527'); return false; }


	API=G.API({

		name:'Form'

		,static:{

			version:'0.1'

			,Pkg:'ggn.form'

			,Data:{}

		}

		,constructor:function(){

			var o=this;

			o.static=G.Form;

			o.args=arguments[0]||[];

			o.name=o.args[0]||false;

			o.event=G.Event(o);

		}

	}).create();


	API.static('Initialize', function(){

		var o=this;

		o.Data.Textareas = G('textarea')._nodeList;

		o.InitTextareaARZ();

		return o;
	});
	

	API.static('InitTextareaARZ', function(){

		var o=this;

		G.foreach(o.Data.Textareas, function(t,k){

			var gel=G(t);

			if(!isObject(gel)){return false;}

			var el=gel.element;

			if(!isObject(gel||undefined)){return false;}

			gel.data('default-row', gel.prop("rows")+1);

			// gel.data('default-overflow', 'hidden');

			GEvent(el).listen('keyup', function(e){

				var ti=G(e).source(),ge=G(ti),d=ge.data('auto-resize'),max=ge.data('auto-resize-max')||false,v=ti.value;

				if(isString(d)){if(d=='1'){var row=o.GetRow(v);o.SetRow(ti, row);}}

			}, false);

			o.SetRow(el, o.GetRow(el.value));

		});

		return o;

	});
	
	API.static('SetRow', function(ti, row){

		var ge=G(ti),max=ge.data('auto-resize-max') ,scr=ge.data('default-overflow')||'hidden',ri=ge.data('default-row');

		if(isString(ri)){

			max=(isString(max))?max*1:false;

			if(isNumber(max)){

				if(row>max){

					row=max;

					ri=max;

					scr='auto';

				}

			}

			ti.rows=(row>ri)?row:ri;

			ge.css({overflow:scr});

		}

	});

	API.static('GetRow', function(v){

		var r0=v.split("\n") ,r1=v.split("\r") ,r2=v.split("\r\n"),row=(r0.length>r1.length)?r0.length:r1.length;

		return (row>r2.length)?row:r2.length;

	});

	GEvent(A).listen('load', function(){

		G.Form.Initialize();

	});

})(window,screen,navigator);
