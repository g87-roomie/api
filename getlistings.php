<?php
header("Access-Control-Allow-Origin: *");
include("dbcn.php");
include("validatetoken.php");
//echo $mobile_no;

$sql = "select * from `listings` where mobile_no = '$mobile_no' order by timestamp DESC";
	//echo $sql;
	$result = $conn->query($sql);
	while($row=$result->fetch_row())
		$listings[$row[0]]=(array("area"=>$row[3],"pincode"=>$row[4]));
	//print_r($listings);
	echo json_encode(array("status"=>200,"listings"=>$listings));
?>