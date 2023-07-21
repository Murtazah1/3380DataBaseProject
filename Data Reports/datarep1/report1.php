<?php
// establish connection to db

include_once 'connect.php';




// STORE THE DATE VALUES
$startdate = $_POST['STARTDATE'];
$enddate = $_POST['ENDDATE'];



echo "<head>";
echo "<title>Report 1</title>";
echo "<link rel='stylesheet' type='text/css' href='reportone.css'>";
echo "</head>";


echo "<body>";


echo "<div style='display: grid;'>";





echo "<div>";
// getting the results to display
$sql = "SELECT DAYOFLOG, SHOPREV, RESTAURANTREV, TICKETSSOLD FROM DAILYREV WHERE DAYOFLOG BETWEEN TO_DATE('$startdate','YYYY-MM-DD') AND TO_DATE('$enddate','YYYY-MM-DD')";
$dp = oci_parse($conn,$sql);
oci_execute($dp);
echo "<h1>TOTAL PROFITS FROM $startdate TO $enddate</h1>";
echo "<table>";
echo "<thead>
        <tr>
          <th>Date Of Log</th>
          <th>Revenue From Shop</th>
          <th>Revenue From Restaurant</th>
          <th>Tickets Sold</th>
        </tr>
      </thead>";

echo "<tbody>";
while (($row = oci_fetch_assoc($dp)) != false) {
    echo "<tr>";
    echo "<td>".$row['DAYOFLOG']."</td>";
    echo "<td>".$row['SHOPREV']."</td>";
    echo "<td>".$row['RESTAURANTREV']."</td>";
    echo "<td>".$row['TICKETSSOLD']."</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";


// display the total profit: pull from daily rev table (shoprev,restrev)
$profit = "SELECT SUM(shoprev) + SUM(restaurantrev) as totalprofit FROM DAILYREV WHERE DAYOFLOG BETWEEN TO_DATE('$startdate','YYYY-MM-DD') AND TO_DATE('$enddate','YYYY-MM-DD')";
$pq = oci_parse($conn,$profit);
oci_execute($pq);
$result1 = oci_fetch_assoc($pq);
$netprofit = $result1['TOTALPROFIT'];

echo "<h2>THE TOTAL PROFIT OVER $startdate TO $enddate IS $" .number_format($netprofit,2). "</h2>";
echo "</div>";






echo "<h1>TOTAL LOSSES FROM $startdate to $enddate</h1>";

// pulling all the values from shipment costs



echo "<div>";
$sql = "SELECT DATEOFLOG, SHOPSHIP, RESTSHIP FROM SHIPCOST WHERE DATEOFLOG BETWEEN TO_DATE('$startdate','YYYY-MM-DD') AND TO_DATE('$enddate','YYYY-MM-DD')";
$shipcost = oci_parse($conn,$sql);
oci_execute($shipcost);


echo "<h2>THE TOTAL SHIPPING COSTS FROM $startdate to $enddate</h2>";
echo "<table>";
echo "<thead>
        <tr>
          <th>Date Of Log</th>
          <th>Shipment Costs For The Shop</th>
          <th>Shipment Costs For The Restaurant</th>
        </tr>
      </thead>";

echo "<tbody>";
while (($row = oci_fetch_assoc($shipcost)) != false) {
    echo "<tr>";
    echo "<td>".$row['DATEOFLOG']."</td>";
    echo "<td>".$row['SHOPSHIP']."</td>";
    echo "<td>".$row['RESTSHIP']."</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";

$sql = "SELECT SUM(SHOPSHIP) + SUM(RESTSHIP) AS TOTALSHIP FROM SHIPCOST WHERE DATEOFLOG BETWEEN TO_DATE('$startdate','YYYY-MM-DD') AND TO_DATE('$enddate','YYYY-MM-DD')";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$result = oci_fetch_assoc($parse);
$totalship = $result['TOTALSHIP'];

echo "<h2>THE TOTAL COST OF ALL THE SHIPMENTS FROM $startdate TO $enddate IS $" .number_format($totalship,2).  "</h2>";
echo "</div>";




// pulling all the values from rides maintainence

echo "<div>";
$sql = "SELECT COSTOFMAINTENANCE, DATEOFMAINTENANCE, RIDEREPAIRED FROM REPAIR WHERE DATEOFMAINTENANCE BETWEEN TO_DATE('$startdate','YYYY-MM-DD') AND TO_DATE('$enddate','YYYY-MM-DD') ";
$parse = oci_parse($conn,$sql);
oci_execute($parse);

echo "<h2>THE TOTAL MAINTAINENCE COSTS FOR RIDES FROM $startdate to $enddate</h2>";
echo "<table>";
echo "<thead>
        <tr>
          <th>Date Of Maintenance Operation</th>
          <th>Cost Of The Maintenance Operaiton</th>
          <th>ID Of The Ride That Was Repaired</th>
        </tr>
      </thead>";

echo "<tbody>";
while (($row = oci_fetch_assoc($parse)) != false) {
    echo "<tr>";
    echo "<td>".$row['DATEOFMAINTENANCE']."</td>";
    echo "<td>".$row['COSTOFMAINTENANCE']."</td>";
    echo "<td>".$row['RIDEREPAIRED']."</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";


$sql = "SELECT SUM(COSTOFMAINTENANCE) AS TOTALMAINTAIN FROM REPAIR WHERE DATEOFMAINTENANCE BETWEEN TO_DATE('$startdate','YYYY-MM-DD') AND TO_DATE('$enddate','YYYY-MM-DD')";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$result = oci_fetch_assoc($parse);
$totalmaintain = $result['TOTALMAINTAIN'];
echo "<h2>THE TOTAL COST OF ALL THE MAINTENANCE OPERATIONS FOR RIDES FROM $startdate TO $enddate IS $" .number_format($totalmaintain,2).  "</h2>";
echo "</div>";



// pulling all the values from transportation maintainence
echo "<div>";
$sql = "SELECT COSTOFREP, DATEOFREP, TRANSPREPAIRED FROM REPAIRTRANSP WHERE DATEOFREP BETWEEN TO_DATE('$startdate','YYYY-MM-DD') AND TO_DATE('$enddate','YYYY-MM-DD')";
$parse = oci_parse($conn,$sql);
oci_execute($parse);

echo "<h2>THE TOTAL MAINTAINENCE COSTS FOR TRANSPORTATION FROM $startdate to $enddate</h2>";
echo "<table>";
echo "<thead>
        <tr>
          <th>Date Of Maintenance Operation</th>
          <th>Cost Of The Maintenance Operaiton</th>
          <th>ID Of The Transportation That Was Repaired</th>
        </tr>
      </thead>";

echo "<tbody>";
while (($row = oci_fetch_assoc($parse)) != false) {
    echo "<tr>";
    echo "<td>".$row['DATEOFREP']."</td>";
    echo "<td>".$row['COSTOFREP']."</td>";
    echo "<td>".$row['TRANSPREPAIRED']."</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";

$sql = "SELECT SUM(COSTOFREP) AS TOTALT FROM REPAIRTRANSP WHERE DATEOFREP BETWEEN TO_DATE('$startdate','YYYY-MM-DD') AND TO_DATE('$enddate','YYYY-MM-DD')";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$result = oci_fetch_assoc($parse);
$totalt = $result['TOTALT'];
echo "<h2>THE TOTAL COST OF ALL THE MAINTENANCE OPERATIONS FOR TRANSPORTATION FROM $startdate TO $enddate IS $" .number_format($totalt,2). "</h2>";
echo "</div>";





// pulling all the values from legal 
echo "<div>";
$sql = "SELECT COSTOFACCIDENT, CASEID, STARTDATE FROM LEGAL WHERE STARTDATE BETWEEN TO_DATE('$startdate','YYYY-MM-DD') AND TO_DATE('$enddate','YYYY-MM-DD')";
$parse = oci_parse($conn,$sql);
oci_execute($parse);

echo "<h2>THE TOTAL LEGAL COSTS FROM $startdate to $enddate</h2>";
echo "<table>";
echo "<thead>
        <tr>
          <th>Date Of Legal Operation</th>
          <th>Cost Of The Legal Operaiton</th>
          <th>ID Of The Transportation That Was Repaired</th>
        </tr>
      </thead>";

echo "<tbody>";
while (($row = oci_fetch_assoc($parse)) != false) {
    echo "<tr>";
    echo "<td>".$row['STARTDATE']."</td>";
    echo "<td>".$row['COSTOFACCIDENT']."</td>";
    echo "<td>".$row['CASEID']."</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";

$sql = "SELECT SUM(COSTOFACCIDENT) AS TOTALL FROM LEGAL  WHERE STARTDATE BETWEEN TO_DATE('$startdate','YYYY-MM-DD') AND TO_DATE('$enddate','YYYY-MM-DD')";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
$result = oci_fetch_assoc($parse);
$totall = $result['TOTALL'];
echo "<h2>THE TOTAL COST OF ALL THE LEGAL OPERATIONS FROM $startdate TO $enddate IS $" .number_format($totalt,2). "</h2>";
echo "</div>";





echo "<div>";
// display the total losses: pull from repair and legal and shipcost (costofmainten rides + transp,legal cases, shopcost, restcost)
$cost = "SELECT ( SELECT SUM(COSTOFMAINTENANCE) FROM REPAIR WHERE DATEOFMAINTENANCE BETWEEN TO_DATE('$startdate','YYYY-MM-DD') AND TO_DATE('$enddate','YYYY-MM-DD') ) + ( SELECT SUM(COSTOFREP) FROM REPAIRTRANSP WHERE DATEOFREP BETWEEN TO_DATE('$startdate','YYYY-MM-DD') AND TO_DATE('$enddate','YYYY-MM-DD')) + ( SELECT SUM(SHOPSHIP) + SUM(RESTSHIP) FROM SHIPCOST WHERE DATEOFLOG BETWEEN TO_DATE('$startdate','YYYY-MM-DD') AND TO_DATE('$enddate','YYYY-MM-DD')) + (SELECT SUM(COSTOFACCIDENT) FROM LEGAL WHERE STARTDATE BETWEEN TO_DATE('$startdate','YYYY-MM-DD') AND TO_DATE('$enddate','YYYY-MM-DD')) AS totalloss FROM DUAL";
$cq = oci_parse($conn,$cost);
oci_execute($cq);
$result2 = oci_fetch_assoc($cq);
$netloss = $result2['TOTALLOSS'];

echo "<h2>THE TOTAL LOSS FROM $startdate TO $enddate IS $" .number_format($netloss,2). "</h2>";
echo "</div>";
// display the net profit




echo "<div>";
$difference = $netprofit - $netloss;
 
echo "<h1>THE TOTAL NET PROFIT FROM $startdate TO $enddate IS $". number_format($difference,2) ."</h1>";
echo "</div>";


echo "</div>";

echo "</body>";

?>



