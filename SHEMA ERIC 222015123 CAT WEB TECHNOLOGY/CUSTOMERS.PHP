<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>customer Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;<!DOCTYPE html>

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
    <img src="./Images/collage logo.png" width="90" height="60" alt="Logo">
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
    <li style="display: inline; margin-right: 10px;"><a href="./About.html">ABOUT US</a>
      <li style="display: inline; margin-right: 10px;"><a href="./Contact.html">CONTACT US</a>
        <li style="display: inline; margin-right: 10px;"><a href="./CUSTOMERS.PHP">CUSTOMERS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./FARMERS.PHP">FARMERS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./FLOWERS.PHP">FLOWERS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./orders.PHP">ORDERS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./payment.PHP">PAYMENTS</a>
  </li>
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
 <title>Customer Form</title>
</head>
<body>
    <h1>Customer Form</h1>

    <form method="post" onsubmit="return confirmInsert();">
      
        <label for="Customer_id">Customer ID:</label>
        <input type="number" id="custid" name="custid"><br><br>

        <label for="Customer_Name">Customer Name:</label>
        <input type="text" id="Custn" name="Custn" required><br><br>

        <label for="Contact_Number">Contact Number:</label>
        <input type="text" id="Cnm" name="Cnm" required><br><br>

        <label for="Email">Email:</label>
        <input type="email" id="eml" name="eml" required><br><br>

        <label for="Address">Address:</label>
        <input type="text" id="Addss" name="Addss" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    include('db_connection.php');
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO Customers (Customer_id, Customer_Name, Contact_Number, Email, Address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $Customer_id, $Customer_Name, $Contact_Number, $Email, $Address);

        // Set parameters from POST data with validation (optional)
        $Customer_id = intval($_POST['custid']); // Ensure integer for ID
        $Customer_Name = $_POST['Custn']; 
        $Contact_Number = $_POST['Cnm'];
        $Email = $_POST['eml']; // Validate email
        $Address = $_POST['Addss'];

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
// Connection details
include('db_connection.php');

// SQL query to fetch data from APPLICANT-INFO table
$sql = "SELECT * FROM customers";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of customers</title>
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
    <center><h2>Table of customers</h2></center>
    <table border="5">
        <tr>
            <th>Customer_id</th>
            <th>Customer_Name</th>
            <th>Contact_Number</th>
            <th>email</th>
            <th>Address</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Define connection parameters
        include('db_connection.php');

        // Prepare SQL query to retrieve all Customers
        $sql = "SELECT * FROM customers";
        $result = $connection->query($sql);

        // Check if there are any Customers
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $cid = $row['Customer_id']; // Fetch the aCustomerid
                echo "<tr>
                    <td>" . $row['Customer_id'] . "</td>
                    <td>" . $row['Customer_Name'] . "</td>
                    <td>" . $row['Contact_Number'] . "</td>
                    <td>" . $row['Email'] . "</td>
                    <td>" . $row['Address'] . "</td>
                    <td><a style='padding:4px' href='delete_customers.php?Customer_id=$cid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_customers.php?Customer_id=$cid'>Update</a></td> 
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