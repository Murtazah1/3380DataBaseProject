<?php

include_once 'connect.php';

// get the location
$locationString = $_POST['LOCATION'];
$location = 0;

switch($locationString){
    case "Wild West World":
        $location = 1;
        break;

    case "Fantasylandia":
        $location = 2;
        break;

    case "Oceanic World":
        $location = 3;
        break;
    
    case "Space Odyssey Park":
        $location = 4;
        break;
    
    case "Medieval Kingdoms":
        $location = 5;
        break;
    
    case "DinoLand Adventure":
        $location = 6;
        break;

    case "Enchanted Forest Park":
        $location = 7;
        break;

    case "Time Traveler's Kingdom":
        $location = 8;
        break;

    case "Adventure Oasis":
        $location = 9;
        break;
}




echo "<head>";
echo "<title>Report 2</title>";
echo "<link rel='stylesheet' type='text/css' href='reportone.css'>";
echo "</head>";


echo "<body>";

echo "<h1>ALL THE ITEMS AT LOCATION $locationString</h1>";

// get all the shops at location
echo "<h2>ALL THE SHOPS AT LOCATION $locationString</h2>";
$sql = "SELECT NAMEOFSHOP 
        AS structname FROM SHOP WHERE LOCATION = $location AND  DELETED = 0";
$parse = oci_parse($conn,$sql);
oci_execute($parse);


echo "<ul>";
// Loop through the query results and echo each row as a list item
while ($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<li>" . $row['STRUCTNAME'] . "</li>";
}

// End the unordered list
echo "</ul>";


// get all the eomployees that work there as well
echo "<p>All the employees that work in the shops at location $locationString</p>";
$sql = "SELECT NAMEOFEMPLOYEE FROM EMPLOYEE 
        JOIN WORKSON_SHOPS ON EMPLOYEE.EMPLOYEEID = WORKSON_SHOPS.EMPID 
        WHERE EMPLOYEE.DELETED = 0 AND WORKSON_SHOPS.SHOPNAME = (SELECT NAMEOFSHOP FROM SHOP WHERE LOCATION = $location AND SHOP.DELETED = 0)";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
echo "<ul>";
// Loop through the query results and echo each row as a list item
while ($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<li>" . $row['NAMEOFEMPLOYEE'] . "</li>";
}

// End the unordered list
echo "</ul>";





// get all the Restaurants at location
echo "<h2>ALL THE RESTAURANTS AT LOCATION $locationString</h2>";
$sql = "SELECT NAMEOFRESTAURANT AS structname FROM RESTAURANTS WHERE LOCATION = $location AND DELETED = 0";
$parse = oci_parse($conn,$sql);
oci_execute($parse);


echo "<ul>";
// Loop through the query results and echo each row as a list item
while ($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<li>" . $row['STRUCTNAME'] . "</li>";
}

// End the unordered list
echo "</ul>";


// get all the employees that work there as well
echo "<p>All the employees that work in the restaurants at location $locationString</p>";
$sql = "SELECT NAMEOFEMPLOYEE FROM EMPLOYEE 
        JOIN WORKSON_RES ON EMPLOYEE.EMPLOYEEID = WORKSON_RES.EMPID 
        WHERE EMPLOYEE.DELETED = 0 AND WORKSON_RES.RESNAME = (SELECT NAMEOFRESTAURANT FROM RESTAURANTS WHERE LOCATION = $location AND DELETED = 0)";
$parse = oci_parse($conn,$sql);
oci_execute($parse);
echo "<ul>";
// Loop through the query results and echo each row as a list item
while ($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<li>" . $row['NAMEOFEMPLOYEE'] . "</li>";
}

// End the unordered list
echo "</ul>";


// get all the rides at location
echo "<h2>ALL THE RIDES AT LOCATION $locationString</h2>";
$sql = "SELECT RIDENAME AS structname FROM RIDE WHERE LOCATION = $location AND DELETED = 0";
$parse = oci_parse($conn,$sql);
oci_execute($parse);


echo "<ul>";
// Loop through the query results and echo each row as a list item
while ($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<li>" . $row['STRUCTNAME'] . "</li>";
}

// End the unordered list
echo "</ul>";


// get all the employees that work there as well
echo "<p>All the employees that work in the rides at location $locationString</p>";
$sql = "SELECT NAMEOFEMPLOYEE FROM EMPLOYEE 
    JOIN WORKSON_RIDE ON EMPLOYEE.EMPLOYEEID = WORKSON_RIDE.EMPID JOIN RIDE ON RIDE.RIDEID = WORKSON_RIDE.RIDEID 
    WHERE EMPLOYEE.DELETED = 0 AND RIDE.LOCATION = $location AND RIDE.DELETED = 0";
        
