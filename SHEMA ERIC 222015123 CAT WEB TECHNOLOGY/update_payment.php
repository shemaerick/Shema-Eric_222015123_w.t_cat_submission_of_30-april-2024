<?php
include('db_connection.php');

// Check if Customer_id is set
if(isset($_REQUEST['Customer_id'])) {
    $custid = $_REQUEST['Customer_id'];
    
    // Prepare and execute SELECT query
    $stmt = $connection->prepare("SELECT * FROM payment WHERE Customer_id=?");
    $stmt->bind_param("i", $custid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if payment exists for given Customer_id
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['Order_id'];
        $z = $row['Payment_Amount'];
        $w = $row['Payment_Date'];
        $v = $row['Payment_Method'];
    } else {
        echo "Payment for Customer id not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of payment</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of payment form -->
    <h2><u>Update Form of payment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="ordid">Order id:</label>
        <input type="number" name="ordid" value="<?= isset($y) ? htmlspecialchars($y) : ''; ?>">
        <br><br>

        <label for="payamount">Payment Amount:</label>
        <input type="number" name="payamount" value="<?= isset($z) ? htmlspecialchars($z) : ''; ?>">
        <br><br>

        <label for="paydate">Payment Date:</label>
        <input type="date" name="paydate" value="<?= isset($w) ? htmlspecialchars($w) : ''; ?>">
        <br><br>

        <label for="paymethod">Payment Method:</label>
        <input type="text" name="paymethod" value="<?= isset($v) ? htmlspecialchars($v) : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
// Process form submission
if(isset($_POST['up'])) {
    $Order_id = $_POST['ordid'];
    $paymntAmount = $_POST['payamount'];
    $paymntDate = $_POST['paydate'];
    $paymentMethod = $_POST['paymethod'];
    
    // Update payment in the database
    $stmt = $connection->prepare("UPDATE payment SET Order_id=?, Payment_Amount=?, Payment_Date=?, Payment_Method=? WHERE Customer_id=?");
    $stmt->bind_param("sdssi", $Order_id, $paymntAmount, $paymntDate, $paymentMethod, $custid);
    $stmt->execute();
    
    // Redirect to payment.php
    header('Location: payment.php');
    exit();
}
?>
