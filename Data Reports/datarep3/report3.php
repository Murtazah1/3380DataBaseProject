<?php

include_once 'connect.php';

// get the ride id
$rideid = $_POST['RIDEID'];




echo "<head>";
echo "<title>Report 3</title>";
echo "<link rel='stylesheet' type='text/css' href='reportone.css'>";
echo "</head>";


echo "<body>";


// GETTING THE NAME OF THE RIDE
$name = "SELECT RIDENAME as THERIDE FROM RIDE WHERE RIDEID = $rideid";
$nq = oci_parse($conn,$name);
oci_execute($nq);
$result2 = oci_fetch_assoc($nq);
$rname = $result2['THERIDE'];
echo "<h1>CALCULATING THE TOTAL COST OF RIDE $rname</h1>";

// THE TOTAL COST
$cost = "SELECT SUM(RIDE.COSTOFINSTALLATION + REPAIR.COSTOFMAINTENANCE) AS TOTALCOST FROM RIDE JOIN REPAIR ON RIDE.RIDEID = REPAIR.RIDEREPAIRED WHERE RIDE.RIDEID = $rideid AND RIDE.DELETED = 0";
$cq = oci_parse($conn,$cost);
oci_execute($cq);
$result = oci_fetch_assoc($cq);
$totalcost = $result['TOTALCOST'];



// THE COST OF INSTALLATION
$install = "SELECT COSTOFINSTALLATION AS INSTALL FROM RIDE WHERE RIDEID = $rideid AND DELETED = 0";
$iq = oci_parse($conn,$install);
oci_execute($iq);
$result2 = oci_fetch_assoc($iq);
$instcost = $result2['INSTALL'];


echo "<h2>THE COST OF THE INSTALLATION WAS $".number_format($instcost,2). "</h2>";


echo "<h2>THE COST OF ALL THE REPAIR OPERATIONS ON THE RIDE<h2>";
$sql = "SELECT REPAIRID AS ID, COSTOFMAINTENANCE AS COST, dateofmaintenance AS DAY 
        FROM REPAIR WHERE RIDEREPAIRED = $rideid";
$parse = oci_parse($conn,$sql);
oci_execute($parse);

echo "<table>
<tr>
<th>REPAIR ID</th>
<th>COST OF THE MAINTENANCE OPERATION</th>
<th>DATE OF THE OPERATION</th>
</tr>";

// Loop through the rows and display the data
while ($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>";
    echo "<td>" . $row['ID'] . "</td>";
    echo "<td>" . $row['COST'] . "</td>";
    echo "<td>" . $row['DAY'] . "</td>";
    echo "</tr>";
}

// Close the table tag
echo "</table>";



// SUM OF THE REPAIR COSTS
$repairs = "SELECT SUM(REPAIR.COSTOFMAINTENANCE) AS REPCOST FROM RIDE JOIN REPAIR ON RIDE.RIDEID = REPAIR.RIDEREPAIRED WHERE RIDE.RIDEID = $rideid AND RIDE.DELETED = 0";
$rq = oci_parse($conn,$repairs);
oci_execute($rq);
$result3 = oci_fetch_assoc($rq);
$repcost = $result3['REPCOST'];


if ($totalcost == 0){
    $totalcost = $instcost;
}


echo "<h2>THE TOTAL CUMULATIVE COST OF ALL THE REPAIR OPERATIONS IS $" .number_format($repcost,2). "</h2>";

echo "<h1>THE TOTAL CUMULATIVE COST OF THE ENTIRE RIDE IS $" .number_format($totalcost,2). "</h1>";



echo "</body>";
?>