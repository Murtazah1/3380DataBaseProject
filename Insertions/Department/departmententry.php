<?php

include_once 'connect.php';

$departmentid = $_POST['DEPARTMENTID'];
$departmentname = $_POST['DEPARTMENTNAME'];

$numofemployees = $_POST['NUMOFEMPLOYEES'];
$manager = $_POST['MANAGER'];

$location = $_POST['LOCATION'];

$insert = "INSERT INTO DEPARTMENTS (departmentid, departname, numofemployees, manager, location) VALUES ($departmentid, '$departmentname', $numofemployees, '$manager', $location)";

$stmt = oci_parse($conn, $insert);
$result = oci_execute($stmt);

//Insertion successful
if ($result === true) {

    // Echo tuple affected by update
    echo '<div class ="FormHeader">';
    echo '<h1>Insert New Department Record</h1>';
    echo '</div>';

    echo '<div class="insert-record">';
    echo '<h2>Sucessfully Inserted Record Into Database</h2>';
    echo "<p><strong>Department ID:</strong> " . $departmentid . "</p>";
    echo "<p><strong>Department Name:</strong> " . $departmentname . "</p>";
    echo "<p><strong>Number of Employees:</strong> " . $numofemployees . "</p>";
    echo "<p><strong>Manager:</strong> " . $manager . "</p>";
    echo "<p><strong>Location:</strong> " . $location . "</p>";

    echo '</div>';

} 
//Insertion failed
else {
echo '<div class ="FormHeader">';
echo '<h1>Insert New Department Record</h1>';
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
<title>Insert New Department Record</title>
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




?>