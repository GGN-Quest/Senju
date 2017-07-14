/* GougnonJS.Gabarit.Parallax, version : 0.1, update : 160922#0006, Copyright GOBOU Y. Yannick 2016 */

(function(A,P,I){var API;

	if(!Gougnon.support('nightly 0.1')){alert('La version de GougnonJS n\'est pas compatible avec GGabarit 0.1 ');return false;}


	API=G.API({

		name:'GabaritParallax'

		,static:{
			
			version:'0.1 nightly, Sept 2016, 160922.0006'

			, Detector : []

			, Directives : {

				Dual : 'toggle visible invisible before-visible after-visible'

				, Desc : 'desc-enter desc-leave'

				, Asc : 'asc-enter asc-leave'

			} 

			, aoin : false

			, aolv : false

		}

		,constructor:function(){
		
			var o=this;
		
				o.args = arguments[0]||[];
		
				o.Box = o.args[0]||[];
		
				o.event = G.Event(o);
		
		}

	}).create();


	API

		.static('Initialize', function(){
			
			var o = this, D = o.Directives

				, Dual = D.Dual.split(' ')

				, Desc = D.Desc.split(' ')

				, Asc = D.Asc.split(' ')

			;


			if(Dual.length){

				G.foreach(Dual, function(di){

					var att = '[ggn-parallax-'; att += di; att += ']';

					o.Get(att, di, function(Els){o.SetScroll(di, Els, false);}, true);

				}, false, false, '.');

			}


			if(Desc.length){

				G.foreach(Desc, function(di){

					var att = '[ggn-parallax-'; att += di; att += ']';

					o.Get(att, di, function(Els){o.SetScroll(di, Els, 'desc');}, true);

				}, false, false, '.');

			}


			if(Asc.length){

				G.foreach(Asc, function(di){

					var att = '[ggn-parallax-'; att += di; att += ']';

					o.Get(att, di, function(Els){o.SetScroll(di, Els, 'asc');}, true);

				}, false, false, '.');

			}

				
			return o;

		})

		.static('ToggleCn', function(e, Cne, Cnl){
			
			var o = this

				, e = e || false

				, Cne = Cne || false

				, Cnl = Cnl || false

			;

			if(isObj(e)){

				if(isStr(Cne)){e.addClass(Cne);}

				if(isStr(Cnl)){e.removeClass(Cnl);}

			}

			return o;

		})

		.static('SetScroll', function(typ, Els, Sens, _type){
			
			var o = this

				, Sens = isStr(Sens) ? Sens : false

				, type = _type || 'ggn-parallax-'

				// , frce, force

			;

			type += isStr(typ) ? typ : 'toggle';

			// frce = type; frce += '-force';


			


			G.foreach(Els, function(El){

				if(El.attrib){

					var att = El.attrib(type)||false

						// , force = El.attrib(frce)||false

						, axe = El.attrib('ggn-parallax-axe')||false

					;

					axe = (axe == 'x') ? axe : false;

					if(isStr(att)){

						var instr = att.split(' && ');

						G.foreach(instr, function(ins){

							var ex = ins.split('/')

								, es = ex[0]||''

								, cns = ex[1]||'scroll-leave:scroll-enter'

								, xcns = cns.split(':')

							;

							if(isStr(es)){

								var e = (es.isEmpty()) ? El : G(es);

								if(isObj(e)){

									var Cne = xcns[0]||''

										, Cnl = xcns[1]||''

										, body = G.getDocElement()

										, oft = El.offset()

									;


									Cne = (Cne.toString().isEmpty()) ? false : Cne;

									Cnl = (Cnl.toString().isEmpty()) ? false : Cnl;


									// console.log('SetScroll //', Sens, typ)


									// if(Sens === false){


									o.OnIScroll(El, axe


										/* Entrée */

										, function(L, T, Lx, Ly, ofs, oscrn, ooscrn){

											/* 2 sens */
											
											if(Sens === false){

												if(typ == 'toggle'){o.ToggleCn(e, Cne, Cnl); }


											}


											/* Descendant */

											if(Sens == 'desc' && ( Lx <= L && Ly <= T ) ){

												if(typ == 'desc-enter' ){

													o.ToggleCn(e, Cne, Cnl);

												}

											}


											/* Ascendant */

											if(Sens == 'asc' && ( Lx >= L && Ly >= T ) ){

												if(typ == 'asc-enter' ){

													o.ToggleCn(e, Cne, Cnl);

												}

											}



												
										}


										/* Sortie */

										, function(L, T, Lx, Ly, ofs, oscrn, ooscrn){


											/* 2 sens */

											if(Sens === false){

												if(typ == 'toggle'){o.ToggleCn(e, Cnl, Cne); }


												if(typ == 'before-enter' && ((T <= ofs.top) && (L <= ofs.left)) ){

													o.ToggleCn(e, Cne, Cnl);

												}


												if(typ == 'after-enter'){

													var cy = (T >= (ofs.top + ofs.height)), cx = (L >= (ofs.left + ofs.width));

													if( (cy  && (L == 0)) || (cy && cx) ){

														o.ToggleCn(e, Cne, Cnl);

													}

												}


											}


											/* Descendant */

											if(Sens == 'desc' && ( Lx <= L && Ly <= T ) ){

												if(typ == 'desc-leave' ){

													o.ToggleCn(e, Cne, Cnl);

												}

											}


											/* Ascendant */

											if(Sens == 'asc' && ( Lx >= L && Ly >= T ) ){

												if(typ == 'asc-leave' ){

													o.ToggleCn(e, Cne, Cnl);

												}

											}


										}
										

										/* visible a l'ecran */

										, function(L, T, Lx, Ly, ofs, oscrn, ooscrn){


											if(Sens === false){

												if(typ == 'visible'){

													o.ToggleCn(e, Cne, Cnl);

												}

											}



										}
										
										

										/* invisible a l'ecran */

										, function(L, T, Lx, Ly, ofs, oscrn, ooscrn){

											if(Sens === false){

												if(typ == 'invisible'){

													o.ToggleCn(e, Cne, Cnl);

												}

												if(typ == 'before-visible' && ((T <= ofs.top) && (L <= ofs.left)) ){

													o.ToggleCn(e, Cne, Cnl);

												}

												if(typ == 'after-visible'){

													var cy = (T >= (ofs.top + ofs.height)), cx = (L >= (ofs.left + ofs.width));

													if( (cy  && (L == 0)) || (cy && cx) ){

														o.ToggleCn(e, Cne, Cnl);

													}

												}



											}


											// console.log('invisible a l\'ecran // ', oscrn, ooscrn);

										}
										

										/* Changement d'etat */

										, function(L, T, Lx, Ly, ofs, oscrn, ooscrn){

											// console.log('changed // ', oscrn, ooscrn);

										}
										
									);


									// }
								



								}


							}

							

						});

					}


				}

			}, false, false, {});


				
			return o;

		})


		.static('OnIScroll', function(El, axe, Fne, Fnl, Fnr, Fnor, Fnc){
			
			var o = this

				, El = El || false

				, Fne = isFunction(Fne||'') ? Fne : G.F()

				, Fnl = isFunction(Fnl||'') ? Fnl : G.F()

				, Fnc = isFunction(Fnc||'') ? Fnc : G.F()

				, Fnor = isFunction(Fnor||'') ? Fnor : G.F()

				, Fnr = isFunction(Fnr||'') ? Fnr : G.F()

				, body = G.getDocElement()

			;

			if(isObj(El) ){


				var aoin = false, aolv = false, aot = false, aiot = false, Lx = body.scrollLeft, Ly = body.scrollTop;


				var Setter = function(){

					var ofs = El.offset()

						, L = body.scrollLeft

						, T = body.scrollTop


						, beginY = ofs.top

						, endY = (ofs.top + ofs.height)


						, beginX = ofs.left

						, endX = (ofs.left + ofs.width)


						, oin = (T >= beginY && T <= endY)

						, olv = (T < beginY || T > endY)


						, scrn = GScreen.Offset()

						, scrnw = scrn.width

						, scrnh = scrn.height

						, ooscrn =  ( ((beginX + ofs.width) >= L) && ((beginX + ofs.width) <= (L + scrnw)) ) && ( ((beginY + ofs.height) >= T) && ((beginY + ofs.height) <= (T + scrnh)) )

						, oscrn = ( ( (beginX >= L) && (beginX <= (L + scrnw)) ) && ( (beginY >= T) && (beginY <= (T + scrnh)) ) ) 


						, changed = false

					;





					oin = (axe == 'x') ? (oin && (axe == 'x' && L >= beginX && T <= endX) ) : oin;

					olv = (axe == 'x') ? (olv && (axe == 'x' && L < beginX || L > endX) ) : olv;



					if(oin === true && !aoin){

						Fne(L, T, Lx, Ly, ofs, oscrn, ooscrn);

						changed = true;

						aolv = true;

					}


					if(olv === true && !aolv){

						Fnl(L, T, Lx, Ly, ofs, oscrn, ooscrn);

						changed = true;

						aoin = true;


					}


					if(!oscrn && !ooscrn && !aiot){

						Fnor(L, T, Lx, Ly, ofs, oscrn, ooscrn);

						changed = true;

						aot = false;

						aiot = true;

					}

					if((oscrn || ooscrn) && !aot){

						Fnr(L, T, Lx, Ly, ofs, oscrn, ooscrn);

						changed = true;

						aot = true;

						aiot = false;

					}


					if(changed){

						Fnc(L, T, Lx, Ly, ofs, oscrn, ooscrn);

						aoin = !aoin;

						aolv = !aolv;

						
					}


					Lx = L; Ly = T;


				};


				Setter();

				GEvent(window).listen('scroll', Setter);


			}

			return o;

		})

		.static('cbLength', 0)

		.static('Get', function(seL, tog, Fn, Re){
			
			var o = this

				, Re = Re || false

				, Fn = isFunction(Fn||'') ? Fn : G.F()

				, changed = false

				, Db

				, tog = tog||''

				, tg = 'parallax-detected-'

				, det = ':not(['

			;


			tg += tog;


			det += tg;

			det += '])';


			var D = [],lmx;

				seL += det;

				Db = G('body').child(seL);

				lmx = Db.length;
				

			// if(!isNaN(lmx)){

			// 	if(lmx != o.cbLength){

					G.foreach(Db, function(El){

						D[D.length] = El;

						El.attrib(tg, 'true');

					}, false, false, {});
				

					if(D.length > 0){

						Fn(D);

					}

					if(Re){

						G(function(){o.Get(seL, tog, Fn, Re); }).timeout(1000);

					}

					// console.log('length ', lmx, o.cbLength, D.length);

					// o.cbLength = lmx;

			// 	}


			// }

				
			return o;

		})


	;



	
	GEvent(A).listen('load', function(){

		G.GabaritParallax.Initialize();

	});


})(window,document,navigator);