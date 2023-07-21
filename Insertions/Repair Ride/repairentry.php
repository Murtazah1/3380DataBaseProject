<?php

include_once 'connect.php';
// Get values from the form

$costofmaint = $_POST['COSTOFMAINTENANCE'];
$dateofmaint = $_POST['DATEOFMAINTENANCE'];
$repairid = $_POST['REPAIRID'];
$riderepaired = $_POST['RIDEREPAIRED'];


// Prepare and execute SQL statement to insert values into the database
$sql = "INSERT INTO REPAIR (COSTOFMAINTENANCE,DATEOFMAINTENANCE,REPAIRID,RIDEREPAIRED) VALUES ($costofmaint,TO_DATE('$dateofmaint','YYYY-MM-DD'),$repairid,$riderepaired)";
$stmt = oci_parse($conn, $sql);

//execute insert query
$result = oci_execute($stmt);

//Insertion successful
if ($result === true) {

        // Echo tuple affected by update
        echo '<div class ="FormHeader">';
        echo '<h1>Insert New Ride Maintenance Record</h1>';
        echo '</div>';

        echo '<div class="insert-record">';
        echo '<h2>Sucessfully Inserted Record Into Database</h2>';
        echo "<p><strong>Repair ID:</strong> " . $repairid . "</p>";
        echo "<p><strong>ID of Maintenanced Ride:</strong> " . $riderepaired . "</p>";
        echo "<p><strong>Date of Maintenance:</strong> " . $dateofmaint . "</p>";
        echo "<p><strong>Cost of Maintenance:</strong> " . $costofmaint . "</p>";
    
        echo '</div>';

} 
//Insertion failed
else {
    echo '<div class ="FormHeader">';
    echo '<h1>Insert New Ride Maintenance REcord</h1>';
    echo '</div>';

    echo '<div class="insert-record">';
    echo '<h2>Insertion into Database Has Failed.</h2>';
    echo '<p><strong>Incorrect Data Entered</p>';
    echo '</div>';
}

// Close the statement and database connection
oci_free_statement($stmt);
oci_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert New Ride Repair Record</title>
    <style>
        .insert-record {
            display:block;
            background-color: lightgray;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: auto;
            width: 50%;
            padding: 20px;
            text-align: center;
        }
        .FormHeader{
            display:block;
            background-color:rgb(200, 16, 42);
            display: block;
            font-family: Arial, Helvetica, sans-serif;
            color:white;
            text-align: center;

        }
    </style>
</head>
<body style="background-color:whitesmoke">




</body>
</html>

