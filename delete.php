<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $DeleteID = $_POST["DeleteID"];
    $DeleteName = $_POST["DeleteName"];
    $DeleteEmail = $_POST["DeleteEmail"];

    // Database connection parameters
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

    // Delete the reservation based on the provided ID, name, and email
    $sql = "DELETE FROM reservation WHERE ID = '$DeleteID' AND Name = '$DeleteName' AND Email = '$DeleteEmail'";

    if ($conn->query($sql) === TRUE) {
        // Reservation deleted successfully, redirect to delete_conf.html
        header("Location: delete_conf.html");
        exit; // Make sure to exit after the header redirection
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
