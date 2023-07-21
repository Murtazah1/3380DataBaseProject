<?php


include_once 'connect.php';

$ACCID = $_POST['ACCOUNTID'];
$name = $_POST['NAMEOFCUSTOMER'];
$address = $_POST['ADDRESS'];
$birth = $_POST['BIRTHDATE'];
$pnum = $_POST['PHONENUMBER'];
$email = $_POST['EMAIL'];
$password = $_POST['CUSTPASS']; 

$insert = "INSERT INTO customerstats (accountid, nameofcustomer, address, birthdate, phonenumber, email, custpass) VALUES ($ACCID, '$name', '$address', TO_DATE('$birth','YYYY-MM-DD'), '$pnum', '$email', '$password')";
$stmt = oci_parse($conn, $insert);
$result = oci_execute($stmt);

//Insertion successful
if ($result === true) {

        // Echo tuple affected by update
        echo '<div class ="FormHeader">';
        echo '<h1>Insert New Customer Record</h1>';
        echo '</div>';
    
        echo '<div class="insert-record">';
        echo '<h2>Sucessfully Inserted Record Into Database</h2>';
        echo "<p><strong>Account ID:</strong> " . $ACCID . "</p>";
        echo "<p><strong>Name:</strong> " . $name . "</p>";
        echo "<p><strong>Address:</strong> " . $address . "</p>";
        echo "<p><strong>Birth:</strong> " . $birth . "</p>";
        echo "<p><strong>Phone Number:</strong> " . $pnum . "</p>";
        echo "<p><strong>Email:</strong> " . $email . "</p>";
        echo "<p><strong>Password:</strong> " . $password . "</p>";
        echo '</div>';
    
} 
//Insertion failed
else {
    echo '<div class ="FormHeader">';
    echo '<h1>Insert New Customer Record</h1>';
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
	<title>Insert New Customer Record</title>
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