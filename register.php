<?php
// Database connection
$servername = "localhost";
$username = "root"; // Default XAMPP user for MariaDB
$password = ""; // Default XAMPP password for MariaDB (empty)
$dbname = "login_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if username already exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Username exists, show error
        header("Location: index.php?register_message=Username%20already%20exists.");
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $hashedPassword);
        if ($stmt->execute()) {
            // Success
            header("Location: index.php?register_message=Registration%20successful!");
        } else {
            // Error inserting user
            header("Location: index.php?register_message=Error%20registering%20user.");
        }
    }
}

$conn->close();
?>
