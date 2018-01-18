<?php

function mixing_mastering_order() {
?>
    <link type="text/css" href="<?php echo plugins_url(); ?>/mixing_mastering/css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" href="<?php echo plugins_url(); ?>/mixing_mastering/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo plugins_url(); ?>/mixing_mastering/js/jquery.dataTables.min.js" rel="stylesheet" ></script>
<div class="wrap">
	<?php
	global $con;
    global $wpdb;
	$uploadDir = get_template_directory_uri().'/uploads/projectfiles/';
	$PostID = (isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0);
	$query = "SELECT ID, ArtistName, TotalPackages, Price, Paid, DATE_FORMAT(DateAdded, '%Y/%m/%d %h:%i %p') AS DateAdded, DATE_FORMAT(DateModified, '%Y/%m/%d %h:%i %p') AS DateModified, DATE_FORMAT(DateAdded, '%Y-%m-%d') AS DateAddedDisp, DATE_FORMAT(DateModified, '%Y-%m-%d %h:%i %p') AS DateModified FROM ".$wpdb->prefix . "mixing_mastering WHERE ID = '".($PostID)."'";
	$res = mysqli_query($con, $query) or die(mysqli_error($con));
	if(mysqli_num_rows($res) > 0){
		while($row = mysqli_fetch_array($res)){
		?>
	<div id="poststuff">
		<div id="post-body">
			<div class="postbox-container">
				<h1 class=""><span>Mixing & Mastering Orders [<?php echo $row["ArtistName"]; ?>]</span></h1>
				<div class="meta-box">
					<div id="mymetabox_revslider_0" class="postbox ">
						<div class="inside">
							<h1 class=""><span>Order Info.</span></h1>
							<div class="row">
								<div class="col-md-4 text-right">
									<h3>Artist Name:</h3>
								</div>
								<div class="col-md-6">
									<h3><strong><?php echo $row["ArtistName"]; ?></strong></h3>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 text-right">
									<h3>Total Packages:</h3>
								</div>
								<div class="col-md-6">
									<h3><strong><?php echo $row["TotalPackages"]; ?></strong></h3>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 text-right">
									<h3>Price:</h3>
								</div>
								<div class="col-md-6">
									<h3><strong>$<?php echo $row["Price"]; ?></strong></h3>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 text-right">
									<h3>Payment Status:</h3>
								</div>
								<div class="col-md-6">
									<h3><strong><?php echo ($row["Paid"] == 0 ? 'Unpaid' : 'Paid'); ?></strong></h3>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 text-right">
									<h3>Order Date:</h3>
								</div>
								<div class="col-md-6">
									<h3><strong><?php echo $row["DateAdded"]; ?></strong></h3>
								</div>
							</div>
						</div>
					</div>
						<h1 class=""><span><br/><br/>Order Details</span></h1>
						<?php
							$query2 = "SELECT *, DATE_FORMAT(DateAdded, '%Y-%m-%d %h:%i %p') AS DateAdded FROM ".$wpdb->prefix . "mixing_mastering_details WHERE ServiceID = '".($PostID)."'";
							$res2 = mysqli_query($con, $query2) or die(mysqli_error($con));
								while($row2 = mysqli_fetch_array($res2)){
						?>
					<div id="mymetabox_revslider_0" class="postbox ">
						<div class="inside">
							<h1 class=""><?php echo $row2["ServiceName"]; ?></h1>
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-4 text-right">
											<h3>Song Name:</h3>
										</div>
										<div class="col-md-6">
											<h3><strong><?php echo $row2["SongName"]; ?></strong></h3>
										</div>
									</div>
								</div>
<?php if($row2["MasteringType"] != "") { ?>
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-4 text-right">
											<h3>Mastering Type:</h3>
										</div>
										<div class="col-md-6">
											<h3><strong><?php echo $row2["MasteringType"]; ?></strong></h3>
										</div>
									</div>
								</div>
<?php } ?>
<?php if($row2["NoOfStem"] != 0) { ?>
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-4 text-right">
											<h3>No. Of Stem:</h3>
										</div>
										<div class="col-md-6">
											<h3><strong><?php echo $row2["NoOfStem"]; ?></strong></h3>
										</div>
									</div>
								</div>
<?php } ?>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-4 text-right">
											<h3>Song Key:</h3>
										</div>
										<div class="col-md-6">
											<h3><strong><?php echo $row2["SongKey"]; ?></strong></h3>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-4 text-right">
											<h3>Song Tempo:</h3>
										</div>
										<div class="col-md-6">
											<h3><strong><?php echo $row2["SongTempo"]; ?></strong></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-4 text-right">
											<h3>Price:</h3>
										</div>
										<div class="col-md-6">
											<h3><strong>$<?php echo $row2["Price"]; ?></strong></h3>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-4 text-right">
											<h3>Files:</h3>
										</div>
										<div class="col-md-6">
						<?php
							$query3 = "SELECT *, DATE_FORMAT(DateAdded, '%Y-%m-%d %h:%i %p') AS DateAdded FROM ".$wpdb->prefix . "mixing_mastering_files WHERE ServiceID = '".($PostID)."' AND ServiceDetailsID = '".($row2["ID"])."'";
							$res3 = mysqli_query($con, $query3) or die(mysqli_error($con));
								while($row3 = mysqli_fetch_array($res3)){
						?>
											<p><strong><a href="<?php echo $row3["FileLink"]; ?>" target="_blank"><?php echo $row3["FileName"]; ?></strong></a></p>
						<?php
								}
						?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
						<?php
								}
						?>
				</div>
			</div>
		</div>
	</div>
		<h1></h1>
		<hr class="wp-header-end">
		<h3><p></p></h3>
		
		<?php
		}
	}
	else{
		echo "<meta http-equiv='refresh' content='0;url=".admin_url()."admin.php?page=mixing_mastering'>";
		exit();
	}
?>
</div>
<?php
}