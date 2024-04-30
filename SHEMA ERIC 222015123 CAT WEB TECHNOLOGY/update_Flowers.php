<?php
include('db_connection.php');

// Check if Flower_Id is set
if(isset($_REQUEST['Flower_id'])) {
    $fid = $_REQUEST['Flower_id'];
    
    $stmt = $connection->prepare("SELECT * FROM Flowers WHERE Flower_id=?");
    $stmt->bind_param("i", $fid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['Flower_id'];
        $y = $row['Name'];
        $z = $row['Description'];
        $w = $row['Price_Per_Unit'];
    } else {
        echo "flower id not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Form of Flowers</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of Flowers form -->
    <h2><u>Update Form of Flowers</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="flwrname">Name:</label>
        <input type="text" name="flwrname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="flwrdescription">Description:</label>
        <input type="text" name="flwrdescription" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="priceunit">Price Per Unit:</label>
        <input type="number" name="priceunit" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $flower_name = $_POST['flwrname'];
    $flower_description = $_POST['flwrdescription'];
    $price_unit = $_POST['priceunit'];
    
    // Update the FLOWERS in the database
    $stmt = $connection->prepare("UPDATE Flowers SET Name=?, Description=?, Price_Per_Unit=? WHERE Flower_id=?");
    $stmt->bind_param("ssdi", $flower_name, $flower_description, $price_unit, $fid);
    $stmt->execute();
    
    // Redirect to FLOWERS.php
    header('Location: FLOWERS.PHP');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
