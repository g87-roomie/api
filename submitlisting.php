<?php

/*
Area * 
City *
Pincode *
Rent * 
Advance * 
Available from (date) * 


Gender * 
Smoking
Drinking
Single/Shared * 

About Property
Apartment / Independent House * 
Power Backup
Bathroom Attached
Lift
Parking
Comments


chat enable
call enable
*/

header("Access-Control-Allow-Origin: *");
include("dbcn.php");

if (!(isset($_REQUEST["token"]) && isset($_REQUEST["city"]) && isset($_REQUEST["area"]) && isset($_REQUEST["pincode"]) && isset($_REQUEST["rent"]) && isset($_REQUEST["advance"]) && isset($_REQUEST["date_of_posession"]) && isset($_REQUEST["gender"]) && isset($_REQUEST["shared"]) && isset($_REQUEST["enable_chat"]) && isset($_REQUEST["enable_call"])))
{
echo json_encode(array('status'=>'400'));
die();	
}
$token=$_REQUEST["token"];
$city=$_REQUEST["city"];
$area=$_REQUEST["area"];
$pincode=$_REQUEST["pincode"];
$rent=$_REQUEST["rent"];
$advance=$_REQUEST["advance"];
$date_of_posession=$_REQUEST["date_of_posession"];
$gender=$_REQUEST["gender"];
//$smoking=$_REQUEST["smoking"];
//$drinking=$_REQUEST["drinking"];
$shared=$_REQUEST["shared"];
//$type_of_building=$_REQUEST["type_of_building"];
//$power_backup=$_REQUEST["power_backup"];
//$attached_bathroom=$_REQUEST["attached_bathroom"];
//$lift=$_REQUEST["lift"];
//$two_wheeler_parking=$_REQUEST["two_wheeler_parking"];
//$four_wheeler_parking=$_REQUEST["four_wheeler_parking"];
//$comments=$_REQUEST["comments"];
$enable_chat=$_REQUEST["enable_chat"];
$enable_call=$_REQUEST["enable_call"];
//echo "true";
$sql = "select * from `access_token` where token = '$token'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
//echo "found";
$row=$result->fetch_row();
$mobile_no=$row[1];
$sql = "INSERT INTO `listings` (`mobile_no`, `city`, `area`, `pincode`, `rent`, `advance`, `date_of_posession`, `gender`, `shared`, `chat`, `call`) values('$mobile_no','$city','$area','$pincode','$rent','$advance','$date_of_posession','$gender','$shared','$enable_chat','$enable_call')";
$result = $conn->query($sql);
if ($result)
{
	$sql = "select * from `listings` where mobile_no = '$mobile_no' order by timestamp DESC";
	//echo $sql;
	$result = $conn->query($sql);
	$row=$result->fetch_row();
	$listing_id=$row[0];
	echo json_encode(array('status'=>'200','listing_id'=>$listing_id));
}
}
else
{
echo json_encode(array('status'=>'401'));
die();	
}
?>