<?php global $GLANG; ?>/* GougnonJS.Gabarit, version : 0.1, update : 160122#1050, Copyright GOBOU Y. Yannick 2015 */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GGabarit 0.1 ');return false;}


	if(!G['UI']){GScript.package('ggn.ui');}


	API=G.API({

		name:'Gabarit'

		,static:{
			
			version:'0.1 nightly, 170531.2114'
			
			,Status:false
			
			,LetWheelNow:false
			
			,C:0
			
			,Built:[]
			
			,Els:[]
			
			,CallBack:[]
			
			,Attr:function(ge,n){return ge.attrib(n);}

			, Last : {}


			,Date : {

				Label : function(t){

					var o = this

						,D = new Date()

						,Dt = ''

						,_D = new Date()

						,_ct = _D.getTime()

						,doy = _D.dayOfYear().floor()

						,_t = doy -  _D.HtS

						,_hr = _t -  _D.HtS

						,_tf = doy

						, Dn = ''

					;


					D.setTime(t);

					Dn += D._dayName[D.getDay()]||''

					Dn += ' ';

					Dn += (D.getMonth()*1+1).zeroBefore(2);

					Dn += '/';

					Dn += (D.getFullYear()).zeroBefore(2);

					Dt += (_t < t && t <= _tf) ? D._labelToDay : ( (_hr < t && t <= _t) ? D._labelYesterDay : Dn);

					Dt += ' ';

					Dt += ', ';

					Dt += (D.getHours()*1+1).zeroBefore(2);

					Dt += ':';

					Dt += (D.getMinutes()).zeroBefore(2);
					
					Dt += ':';

					Dt += (D.getSeconds()).zeroBefore(2);


					return Dt;

				}

			}


			, Toggle:{

				Trigger:function(e){

				var o=G.Gabarit, ge=G(e)

					tgs=o.Attr(ge,'gabarit-toggle')

					// ,tgcst=(o.Attr(ge,'toggle-copy-size-to')||'').split(',')
			
					,frmss=(o.Attr(ge,'toggle-from')||'close').split(' ')
			
					,toss=(o.Attr(ge,'toggle-to')||'open').split(' ')
			
					,its=(o.Attr(ge,'toggle-in-timeout')||'').split(',')
			
					,ots=(o.Attr(ge,'toggle-out-timeout')||'').split(',')
			
					,tmrs=(o.Attr(ge,'toggle-timer')||'').split(',')
			
					ct=0
			
					;


				if(isString(tgs) && isObj(frmss) && isObj(toss)){

					G.foreach(tgs.split(','), function(tg,k){

						if(!isString(tg)){return false;}

						var bx=G(tg.trim()), k=k*1, sta,it,ot,tmr=tmrs[k]||tmrs[0]||1 ;

						G(function(){

							if(isObject(bx)){

								frms=frmss[k]||frmss[0]||'';
								tos=toss[k]||toss[0]||'';


								it=its[k]||its[0]||false;
								ot=ots[k]||ots[0]||false;

								sta=bx.attrib('gabarit-toggle-status'),ds=bx.css('display')||'block';

								sta=(sta=='true') ? true : false;


								if(sta==true){

									G.foreach(tos.split(','), function(to){bx.removeClass(to);},false,false,'.'); 

									G.foreach(frms.split(','), function(frm){o.Ex(function(o,frm){bx.addClass(frm);},o,ot,frm);},false,false,'.');

								}

								if(sta==false){

									G.foreach(frms.split(','), function(frm){bx.removeClass(frm);},false,false,'.');
							
									G.foreach(tos.split(','), function(to){o.Ex(function(o,to){bx.addClass(to);},o,it,to); },false,false,'.');

								}

								bx.attrib('gabarit-toggle-status', (!sta).toString() );

								GEvent(e).prevent(true);
							}

						}).timeout(tmr+ct);

						ct+=tmr*1;

					});

				}

				}

			}

			, Input:{

				Trigger:function(e){
			
					var ge=G(e), o=G.Gabarit
			
						,tgs=o.Attr(ge,'gabarit-focus')
			
						,fns=(o.Attr(ge,'focus-class')||'focus').split(',')
			
						,ft=o.Attr(ge,'focus-timeout')||false
			
						,bt=o.Attr(ge,'blur-timeout')||100
			
					;

					G.foreach(tgs.split(','),function(tg,kg){

						if(isString(tg)){
			
							var bx=G(tg);
			
							if(isObject(bx)){

								var fss = fns[kg]||fns[0]||'focus';

								G.foreach(fss.split(','),function(fn){

									o.Ex(function(){bx.addClass(fn);},o,ft);

								},false,false,'.');

							}

						}

					},false,false,'.');

					var fnc = function(){

						G.foreach(tgs.split(','),function(tg,kg){

						if(isString(tg)){

							var bx=G(tg);

							if(isObject(bx)){

								var fss = fns[kg]||fns[0]||'focus';

								G.foreach(fss.split(','),function(fn){

									o.Ex(function(){bx.removeClass(fn);},false,bt); 

								},false,false,'.');

							}
						}
						},false,false,'.');

						GEvent(ge).removeListener('blur',fnc); 
						
					};

					GEvent(ge).listen('blur',fnc); 
					

				}

			}


			, Button:{

				CheckBox:{

					Trigger : function(e, check, noFam){

						var get = e.attrib('checked')||false

							, nme = e.attrib('swap-name')||'swap-key'

							, fam = e.attrib('swap-family')||false

							, inp = e.child('input[type="checkbox"]')[0]||false

							, noFam = noFam||false

						;

						get = (typeof check == 'undefined') ? get : check ;

						e.attrib('draggable', 'true');

						if(!inp){inp = e.create({tag:'input',cn:'disable'});inp.attrib('type', 'checkbox').attrib('name', nme); }

						if(isStr(fam) && noFam === false){

							var qs = '*[swap-family="',els;

								qs += fam;

								qs += '"]';

								els = G(qs);

							if(isObj(els)){

								G.foreach(els.nodes(), function(nd){

									if(nd!==e){GGabarit.Button.CheckBox.Trigger(nd, true, true); }

								}, false, false, {});

							}

						}

						if(inp){

							if(!get){

								e.attrib('checked', 'true');

								inp.attrib('checked', 'true');

							}

							else{

								e.removeAttrib('checked');

								inp.removeAttrib('checked');

							}

						}


					}


				}

			}




			, Bar:{

				Sliding:{

					Trigger : function(e,ev){

						var pa = G.browseHTMLElementPath(e,function(e){return e.className;})

							, nme = e.attrib('slider-name')||'slider-key'

							// , tck = e.child('.ui-slider-track')[0]||false

							// , hdl = tck.child('.ui-slider-handler')[0]||false

							, m, xf,yf

							, off = e.offset()
							, x = off.left, y = off.top

						;

						// console.log('Get Parent ///', pa);

						// if(isObj(tck)){tck = e.create({tag:'div',cn:'ui-slider-track'});}

						// if(isObj(hdl)){hdl = tck.create({tag:'div',cn:'ui-slider-handler'});}

						m = GMouse(ev).pos();

						xf = m.x - x, yf = m.y - y;

						console.log('Mouse ///', xf, yf, m.x, m.y, '///', x, y);

					}


				}

			}


			, Form:{

				CheckBox:{

					Trigger:function(e){

						var ge=G(e), o=G.Gabarit
				
							,fml=o.Attr(ge,'checkbox-set-scope')||''

							,form=o.Attr(ge,'checkbox-form')||''

							,on=o.Attr(ge,'checkbox-on')||'tout décocher'

							,onc=o.Attr(ge,'checkbox-active-class')||'active'

							,off=o.Attr(ge,'checkbox-off')||'tout cocher'

							,f=G(ge.form||form)

							,sT

							,els, ln='[checkbox-scope~="'

						;

						if(!isObj(f)){return false;}
						
						sT=f.data('gabarit-checkbox-status')||'false'

						sT = sT=='true' ? true: false;

						ln+=fml; ln+='"]';

						els=f.child(ln)

						ge.data('gabarit-checkbox-status', (!sT).toString());

						G.foreach(els,function(inp){

							inp.checked = !sT;

						},false,false,{});
						

						if(sT===true){ge.html(off); ge.removeClass(onc);}

						if(sT!==true){ge.html(on); ge.addClass(onc);}

						f.data('gabarit-checkbox-status', (!sT).toString() );

					}

				}


				, TextArea:{

					Flexible:{

						Trigger : function(e){

							var ge=G(e)

								,min,max,of,h,sh, val,hf

							;

							if(isObj(e)){

								min=ge.css('min-height').stripAlphaChar()*1;

								max=ge.css('max-height').stripAlphaChar()*1;

								of = ge.offset();

								h = of.height;

								val = ge.value;

								hf = '';

								sh = of.scrollHeight;

								if(sh>h && sh>min && sh<max){

									hf+=sh; hf+='px';

									ge.css({'height':hf});

								}

								else{

									if(sh>max){
										ge.css({'overflow-y':'auto !important'});
									}

									if(val.isEmpty()){

										hf+=min; hf+='px';

										ge.css({'height':hf});

									}

								}

							}

						}
					}

				}


			}


			, Ajax:{

				Target:false

				,Capture:false

				,ActiveHistory:false

				,CallBack:false

				,DefaultTitle:false

				,Events : false

				,Data : []

				,host:'<?php echo HTTP_HOST; ?>'

				,Trigger : function(e, cfg){

					var o=G.Gabarit, o_=this, Cfg = cfg||{}, stt = (isObj(cfg||'')) ? true : false

						,hrf = (stt) ? ( isObj(e) ? e.attrib('href') : (isStr(e) ? e : false) ) : (e.attrib('href')||e.attrib('ajax-href')||false)

						,cap = ((stt) ? (true) : ( (e.attrib('ajax-capture') == 'true') ? (o_.Capture || true) : (false) ))

						,his = ((stt) ? (Cfg['history']||false) : (e.attrib('ajax-history') == true ? e.attrib('ajax-history') : o_.ActiveHistory || false ) )

						,tarid = ((stt) ? (Cfg['target']||false) : (e.attrib('ajax-target') || e.attrib('target')) ) || o_.Target||false

						,tar

						,cb = ((stt) ? (Cfg['callback']||false) : (e.attrib('ajax-callback')) ) ||o_.CallBack||false

						,dat = ((stt) ? (Cfg['data']||null) : (e.attrib('ajax-data')||null) ) || o_.Data || null

					;


					cap = (isStr( e.attrib('ajax-capture') )) ? (e.attrib('ajax-capture') == 'true' ? true : false) : o_.Capture;



					o_.Events.detect('handler', o_);

					if(cap){

						o_.Events.detect('capture', o_);

						tar = G(tarid);

						o_.Jx(hrf,dat,tar,cb,his,tarid,false,e);

						return false;

					}

					location.href = hrf;

				}

				, SetData : function(n, v){

					var o=this;

					o.Data[n] = v;

					return o;
				
				}

				, Init : function(){

					var o=this
				
						,l=location.href
				
						,ex = l.split('?')
				
						,g=ex[1]||null

						,cc={}

						,t = G.D.title
						
					;

					o.Events = GEvent(o);


					GEvent(A).listen('popstate',function(e){

						var s = e.state;

						o.Events.detect('popstate',e);

						if(s){

							o.Jx(s.hrf, s.data, G(s.target), s.callback, s.his, s.target, true, false);

						}

						else{

							location.href = location.href;

						}


					});

				}

				, Jx : function(hrf,dat,tar,cb,his,tarid,noPut,ge){

					var o=this, data = (isStr(dat)) ? dat : '', hrf = isStr(hrf||false) ? ((hrf=='false' || (hrf).isEmpty() ) ? './' : hrf) : './';

					o.Events.detect('wait', this);


					if(isObj(dat)){

						G.foreach(dat, function(v,n){

							if((isStr(v) || !isNaN(v) || !isBoolean(v)) && v!=null){

								data += n;

								data += '=';

								data += escape(v.toString());

							}

						});

					}


					var noPut=noPut||false, jxs=G.Ajax({

						URI:hrf

						, mode:'POST'

						, data:data

						, headers : {'X-Requested-Width':'XMLHttpRequest' }

						, success:function(){

							var xhr = this.xhr, ttl;

							res=xhr.responseText;

							o.Events.detect('success', xhr, ge);
							
							if(isObj(tar)){

								o.Events.detect('change', xhr, ge, hrf, this);

								tar.html(res).execScript();

								// console.log('/// ', res) 

								ttl = G.Gabarit.Ajax.DefaultTitle||((isStr(document.title||false) && !document.title.isEmpty()) ? document.title : "<?php echo \_GGN::varn('SITENAME'); ?>");

								// ttl = G.Gabarit.Ajax.DefaultTitle||"<?php echo \_GGN::varn('SITENAME'); ?>";

								G.D.title = ttl;

							}
							
							if(!isObj(tar)){

								GToast("Impossible de retrouver la cible du rendu").warning();

							}

							o.Events.detect('callback', xhr, ge);

							if(isStr(cb||false)){

								// console.log(cb)

								GScript.exec(cb);

							}

							if(his&&!noPut){

								var cc = {};

									cc.target = tarid;

									cc.data = dat;

									cc.callback = cb;

									cc.his = his;

									cc.hrf = hrf;

									cc.ttl = ttl||"<?php echo \_GGN::varn('SITENAME'); ?>";

								o.Events.detect('put.history', xhr, ge);

								history.pushState(cc, ttl, hrf);

							}
							

						}
						
						, fail:function(ev){

							o.Events.detect('fail', ev, this);

							GToast("Impossible de retrouver la page demandée !").error();

						}
						
						, error:function(ev){

							o.Events.detect('error', ev, this);

							GToast("Erreur lors du chargement de la page").warning();

						}

						, loadend:function(ev){

							o.Events.detect('wait.end', ev, this);

						}

					}).XHR();


					jxs.send();


				}


			}



			, Tag : {

				Select : {

					Trigger : function(e,ev){

						var ge=G(e)

							, o=G.Gabarit

							, o_=this


							, Pa = ge.parentNode

							, Lab = e

							, Text = e.child('.text', true)[0]||false

							, Opt = Pa.child('.options', true)[0]||false

							, Inp = Pa.child('input[tag-select]', true)[0]||false

						;


						if(isObj(Pa) && isObj(e) && isObj(Opt) && isObj(Text)){

							var sta = Pa.attrib('tag-select-status')||'0'

								, name = Pa.attrib('tag-select-name')||false

								, never = (Pa.attrib('tag-select-never-trigged')) ? false : true

							;


							if(sta){

								if(sta == '0'){

									var pof = Pa.offset()

										, w = pof.width

										, h = Opt.scrollHeight

									;

									w+='px';

									h+='px';

									Opt.css({'min-width':w, 'height':h});

									Pa.addClass('focus');


									if(never){

										GEvent(e).listen('click', function(){

											var isa = Pa.attrib('tag-select-istatus')||'0';

											if(isa=='1'){

												o_.Close(e,Pa, Opt).blur();
												
											}

											else{

												Pa.attrib('tag-select-istatus', '1');

											}

										});

									}


									var options = Pa.child('.label + .options > .option');

									if(isObj(options)){

										G(function(){

											var oval = Inp.value||'';

											G.foreach(options, function(option, k){

												option.on('click', function(e){

													var val = this.data('value')||false

														, onc = Inp.onchange||false

														, hval = this.html().inner

													;

													Inp.value = val;

													Pa.title = hval;

													Text.html(hval);

													if(isFunction(onc) && val != oval){Inp.onchange(e);}

												});

											});

										}).timeout(150);

									}


									Pa.attrib('tag-select-status', '1');

								}

								else{

									o_.Close(e,Pa, Opt);

								}

							}


							if(never){

								GEvent(e).listen('blur', function(){

									G(function(){

										o_.Close(e,Pa, Opt);

									}).timeout(10);

								});

								Pa.attrib('tag-select-never-trigged', '1');

							}


						}

						return this;
						

					}

					, Close : function(e,Pa,Opt){

						var o_=this;

						G(function(){

							var ge=G(e)

								, o=G.Gabarit

							;

							if(isObj(Pa)){

								Pa.removeClass('focus');

								Pa.attrib('tag-select-status', '0');

								Pa.attrib('tag-select-istatus', '0');

								Opt.css({'height':'0px'});


							}

						}).timeout(100);

						return e;

					}

				}

			}



		}

		,constructor:function(){
		
			var o=this;
		
				o.args = arguments[0]||[];
		
				o.Box = o.args[0]||[];
		
				o.event = G.Event(o);
		
		}

	}).create();


	API.static('Launch', function(){

		var o=this;

			o.dyn = G.Gabarit;
			
			o.Ajax.Init();


			GAction('handler:Gabarit.Button.CheckBox').listen('mouseup',function(e,ev){

				if(GEvent(ev).isLeftClick()){o.Button.CheckBox.Trigger(e);}

			}, true);


			GAction('handler:Gabarit.Bar.Sliding').listen('mousedown',function(e,ev){

				if(GEvent(ev).isLeftClick()){o.Bar.Sliding.Trigger(e,ev);}

			}, true);


			GAction('handler:Gabarit.Form.TextArea.Flexible').listen('keyup',function(e){

				o.Form.TextArea.Flexible.Trigger(e);

			});


			GAction('handler:Gabarit.Input.Focus').listen('focus',function(e){
				
				o.Input.Trigger(e);

			});

			GAction('handler:Gabarit.Toggle').listen('click',function(e,ev){

				if(GEvent(ev).isLeftClick()){o.Toggle.Trigger(e);}

			});

			GAction('handler:Gabarit.Tag.Select').listen('focus click',function(e,ev){

				o.Tag.Select.Trigger(e,ev);

			});

			GAction('handler:Gabarit.Form.CheckBox').listen('click',function(e,ev){

				if(GEvent(ev).isLeftClick()){o.Form.CheckBox.Trigger(e);}

			});


			GEvent(document).listen('click', function(ev){

				var Ge = GEvent(ev).source(), Path = G.HTMLElementPath(Ge)||[], indx = Path.indexOf('A'), oPath = G.browseHTMLElementPath(Ge, function(e){return e;}).reverse();

				if(isObj(Ge) && indx > -1 && o.Ajax.Capture === true){

					if(GEvent(ev).isLeftClick()){

						var A = oPath[indx], hrf = A.toString(), B = G('base');

						if(isObj(B)){

							var h = B.href, avail = hrf.substr(0, h.length) == h;

							if(avail){

								o.Ajax.Trigger(A);

								GEvent(ev).prevent(true).stop();

							}

						}

					}

				}

			}, true);


			GAction('handler:Gabarit.Ajax').listen('click',function(e,ev){

				if(GEvent(ev).isLeftClick()){o.Ajax.Trigger(e);}

			});


		return o;
	})


	.static('Ex', function(f){
		
		var o=this
	
			, ar=arguments
	
			, a=ar[1]||o
	
			, t=ar[2]||1

			, args=ar[3]||null
	
		;

		if(isFunction(f||'')){
	
			G(function(){
	
				f(a,args);
	
			}).timeout(isNaN(t*1)?10:t*1);
	
		}

		return o;
	});


	;


	return GGabarit;

})(window,document,navigator).Launch();
