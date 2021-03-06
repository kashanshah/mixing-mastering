<?php
/*
Plugin Name: Mixing & Mastering
Description: This is the plugin developed for Mixing & Mastering Page.
Version: 0.9.1
Author: craftedium.xyz
Author URI: http://craftedium.xyz
*/

header("HTTP/1.1 200 OK");
global $con;
$localhost = DB_HOST;
$user = DB_USER;
$password = DB_PASSWORD;
$db = DB_NAME;
$con = mysqli_connect($localhost,$user,$password,$db);



// function to create the DB / Options / Defaults					
function mixing_mastering_install() {
    global $wpdb, $wnm_db_version;

    $sql = array();

    //sms table
    $sms_table = $wpdb->prefix . "mixing_mastering";

    if( $wpdb->get_var("show tables like '". $sms_table . "'") !== $sms_table ) { 

    $sql[] = "CREATE TABLE `".$sms_table . "` (
	 `ID` int(11) NOT NULL AUTO_INCREMENT,
	 `ArtistName` text NOT NULL,
	 `TotalPackages` int(11) NOT NULL,
	 `Price` float NOT NULL,
	 `Paid` int(11) NOT NULL DEFAULT '0',
	 `DateAdded` datetime NOT NULL,
	 `DateModified` datetime NOT NULL,
	 PRIMARY KEY (`ID`)
	)";


    }

    //sms messages table
    $sms_message_table = $wpdb->prefix . "mixing_mastering_details";

    if( $wpdb->get_var("show tables like '". $sms_message_table . "'") !== $sms_message_table ) { 

    $sql[] = "CREATE TABLE `".$sms_message_table . "` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `ServiceID` int(11) NOT NULL,
 `ServiceName` text NOT NULL,
 `SongName` text NOT NULL,
 `NoOfStem` text NOT NULL,
 `SongKey` text NOT NULL,
 `SongTempo` text NOT NULL,
 `MasteringType` text NOT NULL,
 `Price` float NOT NULL,
 `Status` int(11) NOT NULL,
 `DateAdded` datetime NOT NULL,
 PRIMARY KEY (`ID`)
)";
    }

    //sms messages table
    $sms_message_table = $wpdb->prefix . "mixing_mastering_files";

    if( $wpdb->get_var("show tables like '". $sms_message_table . "'") !== $sms_message_table ) { 

    $sql[] = "CREATE TABLE `".$sms_message_table . "` (
 `ID` int(11) NOT NULL AUTO_INCREMENT,
 `ServiceID` int(11) NOT NULL,
 `ServiceDetailsID` int(11) NOT NULL,
 `FileName` text NOT NULL,
 `FileLink` text NOT NULL,
 `DateAdded` datetime NOT NULL,
 PRIMARY KEY (`ID`)
)";
    }

    //sms messages table
    $sms_message_table = $wpdb->prefix . "mixing_mastering_settings";

    if( $wpdb->get_var("show tables like '". $sms_message_table . "'") !== $sms_message_table ) { 

    $sql[] = "CREATE TABLE `".$sms_message_table . "` (
  `ID` int(11) NOT NULL,
  `PaypalEmail` text NOT NULL,
  `IdentityToken` text NOT NULL,
  `DateModified` datetime NOT NULL
)";
    $sql[] = "INSERT INTO `".$sms_message_table . "` (`ID`, `PaypalEmail`, `IdentityToken`, `DateModified`) VALUES
(1, 'l2000830-facilitator@mvrht.com', 'FEXgQtbIyylwRtbKwc3R0HVyyFM4OzNBEvviqqyE5a5lDwI4DJPiHDM81Qa', NOW());";

    }


    if ( !empty($sql) ) {

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        dbDelta($sql);
        add_option("wnm_db_version", $wnm_db_version);

    }
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'mixing_mastering_install');

//menu items
add_action('admin_menu','mixing_mastering_modifymenu');
function mixing_mastering_modifymenu() {
    global $con;
    global $wpdb;
	
	//this is the main item for the menu
	add_menu_page('Mixing & Mastering', //page title
	'Mixing & Mastering', //menu title
	'manage_options', //capabilities
	'mixing_mastering', //menu slug
	'mixing_mastering_main', //function
	'dashicons-playlist-audio' //icon
	);
	
	//this is a submenu
	add_submenu_page('mixing_mastering', //parent slug
	'View Order Details', //page title
	'', //menu title
	'manage_options', //capability
	'mixing_mastering_order', //menu slug
	'mixing_mastering_order'); //function

	add_submenu_page('mixing_mastering', //parent slug
	'Settings', //page title
	'Settings', //menu title
	'manage_options', //capability
	'mixing_mastering_settings', //menu slug
	'mixing_mastering_settings'); //function
	
}

