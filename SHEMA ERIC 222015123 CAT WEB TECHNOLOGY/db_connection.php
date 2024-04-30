<?php
    // Connection details
    $host = "localhost";
    $user = "Shema";
    $pass = "shema$09.";
    $database = "bloom_hub_connecting";

    // Creating connection
    $connection = new mysqli($host, $user, $pass, $database);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
?>