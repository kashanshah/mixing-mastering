<?php

function mixing_mastering_settings() {
	$msg = "";
    global $wpdb;
    $table_name = $wpdb->prefix . "mixing_mastering_settings";
//update
    if (isset($_POST['action']) && $_POST['action'] == "UpdatePaypal") {
		$PaypalEmail = $_POST["PaypalEmail"];
		$IdentityToken = $_POST["IdentityToken"];
        $wpdb->update(
                $table_name, //table
                array('PaypalEmail' => $PaypalEmail, 'IdentityToken' => $IdentityToken, 'DateModified' => current_time('mysql', 1)), //data
                array('ID' => '1'), //where
                array('%s'), //data format
                array('%s') //where format
        );
		$msg = '<div id="message" class="updated notice notice-success is-dismissible"><p>Paypal Info Updated!</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
    }
//delete
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/sinetiks-schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h1>Mixing Mastering Settings</h1>
<?php
global $wpdb;
$mylink = $wpdb->get_row( "SELECT PaypalEmail, IdentityToken, Date_FORMAT(DateModified, '%Y-%m-%d %r') AS DateModified FROM " . $wpdb->prefix . "mixing_mastering_settings WHERE ID<>0 LIMIT 1");
?>
    <link type="text/css" href="<?php echo plugins_url(); ?>/mixing_mastering/css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" href="<?php echo plugins_url(); ?>/mixing_mastering/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo plugins_url(); ?>/mixing_mastering/js/jquery.dataTables.min.js" rel="stylesheet" ></script>
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
			<input type="hidden" name="action" value="UpdatePaypal"/>
			<div class="stuffbox">
				<div class="inside">
					<div class="row">
						<?php echo $msg; ?>
						<br/><br/>
						<div class="col-md-4 text-right"><h4>Paypal Email</h4></div>
						<div class="col-md-6"><input type="text" name="PaypalEmail" class="form-control" value="<?php echo $mylink->PaypalEmail; ?>"/></div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right"><h4>Paypal API Token</h4></div>
						<div class="col-md-6"><input type="text" name="IdentityToken" class="form-control" value="<?php echo $mylink->IdentityToken; ?>"/></div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right"><h4>Last Updated on</h4></div>
						<div class="col-md-6"><h4><strong><?php echo $mylink->DateModified; ?></strong></h4></div>
					</div>
					<div class="row">
						<div class="col-md-4 text-right"><h4></h4></div>
						<div class="col-md-6"><h4><strong><button type='submit' class='button btn btn-primary btn-lg'>SAVE</button></strong></h4></div>
					</div>
				</div>
			</div>
			 &nbsp;&nbsp;
		</form>
    </div>
    <?php
}