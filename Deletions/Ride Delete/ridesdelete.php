<?php

include_once 'connect.php';


    $dataToDelete = $_POST['ID'];
    
    $delete = "UPDATE RIDE SET DELETED = 1 WHERE RIDEID = :var1";
    $stmt = oci_parse($conn, $delete);
    oci_execute($stmt);
    $result = oci_num_rows($stmt);

    //Fetch affected rows
    $row = oci_fetch_assoc($stmt);

    if ($result != 0) {

        // Echo the updated record
        echo '<div class ="FormHeader">';
        echo '<h1>Ride Record Deletion</h1>';
        echo '</div>';

        echo '<div class="deleted-record">';
        echo '<h2>Sucessfully Deleted Record</h2>';
        echo "<p><strong>Ride ID Deleted:</strong> " . $dataToDelete . "</p>";
        echo '</div>';
    } else {
        echo '<div class ="FormHeader">';
        echo '<h1>Ride Record Deletion</h1>';
        echo '</div>';

        echo '<div class="deleted-record">';
        echo '<h2>Deletion has failed.</h2>';
        echo '<p><strong>Incorrect Ride ID Entered</p>';
        echo '</div>';
    }

    // Close the connection
    oci_free_statement($stmt);
    oci_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ride Removal</title>
    <link rel="stylesheet" type="text/css" href="deleteResultStyle.css">
</head>
<body>
    </br>
    <button onclick = "history.go(-1);">
        Return to Previous Page
    </button>


</body>
</html>