<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Login</title>
  <?php
  // Database connection parameters
  $servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
  $username = "root"; // Your MySQL username
  $password = ""; // Your MySQL password
  $database = "accounts"; // Your MySQL database name

  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Handle form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password (for secure storage and comparison)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query
    $sql = "SELECT * FROM members WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // User exists, verify password
      $row = $result->fetch_assoc();
      if (password_verify($password, $row['password'])) {
        // Password is correct, redirect to success page
        // send data sa next page
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['phonenumber'] = $row['phonenumber'];


        $username = $row['username'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $address = $row['address'];
        $phonenumber = $row['phonenumber'];
        header("Location: shop/shop.php?username=$username&firstname=$firstname&lastname=$lastname&email=$email&address=$address&phonenumber=$phonenumber");
        exit();
      } else {
        // Password is incorrect
        echo "<p><b>Incorrect username or password!</b></p>";
      }
    } else {
      // User does not exist
      echo "<p><b>User does not exist.</b></p>";
    }
  }

  // Close connection
  $conn->close();
  ?>
</head>

<body>
<a href="owner.php" class="backbuttn">➥ADMIN</a>
  <img src="Images/bgnd-cover2.png" id="bgnd">
  <!--ring div starts here-->
  <div class="ring">
    <i style="--clr:#00ff0a;"></i>
    <i style="--clr:#ff0057;"></i>
    <i style="--clr:#fffd44;"></i>
    <div class="login">
      <div class="logincontainer">
        <h2>Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <div class="inputBx">
            <input type="text" name="username" placeholder="Username">
          </div>
          <div class="inputBx">
            <input type="password" name="password" placeholder="Password">
          </div>
          <div class="inputBx">
            <input type="submit" value="Sign in">
          </div>
        </form>
        <div class="links">
          <a href="#">Don't have account?</a>
          <a href="signup.php"><button class="hovi"><ins>Sign-up</ins></button></a>
        </div>
      </div>
    </div>
  </div>
  <!--ring div ends here-->

</body>

</html>