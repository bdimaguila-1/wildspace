<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = $_POST["Name"];
    $Email = $_POST["Email"]; // Change this to match your actual form field name
    $Date = $_POST["Date"];
    $Design = $_POST["Design"];

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "wild_space";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO reservation (Name, Email, Date, Design) 
            VALUES ('$Name', '$Email', '$Date', '$Design')";

    if ($conn->query($sql) === TRUE) {
        // Get the auto-incremented ID
        $ID = $conn->insert_id;

        // Redirect to the confirmation page with the ID as a parameter
        header("Location: confirmation.php?ID=$ID");
        exit; // Ensure no further code is executed
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
