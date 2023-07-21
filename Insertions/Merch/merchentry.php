<?php

// Get values from the form
$manufacturelocation = $_POST['MANUFACTURELOCATION'];
$costtomake = $_POST['COSTTOMAKE'];
$whereitissold = $_POST['WHEREITISSOLD'];
$type = $_POST['TYPE'];
$merchid = $_POST['MERCHID'];
$sellprice = $_POST['SELLPRICE'];



// Prepare and execute SQL statement to insert values into the database
$sql = "INSERT INTO MERCH (MANUFACTURELOCATION,COST,WHEREITISSOLD,MERCHID,TYPE,SELLPRICE) VALUES ('$manufacturelocation',$costtomake,'$whereitissold',$merchid,'$type',$sellprice)";
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);

if (oci_execute($stmt)) {
    echo "Values saved successfully";
} else {
    $m = oci_error($stmt);
    echo $m['message'], "\n";
}

// Close the connection
oci_free_statement($stmt);
oci_close($conn);

?>