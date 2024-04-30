<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Farmers Page</title>
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
 <title>Farmers Form</title>
</head>
<body>
    <h1>Farmers Form</h1>

    <form method="post" onsubmit="return confirmInsert();">
        <label for="fmid">Farmer_id:</label>
        <input type="number" id="fmid" name="fmid"><br><br>

        <label for="fmn">Farmer_Name:</label>
        <input type="text" id="fmn" name="fmn" required><br><br>

        <label for="Cnm">Contact Number:</label>
        <input type="text" id="Cnm" name="Cnm" required><br><br>

        <label for="lct">Location:</label>
        <input type="text" id="lct" name="lct" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    include('db_connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO farmers (Farmer_id, Farmer_Name, Contact_Number, Location) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $Farmer_id, $Farmer_Name, $Contact_Number, $Location);

        // Set parameters from POST data with validation (optional)
        $Farmer_id = intval($_POST['fmid']); // Ensure integer for ID
        $Farmer_Name = intval($_POST['fmn']); // Ensure integer for ID
        $Contact_Number = $_POST['Cnm']; 
        $Location = $_POST['lct'];

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
$sql = "SELECT * FROM farmers";
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
    <center><h2>Table of farmers</h2></center>
    <table border="5">
        <tr>
            <th>Farmer_id</th>
            <th>Farmer_Name</th>
            <th>Contact_Number</th>
            <th>Location</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
       include('db_connection.php');

        // Prepare SQL query to retrieve all products
        $sql = "SELECT * FROM farmers";
        $result = $connection->query($sql);

        // Check if there are any products
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $fid = $row['Farmer_id']; // Fetch the aCustomerid
                echo "<tr>
                    <td>" . $row['Farmer_id'] . "</td>
                    <td>" . $row['Farmer_Name'] . "</td>
                    <td>" . $row['Contact_Number'] . "</td>
                    <td>" . $row['Location'] . "</td>
                    <td><a style='padding:4px' href='delete_farmers.php?farmer_id=$fid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_farmers.php?farmer_id=$fid'>Update</a></td> 
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