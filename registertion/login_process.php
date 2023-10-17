<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace with your database connection logic
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "form";

    $mysqli = new mysqli($host, $username, $password, $database);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Check if the username and password match in the database (implement actual secure password checking)
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $mysqli->query($query);

    if ($result->num_rows == 1) {
        // Valid login, store the username in the session
        $_SESSION['username'] = $username;
        header("Location: login.php"); // Redirect to the login page
    } else {
        echo "Invalid username or password.";
    }

    $mysqli->close();
}
?>
