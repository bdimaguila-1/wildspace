<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-image: url("BG/bg.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="message">
        <?php
        // Database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "wild_space";

        // Create a database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get data from the HTML form
        $ID = $_POST['ID'];
        $Name = $_POST['Name'];
        $Email = $_POST['Email'];
        $Date = $_POST['Date'];
        $Design = $_POST['Design'];

        // Update the reservation in the database
        $sql = "UPDATE reservation SET Name='$Name', Email='$Email', Date='$Date', Design='$Design' WHERE ID='$ID'";

        if ($conn->query($sql) === TRUE) {
            if ($conn->affected_rows > 0) {
                // Reservation updated successfully
                echo "Reservation updated successfully. ";
                echo '<br><a href="index.html">Return to Wildspace</a>'; // Added link
            } else {
                // No rows were affected, meaning no matching record found
                echo "Reservation not found. ";
                echo '<br><a href="update_res.html">Go back</a>'; // Link to reservation not found page
            }
        } else {
            echo "Error updating reservation: " . $conn->error;
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
