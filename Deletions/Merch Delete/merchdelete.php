<?php

include_once 'connect.php';

    $dataToDelete = $_POST['ID'];
    
    $delete = "UPDATE MERCH SET DELETED = 1 WHERE MERCHID = :var1";
    $stmt = oci_parse($conn, $delete);
    oci_execute($stmt);

    $result = oci_num_rows($stmt);

    //Fetch affected rows
    $row = oci_fetch_assoc($stmt);

    if ($result != 0) {

        // Echo the updated record
        echo '<div class ="FormHeader">';
        echo '<h1>Merch Record Deletion</h1>';
        echo '</div>';

        echo '<div class="deleted-record">';
        echo '<h2>Sucessfully Deleted Record</h2>';
        echo "<p><strong>Merch ID Deleted:</strong> " . $dataToDelete . "</p>";
        echo '</div>';
    } else {
        echo '<div class ="FormHeader">';
        echo '<h1>Merch Record Deletion</h1>';
        echo '</div>';

        echo '<div class="deleted-record">';
        echo '<h2>Deletion has failed.</h2>';
        echo '<p><strong>Incorrect Merch ID Entered</p>';
        echo '</div>';
    }

    // Close the connection
    oci_free_statement($stmt);
    oci_close($conn);

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Merch Removal</title>
    <link rel="stylesheet" type="text/css" href="deleteResultStyle.css">
</head>
<body style="background-color:whitesmoke">
    </br>
    <button onclick = "history.go(-1);">
        Return to Previous Page
    </button>


</body>
</html>









