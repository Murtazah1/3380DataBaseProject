<?php
include_once 'connect.php';

// Get the input values from the HTML form
$accountid = $_POST['ACCOUNTID'];
$birthdate = $_POST['BIRTHDATE'];
$custpass = $_POST['CUSTPASS'];
$email = $_POST['EMAIL'];
$nameofcustomer = $_POST['NAMEOFCUSTOMER'];
$address = $_POST['ADDRESS'];
$phonenumber = $_POST['PHONENUMBER'];

// Select the affected row and display its data before update.
$foundMatch = "SELECT * FROM CUSTOMERSTATS WHERE ACCOUNTID =:accountid AND DELETED = 0";

$foundstmt = oci_parse($conn, $foundMatch);
oci_bind_by_name($foundstmt, ':accountid', $accountid);
oci_execute($foundstmt);

//find number of matching rows.
$selectResult = oci_fetch_assoc($foundstmt);

//if account is found
if ($selectResult){

    echo '<div class ="FormHeader">';
    echo '<h1>Update Customer Record</h1>';
    echo '</div>';
    
    echo '<div class="updated-record">';
    echo '<h2>Found Matching Data:</h2>';
    echo "<p><strong>Account ID:</strong> " . $selectResult['ACCOUNTID'] . "</p>";
    echo "<p><strong>Customer Password:</strong> " . $selectResult['CUSTPASS'] . "</p>";
    echo "<p><strong>Name:</strong> " . $selectResult['NAMEOFCUSTOMER'] . "</p>";
    echo "<p><strong>Address:</strong> " . $selectResult['ADDRESS'] . "</p>";
    echo "<p><strong>Phone Number:</strong> " . $selectResult['PHONENUMBER'] . "</p>";
    echo "<p><strong>Email:</strong> " . $selectResult['EMAIL'] . "</p>";
    echo "<p><strong>Birthdate:</strong> " . date('m-d-Y', strtotime($selectResult['BIRTHDATE'])) . "</p>";
    
    echo '</div>';


    // Build the SQL UPDATE statement based on the input values
    $sql = "UPDATE CUSTOMERSTATS SET ";
    $updates = [];
    $params = [];
    if (!empty($birthdate)) {
        $birthdate = date('d-M-Y', strtotime($_POST['BIRTHDATE']));
        $updates[] = "BIRTHDATE = :birthdate";
        $params[":birthdate"] = $birthdate;
    }
    if (!empty($custpass)) {
        $updates[] = "CUSTPASS = :custpass";
        $params[":custpass"] = $custpass;
    }
    if (!empty($email)) {
        $updates[] = "EMAIL = :email";
        $params[":email"] = $email;
    }
    if (!empty($phonenumber)) {
        $updates[] = "PHONENUMBER = :phonenumber";
        $params[":phonenumber"] = $phonenumber;
    }
    if (!empty($nameofcustomer)) {
        $updates[] = "NAMEOFCUSTOMER = :nameofcustomer";
        $params[":nameofcustomer"] = $nameofcustomer;
    }
    if (!empty($address)) {
        $updates[] = "ADDRESS = :address";
        $params[":address"] = $address;
    }

    // Combine the updates into the SQL statement
    $sql .= implode(", ", $updates);

    // Add the WHERE clause to specify the row to update
    $sql .= " WHERE ACCOUNTID = :accountid AND DELETED = 0";
    $params[":accountid"] = $accountid;

    // Execute the Update SQL statement
    $stmt = oci_parse($conn, $sql);
    foreach ($params as $key => $value) {
        oci_bind_by_name($stmt, $key, $params[$key]);
    }
    $result = oci_execute($stmt);

    //Echo tuple affected by update
    $query = "SELECT * FROM CUSTOMERSTATS WHERE ACCOUNTID = :accountid AND DELETED = 0";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ":accountid", $accountid);
    oci_execute($stmt);
    $row = oci_fetch_assoc($stmt);
    
    
    echo '<div class="updated-record">';
    echo '<h2>Sucessfully Updated Record</h2>';
    echo "<p><strong>Account ID:</strong> " . $row['ACCOUNTID'] . "</p>";
    echo "<p><strong>Customer Password:</strong> " . $row['CUSTPASS'] . "</p>";
    echo "<p><strong>Name:</strong> " . $row['NAMEOFCUSTOMER'] . "</p>";
    echo "<p><strong>Address:</strong> " . $row['ADDRESS'] . "</p>";
    echo "<p><strong>Phone Number:</strong> " . $row['PHONENUMBER'] . "</p>";
    echo "<p><strong>Email:</strong> " . $row['EMAIL'] . "</p>";
    echo "<p><strong>Birthdate:</strong> " . date('m-d-Y', strtotime($row['BIRTHDATE'])) . "</p>";
    echo '</div>';
    
}

//no matching ID found
else {
    echo '<div class ="FormHeader">';
    echo '<h1>Update Customer Record</h1>';
    echo '</div>';
    echo '<div class="updated-record">';
    echo '<h2>Update has failed.</h2>';
    echo '<p><strong>Incorrect ID entered</p>';
    echo '</div>';
}


// Close the statement and database connection
oci_free_statement($stmt);
oci_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Customer Information</title>
    <style>
        .updated-record {
            display:block;
            background-color: lightgray;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: auto;
            width: 50%;
            padding: 20px;
            text-align: center;
            margin-bottom:50px;
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