function count_mixing_masterings($type){
	global $con;
    global $wpdb;
	$query = "SELECT COUNT(ID) AS CountID FROM ".$wpdb->prefix . "mixing_mastering";
	if($type == 1)
		$query .= " WHERE Paid = 1";
	if($type == 0)
		$query .= " WHERE Paid = 0";
	$res = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($res);
	return $row["CountID"];
}


add_shortcode( 'craftedium-mixing-mastering', 'creating_shortcode_for_mixing' );
function creating_shortcode_for_mixing()
{
?>
<link href="<?php echo plugins_url(); ?>/mixing_mastering/css/style.css" rel="stylesheet" >
							<div class="section">
								<form name="mixing_form" id="mixing_form" method="post" action="" enctype="multipart/form-data">
									<input type="hidden" name="action" id="action" value="mixing_mastering_submit">
									<div class="container">
										<div class="row">
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
	add_action( 'wp_footer', 'my_plugin_enable_ajax' );
}
function my_plugin_enable_ajax() {
     ?> 
        <script>
	var addMoreTrackCounter = 1;
	var SNo = 0;
	var trackCounter = 2;
	jQuery("body").on("click", ".deleteThisService", function(){
		jQuery(this).closest(".services-add-remove").remove();
		updateEverything();
	}).on('submit', '#mixing_form', function(e){
		e.preventDefault();
		console.log(jQuery("#mixing_form").serialize());
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		jQuery.ajax({
			type: 'POST',
			url : ajaxurl,
			timeout: 10000,
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			beforeSend: function () {
				jQuery(".submit-form").attr('disabled', 'disabled');
				jQuery(".submit-form").addClass('disabled');
				jQuery("#showloading").fadeIn();
			},
			success : function(data) {
				if(jQuery.isNumeric(data)){
					jQuery("#responseMessage").html('');
					jQuery("#return_paypal").val(ajaxurl + '?action=payViaPaypal&ServiceID='+data);
					jQuery("#paypalForm #submit").click();
				}
				else{
					jQuery(".submit-form").removeAttr('disabled');
					jQuery(".submit-form").removeClass('disabled');
					jQuery("#responseMessage").html(data);
					jQuery("#showloading").fadeOut();
				}
			},
			error: function(data){
				jQuery(".submit-form").removeAttr('disabled');
				jQuery(".submit-form").removeClass('disabled');
				jQuery("#showloading").fadeOut();
			}
		});
	}).on('change', 'select.NoOfStem, .mastering-type', function(){
		var addMasteringTypePrice = 0;
		var parentDiv = jQuery(this).closest(".services-add-remove");
		var Val = parentDiv.find('select.NoOfStem').val();
		var KeyOfStem = parentDiv.find('select.NoOfStem').attr("name");
		var SongSNo = parentDiv.find('input[name="TotalPackages[]"]').val();
		var addOrNot = 0;
		if(parentDiv.find('.mastering-type:checked').length){
			addMasteringTypePrice = parentDiv.find('.mastering-type:checked').data("price");
			if(addMasteringTypePrice == 50){
				parentDiv.find('.upload-track-div .upload-track-file:not(#upload-track-1)').each(function(){
					jQuery(this).find('a[onclick="removeTrackCounter(this);"]').click();
				});
				// parentDiv.find('.add-more-btn-div').slideUp();
				updateSongCount(".upload-track-div", "");
			}
			else{
				// parentDiv.find('.add-more-btn-div').slideDown();
			}
			parentDiv.find('input[name="songPrice-'+SongSNo+'"]').val(addMasteringTypePrice);
		}
		addOrNot = addMasteringTypePrice;
		if(parentDiv.find('input[name="ServiceName[]"]').val() == "Complete Package"){
			addOrNot = addOrNot;
		}
		if(Val >= 1 && Val <= 3){
			jQuery('label[for="'+KeyOfStem+'"] .currently').text("You are currently in 01-03 tracks rates of $50");
			jQuery(this).closest(".services-add-remove").find('input[name="songPrice-'+SongSNo+'"]').val(50 + addOrNot);
		}
		else if(Val == 4){
			jQuery('label[for="'+KeyOfStem+'"] .currently').text("You are currently in 04 tracks rates of $60");
			jQuery(this).closest(".services-add-remove").find('input[name="songPrice-'+SongSNo+'"]').val(60 + addOrNot);
		}
		else if(Val == 5){
			jQuery('label[for="'+KeyOfStem+'"] .currently').text("You are currently in 05 tracks rates of $70");
			jQuery(this).closest(".services-add-remove").find('input[name="songPrice-'+SongSNo+'"]').val(70 + addOrNot);
		}
		else if(Val == 6){
			jQuery('label[for="'+KeyOfStem+'"] .currently').text("You are currently in 06 tracks rates of $80");
			jQuery(this).closest(".services-add-remove").find('input[name="songPrice-'+SongSNo+'"]').val(80 + addOrNot);
		}
		else if(Val == 7){
			jQuery('label[for="'+KeyOfStem+'"] .currently').text("You are currently in 07 tracks rates of $90");
			jQuery(this).closest(".services-add-remove").find('input[name="songPrice-'+SongSNo+'"]').val(90 + addOrNot);
		}
		else if(Val == 8){
			jQuery('label[for="'+KeyOfStem+'"] .currently').text("You are currently in 08 tracks rates of $100");
			jQuery(this).closest(".services-add-remove").find('input[name="songPrice-'+SongSNo+'"]').val(100 + addOrNot);
		}
		else if(Val == 9){
			jQuery('label[for="'+KeyOfStem+'"] .currently').text("You are currently in 09 tracks rates of $110");
			jQuery(this).closest(".services-add-remove").find('input[name="songPrice-'+SongSNo+'"]').val(110 + addOrNot);
		}
		else if(Val == 10){
			jQuery('label[for="'+KeyOfStem+'"] .currently').text("You are currently in 10 tracks rates of $119");
			jQuery(this).closest(".services-add-remove").find('input[name="songPrice-'+SongSNo+'"]').val(119 + addOrNot);
		}
		else if(Val >= 11 && Val <= 20){
			jQuery('label[for="'+KeyOfStem+'"] .currently').text("You are currently in 11-20 tracks rates of $139");
			jQuery(this).closest(".services-add-remove").find('input[name="songPrice-'+SongSNo+'"]').val(139 + addOrNot);
		}
		else if(Val >= 21 && Val <= 30){
			jQuery('label[for="'+KeyOfStem+'"] .currently').text("You are currently in 21-30 tracks rates of $159");
			jQuery(this).closest(".services-add-remove").find('input[name="songPrice-'+SongSNo+'"]').val(159 + addOrNot);
		}
		else if(Val >= 31 && Val <= 40){
			jQuery('label[for="'+KeyOfStem+'"] .currently').text("You are currently in 31-40 tracks rates of $179");
			jQuery(this).closest(".services-add-remove").find('input[name="songPrice-'+SongSNo+'"]').val(179 + addOrNot);
		}
		else if(Val >= 41 && Val <= 50){
			jQuery('label[for="'+KeyOfStem+'"] .currently').text("You are currently in 41-50 tracks rates of $199");
			jQuery(this).closest(".services-add-remove").find('input[name="songPrice-'+SongSNo+'"]').val(199 + addOrNot)
		}
		else if(Val >= 51 && Val <= 60){
			jQuery('label[for="'+KeyOfStem+'"] .currently').text("You are currently in 41-60 tracks rates of $219");
			jQuery(this).closest(".services-add-remove").find('input[name="songPrice-'+SongSNo+'"]').val(219 + addOrNot);
		}
		updateEverything();
	});
	function updateSongCount(parentDivName = ".section-heading-style", prefix = "SONG "){
		var test = 0;
		jQuery(parentDivName+" .song-count").each(function(){
			test++;
			jQuery(this).html(prefix+test);
		});
	}
	function addContent(fileName = 'mixing'){
		SNo++;
		jQuery.get( "<?php echo plugins_url(); ?>/mixing_mastering/page-template/template-data-"+fileName+".php?SNo="+SNo, function( data ) {
			jQuery( ".services-add-remove-section" ).append( data );
			updateEverything();
		});
	}
	function removeTrackCounter(thiss){
		var parentDiv = jQuery(thiss).closest(".services-add-remove");
		addMoreTrackCounter--;
		// jQuery(".add-more-btn-div").slideDown();
		parentDiv.find(".TotalPrice").val(parseInt(parentDiv.find(".TotalPrice").val()) - 10)
		jQuery(thiss).closest(".upload-track-file").remove();
		updateEverything();
		updateSongCount(".upload-track-div", "")
	}
	function addMoreTrackUpToFour(thiss){
		if(addMoreTrackCounter < 12)
		{
			var parentDiv = jQuery(thiss).closest(".services-add-remove");
			addMoreTrackCounter++;
			parentDiv.find(".TotalPrice").val(parseInt(parentDiv.find(".TotalPrice").val()) + 10)
			console.log(parentDiv.find(".TotalPrice").val());
			parentDiv.find(".upload-track-div").append('<div class="row upload-track-file" id="upload-track-'+trackCounter+'"><div class="col-md-3"><label>UPLOAD TRACK <strong class="song-count">'+addMoreTrackCounter+'</strong>: *</label></div><div class="col-md-9"><div class="row"><div class="col-md-8"><div class="input-file-div"><input type="file" name="ProjectFile-'+parentDiv.find('input[name="TotalPackages[]"]').val()+'[]" id="MasteringTrack-'+parentDiv.find('input[name="TotalPackages[]"]').val()+'-'+trackCounter+'" class="inputfile" data-multiple-caption="{count} files selected" multiple accept=".rar,.zip" required="" /><label for="MasteringTrack-'+parentDiv.find('input[name="TotalPackages[]"]').val()+'-'+trackCounter+'"><span>&nbsp;</span> <strong> BROWSE</strong></label><a href="javascript:;" onclick="removeTrackCounter(this);"><i class="fa fa-times"></i></a></div></div></div></div></div>');
		}
		if(addMoreTrackCounter > 12 || addMoreTrackCounter == 12){
			// jQuery(".add-more-btn-div").slideUp();
		}
		updateEverything();
		trackCounter++;
	}
	function updateEverything(){
		updateSongCount(".section-heading-style");
		jQuery(".summary-table").html('');
		var grandTotal = 0;
		jQuery('input[name="TotalPackages[]"]').each(function(){
			var parentDiv = jQuery(this).closest(".services-add-remove");
			if(parentDiv.find('input[name="ServiceName[]"]').val() != "Complete Package"){
				jQuery(".summary-table").append('<tr><td class="text-left"><strong><strong class="song-count"></strong></strong> </td><td class="text-left">'+parentDiv.find('input[name="ServiceName[]"]').val()+'</td><td class="text-right"><strong>$'+parentDiv.find(".TotalPrice").val()+'</strong></td></tr>');
			}
			else{
				jQuery(".summary-table").append('<tr><td class="text-left"><strong><strong class="song-count"></strong></strong></td><td class="text-left">COMPLETE PACKAGE </td><td class="text-right"></td></tr><tr><td></td><td class="text-left">MIXING </td><td class="text-right"><strong>$'+parseInt(parseInt(parentDiv.find(".TotalPrice").val()) - parseInt(parentDiv.find(".mastering-type:checked").data("price")))+'</strong></td></tr><tr><td></td><td class="text-left">MASTERING (SAVE $10) </td><td class="text-right"><strong>$'+parseInt(parentDiv.find(".mastering-type:checked").data("price"))+'</strong></td></tr>');
			}
			grandTotal = parseInt(grandTotal) + parseInt(parentDiv.find(".TotalPrice").val());
		});
		jQuery(".grand-total-price").text(grandTotal);
		jQuery('input.GrandTotal').val(grandTotal);
		updateSongCount(".summary-table");
	}
        </script>

     <?php
}
	

