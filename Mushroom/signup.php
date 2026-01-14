<?php
// Database credentials
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "accounts"; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phonenumber = $_POST['phonenumber'];

    // Check if any field is empty
    if (empty($username) || empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($address) || empty($phonenumber)) {
        echo "<p><b>All fields are required!</b></p>";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO members (username, firstname, lastname, email, password, address, phonenumber) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $username, $firstname, $lastname, $email, $hashed_password, $address, $phonenumber);

        // Execute SQL statement
        if ($stmt->execute() === TRUE) {
            echo "New record created successfully";
            header("Location: index.php");
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <img src="Images/bgnd-cover2.png" id="bgnd">
    <a href="index.php" class="backbuttn">➥Back</a>
    <div class="ring">
        <i style="--clr:#00ff0a;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#fffd44;"></i>
        <div class="login">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="inputBx">
                    <input type="text" name="username" placeholder="Username">
                </div>
                <div class="inputBx">
                    <input type="text" name="firstname" placeholder="First Name">
                </div>
                <div class="inputBx">
                    <input type="text" name="lastname" placeholder="Last Name">
                </div>
                <div class="inputBx">
                    <input type="email" name="email" placeholder="Email">
                </div>
                <div class="inputBx">
                    <input type="password" name="password" placeholder="Password">
                </div>
                <div class="inputBx">
                    <input type="text" name="address" placeholder="Address">
                </div>
                <div class="inputBx">
                    <input type="text" name="phonenumber" placeholder="Phone Number">
                </div>
                <div class="inputBx">
                    <input type="submit" value="Sign Up">
                </div>
            </form>
        </div>
    </div>
</body>

</html>