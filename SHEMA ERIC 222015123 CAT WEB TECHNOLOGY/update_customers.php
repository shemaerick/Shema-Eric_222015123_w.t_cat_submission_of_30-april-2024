<?php
include('db_connection.php');

// Check if Customer_Id is set
if(isset($_REQUEST['Customer_id'])) {
    $cusid = $_REQUEST['Customer_id'];
    
    $stmt = $connection->prepare("SELECT * FROM Customers WHERE Customer_id=?");
    $stmt->bind_param("i", $cusid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Customer_id'];
        $y = $row['Customer_Name'];
        $z = $row['Contact_Number'];
        $w = $row['Email'];
        $v = $row['Address'];
    } else {
        echo "customer id not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Form of Customers</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of Customers form -->
    <h2><u>Update Form of Customers</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="custname">Customer Name:</label>
        <input type="text" name="custname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="contnumber">Contact Number:</label>
        <input type="text" name="contnumber" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="eml">Email:</label>
        <input type="number" name="eml" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="adress">Address:</label>
        <input type="number" name="adress" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $cusname = $_POST['custname'];
    $contactnmbr = $_POST['contnumber'];
    $email = $_POST['eml'];
    $adress = $_POST['adress'];
    
    // Update the customer in the database
    $stmt = $connection->prepare("UPDATE Customers SET Customer_Name=?, Contact_Number=?, Email=?, Address=?  WHERE Customer_id=?");
    $stmt->bind_param("ssddi", $cusname, $contactnmbr, $email, $adress, $custid);
    $stmt->execute();
   
    // Redirect to customer.php
    header('Location: CUSTOMERS.PHP');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
