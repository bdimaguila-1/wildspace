<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your database connection parameters
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "wild_space";

    // Create a new database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input
    $Nickname = $_POST["Nickname"];
    $Password = $_POST["Password"];

    // Query the database for the user with the given nickname
    $sql = "SELECT * FROM sign_up WHERE Nickname = '$Nickname'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the password
        if ($Password == $row["Password"]) {
            // Password is correct, start a session
            $_SESSION["Nickname"] = $Nickname;
            header("Location: dashboard.php"); // Redirect to the dashboard or another authenticated page
            exit;
        } else {
            // Password is incorrect
            echo "Invalid password";
        }
    } else {
        // User not found
        echo "User not found";
    }

    // Close the database connection
    $conn->close();
}
?>
