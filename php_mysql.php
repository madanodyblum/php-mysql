
<?php
error_reporting(0);	
session_start();
require_once('Connections/connx.php');

$query_Recordset2a = "select * from users where email='$_SESSION[MM_Username]'";
$Recordset2a = mysqli_query($con, $query_Recordset2a) or die(mysqli_error());
$row_Recordset2a = mysqli_fetch_assoc($Recordset2a);
$totalRows_Recordset2a = mysqli_num_rows($Recordset2a);

$query_Recordset2b = "select * from users where groupcode='1' and status ='1'";
$Recordset2b = mysqli_query($con, $query_Recordset2b) or die(mysqli_error());
$users_data = mysqli_fetch_all($Recordset2b);
// while($data = mysqli_fetch_assoc($Recordset2b))
// {
//     $long = $data['longi'];
// 	$lat = $data['lati'];
// 	$fname = $data['firstname'];
// }

function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2) {
    $theta = $longitude1 - $longitude2;
    $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    $kilometers = $miles * 1.609344;
    return compact('kilometers'); 
}

//     ---------------Example:---------------------

$point1 = array('lat' => $row_Recordset2a['lati'], 'long' => $row_Recordset2a['longi']);
foreach ($users_data as $key => $data) {
    $long = $data[15];
    $lat = $data[16];
    $fname = $data[1];
    $point2 = array('lat' => $lat, 'long' => $long);
    $distance = getDistanceBetweenPointsNew($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
    foreach ($distance as $unit => $value) {
        if($value!=0){
            echo $fname; echo $unit; echo $value;
        }
    }
}


// foreach ($distance as $unit => $value) {
//     //echo $unit.': '.number_format($value,4).'<br />';
// $dist = number_format($value,4);
// echo $dist; echo $unit; echo $fname;
// }
// if ($dist < 900)
// {
// //echo $data['firstname'];
// echo 'success';
// }
?>