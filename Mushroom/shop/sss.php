<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My orders</title>
    <link rel="stylesheet" href="shop.css">
</head>

<body>
    <?php
    // Retrieve the values from the URL parameters
    $fullname = $_GET['fullname'];
    $address = $_GET['address'];
    $phonenumber = $_GET['phonenumber'];

    // Ensure that the values are not empty (add more validation as needed)
    if (!empty($fullname) && !empty($address) && !empty($phonenumber)) {
        // Connect to your database (replace these values with your actual database credentials)
        $conn = new mysqli("localhost", "root", "", "admin");

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL query with WHERE clauses to filter the data
        $sql = "SELECT productname, quantity, total FROM orders WHERE fullname = ? AND address = ? AND phonenumber = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $fullname, $address, $phonenumber);
        $stmt->execute();
        $result = $stmt->get_result();

        // Display the received data
        if ($result->num_rows > 0) {
    ?>
           
             <a class="aljonbutton"href="shop.php">Back</a>
            <h2 class="ord">Orders</h2>
            <div class="modparent">
                <div id="cancelMessage"></div>
                <div class="mod-container">
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <div class="comment">
                            <div id="displaypname"><?php echo $row["productname"]; ?></div>
                            <div id="displayquan">
                                <pre>Quantity: <?php echo $row["quantity"]; ?></pre>
                            </div>
                            <div id="displaytot">
                                <pre>₱ <?php echo $row["total"]; ?></pre>
                            </div>
                            <div><button class="cnlbutton" onclick="cancelOrder('<?php echo $fullname; ?>', '<?php echo $phonenumber; ?>', '<?php echo $row["productname"]; ?>', '<?php echo $row["total"]; ?>')">Cancel</button></div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
           
    <?php
        } else {
            echo "No data found for the provided information.";
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid or missing parameters.";
    }
    ?>
    <script src="script.js"> </script>

</body>

</html>
modify code put checkbox per item displayed to checkout (button) update orders column status to 'checkout', remove buttons like cancel instead make it delete the item in database from orders table  
dont use java script for delete remove js function