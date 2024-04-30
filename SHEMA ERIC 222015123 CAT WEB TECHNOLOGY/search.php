<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
    
   include('db_connection.php');

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'customers' => "SELECT Customer_Name FROM customers WHERE Customer_Name LIKE '%$searchTerm%'",
        'farmers' => "SELECT Farmer_Name FROM farmers WHERE Farmer_Name LIKE '%$searchTerm%'",
        'flowers' => "SELECT Name FROM flowers WHERE Name LIKE '%$searchTerm%'",
        'orders' => "SELECT Order_id FROM orders WHERE Order_id LIKE '%$searchTerm%'",
        'payment' => "SELECT Payment_Method FROM payment WHERE Payment_Method LIKE '%$searchTerm%'",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
