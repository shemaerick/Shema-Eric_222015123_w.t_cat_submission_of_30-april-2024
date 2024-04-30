<?php
include('db_connection.php');

if(isset($_REQUEST['Farmer_id'])) {
    $farmid = $_REQUEST['Farmer_id'];
    $stmt = $connection->prepare("SELECT * FROM farmers WHERE Farmer_id=?");
    $stmt->bind_param("i", $farmid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $D = $row['Farmer_id'];
        $Y = $row['Farmer_Name'];
        $Z = $row['Contact_Number'];
        $W = $row['Location'];
        
    } else {
        echo "Farmer id not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Form of Farmers</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Form of Farmers form -->
    <h2><u>Update Form of Farmers</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        
        <label for="FARMNME">Farmer Name:</label>
        <input type="text" name="FARMNME" value="<?= isset($Y) ? htmlspecialchars($Y) : ''; ?>">
        <br><br>

        <label for="ctnmber">Contact Number:</label>
        <input type="text" name="ctnmber" value="<?= isset($Z) ? htmlspecialchars($Z) : ''; ?>">
        <br><br>
       
        <label for="LOCAT">Location:</label>
        <input type="text" name="LOCAT" value="<?= isset($W) ? htmlspecialchars($W) : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $farmname = $_POST['FARMNME'];
    $contnumber = $_POST['ctnmber'];
    $location = $_POST['LOCAT'];
    
    // Update the farmer info in the database
    $stmt = $connection->prepare("UPDATE farmers SET Farmer_Name=?, Contact_Number=?, Location=? WHERE Farmer_id=?");
    $stmt->bind_param("sssi", $farmname, $contnumber, $location, $farmid);
    $stmt->execute();
   
    // Redirect to farmers.php
    header('Location: FARMERS.PHP');
    exit(); // Ensure that no other content is sent
}
?>
