<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "form";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Delete the user data from the database
    $delete_query = "DELETE FROM users WHERE id = $id";

    if ($conn->query($delete_query) === TRUE) {
        // Redirect to show_data.php after deleting
        header("Location: show_data.php");
        exit();
    } else {
        echo "Error deleting user data: " . $conn->error;
    }
}
?>
