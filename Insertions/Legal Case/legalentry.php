<?php

include_once 'connect.php';
// Get values from the form

$caseid = $_POST['CASEID'];
$type = $_POST['TYPE'];
$costofaccident = $_POST['COSTOFACCIDENT'];
$thirdpartyfirm = $_POST['THIRDPARTYFIRM'];
$startdate = $_POST['STARTDATE'];
$casestatus = $_POST['CASESTATUS'];
$rideid = $_POST['RIDEIDL'];

// Prepare and execute SQL statement to insert values into the database
$sql = "INSERT INTO LEGAL (CASEID,TYPE,COSTOFACCIDENT,THIRDPARTYFIRM,STARTDATE, CASESTATUS, RIDEIDL) VALUES ($caseid,'$type',$costofaccident,'$thirdpartyfirm',TO_DATE('$startdate','YYYY-MM-DD'), '$casestatus', $rideid)";
$stmt = oci_parse($conn, $sql);

//execute insert query
$result = oci_execute($stmt);

//Insertion successful
if ($result === true) {

        // Echo tuple affected by update
        echo '<div class ="FormHeader">';
        echo '<h1>Insert New Legal Record</h1>';
        echo '</div>';

        echo '<div class="insert-record">';
        echo '<h2>Sucessfully Inserted Record Into Database</h2>';
        echo "<p><strong>Legal Case:</strong> " . $caseid . "</p>";
        echo "<p><strong>Type:</strong> " . $type . "</p>";
        echo "<p><strong>Cost of Accident:</strong> " . $costofaccident . "</p>";
        echo "<p><strong>Third Party Firm:</strong> " . $thirdpartyfirm . "</p>";
        echo "<p><strong>Start Date:</strong> " . $startdate . "</p>";
        echo "<p><strong>Case Status:</strong> " . $casestatus . "</p>";
        echo "<p><strong>Ride ID:</strong> " . $rideid . "</p>";
        echo '</div>';

} 
//Insertion failed
else {
    echo '<div class ="FormHeader">';
    echo '<h1>Insert New Legal Record</h1>';
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
    <title>Insert New Legal Record</title>
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

