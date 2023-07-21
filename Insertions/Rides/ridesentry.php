<?php

include_once 'connect.php';

// Get values from the form
$rideid = $_POST['RIDEID'];
$lastdateofmaintain = $_POST['LASTDATEOFMAINTAIN'];
$typeofride = $_POST['TYPEOFRIDE'];
$costofinstallation = $_POST['COSTOFINSTALLATION'];
$isrunning = $_POST['ISRUNNING'];
$ridename = $_POST['RIDENAME'];
$location = $_POST['LOCATION'];


//Prepare Insert Query
$sql = "INSERT INTO RIDE (RIDEID, LASTDATEOFMAINTAIN, TYPEOFRIDE,COSTOFINSTALLATION,ISRUNNING,RIDENAME,LOCATION) 
VALUES (:rideid,TO_DATE(:lastdateofmaintain,'YYYY-MM-DD'), :typeofride,:costofinstallation,:isrunning,:ridename,:location)";
$stmt = oci_parse($conn, $sql);

// Bind parameters to statement
oci_bind_by_name($stmt, ":rideid", $rideid);
oci_bind_by_name($stmt, ":lastdateofmaintain", $lastdateofmaintain);
oci_bind_by_name($stmt, ":typeofride", $typeofride);
oci_bind_by_name($stmt, ":costofinstallation", $costofinstallation);
oci_bind_by_name($stmt, ":isrunning", $isrunning);
oci_bind_by_name($stmt, ":ridename", $ridename);
oci_bind_by_name($stmt, ":location", $location);

//execute insert query
$result = oci_execute($stmt);

//Insertion successful
if ($result === true) {

        // Echo tuple affected by update
        echo '<div class ="FormHeader">';
        echo '<h1>Insert New Ride Record</h1>';
        echo '</div>';
    
        echo '<div class="insert-record">';
        echo '<h2>Sucessfully Inserted Record Into Database</h2>';
        echo "<p><strong>Ride ID:</strong> " . $rideid . "</p>";
        echo "<p><strong>Last Day of Maintenance:</strong> " . $lastdateofmaintain . "</p>";
        echo "<p><strong>Type of Ride:</strong> " . $typeofride . "</p>";
        echo "<p><strong>Cost of Installation:</strong> " . $costofinstallation . "</p>";
        echo "<p><strong>Is it Running:</strong> " . $isrunning . "</p>";
        echo "<p><strong>Ridename:</strong> " . $ridename . "</p>";
        echo "<p><strong>Location:</strong> " . $location . "</p>";
        echo '</div>';
    
} 
//Insertion failed
else {
    echo '<div class ="FormHeader">';
    echo '<h1>Insert New Ride Record</h1>';
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
	<title>Insert New Rides Record</title>
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
