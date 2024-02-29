<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $family_info = $_POST["family_info"];
    $engagement_history = $_POST["engagement_history"];
    $membership_status = $_POST["membership_status"];

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "auth";
    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO profiles (first_name, last_name, email, phone, address, family_info, engagement_history, membership_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $first_name, $last_name, $email, $phone, $address, $family_info, $engagement_history, $membership_status);

    if ($stmt->execute()) {
        header("Location: profile_success.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}

