<?php

include_once 'connect.php';


$employeeid = $_POST['EMPLOYEEID'];
$position = $_POST['POSITION'];
$sex = $_POST['SEX'];
$salary = $_POST['SALARY'];
$nameofemployee = $_POST['NAMEOFEMPLOYEE'];
$address = $_POST['ADDRESS'];
$birthdate = $_POST['BIRTHDATE'];
$manager = $_POST['MANAGER'];
$departmentid = $_POST['DEPARTMENTID']; 


if (empty($manager)){
    $manager = null;
}

$insert = "INSERT INTO EMPLOYEE (employeeid,position,sex,salary,nameofemployee,address,birthdate,manager,departmentid) VALUES ($employeeid, '$position', '$sex',  $salary, '$nameofemployee', '$address', TO_DATE('$birthdate','YYYY-MM-DD') , $manager, $departmentid)";
$stmt = oci_parse($conn, $insert);
$result = oci_execute($stmt);

//Insertion successful
if ($result === true) {

    // Echo tuple affected by update
    echo '<div class ="FormHeader">';
    echo '<h1>Insert New Employee Record</h1>';
    echo '</div>';

    echo '<div class="insert-record">';
    echo '<h2>Sucessfully Inserted Record Into Database</h2>';
    echo "<p><strong> Employee ID:</strong> " . $employeeid . "</p>";
    echo "<p><strong>Department ID:</strong> " . $departmentid . "</p>";
    echo "<p><strong>Sex:</strong> " . $sex . "</p>";
    echo "<p><strong>Salary:</strong> " . $salary . "</p>";
    echo "<p><strong>Name of employee:</strong> " . $nameofemployee . "</p>";
    echo "<p><strong>Address:</strong> " . $address . "</p>";
    echo "<p><strong>Birth Date:</strong> " . $birthdate . "</p>";
    echo "<p><strong>Manager:</strong> " . $manager . "</p>";


    echo '</div>';

} 
//Insertion failed
else {
echo '<div class ="FormHeader">';
echo '<h1>Insert Employee Record</h1>';
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
<title>Insert New Employee Record</title>
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