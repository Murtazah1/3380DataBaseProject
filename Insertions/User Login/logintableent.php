<?php

include_once 'connect.php';

// Get values from the form
$username = $_POST['USERNAME'];
$password = $_POST['USERPASSWORD'];
$typeofuser = $_POST['TYPEOFUSER'];


//Prepare Insert Query
$sql = "INSERT INTO LOGINTABLE (USERNAME, USERPASSWORD, TYPEOFUSER) VALUES (:username, :password,:typeofuser)";
$stmt = oci_parse($conn, $sql);

// Bind parameters to statement
oci_bind_by_name($stmt, ":username", $username);
oci_bind_by_name($stmt, ":password", $password);
oci_bind_by_name($stmt, ":typeofuser", $typeofuser);


//execute insert query
$result = oci_execute($stmt);

//Insertion successful
if ($result === true) {

        // Echo tuple affected by update
        echo '<div class ="FormHeader">';
        echo '<h1>Insert New User Record</h1>';
        echo '</div>';
    
        echo '<div class="insert-record">';
        echo '<h2>Sucessfully Inserted Record Into Database</h2>';
        echo "<p><strong>Username:</strong> " . $username . "</p>";
        echo "<p><strong>Password Cost:</strong> " . $password . "</p>";
        echo "<p><strong>Type of User:</strong> " . $typeofuser . "</p>";

        echo '</div>';
    
} 
//Insertion failed
else {
    echo '<div class ="FormHeader">';
    echo '<h1>Insert New User Record</h1>';
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
	<title>Insert New User Record</title>
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

