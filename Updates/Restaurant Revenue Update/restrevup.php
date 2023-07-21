<?php

include_once 'connect.php';


$yesterdaysrevenue = $_POST['YESTERDAYSREVENUE'];
$nameofrestaurant = $_POST['NAMEOFRESTAURANT'];

echo "<head>";
echo "<title>Restaurant Revenue Update</title>";
echo "<link rel='stylesheet' type='text/css' href='reportone.css'>";
echo "</head>";


echo "<body>";
// previous yesterday rev

$sql = "SELECT YESTERDAYSREVENUE FROM RESTAURANTS WHERE NAMEOFRESTAURANT LIKE '$nameofrestaurant' AND DELETED = 0";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$result = oci_fetch_assoc($parse);
$oldnum = $result['YESTERDAYSREVENUE'];

echo "<h1>THE REVENUE IN $nameofrestaurant FROM THE PREVIOUS DAY</h1>";
echo "<p>$oldnum</p>";


$update = "UPDATE restaurants SET yesterdaysrevenue = $yesterdaysrevenue WHERE nameofrestaurant LIKE '$nameofrestaurant' AND DELETED = 0";
$stmt = oci_parse($conn, $update);
oci_execute($stmt);



$num_rows = oci_num_rows($stmt);
if ($num_rows > 0) 
{
    $sql = "SELECT YESTERDAYSREVENUE FROM RESTAURANTS WHERE NAMEOFRESTAURANT LIKE '$nameofrestaurant' AND DELETED = 0";
    $parse = oci_parse($conn,$sql);
    oci_execute($parse);
    $result = oci_fetch_assoc($parse);
    $newnum = $result['YESTERDAYSREVENUE'];

    echo "<h1>THE REVENUE IN $nameofrestaurant FROM TODAY</h1>";
    echo "<p>$newnum</p>";

} 
else 
{
    echo "<h1>ID was entered in wrong/ID does not exist</h1>";
}


echo "</body>";

// Close the connection
oci_free_statement($stmt);
oci_close($conn);

?>
