<?php
include('db_connection.php');

// Check if Farmer_id is set
if(isset($_REQUEST['Farmer_id'])) {
    $farmid = $_REQUEST['Farmer_id'];

    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM farmers WHERE Farmer_id=?");
    $stmt->bind_param("i", $farmid); // Change "b" to "i" for integer type
    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='FARMERS.PHP'>OK</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Farmer_id is not set.";
}

$connection->close();
?>
