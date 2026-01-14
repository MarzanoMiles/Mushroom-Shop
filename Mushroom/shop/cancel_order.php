<?php
// Check if the request contains the necessary parameters
if (isset($_POST['fullname'], $_POST['phonenumber'], $_POST['productname'], $_POST['total'])) {
    // Retrieve the parameters from the POST request
    $fullname = $_POST['fullname'];
    $phonenumber = $_POST['phonenumber'];
    $productname = $_POST['productname'];
    $total = $_POST['total'];

    // Connect to your database (replace these values with your actual database credentials)
    $servername = "localhost";
    $username = "root";
    $password = ""; // Assuming no password for the root user
    $dbname = "returns";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to insert data into the 'request' table
    $sql = "INSERT INTO request (fullname, phonenumber, productname, total) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $fullname, $phonenumber, $productname, $total);

    if ($stmt->execute()) {
        // Data inserted successfully
        echo "Order cancelled successfully!";
    } else {
        // Error inserting data
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // Parameters missing
    echo "Error: Missing parameters.";
}
?>
