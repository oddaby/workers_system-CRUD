<!DOCTYPE html>
<html>
<head>
    <title>Calculate Supplier Payments</title>
    <style>
        /* Custom CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .menu {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
        }

        .menu a {
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }

        .menu a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="menu">
        <a href="calculate_client_payment.php">Calculate Client Payments</a>
        <a href="calculate_supplier_payment.php">Calculate Supplier Payments</a>
        <a href="delete.php">Delete Information</a>
    </div>

    <h1>Calculate Supplier Payments</h1>

    <?php
    // Replace with your actual database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "assino";

    // Create a database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve the suppliers and their total payment amounts
    $sql = "SELECT id,name,amount FROM suppliers";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Check if any records are found
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Total payments</th></tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $totalPayment = $row['amount'];

                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>$name</td>";
                echo "<td>$totalPayment</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No records found";
        }
    } else {
        echo "Error retrieving records: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
