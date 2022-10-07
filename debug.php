<?php
$servername = "localhost";
$username = "ygmlimit_inv";
$password = "Munene37@";
$dbname = "ygmlimit_inv";
$con = mysqli_connect($servername, $username, $password, $dbname);

if($_REQUEST['empid']) {
	$sql = "SELECT id,username,email, mobile,location,country FROM merchant WHERE id='".$_REQUEST['empid']."'";
	$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));	
	$data = array();
	while( $rows = mysqli_fetch_assoc($resultset) ) {
		$data = $rows;
	}
	echo json_encode($data);
} else {
	echo 0;	
}
?>