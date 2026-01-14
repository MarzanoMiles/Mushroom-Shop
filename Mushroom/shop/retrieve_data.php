<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="retrieve_data.css">
</head>

<body>
<?php
// Retrieve the values from the URL parameters
$fullname = $_GET['fullname'];
$address = $_GET['address'];
$phonenumber = $_GET['phonenumber'];

// Ensure that the values are not empty
if (!empty($fullname) && !empty($address) && !empty($phonenumber)) {
    // Connect to your database
    $conn = new mysqli("localhost", "root", "", "admin");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query with WHERE clauses to filter the data
    $sql = "SELECT id, productname, quantity, total FROM orders WHERE fullname = ? AND address = ? AND phonenumber = ? AND status != 'checkout'";
    
    // Debugging the query and checking for errors
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $fullname, $address, $phonenumber);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        die("Error preparing statement: " . $conn->error);
    }

    $thankYouMessage = ""; // Initialize the thank you message variable

    // Check if form submission happened
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['checkout'])) {
            // Update selected items to "checkout"
            if (!empty($_POST['selected_items'])) {
                foreach ($_POST['selected_items'] as $item_id) {
                    $update_sql = "UPDATE orders SET status = 'checkout' WHERE id = ?";
                    $update_stmt = $conn->prepare($update_sql);
                    $update_stmt->bind_param("i", $item_id);
                    $update_stmt->execute();
                    $update_stmt->close();
                }
                $thankYouMessage = "Thank you! Your selected items have been successfully checked out."; // Set the thank you message
            }
        } elseif (isset($_POST['delete'])) {
            // Delete selected items from the database
            if (!empty($_POST['selected_items'])) {
                foreach ($_POST['selected_items'] as $item_id) {
                    $delete_sql = "DELETE FROM orders WHERE id = ?";
                    $delete_stmt = $conn->prepare($delete_sql);
                    $delete_stmt->bind_param("i", $item_id);
                    $delete_stmt->execute();
                    $delete_stmt->close();
                }
            }
        }

        // Refresh the page to reflect changes
        header("Location: " . $_SERVER['PHP_SELF'] . "?fullname=$fullname&address=$address&phonenumber=$phonenumber&thankYouMessage=" . urlencode($thankYouMessage));
        exit;
    }

    // Display the thank you message if present
    if (!empty($_GET['thankYouMessage'])) {
        echo "<p style='text-align: center; color: green; font-weight: bold;'>" . htmlspecialchars($_GET['thankYouMessage']) . "</p>";
    }
?>

    <a class="aljonbutton" href="shop.php">Back</a>
    <h2 class="ord">Orders</h2>
    <form method="POST">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><input type="checkbox" name="selected_items[]" value="<?php echo $row['id']; ?>"></td>
                            <td><?php echo $row['productname']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td>₱ <?php echo $row['total']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">No items found for the provided information.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if ($result->num_rows > 0) : ?>
            <button type="submit" name="checkout" class="checkoutbutton">Checkout</button>
            <button type="submit" name="delete" class="deletebutton">Remove</button>
        <?php endif; ?>
    </form>

<?php
    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo "<p style='text-align: center;'>Invalid or missing parameters.</p>";
}
?>

    <script src="script.js"> </script>
</body>

</html>
