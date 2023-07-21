
<?php

include_once 'connect.php';

$managerid = $_POST['MANAGERID'];
$name = $_POST['NAME'];
$departmentid = $_POST['DEPARTMENTID'];

$sql = "INSERT INTO managers (managerid, name, departmentid) VALUES ($managerid, '$name', $departmentid)";
$stmt = oci_parse($conn, $sql);


if (oci_execute($stmt)) {
    echo '<div class ="FormHeader">';
    echo '<h1>Insert New Manager</h1>';
    echo '</div>';
    
    echo '<div class="insert-record">';
    echo '<h2>Sucessfully Inserted Record Into Database</h2>';
    echo "<p><strong>Manager ID:</strong> " . $managerid . "</p>";
    echo "<p><strong>Name:</strong> " . $name . "</p>";
    echo "<p><strong>Department ID:</strong> " . $departmentid . "</p>";
    echo '</div>';
} else {
    echo '<div class ="FormHeader">';
    echo '<h1>Insert New Manager Record</h1>';
    echo '</div>';

    echo '<div class="insert-record">';
    echo '<h2>Insertion into Database Has Failed.</h2>';
    echo '<p><strong>Incorrect Data Entered</p>';
    echo '</div>';
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert New Legal Record</title>
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


