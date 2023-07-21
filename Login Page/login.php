<?php

include_once 'connect.php';

        // Check if the form has been submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get values from the form
                $name = $_POST['uname'];
                $password = $_POST['password'];


                // Prepare and execute SQL statement to insert values into the database
                $sql = "SELECT TYPEOFUSER FROM LOGINTABLE WHERE USERNAME = :var1 AND USERPASSWORD =:var2";
                $stmt = oci_parse($conn, $sql);
                
    
                oci_bind_by_name($stmt, ":var1", $name);
                oci_bind_by_name($stmt, ":var2", $password);
                
                //execute query 
                oci_execute($stmt);
                $row = oci_fetch_array($stmt);

                //result found
                if($row  != false){
                    echo "Query Success";
                    switch($row['TYPEOFUSER']){
                        case "admin":
                            header("Location:http://129.146.42.73/cosc3380/admin_page.html");
                            exit();
                        
                        case "manager":
                            header("Location:http://129.146.42.73/cosc3380/managers_page.html");
                            exit();
    
                        case "employee":
                            header("Location:http://129.146.42.73/cosc3380/employees_page.html");
                            exit();
                    };
                }
                else{
                    echo "Username or password is incorrect";
                }


                /// Close the connection
                oci_free_statement($stmt);
                oci_close($conn);
            }
        ?>

<!DOCTYPE html>
<html lang ="en">

<html>

<head>

  <title>CougarLand </title>

  <link rel="stylesheet" type="text/css" href="loginpage.css">

</head>

<body>

  <form action="login.php" method="POST">

    <label> CougarLand </label>

    <input type="text" name="uname" placeholder="User Name"><br>

    <input type="password" name="password" placeholder="Password"><br> 

    <button type="submit">Login</button>

  </form>
    

</body>

</html>