define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'orders-list.php');
require_once(ROOTDIR . 'order-details.php');
require_once(ROOTDIR . 'plugin-settings.php');



add_action( 'wp_ajax_payViaPaypal', 'payViaPaypal' );
add_action( 'wp_ajax_nopriv_payViaPaypal', 'payViaPaypal' );
function payViaPaypal() {
	global $wpdb; // this is how you get access to the database
	global $con;
	$ServiceID = isset($_REQUEST["ServiceID"]) ? $_REQUEST["ServiceID"] : 0;
	$wpdb->update( $wpdb->prefix . "mixing_mastering", array('Paid' => '1'), array('ID' => (int)$ServiceID) ); 
	wp_redirect(site_url()."/order-placed/");
	exit();
}
function reArrayFiles(&$file_post) {
    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);
    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}
function dbinput($str){
	return $str;
}

add_action( 'wp_ajax_mixing_mastering_submit', 'mixing_mastering_submit' );
add_action( 'wp_ajax_nopriv_mixing_mastering_submit', 'mixing_mastering_submit' );
function mixing_mastering_submit() {
	global $wpdb; // this is how you get access to the database
	global $con;

if(isset($_POST["action"]) && $_POST["action"] == "mixing_mastering_submit"){
	if(!isset($_POST["TotalPackages"]) || empty($_POST["TotalPackages"]) )
	{
		echo '<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-times-circle"></i>&nbsp; Please select any package from Mixing / Mastering ? Complete Package.</div>';
		wp_die('');
	}
	$uploads = wp_upload_dir();
	$uploadDirPhy = $uploads['path'];
	$uploadDir = $uploads['url'];
	foreach($_REQUEST as $key => $val)
		$$key = $val;
	$query = "INSERT INTO ".$wpdb->prefix . "mixing_mastering SET
		ArtistName = '".dbinput($ArtistName)."',
		TotalPackages = '".(int)sizeof($TotalPackages)."',
		Price = '".(float)($GrandTotal)."',
		DateAdded = NOW()
	";
	mysqli_query($con, $query) or die(mysqli_error($con));
	$ServiceID = mysqli_insert_id($con);
	foreach($_REQUEST['TotalPackages'] as $SerialNo){
		$ServiceName = "ServiceName-".$SerialNo;
		$SongName = "SongName-".$SerialNo;
		$NoOfStem = "NoOfStem-".$SerialNo;
		$SongKey = "SongKey-".$SerialNo;
		$SongTempo = "SongTempo-".$SerialNo;
		$MasteringType = "MasteringType-".$SerialNo;
		$Price = "songPrice-".$SerialNo;
		$query = "INSERT INTO ".$wpdb->prefix . "mixing_mastering_details SET
			ServiceID = '".(int)$ServiceID."',
			ServiceName = '".dbinput( isset($$ServiceName) ? $$ServiceName : '' )."',
			SongName = '".dbinput( isset($$SongName) ? $$SongName : '' )."',
			NoOfStem = '".(int)( isset($$NoOfStem) ? $$NoOfStem : 0 )."',
			SongKey = '".dbinput( isset($$SongKey) ? $$SongKey : '' )."',
			SongTempo = '".dbinput( isset($$SongTempo) ? $$SongTempo : '' )."',
			MasteringType = '".dbinput( isset($$MasteringType) ? $$MasteringType : '' )."',
			Status = '0',
			Price = '".(float)( isset($$Price) ? $$Price : 0 )."',
			DateAdded = NOW()
		";
		mysqli_query($con, $query) or die(mysqli_error($con));
		$ServiceDetailsID = mysqli_insert_id($con);
		$FilesArr = isset($_FILES["ProjectFile-".$SerialNo]) ? reArrayFiles($_FILES["ProjectFile-".$SerialNo]) : null;
		if(empty($FilesArr)){
			echo '<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-times-circle"></i>&nbsp; Please upload file.</div>';
			return false;
		}
		foreach($FilesArr as $FileArr){
			$fileName = $FileArr['name'];
			$ext = explode(".",$fileName);
			$uniqId = uniqid();
			$fileLinkPhy = $uploadDirPhy . "/" .$uniqId.".".$ext[sizeof($ext) - 1];
			$fileLink = $uploadDir . "/" .$uniqId.".".$ext[sizeof($ext) - 1];
			$filesize = $FileArr['size'];
			$tmpName = $FileArr['tmp_name'];
			$filePath = $fileLink;
			$type=Array(1 => 'jpg', 2 => 'jpeg', 3 => 'png', 4 => 'gif', 5 => 'doc', 6 => 'docx', 7 => 'pdf', 8 => 'zip', 9 => 'rar', 10 => 'mp3', 11 => 'wav', 12 => 'ogg', 13 => 'mpeg');
			if($fileName != '' && !(in_array($ext[sizeof($ext) - 1],$type))){
				echo 'invalid';
			}else{
				$result = move_uploaded_file($tmpName, $fileLinkPhy);
				$query = "INSERT INTO ".$wpdb->prefix . "mixing_mastering_files SET
					ServiceID = '".(int)$ServiceID."',
					ServiceDetailsID = '".(int)$ServiceDetailsID."',
					FileName = '".dbinput($fileName)."',
					FileLink = '".dbinput($fileLink)."',
					DateAdded = NOW()
				";
				mysqli_query($con, $query) or die(mysqli_error($con));
			}
		}
	}
	echo $ServiceID;
	wp_die();
}

if($action == 'confirmAppointment'){
	$ajaxRequest = $_REQUEST["ajaxRequest"];
get_header();
get_footer();
?>
<script>
jQuery(function($){
$.getJSON( "<?php echo $ajaxRequest; ?>", function( data ) {
  var items = [];
  $.each( data, function( key, val ) {
    items.push( { message : val} );
  });
	window.location.href='<?php echo site_url(); ?>/appointment-confirmed/';
});
});
</script>
<?php
}
wp_die();
}
?>