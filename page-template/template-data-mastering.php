<?php
$SNo = (isset($_REQUEST["SNo"]) ? $_REQUEST["SNo"] : "01");
?>
									<div class="services-add-remove">
										<div class="container-fluid separator">
											<div class="row">
												<div class="col-md-12">
													<hr/>
												</div>
											</div>
										</div>
										<div class="container service-div">
											<div class="row">
												<div class="wrap mcb-wrap col-md-12 valign-top clearfix" style="">
													<div class="mcb-wrap-inner video-graphy-form">
														<div class="col-md-12">
															<div class="column_attr clearfix" style="">
																<div class="row">
																	<div class="col-md-3">
																		<h2 class="section-heading-style text-right">
																			MASTERING
																			<input type="hidden" name="TotalPackages[]" value="<?php echo $SNo; ?>" />
																			<input type="hidden" name="ServiceName[]" value="Mastering" />
																			<input type="hidden" name="ServiceName-<?php echo $SNo; ?>" value="Mastering" />
																			<input type="hidden" class="TotalPrice" name="songPrice-<?php echo $SNo; ?>" value="50"/>
																		</h2>
																	</div>
																	<div class="col-md-9 text-right">
																		<h2 class="section-heading-style">
																			<span><strong class="song-count">SONG <?php echo $SNo; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																				<span class="cursor-pointer pull-right deleteThisService"><i class="fa fa-times"></i></span>
																			</span>
																		</h2>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-12">
															<div class="column_attr clearfix" style="">
																<div class="row">
																	<div class="col-md-3">
																		<label>SONG NAME: *</label>
																	</div>
																	<div class="col-md-4">
																		<input type="text" name="SongName-<?php echo $SNo; ?>" value="" placeholder="Artist, Band, or Producer Name" required="" />
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-3">
																		<label>SONG KEY:</label>
																	</div>
																	<div class="col-md-2">
																		<select name="SongKey-<?php echo $SNo; ?>">
																			<option value="Ab Minor_0">Ab Minor</option>
																			<option value="Ab Major_1">Ab Major</option>
																			<option value="A Minor_2">A Minor</option>
																			<option value="A Major_3">A Major</option>
																			<option value="A# Minor_4">A# Minor</option>
																			<option value="Bb Minor_5">Bb Minor</option>
																			<option value="Bb Major_6">Bb Major</option>
																			<option value="B Minor_7">B Minor</option>
																			<option value="B Major_8">B Major</option>
																			<option value="Cb Major_9">Cb Major</option>
																			<option value="C Minor_10">C Minor</option>
																			<option value="C Major_11">C Major</option>
																			<option value="C# Minor_12">C# Minor</option>
																			<option value="C# Major_13">C# Major</option>
																			<option value="Db Major_14">Db Major</option>
																			<option value="D Minor_15">D Minor</option>
																			<option value="D Major_16">D Major</option>
																			<option value="D# Minor_17">D# Minor</option>
																			<option value="Eb Minor_18">Eb Minor</option>
																			<option value="Eb Major_19">Eb Major</option>
																			<option value="E Minor_20">E Minor</option>
																			<option value="E Major_21">E Major</option>
																			<option value="D Minor_22">D Minor</option>
																			<option value="D Major_23">D Major</option>
																			<option value="D# Minor_24">D# Minor</option>
																			<option value="Eb Minor_25">Eb Minor</option>
																			<option value="Eb Major_26">Eb Major</option>
																			<option value="E Minor_27">E Minor</option>
																			<option value="E Major_28">E Major</option>
																			<option value="F Minor_29">F Minor</option>
																			<option value="F Major_30">F Major</option>
																			<option value="F# Minor_31">F# Minor</option>
																			<option value="F# Major_32">F# Major</option>
																			<option value="Gb Major_33">Gb Major</option>
																			<option value="G Minor_34">G Minor</option>
																			<option value="G Major_35">G Major</option>
																			<option value="G# Minor_36">G# Minor</option>
																		</select>
																	</div>
																	<div class="col-md-2">
																		<label>SONG TEMPO:</label>
																	</div>
																	<div class="col-md-2">
																		<span class="BPM-input"><input type="text" name="SongTempo-<?php echo $SNo; ?>" value="" placeholder="" required="" /></span>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-offset-3 col-md-9">
																		<div class="radio-button">
																			<input type="radio" required="" name="MasteringType-<?php echo $SNo; ?>" class="mastering-type" id="radio-button-<?php echo $SNo; ?>" checked="checked" value="Sterio (50)" data-price="50" />
																			<label class="check-btn-label" for="radio-button-<?php echo $SNo; ?>"></label>
																			<label for="radio-button-<?php echo $SNo; ?>">STEREO MASTERING ($50)</label>
																		</div>
																		<div class="radio-button">
																			<input type="radio" required="" name="MasteringType-<?php echo $SNo; ?>" class="mastering-type" id="radio-button-2-<?php echo $SNo; ?>" value="Stem (150)" data-price="150" />
																			<label class="check-btn-label" for="radio-button-2-<?php echo $SNo; ?>"></label>
																			<label for="radio-button-2-<?php echo $SNo; ?>">STEM MASTERING ($150)</label>
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-md-12 text-center">
																		<p>For Stereo Mastering - upload a zip file (or .rar) of your single .wav file mixdown with at least 3 db of headroom. (make sure the loudest part of your mix doesn’t go over -3db in volume). For Stem Mastering - upload a zip (or .rar) file with up to 12 stems of your mixdown and at least 3 db of headroom.</p>
																	</div>
																</div>
																<div class="upload-track-div">
																	<div class="row upload-track-file" id="upload-track-1">
																		<div class="col-md-3">
																			<label>UPLOAD TRACK <strong class="song-count">01</strong>: *</label>
																		</div>
																		<div class="col-md-9">
																			<div class="row">
																				<div class="col-md-8">
																					<div class="input-file-div">
																						<input type="file" name="ProjectFile-<?php echo $SNo; ?>[]" id="MasteringTrack-<?php echo $SNo; ?>-1" class="inputfile" data-multiple-caption="{count} files selected" multiple accept=".rar,.zip" required="" />
																						<label for="MasteringTrack-<?php echo $SNo; ?>-1"><span>&nbsp;</span> <strong> BROWSE</strong></label>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="add-more-btn-div" style="display:none;">
																	<div class="row">
																		<div class="col-md-offset-3 col-md-2">
																			<a class="button btn button_size_5 button_js bg-gold-two" onclick="addMoreTrackUpToFour(this)" href="javascript:;"><span class="button_label"><i class="fa fa-plus"></i> ADD MORE</span></a>
																		</div>
																		<div class="col-md-7">
																			<label class="info-label"><i class="fa fa-info-circle"></i>ADD MORE TRACKS:<span>EACH EXTRA track WILL BE CHARGED AT $10 PER TRACK</span></label>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>