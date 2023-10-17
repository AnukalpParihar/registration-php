<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "form";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize an HTML table
$html = '<table class="user-table">
    <tr>
        <th>S.No</th>
        <th>Name</th>
        <th>Date of Birth</th>
        <th>Mobile</th>
        <th>Action</th>
    </tr>';

// SQL query to retrieve all data from the "users" table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

$serialNumber = 1; // Initialize the serial number

// Check if there are any registered users
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Add data for each user to the HTML table
        $html .= '<tr>
            <td>' . $serialNumber . '</td>
            <td>' . $row["name"] . '</td>
            <td>' . $row["dob"] . '</td>
            <td>' . $row["mobile"] . '</td>
            <td>
                <a class="action-link" href="update_user.php?id=' . $row["id"] . '">Update</a> |
                <a class="action-link" href="delete_user.php?id=' . $row["id"] . '">Delete</a>
            </td>
        </tr>';
        
        $serialNumber++; // Increment the serial number
    }
} else {
    $html .= '<tr><td colspan="5">No registered users found.</td></tr>';
}

// Close the HTML table
$html .= '</table';

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Data of Registered Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .user-table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        .user-table th, .user-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .user-table th {
            background-color: #f2f2f2;
        }

        .action-link {
            color: #007BFF;
            text-decoration: none;
            margin-right: 10px;
        }

        .back-button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Registered Users</h2>
    <?php echo $html; ?>

    <div class="back-button">
        <a href="registration.php">Back to Registration Page</a>
        <a href="logout.php" style="float: right;">Logout</a>
    </div>
</body>
</html>
