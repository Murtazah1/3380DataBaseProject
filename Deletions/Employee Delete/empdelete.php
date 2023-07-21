<?php

include_once 'connect.php';

$dataToDelete = $_POST['ID'];

$delete = "UPDATE EMPLOYEE SET DELETED = 1 WHERE EMPLOYEEID = :var1";
$stmt = oci_parse($conn, $delete);
oci_bind_by_name($stmt, ":var1", $dataToDelete);
oci_execute($stmt);
$result = oci_num_rows($stmt);

//Fetch affected rows
$row = oci_fetch_assoc($stmt);

if ($result != 0) {

    // Echo the updated record
    echo '<div class ="FormHeader">';
    echo '<h1>Employee Record Deletion</h1>';
    echo '</div>';

    echo '<div class="deleted-record">';
    echo '<h2>Sucessfully Deleted Record</h2>';
    echo "<p><strong>Employee ID Deleted:</strong> " . $dataToDelete . "</p>";
    echo '</div>';
} else {
    echo '<div class ="FormHeader">';
    echo '<h1>Employee Record Deletion</h1>';
    echo '</div>';

    echo '<div class="deleted-record">';
    echo '<h2>Deletion has failed.</h2>';
    echo '<p><strong>Incorrect Employee ID Entered</p>';
    echo '</div>';
}

// Close the connection
oci_free_statement($stmt);
oci_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee Removal</title>
    <link rel="stylesheet" type="text/css" href="deleteResultStyle.css">
</head>
<body>
        </br>
        <button onclick = "history.go(-1);">
            Return to Previous Page
        </button>


</body>
</html>
