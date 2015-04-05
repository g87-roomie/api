<?php
header("Access-Control-Allow-Origin: *");
include("dbcn.php");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//print_r($_POST['mobile_no']);
//$b = $_POST['mobile_no'];echo $b;

if (!(isset($_REQUEST["mobile_no"]) && isset($_REQUEST["device_id"])))
{
echo json_encode(array('Error'=>'Invalid Params'));
die();	
}

$mobile=$_REQUEST["mobile_no"];
//setcookie("user", $mobile , time() + (86400 * 30), "/");
//false true
$device_id=$_REQUEST["device_id"];
if (!(is_numeric($mobile) && ($mobile/1000000000>0.0 && $mobile/10000000000<10.0)))
{
echo json_encode(array('Error'=>'Invalid Params'));
die();
}

$sql = "select * from `user_reg` where mobile_no = '$mobile'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
$sql = "INSERT INTO `user_reg` (`mobile_no`, `device_id`, `gcm_id`, `otp`, `verified`) values('$mobile','$device_id','gcm_id','123','False')";
$result = $conn->query($sql);
if ($result)
{
	echo json_encode(array('status'=>'True'));
}
}
else
	{
		echo json_encode(array('status'=>'True'));
	}

/*
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}
*/
$conn->close();
?>
