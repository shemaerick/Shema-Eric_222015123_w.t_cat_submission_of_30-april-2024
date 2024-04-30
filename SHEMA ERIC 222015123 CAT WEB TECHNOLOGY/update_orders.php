 <?php
include('db_connection.php');

// Check if Order_Id is set
if(isset($_REQUEST['Order_id'])) {
    $ordid = $_REQUEST['Order_id'];
    
    $stmt = $connection->prepare("SELECT * FROM orders WHERE Order_id=?");
    $stmt->bind_param("i", $ordid);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Order_id'];
        $y = $row['Customer_id'];
        $z = $row['Flower_id'];
        $w = $row['Farmer_id'];
        $p = $row['Quantity'];
        $q = $row['Total_Price'];
        $u = $row['Order_Date'];
    } else {
        echo "Order id not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of Orders</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of Orders form -->
    <h2><u>Update Form of Orders</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="custid">Customer id:</label>
        <input type="number" name="custid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="flrid">Flower id:</label>
        <input type="number" name="flrid" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="farmid">Farmer id:</label>
        <input type="number" name="farmid" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="qty">Quantity:</label>
        <input type="number" name="qty" value="<?php echo isset($p) ? $p : ''; ?>">
        <br><br>

        <label for="priceunit">Total Price:</label>
        <input type="number" name="priceunit" value="<?php echo isset($q) ? $q : ''; ?>">
        <br><br>

        <label for="orddate">Order Date:</label>
        <input type="date" name="orddate" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Customer_id = $_POST['custid'];
    $Flower_id = $_POST['flrid'];
    $Farmer_id = $_POST['farmid'];
    $Quantity = $_POST['qty'];
    $Total_Price = $_POST['priceunit'];
    $Order_Date = $_POST['orddate'];
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE orders SET Customer_id=?, Flower_id=?,Farmer_id=?,Quantity=?,Total_Price=?,Order_Date=? WHERE Order_id=?");
    $stmt->bind_param("ssdibbb", $Customer_id, $Flower_id, $Farmer_id, $qty, $Total_Price, $Order_Date, $ordid);
    $stmt->execute();
    // Redirect to product.php
    header('Location: orders.PHP');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
