<?php

include_once 'connect.php';

// Get values from the form
$nameofshop = $_POST['NAMEOFSHOP'];
$yesterdaysrevenue = $_POST['YESTERDAYSREVENUE'];
$location = $_POST['LOCATION'];
$numberofstaff = $_POST['NUMBEROFSTAFF'];
$manager = $_POST['MANAGER'];


//Prepare Insert Query
$sql = "INSERT INTO SHOP (NAMEOFSHOP, YESTERDAYSREVENUE, LOCATION, NUMBEROFSTAFF,MANAGER) VALUES (:nameofshop, :yesterdaysrevenue, :location,:numberofstaff,:manager)";
$stmt = oci_parse($conn, $sql);

// Bind parameters to statement
oci_bind_by_name($stmt, ":nameofshop", $nameofshop);
oci_bind_by_name($stmt, ":yesterdaysrevenue", $yesterdaysrevenue);
oci_bind_by_name($stmt, ":location", $location);
oci_bind_by_name($stmt, ":numberofstaff", $numberofstaff);
oci_bind_by_name($stmt, ":manager", $manager);

//execute insert query
$result = oci_execute($stmt);

//Insertion successful
if ($result === true) {

        // Echo tuple affected by update
        echo '<div class ="FormHeader">';
        echo '<h1>Insert New Shop Record</h1>';
        echo '</div>';
    
        echo '<div class="insert-record">';
        echo '<h2>Sucessfully Inserted Record Into Database</h2>';
        echo "<p><strong>Name of Shop:</strong> " . $nameofshop . "</p>";
        echo "<p><strong>Yesterday's Revenue:</strong> " . $yesterdaysrevenue . "</p>";
        echo "<p><strong>Location:</strong> " . $location . "</p>";
        echo "<p><strong>Number of Staff:</strong> " . $numberofstaff . "</p>";
        echo "<p><strong>Manager:</strong> " . $manager . "</p>";
        echo '</div>';
    
} 
//Insertion failed
else {
    echo '<div class ="FormHeader">';
    echo '<h1>Insert New Shop Record</h1>';
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
	<title>Insert New Shop Record</title>
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

