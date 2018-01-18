<?php
/**
 * Template Name: Mixing Template
 *
 * @package Betheme
 * @author Muffin group
 * @link http://muffingroup.com
 */
 

get_header();
?>
<link href="<?php echo plugins_url(); ?>/mixing_mastering/css/style.css" rel="stylesheet" >
	

<!-- #Content -->
<div id="Content">
	<div class="content_wrapper clearfix">

		<!-- .sections_group -->
		<div class="sections_group">
		
			<div class="entry-content" itemprop="mainContentOfPage">
			
				<?php 
					while ( have_posts() ){
						the_post();							// Post Loop
						?>
						<div class="">
							<div class="section">
								<form name="mixing_form" id="mixing_form" method="post" action="" enctype="multipart/form-data">
									<input type="hidden" name="action" id="action" value="mixing_mastering_submit">
									<div class="container">
										<div class="row">
											<div class="wrap mcb-wrapcol-md-12 valign-top clearfix" style=""  >
												<div class="mcb-wrap-inner">
													<div class="column mcb-column one-sixth column_placeholder">
														<div class="placeholder">&nbsp;</div>
													</div>
													<div class="column mcb-column two-third column_column  column-margin-">
														<div class="column_attr clearfix align_center"  style="">
															<blockquote class="about-quote">Please fill out the form below</blockquote>
														</div>
													</div>
													<div class="column mcb-column one-sixth column_placeholder">
														<div class="placeholder">&nbsp;</div>
													</div>
												</div>
											</div>
											<div class="wrap mcb-wrapcol-md-12 valign-top clearfix" style=""  >
												<div class="mcb-wrap-inner">
													<div class="column mcb-column col-md-12 column_column  column-margin-">
														<div class="column_attr clearfix align_center"  style="">
															<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque <br />penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu!.</p>
														</div>
													</div>
												</div>
											</div>
											<div class="wrap mcb-wrap col-md-12 valign-top clearfix" style=""  >
												<div class="mcb-wrap-inner">
													<div class="column mcb-columncol-md-12column_column  column-margin-">
														<div class="column_attr clearfix"  style=""></div>
													</div>
												</div>
											</div>
											<div class="wrap mcb-wrap col-md-12 valign-top clearfix" style=""  >
												<div class="mcb-wrap-inner">
													<div class="column mcb-columncol-md-12column_column  column-margin-">
														<div class="column_attr clearfix"  style=""></div>
													</div>
												</div>
											</div>
											<div class="wrap mcb-wrap col-md-12  valign-top clearfix" style="">
												<div class="mcb-wrap-inner video-graphy-form">
													<div class="column mcb-column col-md-12 column_column  column-margin-">
														<div class="column_attr clearfix" style="">
															<h2 class="section-heading-style">ARTIST INFORMATION</h2>
														</div>
													</div>
													<div class="column mcb-column col-md-12 column_column column-margin-">
														<div class="column_attr clearfix" style="">
															<div class="row">
																<div class="col-md-2">
																	<label>NAME: *</label>
																</div>
																<div class="col-md-4">
																	<input type="text" name="ArtistName" value="" class="" required="" />
																</div>
															</div>
															<div class="row">
																<div class="col-md-2">
																	<label>ADD SONG:<span class="fs-9">Select what do you need</span></label>
																</div>
																<div class="col-md-10">
																	<a class="button btn button_size_5 button_js bg-gold-one" href="javascript:;" onclick="addContent('mixing');" ><span class="button_label">MIXING</span></a>
																	<a class="button btn button_size_5 button_js bg-gold-two" href="javascript:;" onclick="addContent('mastering');" ><span class="button_label">MASTERING</span></a>
																	<a class="button btn button_size_6 button_js bg-gold-two" href="javascript:;" onclick="addContent('complete');" ><span class="button_label">COMPLETE<br/>PACKAGE</span></a>
																	<label class="info-label"><i class="fa fa-info-circle"></i>COMPLETE PACKAGE:<span>SAVE $10 oN MIXING & MASTERING BOTH</span></label>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="services-add-remove-section">
									
									</div>
									<div class="summary-section">
										<div class="container">
											<div class="row">
												<div class="wrap mcb-wrap col-md-12 valign-top clearfix" style="">
													<div class="mcb-wrap-inner video-graphy-form">
														<div class="col-md-12">
															<div class="column_attr clearfix" style="">
																<div class="row">
																	<div class="col-md-offset-1 col-md-11">
																		<h2 class="section-heading-style">
																			ORDER OVERVIEW
																		</h2>
																		<p>Please check your order details below and confirm:</p>
																		<div class="row">
																			<div class="col-md-5 table-responsive">
																				<table class="table summary-table">
																					<!--
																					<tr>
																						<td class="text-left"><strong>SONG <strong class="song-count">01</strong></strong> MIXING (01 - 10 STEMS)</td>
																						<td class="text-right"><strong>$0</strong></td>
																					</tr>
																					<tr>
																						<td class="text-left"><strong>SONG <strong class="song-count">02</strong></strong> MASTERING (04 TRACKS)</td>
																						<td class="text-right"><strong>$50</strong></td>
																					</tr>
																					-->
																				</table>
																				<table class="table">
																					<tr>
																						<td class="text-right" colspan="3">
																							<div class="separator"><hr/></div>
																							<strong>TOTAL: $<strong class="grand-total-price">0</span></strong>
																							<input type="hidden" name="GrandTotal" class="GrandTotal" value="0" />
																						</td>
																					</tr>
																				</table>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-12">
																		<div class="checkbox-button agree-to-terms">
																			<input type="checkbox" required="" name="IAgree" class="" id="checkbox-button-agree" value="1" />
																			<label class="check-btn-label" for="checkbox-button-agree"></label>
																			<label for="checkbox-button-agree">I agree to the Terms &amp; Conditions.</label>
																		</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-12">
																				<input type="submit" value="ORDER NOW" class="submit-form" />
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-12">
																				<div id="responseMessage"></div>
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
								</form>
<?php
global $wpdb;
$mylink = $wpdb->get_row( "SELECT PaypalEmail, IdentityToken FROM " . $wpdb->prefix . "mixing_mastering_settings WHERE ID<>0 LIMIT 1");
?>
								<form name="paypalForm" id="paypalForm" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
								<input name="business" value="<?php echo $mylink->PaypalEmail; ?>" type="hidden">
								<input name="cmd" value="_xclick" type="hidden">
								<input name="tx" value="4U3114973X461690U" type="hidden">
								<input name="at" value="<?php echo $mylink->IdentityToken; ?>" type="hidden">
								<input name="item_name" value="Recording Studio Appointement" type="hidden">
								<input name="amount" id="amount" class="GrandTotal" value="0" type="hidden">
								<input name="currency_code" value="USD" type="hidden">
								<input name="handling" value="0" type="hidden">
								<input name="cancel_return" value="<?php global $wp; echo home_url(add_query_arg(array(),$wp->request)); ?>" type="hidden">
								<input name="return" id="return_paypal" value="<?php echo plugins_url(); ?>/mixing_mastering/process.php" type="hidden">
								<button type="submit" name="submit" id="submit" alt="PayPal - The safer, easier way to pay online!" value="Pay" class="btnproceed main-button">
								Pay
								</button>
								</form>
							</div>
						<?php
						mfn_builder_print( get_the_ID() );	// Content Builder & WordPress Editor Content
					}
				?>
				
				<div class="section section-page-footer">
					<div class="section_wrapper clearfix">
					
						<div class="column one page-pager">
							<?php
								// List of pages
								wp_link_pages(array(
									'before'			=> '<div class="pager-single">',
									'after'				=> '</div>',
									'link_before'		=> '<span>',
									'link_after'		=> '</span>',
									'next_or_number'	=> 'number'
								));
							?>
						</div>
						
					</div>
				</div>
				
			</div>
			
			<?php if( mfn_opts_get('page-comments') ): ?>
				<div class="section section-page-comments">
					<div class="section_wrapper clearfix">
					
						<div class="column one comments">
							<?php comments_template( '', true ); ?>
						</div>
						
					</div>
				</div>
			<?php endif; ?>
	
		</div>
		
		<!-- .four-columns - sidebar -->
		<?php get_sidebar(); ?>

	</div>
</div>
<?php get_footer();

// Omit Closing PHP Tags

?>
<script>
	(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);
	
</script>