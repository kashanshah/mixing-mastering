<?php
require( get_home_path().'/wp-load.php' );
global $con;
global $wpdb;

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
if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "payViaPaypal"){
	$ServiceID = isset($_REQUEST["ServiceID"]) ? $_REQUEST["ServiceID"] : 0;
	$query = "UPDATE ".$wpdb->prefix . "mixing_mastering SET
		Paid = 1
		WHERE 
		ID = '".(int)$ServiceID."'";
	mysqli_query($con, $query) or die(mysqli_error($con));
	header("location: ".site_url()."/order-placed/");
	exit();
}

if(isset($_POST["action"]) && $_POST["action"] == "mixing_mastering"){
	if(!isset($_POST["TotalPackages"]) || empty($_POST["TotalPackages"]) )
	{
		echo '<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><i class="fa fa-times-circle"></i>&nbsp; Please select any package from Mixing / Mastering ? Complete Package.</div>';
		return false;
	}
	$uploads = wp_upload_dir();
	$uploadDir = $uploads['path'];
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
		$MasteringType = "sterioMastering-".$SerialNo;
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
			$fileLink = $uploadDir . "/" .uniqid().".".$ext[sizeof($ext) - 1];
			$filesize = $FileArr['size'];
			$tmpName = $FileArr['tmp_name'];
			$filePath = $fileLink;
			$type=Array(1 => 'jpg', 2 => 'jpeg', 3 => 'png', 4 => 'gif', 5 => 'doc', 6 => 'docx', 7 => 'pdf', 8 => 'zip', 9 => 'rar', 10 => 'mp3', 11 => 'wav', 12 => 'ogg', 13 => 'mpeg');
			if($fileName != '' && !(in_array($ext[sizeof($ext) - 1],$type))){
				echo 'invalid';
			}else{
				$result = move_uploaded_file($tmpName, $fileLink);
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

?>