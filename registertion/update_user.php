<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "form";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the updated data from the form
    $id = $_POST["id"];
    $name = $_POST["name"];
    $dob = $_POST["dob"];
    $mobile = $_POST["mobile"];

    // Update the user data in the database
    $update_query = "UPDATE users SET name = '$name', dob = '$dob', mobile = '$mobile' WHERE id = $id";

    if ($conn->query($update_query) === TRUE) {
        // Redirect to show_data.php after successful update
        header("Location: show_data.php");
        exit();
    } else {
        echo "Error updating user data: " . $conn->error;
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Retrieve the user's current data from the database
    $select_query = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($select_query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $row["name"]; ?>">
        <br>
        <label for="dob">Date of Birth:</label>
        <input type="text" name="dob" value="<?php echo $row["dob"]; ?>">
        <br>
        <label for="mobile">Mobile:</label>
        <input type="text" name="mobile" value="<?php echo $row["mobile"]; ?>">
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
