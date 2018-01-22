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
																			MIXING
																			<input type="hidden" name="TotalPackages[]" value="<?php echo $SNo; ?>" />
																			<input type="hidden" name="ServiceName[]" value="Mixing" />
																			<input type="hidden" name="ServiceName-<?php echo $SNo; ?>" value="Mixing" />
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
																		<label>No. OF STEMS: *</label>
																	</div>
																	<div class="col-md-2">
																		<select class="NoOfStem" name="NoOfStem-<?php echo $SNo; ?>">
																			<?php for($i = 1; $i <= 60; $i++){ ?>
																			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
																			<?php } ?>
																		</select>
																	</div>
																	<div class="col-md-5">
																		<label for="NoOfStem-<?php echo $SNo; ?>" class="info-label"><i class="fa fa-info-circle"></i>PRICE RANGE:<span class="currently">You are currently in 01-03 tracks rates of $50</span></label>
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
																	<div class="col-md-3">
																		<label>UPLOAD FILE:</label>
																	</div>
																	<div class="col-md-9">
																		<div class="row">
																			<div class="col-md-8">
																				<div class="input-file-div">
																					<input type="file" name="ProjectFile-<?php echo $SNo; ?>[]" id="MixingFile-<?php echo $SNo; ?>" class="inputfile" data-multiple-caption="{count} files selected" accept=".rar,.zip" required="" />
																					<label for="MixingFile-<?php echo $SNo; ?>"><span>&nbsp;</span> <strong> BROWSE</strong></label>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<label class="info-label"><i class="fa fa-info-circle"></i>PROJECT FOLDER:<span>ARCHIVED AS .ZIP or .RAR</span></label>
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
									</div>