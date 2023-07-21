<?php

include_once 'connect.php';

// Get values from the form
$empid = $_POST['EMPID'];
$rideid = $_POST['RIDEID'];

//Prepare Insert Query
$sql = "INSERT INTO WORKSON_RES (EMPID, RIDEID) VALUES (:empid, :rideid)";
$stmt = oci_parse($conn, $sql);

// Bind parameters to statement
oci_bind_by_name($stmt, ":empid", $empid);
oci_bind_by_name($stmt, ":rideid", $depid);

//execute insert query
$result = oci_execute($stmt);

//number of rows affected by insert query
$num_rows = oci_num_rows($stmt);

if ($result === true) {
    // Check if any rows were updated
    if ($num_rows == 0) {
        echo '<div class ="FormHeader">';
        echo '<h1>Insert New Works On Ride Record</h1>';
        echo '</div>';

        echo '<div class="insert-record">';
        echo '<h2>Insertion into Database Has Failed.</h2>';
        echo '<p><strong>Incorrect Data Entered</p>';
        echo '</div>';
    } else {
        // Echo tuple affected by update
        echo '<div class ="FormHeader">';
        echo '<h1>Insert New Works on Ride Record</h1>';
        echo '</div>';
    
        echo '<div class="insert-record">';
        echo '<h2>Sucessfully Inserted Record Into Database</h2>';
        echo "<p><strong>Employee ID:</strong> " . $empid . "</p>";
        echo "<p><strong>Ride ID:</strong> " . $rideid . "</p>";
        echo '</div>';
    }
} 
else {
    echo '<div class ="FormHeader">';
    echo '<h1>Insert New Works On Ride Record</h1>';
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
	<title>Insert New Works on Ride Record</title>
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