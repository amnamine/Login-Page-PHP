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

    // Query to get user data
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Login successful
            header("Location: index.php?login_message=Login%20successful!");
        } else {
            // Incorrect password
            header("Location: index.php?login_message=Incorrect%20password.");
        }
    } else {
        // User not found
        header("Location: index.php?login_message=User%20not%20found.");
    }
}

$conn->close();
?>
