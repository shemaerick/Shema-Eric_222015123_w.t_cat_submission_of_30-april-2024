<?php
include('db_connection.php');

// Check if Flower_Id is set
if(isset($_REQUEST['Flower_id'])) {
    $farmid = $_REQUEST['Flower_id'];

    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM Flowers WHERE Flower_id=?");
    $stmt->bind_param("i", $Flower_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='FLOWERS.PHP'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Farmer_id is not set.";
}

$connection->close();
?>
