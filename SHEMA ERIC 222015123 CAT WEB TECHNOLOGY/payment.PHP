<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>payments Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;

      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; /* Adjust this value as needed */

      padding: 8px;
     
    }
  </style>
     <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  
<header>
   

</head>

<body bgcolor="skyblue">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./image/blublogo.jpg" width="90" height="60" alt="Logo">
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
    <li style="display: inline; margin-right: 10px;"><a href="./About.html">ABOUT US</a>
      <li style="display: inline; margin-right: 10px;"><a href="./Contact.html">CONTACT US</a>
    <li style="display: inline; margin-right: 10px;"><a href="./CUSTOMERS.PHP">customers</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./FARMERS.PHP">Farmers</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./FLOWERS.PHP">Flowers</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./orders.PHP">Orders</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./payment.PHP">Payment</a>
  </li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color:darkgreen; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Change Acount</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>
 <title>Payment Form</title>
</head>
<body>
   
    <h1>Payment Form</h1>

    <form method="post" onsubmit="return confirmInsert();">
        <label for="Customer_id">Customer_id:</label>
        <input type="number" id="CSTID" name="CSTID"><br><br>

        <label for="Order_id">Order_id:</label>
        <input type="text" id="ord" name="ord" required><br><br>

        <label for="Payment_Amount">Payment_Amount:</label>
        <input type="text" id="pyma" name="pyma" required><br><br>

        <label for="Payment_Date">Payment_Date:</label>
        <input type="text" id="pd" name="pd" required><br><br>

        <label for="Payment_Method">Payment_Method:</label>
        <input type="text" id="pm" name="pm" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
  include('db_connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO payment(Customer_id, Order_id, Payment_Amount, Payment_Date,Payment_Method) VALUES (?, ?, ?, ?,?)");
        $stmt->bind_param("bssss", $Customer_id, $Order_id, $Payment_Amount, $Payment_Date,$Payment_Method);

        // Set parameters from POST data with validation (optional)
        $Customer_id = intval($_POST['CSTID']); // Ensure integer for ID
        $Order_id = intval($_POST['ord']); // Ensure integer for ID
        $Payment_Amount = $_POST['pyma']; 
        $Payment_Date = $_POST['pd'];
        $Payment_Method = $_POST['pm'];

        // Execute prepared statement with error handling
        if ($stmt->execute()) {
            echo "New record has been added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $connection->close();
    ?>
    
<?php
include('db_connection.php');

// SQL query to fetch data from farmers table
$sql = "SELECT * FROM payment";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of payment</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of payment</h2></center>
    <table border="5">
        <tr>
            <th>Customer_id</th>
            <th>Order_id</th>
            <th>Payment_Amount</th>
            <th>Payment_Date</th>
            <th>Payment_Method</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>

        <?php
      include('db_connection.php');

        // Prepare SQL query to retrieve all customers
        $sql = "SELECT * FROM payment";
        $result = $connection->query($sql);

        // Check if there are any customer
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $cuid = $row['Customer_id']; // Fetch the Customer_id
                echo "<tr>
                    <td>" . $row['Customer_id'] . "</td>
                    <td>" . $row['Order_id'] . "</td>
                    <td>" . $row['Payment_Amount'] . "</td>
                    <td>" . $row['Payment_Date'] . "</td>
                    <td>" . $row['Payment_Method'] . "</td>
                    <td><a style='padding:4px' href='delete_payment.php?Customer_id=$cuid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_payment.php?Customer_id=$cuid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
  </body>
    </section>

  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 & reg, Designer by: @SHEMA ERIC</h2></b>
  </center>
</footer>
</body>
</html>