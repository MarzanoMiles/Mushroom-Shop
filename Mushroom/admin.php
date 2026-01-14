<?php
session_start();

// Check if the username is set in the session
$style = '';
// set loggedin varia
$loggedInUser = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';

if (!isset($_SESSION['username'])) {
    $style = 'style="display: none;"';
}

// Check if logout button is clicked
if (isset($_POST['logout'])) {
    // Destroy the session
    session_destroy();
    // Redirect to the inside page
    header("Location: admin.php");
    exit();
}

if (isset($_POST['signin'])) {
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header("Location: owner.php");
    exit();
}
?>

<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the cancel button was clicked
if (isset($_POST['cancel'])) {
    $id = $_POST['id'];

    // Update the progress to "canceled"
    $sql = "UPDATE orders SET progress='CANCELED' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<p id='noti1'>Order $id marked as canceled.</p>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_POST['recieve'])) {
    $id = $_POST['id'];

    // Update the progress to "recieved"
    $sql = "UPDATE orders SET progress='DELIVERED' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<p id='noti2'>Order $id marked as recieved.</p>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Check if the delete button was clicked
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    // Delete the order
    $sql = "DELETE FROM orders WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "<p id='noti3'>Order $id Succeed.</p>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch all orders
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <?php if ($loggedInUser === 'Guest') : ?>
        <p id="noti7">All Data is Blocked if You're not Logged in</p><br>
        <div class="parent1">
            <!-- Form for logout button -->
            <form method="post" action="">
                <input type="submit" name="signin" value="Sign In">
            </form>
        </div>
    <?php endif; ?>
    <!--end for log condition-->
    <?php if ($loggedInUser !== 'Guest') : ?>


        <div class="admincontainer" <?php echo $style; ?>>
            <div class="parent">
                <!-- Display logged in user -->
                <p class="usernow">Hello Admin <?php echo ucfirst($loggedInUser); ?>!</p>
            </div>
            <br>
            <section>
                <h2 class="title">Client Orders</h2>
                <div class="parent1">
                    <table border="1">
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Full Name</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Refund</th>
                            <th>Progress</th>
                            <th colspan="3">Action</th>
                        </tr>

                        <?php
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["productname"] . "</td>";
                                echo "<td>" . $row["quantity"] . "</td>";
                                echo "<td>" . $row["price"] . "</td>";
                                echo "<td>" . $row["total"] . "</td>";
                                echo "<td>" . $row["fullname"] . "</td>";
                                echo "<td>" . $row["address"] . "</td>";
                                echo "<td>" . $row["phonenumber"] . "</td>";
                                echo "<td>" . $row["refund"] . "</td>";
                                echo "<td>" . $row["progress"] . "</td>";
                                echo "<td>";
                                echo "<form method='post' action=''>";
                                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                                echo "<input type='submit' name='cancel' value='Cancel'>";
                                echo "</form>";
                                echo "</td>";
                                echo "<td>";
                                echo "<form method='post' action=''>";
                                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                                echo "<input type='submit' name='recieve' value='Delivered'>";
                                echo "</form>";
                                echo "</td>";
                                echo "<td>";
                                echo "<form method='post' action=''>";
                                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                                echo "<input type='submit' name='delete' value='✔'>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='10'>No orders found</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </table>

                </div>
            </section>
            <br>
            <!--comments-->
            <?php
            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "productrating";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if the delete button was clicked
            if (isset($_POST['delete1'])) {
                $id = $_POST['id'];

                // Delete the comment
                $sql = "DELETE FROM comments WHERE id=$id";
                if ($conn->query($sql) === TRUE) {
                    echo "<p id='noti4'>Comment $id deleted.</p>";
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            }

            if (isset($_POST['warn'])) {
                $id = $_POST['id'];

                // Update the warning for the comment
                $sql = "UPDATE comments SET warning='Warning for your comment!' WHERE id=$id";
                if ($conn->query($sql) === TRUE) {
                    echo "<p id='noti5'>Warning added for comment $id.</p>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }

            // Fetch all comments
            $sql = "SELECT * FROM comments";
            $result = $conn->query($sql);

            ?>
            <!--Comments-->
            <section class="space">
                <h2 class="title">Ratings & Comments</h2>
                <div class="parent1">
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Created At</th>
                            <th colspan="2">Action</th>
                        </tr>

                        <?php
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["rating"] . "</td>";
                                echo "<td>" . $row["comment"] . "</td>";
                                echo "<td>" . $row["created_at"] . "</td>";
                                echo "<td>";
                                echo "<form method='post' action='' style='display:inline;'>";
                                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                                echo "<input type='submit' name='delete1' value='Delete'>";
                                echo "</form>";
                                echo "</td>";
                                echo "<td>";
                                echo "<form method='post' action='' style='display:inline;'>";
                                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                                echo "<input type='submit' name='warn' value='Add Warning'>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No comments found</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </table>

                </div>
            </section>
            <br>
            <section>
                <?php
                // Database connection parameters
                $host = 'localhost';
                $dbname = 'coowner';
                $username = 'root';
                $password = '';

                try {
                    // Connect to MySQL database using PDO
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

                    // Set PDO to throw exceptions on error
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Check if form data is submitted
                    if (isset($_POST['username']) && isset($_POST['password'])) {
                        // Retrieve form data
                        $username = $_POST['username'];
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt password

                        // Prepare SQL statement to insert data
                        $stmt = $pdo->prepare("INSERT INTO accounts (username, password) VALUES (?, ?)");
                        $stmt->execute([$username, $password]); // Execute the prepared statement with parameters

                        // Echo success message
                        echo "<p id='noti6'>Co-admin created successfully</p>";
                    }
                } catch (PDOException $e) {
                    // Handle database connection errors
                    if ($e->getCode() == '23000' && strpos($e->getMessage(), 'Duplicate entry') !== false) {
                        echo "";
                    } else {
                        echo "Error: " . $e->getMessage();
                    }
                }
                ?>
                <h2 class="title">Creat Co-Admins Accounts</h2>
                <div class="parent1">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="igor">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required><br><br>
                        <input type="submit" value="CREATE">
                    </form>
                </div>
            </section>
            <br>

            <section class="space">
                <?php
                // Database connection details
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "coowner";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Check if the delete button was clicked
                if (isset($_POST['delete2'])) {
                    $id = $_POST['id'];

                    // Delete the account
                    $sql = "DELETE FROM accounts WHERE id=$id";
                    if ($conn->query($sql) === TRUE) {
                        echo "<p id='noti7'>Account $id deleted.</p>";
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                }

                // Fetch all accounts
                $sql = "SELECT * FROM accounts";
                $result = $conn->query($sql);
                ?>
                <h2 class="title">Admin Accounts</h2>
                <div class="parent1">
                    <table border="1">
                        <tr>
                            <th>ID</th>
                            <th>Admin Account</th>
                            <th>Action</th>
                        </tr>

                        <?php
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["username"] . "</td>";
                                echo "<td>";
                                echo "<form method='post' action='' style='display:inline;'>";
                                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                                echo "<input type='submit' name='delete2' value='Delete'>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No accounts found</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </table>
                </div>
            </section>
        </div>
        <br>
        <div class="always-visible">
            <section>
                <div class="parent1">
                    <!-- Form for logout button -->
                    <form method="post" action="">
                        <input type="submit" name="logout" value="Log Out">
                    </form>
                </div>
            </section>
        </div>
    <?php endif; ?>
</body>

</html>