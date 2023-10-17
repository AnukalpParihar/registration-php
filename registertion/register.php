<?php
// Replace these with your actual database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "form";

// Create a database connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $mysqli->real_escape_string($_POST["name"]);
    $username = $mysqli->real_escape_string($_POST["username"]);
    $dob = $mysqli->real_escape_string($_POST["dob"]);
    $mobile = $mysqli->real_escape_string($_POST["mobile"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

    // Check if the username is already in the database
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $result = $mysqli->query($check_query);

    if ($result->num_rows > 0) {
        echo "Username already exists. Please choose another username.";
    } else {
        // Insert user data into the database
        $insert_query = "INSERT INTO users (name, username, dob, mobile, password) 
                         VALUES ('$name', '$username', '$dob', '$mobile', '$password')";

        if ($mysqli->query($insert_query) === TRUE) {
            echo "Registration successful. You can now <a href='login.php'>login</a>.";
        } else {
            echo "Error: " . $insert_query . "<br>" . $mysqli->error;
        }
    }

    $mysqli->close();
}
?>
