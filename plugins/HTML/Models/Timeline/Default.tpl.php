<?php 
/*
	
	Copyright GOBOU Yannick

	version : 0.1
	update : 160903.2207

*/



	global $GLANG;
	


	/* Historique des Entrées */
	$history = isset($history) && is_array($history) ? $history: false;



	$theDays = $GLANG['DAY']['NAME'];

	$toDay = $GLANG['DAY']['LABEL_CURRENT'];



	$theMonth = $GLANG['MONTH']['NAME'];

	$toMonth = $GLANG['MONTH']['LABEL_CURRENT'];







	/*
		Box principal
	*/
		
	$html('<div class="ui-timeline padding-x16 _w10">');

		$html('<div class="ui-timeline-vertical gui flex row">');

			$html('<div class="ui-timeline-line gui box-rounded-biggest ss-disable"></div>');


			$html('<div class="ui-timeline-details">');

				if(is_array($history) ){

					foreach ($history as $Key => $Entry) {


						// echo "<pre>";var_dump($Entry);echo "</pre>";




						$html('<div class="ui-timeline-detail gui flex row">');


							$html('<div class="ui-timeline-pointer gui flex start ss-disable"><div class="ui-timeline-pointer-track"></div></div>');


							$html('<div class="ui-timeline-panel gui flex row wrap box-rounded">');


								if(isset($Entry['time']) && is_numeric($Entry['time']) ){


									$cday = date('Ymd');

									$gday = date('Ymd', $Entry['time']);



									$cmnth = date('Ym');

									$gmnth = date('Ym', $Entry['time']);




									$iday = date('N', $Entry['time']) ;

										$day = (isset($theDays[$iday])) ? $theDays[$iday] : ((($iday*1)==7) ? $theDays[0] : false);



									$dayn = date('d', $Entry['time']);



									$imonth = date('m', $Entry['time']) - 1;

										$month = (isset($theMonth[$imonth])) ? $theMonth[$imonth] : false;



									$year = date('Y', $Entry['time']);



									$html('<div class="ui-timeline-date gui flex column start padding-tb-x16 padding-lr-x24 ss-col-16">');

										if($day!=false){

											$html('<div class="ui-timeline-date-day">'. ucfirst( ($cday != $gday) ? $day : $toDay ) . '</div>');

										}

										// if($cday != $gday){

											$html('<div class="ui-timeline-date-number text-thin">' . $dayn . '</div>');
											
										// }

										// if($cday != $gday){

											$html('<div class="ui-timeline-date-my">' . ucfirst($month) . ' ' . ($year == date('Y') ? '' : $year) . '</div>');
											
										// }



									$html('</div>');

								}



								if(isset($Entry['indicator']) && (is_string($Entry['indicator']) || is_numeric($Entry['indicator'])) ){

									$html('<div class="ui-timeline-indicator gui flex start padding-lr-x12 padding-tb-x20">');

										$html('<div class="ui-timeline-indicator-track x48 padding-x12 gui box-circle flex center text-x24">'

											. $Entry['indicator'] .

										'</div>');
											
									$html('</div>');

								}



								$html('<div class="ui-timeline-info col-0 ss-col-16 padding-x16 gui flex column">');



									if(isset($Entry['title']) && is_string($Entry['title']) ){

										$html('<div class="ui-timeline-info-title">' . ucfirst($Entry['title']) . '</div>');

									}




									if(isset($Entry['content']) ){

										if(is_string($Entry['content'])){

											$html('<div class="ui-timeline-info-about col-0">' . ucfirst($Entry['content']) . '</div>');
											
										}

										if(is_array($Entry['content'])){

											$Content = $Entry['content'];

											$Content['type'] = (isset($Content['type'])) ? $Content['type'] : '-item';

											$Content['data'] = (isset($Content['data'])) ? $Content['data'] : [];


											/* Type : Item / DEBUT */

												if($Content['type'] == '-item'){


													$html('<div class="ui-items-box">');

														$html('<div class="list">');

															foreach ($Content['data'] as $Item) {

																$html('<div class="ui-item gui flex">');


																	if(isset($Item['thumb'])){

																		$html('<div class="ui-item-thumb gui flex column center text-x32">' . $Item['thumb'] . '</div>');

																	}

																	

																	$html('<div class="ui-item-content">');

																		if(isset($Item['title'])){

																			$html('<div class="ui-item-title">' . $Item['title'] . '</div>');
																			
																		}

																		if(isset($Item['about'])){

																			$html('<div class="ui-item-about">' . $Item['about'] . '</div>');

																		}

																		if(isset($Item['infos'])){

																			$html('<div class="ui-item-infos">' . $Item['infos'] . '</div>');

																		}

																	$html('</div>');


																$html('</div>');
																
															}

														$html('</div>');

													$html('</div>');


												}

											/* Type : Item / FIN */



										}


									}




									if(isset($Entry['about']) && is_string($Entry['about']) ){

										$html('<div class="ui-timeline-info-sub">' . $Entry['about'] . '</div>');

									}



								$html('</div>');





							$html('</div>');



						$html('</div>');
						
					} // FOREACH ////////////// FIN


					// exit;


				}


			$html('</div>');


		$html('</div>');

	$html('</div>');







?>