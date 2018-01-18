<?php

function mixing_mastering_main() {
    ?>
    <link type="text/css" href="<?php echo plugins_url(); ?>/mixing_mastering/css/bootstrap.min.css" rel="stylesheet" />
    <link type="text/css" href="<?php echo plugins_url(); ?>/mixing_mastering/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo plugins_url(); ?>/mixing_mastering/js/jquery.dataTables.min.js" rel="stylesheet" ></script>
<?php
	global $con;
    global $wpdb;
	$msg = "";
	if ( count($_GET) > 0 && isset($_GET['action']) && $_GET['action'] == 'delete' )
    {
		foreach($_GET["post"] as $pid)
		{
            $sql = mysqli_query($con,"DELETE FROM ".$wpdb->prefix . "mixing_mastering WHERE ID= '" . $pid . "' ");
            $sql = mysqli_query($con,"DELETE FROM ".$wpdb->prefix . "mixing_mastering_details WHERE ServiceID= '" . $pid . "' ");
            $sql = mysqli_query($con,"SELECT ID, FileLink FROM ".$wpdb->prefix . "mixing_mastering_files WHERE ServiceID= '" . $pid . "' ");
			while($r = mysqli_fetch_array($sql))
			{
				if(file_exists(TEMPLATEPATH.'/uploads/projectfiles/'.$r["FileLink"]))
					unlink(TEMPLATEPATH.'/uploads/projectfiles/'.$r["FileLink"]);
				mysqli_query($con,"DELETE FROM ".$wpdb->prefix . "mixing_mastering_files WHERE ID= '" . $r["ID"] . "' ");
			}
			$msg = '<div id="message" class="updated notice notice-success is-dismissible"><p>Selected order(s) deleted!</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
		}
    }
	?>
<div class="wrap">
	<h1>Mixing & Mastering Orders</h1>
	<hr class="wp-header-end">
	<?php echo $msg; ?>
	<h2 class="screen-reader-text">Filter posts list</h2>
	<ul class="subsubsub">
		<li class="all"><a href="admin.php?page=mixing_mastering" <?php if(!isset($_REQUEST["post_status"])) echo 'class="current""'; ?>>All <span class="count">(<?php echo count_mixing_masterings(2); ?>)</span></a> |</li>
		<li class="publish"><a <?php if(isset($_REQUEST["post_status"]) && $_REQUEST["post_status"] == "paid") echo 'class="current"'; ?> href="admin.php?page=mixing_mastering&post_status=paid">Paid <span class="count">(<?php echo count_mixing_masterings(1); ?>)</span></a></li>
		<li class="publish"><a <?php if(isset($_REQUEST["post_status"]) && $_REQUEST["post_status"] == "unpaid") echo 'class="current"'; ?> href="admin.php?page=mixing_mastering&post_status=unpaid">Unpaid <span class="count">(<?php echo count_mixing_masterings(0); ?>)</span></a></li>
	</ul>
	<form action="<?php echo admin_url(); ?>admin.php">
		<input type="hidden" name="page" value="mixing_mastering" />
		<?php
		if(isset($_REQUEST["post_status"]) && $_REQUEST["post_status"] == "paid") 
			echo '<input type="hidden" name="post_status" value="paid" />'; 
		if(isset($_REQUEST["post_status"]) && $_REQUEST["post_status"] == "unpaid") 
			echo '<input type="hidden" name="post_status" value="unpaid" />'; 
		?>
		<div class="tablenav top">
			<div class="alignleft actions bulkactions">
				<label for="bulk-action-selector-top" class="screen-reader-text">Select bulk action</label>
				<select name="action" id="bulk-action-selector-top">
					<option value="-1">Bulk Actions</option>
					<option value="delete">Move to Trash</option>
				</select>
				<input id="doaction" class="button action" value="Apply" type="submit">
			</div>
			<div class="alignleft actions">
				<label for="filter-by-service" class="screen-reader-text">Filter by Services</label>
				<select name="ServiceName" id="filter-by-service">
					<option <?php echo ((isset($_REQUEST["ServiceName"]) && $_REQUEST["ServiceName"] == "") ? 'selected=""' : ''); ?> value="">All Services</option>
					<option <?php echo ((isset($_REQUEST["ServiceName"]) && $_REQUEST["ServiceName"] == "Mixing") ? 'selected=""' : ''); ?> value="Mixing">Mixing</option>
					<option <?php echo ((isset($_REQUEST["ServiceName"]) && $_REQUEST["ServiceName"] == "Mastering") ? 'selected=""' : ''); ?> value="Mastering">Mastering</option>
					<option <?php echo ((isset($_REQUEST["ServiceName"]) && $_REQUEST["ServiceName"] == "Complete Package") ? 'selected=""' : ''); ?> value="Complete Package">Complete Package</option>
				</select>
				<input name="filter_action" id="post-query-submit" class="button" value="Filter" type="submit">
			</div>
			<br class="clear">
		</div>
		<h2 class="screen-reader-text">Posts list</h2>
		<table class="wp-list-table widefat fixed striped posts form-table">
			<thead>
			<tr>
				<td id="cb" class="manage-column column-cb check-column"><label class="screen-reader-text" for="cb-select-all-1">Select All</label><input id="cb-select-all-1" type="checkbox"></td>
				<th scope="col" id="title" class="manage-column column-title column-primary sortable desc"><span>Artist Name</span><span class="sorting-indicator"></span></th>
				<th scope="col" id="TotalPackages" class="manage-column column-TotalPackages">Total Packages</th>
				<th scope="col" id="Price" class="manage-column column-Price">Price</th>
				<th scope="col" id="PaymentStatus" class="manage-column column-PaymentStatus">Payment Status</th>
				<th scope="col" id="date" class="manage-column column-date sortable asc"><span>Date</span><span class="sorting-indicator"></span></th>
			</tr>
			</thead>

			<tbody id="the-list">
<?php
global $con;
global $wpdb;
$ConQuery = "";
if(isset($_REQUEST["post_status"]) && ($_REQUEST["post_status"] == "paid" || $_REQUEST["post_status"] == "unpaid"))
{
	if($_REQUEST["post_status"] == "paid")
		$ConQuery .= " AND Paid = 1 ";
	else if($_REQUEST["post_status"] == "unpaid")
		$ConQuery .= " AND Paid = 0 ";
}
if(isset($_REQUEST["ServiceName"]))
{
	$ConQuery .= " AND ServiceName = '".mysqli_real_escape_string($con, $_REQUEST["ServiceName"])."' ";
}
$query = "SELECT m.ID, m.ArtistName, m.TotalPackages, m.Price, m.Paid, DATE_FORMAT(m.DateAdded, '%Y/%m/%d %h:%i %p') AS DateAdded, DATE_FORMAT(m.DateModified, '%Y/%m/%d %h:%i %p') AS DateModified, DATE_FORMAT(m.DateAdded, '%Y-%m-%d<br/>%r') AS DateAddedDisp, DATE_FORMAT(m.DateModified, '%Y-%m-%d %h:%i %p') AS DateModified FROM ".$wpdb->prefix . "mixing_mastering m RIGHT JOIN ".$wpdb->prefix . "mixing_mastering_details d ON m.ID = d.ServiceID WHERE m.ID<>0 ".$ConQuery." GROUP BY m.ID ORDER BY m.ID DESC";
$res = mysqli_query($con, $query) or die(mysqli_error($con));
while($row = mysqli_fetch_array($res)){
?>
				<tr id="post-<?php echo $row["ID"]; ?>" class="iedit author-self level-0 post-<?php echo $row["ID"]; ?> type-post status-publish format-standard hentry category-uncategorized">
					<th scope="row" class="check-column">			<label class="screen-reader-text" for="cb-select-<?php echo $row["ID"]; ?>">Select <?php echo $row["ArtistName"]; ?></label>
							<input id="cb-select-<?php echo $row["ID"]; ?>" name="post[]" value="<?php echo $row["ID"]; ?>" type="checkbox">
							<div class="locked-indicator">
								<span class="locked-indicator-icon" aria-hidden="true"></span>
								<span class="screen-reader-text"><?php echo $row["ArtistName"]; ?>!” is locked</span>
							</div>
						</th>
						<td class="title column-title has-row-actions column-primary page-title" data-colname="Title">
							<div class="locked-info"><span class="locked-avatar"></span> <span class="locked-text"></span></div>
				<strong><a class="row-title" href="<?php echo admin_url(); ?>admin.php?page=mixing_mastering_order&id=<?php echo $row["ID"]; ?>&action=view" aria-label="“<?php echo $row["ArtistName"]; ?>!” (Edit)"><?php echo $row["ArtistName"]; ?></a></strong>

							<div class="row-actions">
								<span class="edit"><a href="<?php echo admin_url(); ?>admin.php?page=mixing_mastering_order&id=<?php echo $row["ID"]; ?>&action=view" aria-label="Edit “<?php echo $row["ArtistName"]; ?>!”">View</a> | </span>
								<span class="trash"><a href="javascript:;" onclick="if (confirm('Are you sure you want to delete this ?')) window.location='admin.php?page=mixing_mastering&post[0]=<?php echo $row["ID"]; ?>&action=delete'; return false;" class="submitdelete" aria-label="Move “<?php echo $row["ArtistName"]; ?>!” to the Trash">Trash</a></span>
							</div>
						</td>
						<td class="TotalPackages column-TotalPackages" data-colname="TotalPackages"><a href="javascript:;"><?php echo $row["TotalPackages"]; ?></a></td>
						<td class="Price column-Price" data-colname="Price"><a href="javascript:;"><?php echo $row["Price"]; ?></a></td>
						<td class="PaymentStatus column-PaymentStatus" data-colname="PaymentStatus"><span aria-hidden="true"><?php echo ($row["Paid"] == 0 ? 'Unpaid' : 'Paid'); ?></span><span class="screen-reader-text"><?php echo ($row["Paid"] == 0 ? 'Unpaid' : 'Paid'); ?></span></td>
						<td class="date column-date" data-colname="Date"><abbr title="<?php echo $row["DateAdded"]; ?>"><?php echo $row["DateAddedDisp"]; ?></abbr></td>
					</tr>
<?php
}
?>
				</tbody>
		</table>
	</form>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.form-table').DataTable({
		responsive: true
		});
});
</script>
	<?php
}

?>
