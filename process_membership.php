<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
   
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "auth";
    $conn = new mysqli($host, $username, $password, $dbname);

   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO membership (first_name, last_name) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

  
    $stmt->bind_param("ss", $first_name, $last_name);
   
    $stmt->execute();

 
    if ($stmt->affected_rows > 0) {
        header("Location: process_successful.html");
    } else {
        echo "Error adding member: " . $conn->error;
    }


    $stmt->close();
    $conn->close();
} else {
 
    echo "Form submission method not allowed";
}
?>
