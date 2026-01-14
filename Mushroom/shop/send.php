<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$dbname = "admin"; // Change to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if all necessary POST parameters are set
if(isset($_POST['productname']) && isset($_POST['quantity']) && isset($_POST['price']) && isset($_POST['total']) && isset($_POST['fullname']) && isset($_POST['address']) && isset($_POST['phonenumber'])) {
    // Get data from POST request
    $productName = $_POST['productname'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total = $_POST['total'];
    $fullName = $_POST['fullname'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phonenumber'];

    // Escape special characters to prevent SQL injection
    $productName = $conn->real_escape_string($productName);
    $fullName = $conn->real_escape_string($fullName);
    $address = $conn->real_escape_string($address);
    $phoneNumber = $conn->real_escape_string($phoneNumber);

    // Insert data into MySQL table
    $sql = "INSERT INTO orders (productname, quantity, price, total, fullname, address, phonenumber) VALUES ('$productName', '$quantity', '$price', '$total', '$fullName', '$address', '$phoneNumber')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: Missing POST parameters";
}

// Close connection
$conn->close();
?>