$parse = oci_parse($conn,$sql);
oci_execute($parse);
echo "<ul>";
// Loop through the query results and echo each row as a list item
while ($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<li>" . $row['NAMEOFEMPLOYEE'] . "</li>";
}

// End the unordered list
echo "</ul>";



// the query to get the locations
$local = "SELECT structname, structlocal, tablename FROM 
        (SELECT 'Rides' AS tablename, RIDENAME AS structname, LOCATION AS structlocal FROM RIDE WHERE DELETED = 0 
        UNION 
        SELECT 'Shops' AS tablename, NAMEOFSHOP AS structname,LOCATION AS structlocal FROM SHOP WHERE DELETED = 0 
        UNION 
        SELECT 'Restaurants' AS tablename,NAMEOFRESTAURANT AS structname, LOCATION AS structlocal FROM RESTAURANTS WHERE DELETED = 0)
        WHERE structlocal = $location";
$stmt = oci_parse($conn,$local);
oci_execute($stmt);

// Create a table to display the data



echo "<h1>THE AGGREGATE ITEMS AT LOCATION $locationString</h1>";
echo "<table>
<tr>
<th>NAME</th>
<th>TYPE OF STRUCTURE</th>
</tr>";

// Loop through the rows and display the data
while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>";
    echo "<td>" . $row['STRUCTNAME'] . "</td>";
    echo "<td>" . $row['TABLENAME'] . "</td>";
    echo "</tr>";
}

// Close the table tag
echo "</table>";


// aggregate employyees at location
$sql = "SELECT EMPNAME, STRUCTNAME, TABLENAME FROM (

    SELECT 'SHOPS' AS TABLENAME, NAMEOFEMPLOYEE AS EMPNAME, SHOP.NAMEOFSHOP AS STRUCTNAME FROM EMPLOYEE 
    JOIN WORKSON_SHOPS ON EMPLOYEE.EMPLOYEEID = WORKSON_SHOPS.EMPID JOIN SHOP ON WORKSON_SHOPS.SHOPNAME = SHOP.NAMEOFSHOP
    WHERE EMPLOYEE.DELETED = 0 AND SHOP.LOCATION = $location AND SHOP.DELETED = 0
    
    UNION
    
    SELECT 'RESTAURANTS' AS TABLENAME, NAMEOFEMPLOYEE AS EMPNAME, RESTAURANTS.NAMEOFRESTAURANT AS STRUCTNAME FROM EMPLOYEE 
    JOIN WORKSON_RES ON EMPLOYEE.EMPLOYEEID = WORKSON_RES.EMPID JOIN RESTAURANTS ON WORKSON_RES.RESNAME = RESTAURANTS.NAMEOFRESTAURANT
    WHERE EMPLOYEE.DELETED = 0 AND RESTAURANTS.LOCATION = $location AND RESTAURANTS.DELETED = 0
    
    UNION
    
    SELECT 'RIDES' AS TABLENAME, EMPLOYEE.NAMEOFEMPLOYEE AS EMPNAME, RIDE.RIDENAME AS STRUCTNAME FROM EMPLOYEE 
    JOIN WORKSON_RIDE ON EMPLOYEE.EMPLOYEEID = WORKSON_RIDE.EMPID
    JOIN RIDE ON RIDE.RIDEID = WORKSON_RIDE.RIDEID 
    WHERE EMPLOYEE.DELETED = 0 AND RIDE.LOCATION = $location AND RIDE.DELETED = 0)";


$parse = oci_parse($conn,$sql);
oci_execute($parse);


echo "<h1>THE AGGREGATE EMPLOYEES AT LOCATION $locationString</h1>";
echo "<table>
<tr>
<th>EMPLOYEE NAME</th>
<th>STRUCTURE NAME</th>
<th>TYPE OF STRUCTURE</th>
</tr>";

// Loop through the rows and display the data
while ($row = oci_fetch_array($parse, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>";
    echo "<td>" . $row['EMPNAME'] . "</td>";
    echo "<td>" . $row['STRUCTNAME'] . "</td>";
    echo "<td>" . $row['TABLENAME'] . "</td>";
    echo "</tr>";
}

// Close the table tag
echo "</table>";






echo "</body>";

?>