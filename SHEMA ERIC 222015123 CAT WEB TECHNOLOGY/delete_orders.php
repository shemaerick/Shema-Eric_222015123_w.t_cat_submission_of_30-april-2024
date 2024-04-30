<?php
include('db_connection.php');

// Check if Order_Id is set
if(isset($_REQUEST['Order_id'])) {
    $ordid = $_REQUEST['Order_id'];

    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM orders WHERE Order_id=?");
    $stmt->bind_param("i", $ordid);
     ?>
          <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="ordid" value="<?php echo $ordid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='orders.PHP'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "Order_id is not set.";
}

$connection->close();
?>
