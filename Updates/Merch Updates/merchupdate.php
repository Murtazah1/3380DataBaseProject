<?php
include_once 'connect.php';

// Get the input values from the HTML form
$merchid = $_POST['MERCHID'];
$cost = $_POST['COST'];
$sell = $_POST['SELLPRICE'];
$where = $_POST['WHEREITISSOLD'];
$manufacturer = $_POST['MANUFACTURER'];


try {

    echo "<head>";
    echo "<title>Merch Update</title>";
    echo "<link rel='stylesheet' type='text/css' href='reportone.css'>";
    echo "</head>";



    // body
    echo "<body>";
    // getting the old vvalues of merch
    $sql = "SELECT * FROM MERCH WHERE MERCHID = $merchid AND DELETED = 0";
    $parse = oci_parse($conn,$sql);
    oci_execute($parse);

    echo "<h1>THE OLD VALUES OF MERCH: $merchid</h1>";
    while ($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)) {
        echo "<p> Type: " . $row['TYPE'] . "</p>";
        echo "<p> Cost: " . $row['COST'] . "</p>";
        echo "<p> Sellprice: " . $row['SELLPRICE'] . "</p>";
        echo "<p> Manufacturer: " . $row['MANUFACTURER'] . "</p>";
        

    }

    $valArray = [];









    // Build the SQL UPDATE statement based on the input values
    $sql = "UPDATE MERCH SET ";
    if (!empty($cost)) {
        $sql .= "COST = $cost, ";
        $valArray["COST"] = $cost;
    }

    if (!empty($sell)) {
        $sql .= "SELLPRICE = $sell, ";
        $valArray["SELL"] = $sell;
    }

    if (!empty($where)) {
        $sql .= "WHEREITISSOLD = '$where', ";
        $valArray["WHERE"] = $where;
    }

    if (!empty($manufacturer)) {
        $sql .= "MANUFACTURER = '$manufacturer', ";
        $valArray["MANUFACTURER"] = $manufacturer;
    }

    // Remove the trailing comma and space from the SQL statement
    $sql = rtrim($sql, ", ");

    // Add the WHERE clause to specify the row to update
    $sql .= " WHERE MERCHID = $merchid AND DELETED = 0";

    // Execute the SQL statement
    $stmt = oci_parse($conn, $sql);
    oci_execute($stmt);


    // Check if any rows were affected
    if (!oci_execute($stmt))
    {
        $error = oci_error($stmt);
        switch ($error['code'])
        {
            case 20000:
                echo "<h1>Error: You are making the cost greater than the sell price</h2>";
                break;
        }
    }

    else
    {
        $num_rows = oci_num_rows($stmt);
        if ($num_rows > 0) 
        {
            echo "<h1>Successfully updated Merch: $merchid.</h1>";
            echo "<h2>These Values Were Updated</h2>";
            foreach ($valArray as $key => $value)
            {
                echo "<p>$key: $value</p>";
            }

            $sql = "SELECT * FROM MERCH WHERE MERCHID = $merchid AND DELETED = 0";
            $parse = oci_parse($conn,$sql);
            oci_execute($parse);

            echo "<h1>THE NEW VALUES OF MERCH: $merchid</h1>";
            while ($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS))
            {
                echo "<p> Type: " . $row['TYPE'] . "</p>";
                echo "<p> Cost: " . $row['COST'] . "</p>";
                echo "<p> Sellprice: " . $row['SELLPRICE'] . "</p>";
                echo "<p> Manufacturer: " . $row['MANUFACTURER'] . "</p>";
            }

        } 
        else 
        {
            echo "<h1>ID was entered in wrong/ID does not exist</h1>";
        }
    }
    

    echo "</body>";

    // Close the statement and database connection
    oci_free_statement($stmt);
    oci_close($conn);
    
} catch (Exception $e) {
    // Output error message to webpage
    echo "<div class='error'>" . $e->getMessage() . "</div>";
}
?>
