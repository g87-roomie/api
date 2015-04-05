<?php
error_reporting(1);
header("Access-Control-Allow-Origin: *");
include("dbcn.php");

$user=$_REQUEST["mobile_no"];
$otp=$_REQUEST["otp"];

$token=md5($user);




// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "select * from user_reg where mobile_no='$user' and otp='$otp'";
$result = $conn->query($sql);
//echo $result->num_rows;
if ($result->num_rows > 0) {
	$sql = "select * from access_token where mobile_no='$user'";
	$result = $conn->query($sql);
//echo $result->num_rows;
	if ($result->num_rows == 0) {

		$sql = "INSERT INTO `access_token` (`mobile_no`,`token`) values('$user','$token')";
		//echo $sql;
		$result = $conn->query($sql);
		//setcookie("token", $token , time() + (86400 * 30), "/");
		echo json_encode(array('Success'=>'True','Token'=>$token,'newuser'=>'True'));
		//echo $token;
	}
	else 
		echo json_encode(array('Success'=>'True','Token'=>$token,'newuser'=>'False'));
}
else
echo json_encode(array('Error'=>'Invalid Details'));
?>