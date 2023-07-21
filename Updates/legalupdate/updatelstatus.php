<?php

include_once 'connect.php';

// get the values from the webpage

$caseid = $_POST['CASEID'];
$casestatus = $_POST['CASESTATUS'];

echo "<head>";
echo "<title>Legal Status Update</title>";
echo "<link rel='stylesheet' type='text/css' href='reportone.css'>";
echo "</head>";

echo "<body>";

$sql = "SELECT CASEID, TYPE, COSTOFACCIDENT, THIRDPARTYFIRM, STARTDATE, CASESTATUS, RIDEIDL FROM LEGAL WHERE CASEID = $caseid";
$parse = oci_parse($conn,$sql);
oci_execute($parse);


echo "<h1>OLD VALUES FOR LEGAL OPERATION: $caseid</h1>";
// Loop through the query results and echo each row as a list item
while ($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<p> TYPE: " . $row['TYPE'] . "</p>";
    echo "<p> COST: " . $row['COSTOFACCIDENT'] . "</p>";
    echo "<p> STATUS: " . $row['CASESTATUS'] . "</p>";
}


$update = "UPDATE LEGAL SET CASESTATUS = '$casestatus' WHERE CASEID = $caseid";
$stmt = oci_parse($conn,$update);
oci_execute($stmt);


$num_rows = oci_num_rows($stmt);
if ($num_rows > 0) 
{
    $sql = "SELECT CASEID, TYPE, COSTOFACCIDENT, THIRDPARTYFIRM, STARTDATE, CASESTATUS, RIDEIDL FROM LEGAL WHERE CASEID = $caseid";
    $parse = oci_parse($conn,$sql);
    oci_execute($parse);

    echo "<h1>NEW VALUES FOR LEGAL OPERATION: $caseid</h1>";
    // Loop through the query results and echo each row as a list item
    while ($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)) 
    {
        echo "<p> TYPE: " . $row['TYPE'] . "</p>";
        echo "<p> COST: " . $row['COSTOFACCIDENT'] . "</p>";
        echo "<p> STATUS: " . $row['CASESTATUS'] . "</p>";
    }

} 
else 
{
    echo "<h1>ID was entered in wrong/ID does not exist</h1>";
}




echo "</body>";

?>