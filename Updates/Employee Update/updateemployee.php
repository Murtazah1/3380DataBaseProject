<?php
include_once 'connect.php';

// Get the input values from the HTML form
$employeeid = $_POST['EMPLOYEEID'];
$position = $_POST['POSITION'];
$salary = $_POST['SALARY'];
$nameofemployee = $_POST['NAMEOFEMPLOYEE'];
$birthdate = $_POST['BIRTHDATE'];
$manager = $_POST['MANAGER'];
$departmentid = $_POST['DEPARTMENTID'];
$address = $_POST['ADDRESS'];


echo "<head>";
echo "<title>Merch Update</title>";
echo "<link rel='stylesheet' type='text/css' href='reportone.css'>";
echo "</head>";

echo "<body>";


//getting the old values of employee

$sql = "SELECT * FROM EMPLOYEE WHERE EMPLOYEEID = $employeeid AND DELETED = 0";
$parse = oci_parse($conn,$sql);
oci_execute($parse);

echo "<h1>THE OLD VALUES OF EMPLOYEE: $employeeid</h1>";
while ($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<p> Name: " . $row['NAMEOFEMPLOYEE'] . "</p>";
    echo "<p> Position: " . $row['POSITION'] . "</p>";
    echo "<p> Sex: " . $row['SEX'] . "</p>";
    echo "<p> Salary: " . $row['SALARY'] . "</p>";  
    echo "<p> Birthdate: " . $row['BIRTHDATE'] . "</p>";
    echo "<p> DepartmentID: " . $row['DEPARTMENTID'] . "</p>";
    echo "<p> Address: " . $row['ADDRESS'] . "</p>";  
}


$valArray = [];

// Build the SQL UPDATE statement based on the input values
$sql = "UPDATE EMPLOYEE SET ";
if (!empty($position)) {
    $sql .= "POSITION = '$position', ";
    $valArray["POSITION"] = $position;
}
if (!empty($salary)) {
    $sql .= "SALARY = $salary, ";
    $valArray["SALARY"] = $salary;
}
if (!empty($nameofemployee)) {
    $sql .= "NAMEOFEMPLOYEE = '$nameofemployee', ";
    $valArray["NAME"] = $nameofemployee;
}
if (!empty($birthdate)) {
    $sql .= "BIRTHDATE = TO_DATE('$birthdate','YYYY-MM-DD'), ";
    $valArray["BIRTHDAY"] = $birthdate;
}
if (!empty($manager)) {
    $sql .= "MANAGER = $manager, ";
    $valArray["MANAGER"] = $manager;
}
if (!empty($departmentid)) {
    $sql .= "DEPARTMENTID = $departmentid, ";
    $valArray["DEPARTMENT"] = $departmentid;
}
if (!empty($address)) {
    $sql .= "ADDRESS = '$address', ";
    $valArray["ADDRESS"] = $address;
}

// Remove the trailing comma and space from the SQL statement
$sql = rtrim($sql, ", ");

// Add the WHERE clause to specify the row to update
$sql .= " WHERE EMPLOYEEID = $employeeid AND DELETED = 0";

// Execute the SQL statement
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);

if (oci_execute($stmt)) {
    echo "<h1>SuccessfullY Updated Emmployee: $employeeidy</h1>";
    echo "<h2>These Values Were Updated</h2>";
    foreach ($valArray as $key => $value)
    {
        echo "<p>$key: $value</p>";
    }

    $sql = "SELECT * FROM EMPLOYEE WHERE EMPLOYEEID = $employeeid AND DELETED = 0";
    $parse = oci_parse($conn,$sql);
    oci_execute($parse);

    echo "<h1>THE NEW VALUES OF EMPLOYEE: $employeeid</h1>";
    while ($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)) {
        echo "<p> Name: " . $row['NAMEOFEMPLOYEE'] . "</p>";
        echo "<p> Position: " . $row['POSITION'] . "</p>";
        echo "<p> Sex: " . $row['SEX'] . "</p>";
        echo "<p> Salary: " . $row['SALARY'] . "</p>";  
        echo "<p> Birthdate: " . $row['BIRTHDATE'] . "</p>";
        echo "<p> DepartmentID: " . $row['DEPARTMENTID'] . "</p>";
        echo "<p> Address: " . $row['ADDRESS'] . "</p>";  
    }



} else {
    $m = oci_error($stmt);
    echo $m['message'], "\n";
}
    

// Close the statement and database connection
oci_free_statement($stmt);
oci_close($conn);
?>