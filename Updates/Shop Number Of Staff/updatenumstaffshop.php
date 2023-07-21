<?php

include_once 'connect.php';

$numberofstaff = $_POST['NUMBEROFSTAFF'];
$nameofshop = $_POST['NAMEOFSHOP'];

echo "<head>";
echo "<title>Shop Number of Staff Update</title>";
echo "<link rel='stylesheet' type='text/css' href='reportone.css'>";
echo "</head>";


echo "<body>";



$sql = "SELECT NUMBEROFSTAFF FROM SHOP WHERE NAMEOFSHOP LIKE '$nameofshop' AND DELETED = 0";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$result = oci_fetch_assoc($parse);
$oldnum = $result['NUMBEROFSTAFF'];

echo "<h1>THE NUMBER OF STAFF IN $nameofshop BEFORE UPDATE</h1>";
echo "<p>$oldnum</p>";

$update = "UPDATE shop SET numberofstaff = $numberofstaff WHERE nameofshop LIKE '$nameofshop' AND DELETED = 0";
$stmt = oci_parse($conn, $update);
oci_execute($stmt);


$num_rows = oci_num_rows($stmt);
if ($num_rows > 0) 
{
    $sql = "SELECT NUMBEROFSTAFF FROM SHOP WHERE NAMEOFSHOP LIKE '$nameofshop' AND DELETED = 0";
    $parse = oci_parse($conn,$sql);
    oci_execute($parse);
    $result = oci_fetch_assoc($parse);
    $newnum = $result['NUMBEROFSTAFF'];

    echo "<h1>THE NUMBER OF STAFF IN $nameofshop AFTER UPDATE</h1>";
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
