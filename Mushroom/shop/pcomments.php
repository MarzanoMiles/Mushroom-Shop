<?php
// Database connection settings
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "productrating"; // Change this to your database name

try {
    // Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve comment data from POST request
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];

    // SQL statement to insert data into the comments table
    $sql = "INSERT INTO comments (name, rating, comment) VALUES (:name, :rating, :comment)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':comment', $comment);

    // Execute the SQL statement
    $stmt->execute();

    // Return success message
    echo "Comment added successfully!";
} catch(PDOException $e) {
    // Return error message
    echo "Error: " . $e->getMessage();
}

// Close connection
$conn = null;
?>
