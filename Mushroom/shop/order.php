<?php
$servername = "localhost";  // Replace with your database server
$username = "root";         // Replace with your database username
$password = "";             // Replace with your database password
$dbname = "admin";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle cancel button click
if (isset($_GET['cancel_order_id'])) {
    $order_id = $_GET['cancel_order_id'];
    $sql = "UPDATE orders SET refund = 'PENDING' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();
    $cancel_message = "Please wait for the seller to accept your cancellation.";
}

// SQL to fetch orders with status 'checkout'
$sql = "SELECT * FROM `orders` WHERE `status` = 'checkout'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <link rel="stylesheet" href="order.css"> <!-- Link to external CSS file -->
</head>

<body>
    <a class="aljonbutton" href="shop.php">Back</a>
    <h1>Order Status</h1>
    <?php
    // Show the cancellation message if it was set
    if (isset($cancel_message)) {
        echo "<div class='cancel-message'>$cancel_message</div>";
    }
    ?>

    <div class="container">
        <!-- Canceled Orders Table -->
        <div>
            <h2>Canceled</h2>
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Progress</th>
                </tr>
                <?php
                $hasCanceled = false;
                while ($row = $result->fetch_assoc()) {
                    if ($row['status'] == 'checkout' && $row['progress'] == 'CANCELED') {
                        $hasCanceled = true;
                        echo "<tr>
                                <td>" . $row['productname'] . "</td>
                                <td>" . $row['quantity'] . "</td>
                                <td>" . $row['total'] . "</td>
                                <td>" . $row['address'] . "</td>
                                <td>" . $row['phonenumber'] . "</td>
                                <td>" . $row['progress'] . "</td>
                              </tr>";
                    }
                }
                if (!$hasCanceled) {
                    echo "<tr><td colspan='6'>No canceled orders found</td></tr>";
                }
                ?>
            </table>
        </div>

        <!-- In Progress Orders Table -->
        <div>
            <h2>In Progress</h2>
            <table>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Action</th> <!-- New column for the Cancel button -->
                </tr>
                <?php
                $hasInProgress = false;
                // Reset the result pointer again
                $result->data_seek(0);
                while ($row = $result->fetch_assoc()) {
                    if ($row['status'] == 'checkout' && $row['progress'] == NULL) {
                        $hasInProgress = true;
                        echo "<tr>
                                <td>" . $row['productname'] . "</td>
                                <td>" . $row['quantity'] . "</td>
                                <td>" . $row['total'] . "</td>
                                <td>" . $row['address'] . "</td>
                                <td>" . $row['phonenumber'] . "</td>
                                <td><a href='?cancel_order_id=" . $row['id'] . "' class='cancel-button'>Cancel</a></td> <!-- Cancel button link --></td>
                              </tr>";
                    }
                }
                if (!$hasInProgress) {
                    echo "<tr><td colspan='6'>No orders in progress</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <!-- Delivered Orders Table -->
    <div>
        <h2>Delivered</h2>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Progress</th>
            </tr>
            <?php
            $hasDelivered = false;
            // Reset the result pointer back to the beginning
            $result->data_seek(0);
            while ($row = $result->fetch_assoc()) {
                if ($row['status'] == 'checkout' && $row['progress'] == 'DELIVERED') {
                    $hasDelivered = true;
                    echo "<tr>
                                <td>" . $row['productname'] . "</td>
                                <td>" . $row['quantity'] . "</td>
                                <td>" . $row['total'] . "</td>
                                <td>" . $row['address'] . "</td>
                                <td>" . $row['phonenumber'] . "</td>
                                <td>" . $row['progress'] . "</td>
                              </tr>";
                }
            }
            if (!$hasDelivered) {
                echo "<tr><td colspan='6'>No delivered orders found</td></tr>";
            }
            ?>
        </table>
    </div>


    <script src="script.js"></script>

    <script>
        autoRefresh();
    </script>
</body>

</html>

<?php
$conn->close();
?>