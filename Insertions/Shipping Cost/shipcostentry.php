<?php

include_once 'connect.php';

// Get values from the form
$dateoflog = $_POST['DATEOFLOG'];
$shopship = $_POST['SHOPSHIP'];
$restship = $_POST['RESTSHIP'];


//Prepare Insert Query
$sql = "INSERT INTO SHIPCOST (DATEOFLOG, SHOPSHIP, RESTSHIP) VALUES (TO_DATE(:dateoflog,'YYYY-MM-DD'), :shopship,:restship)";
$stmt = oci_parse($conn, $sql);

// Bind parameters to statement
oci_bind_by_name($stmt, ":dateoflog", $dateoflog);
oci_bind_by_name($stmt, ":shopship", $shopship);
oci_bind_by_name($stmt, ":restship", $restship);


//execute insert query
$result = oci_execute($stmt);

//Insertion successful
if ($result === true) {

        // Echo tuple affected by update
        echo '<div class ="FormHeader">';
        echo '<h1>Insert New Shipping Cost Record</h1>';
        echo '</div>';
    
        echo '<div class="insert-record">';
        echo '<h2>Sucessfully Inserted Record Into Database</h2>';
        echo "<p><strong>Date:</strong> " . $dateoflog . "</p>";
        echo "<p><strong>Shop Shipping Cost:</strong> " . $shopship . "</p>";
        echo "<p><strong>Restaurant Shippinh:</strong> " . $restship . "</p>";

        echo '</div>';
    
} 
//Insertion failed
else {
    echo '<div class ="FormHeader">';
    echo '<h1>Insert New Shipping Cost Record</h1>';
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
	<title>Insert New Shipping Cost Record</title>
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

