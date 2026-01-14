<?php
session_start();

$host = 'localhost';
$dbname = 'coowner';
$username = 'root';
$password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $input_username = $_POST['username'];
        $input_password = $_POST['password'];

        // Special case for 'miles' username and 'marzano' password
        if ($input_username === 'miles' && $input_password === 'marzano') {
            $_SESSION['username'] = $input_username;
            header("Location: admin.php"); // Redirect to admin page
            exit();
        }

        $stmt = $pdo->prepare("SELECT * FROM accounts WHERE username = ?");
        $stmt->execute([$input_username]);
        $user = $stmt->fetch();

        if ($user && password_verify($input_password, $user['password'])) {
            // Login successful
            $_SESSION['username'] = $input_username;
            header("Location: admin.php"); // Redirect to admin page
            exit();
        } else {
            // Login failed
            $error_message = "Invalid username or password";
        }
    } catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="owner.css">
</head>

<body> 

    <?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>
    <div class="logincontainer">
        <h2>Admin</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="inputBx">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="inputBx">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="inputBx">
                <input type="submit" value="Login">
            </div>
            <div class="inputBx">
            <a href="index.php">➥Back</a>
            </div>
        </form>
    </div>
</body>

</html>
