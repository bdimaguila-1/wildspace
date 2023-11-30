<!DOCTYPE html>
<html>
<head>
<title>Payment Confirmation</title>
    <link rel="icon" type="image/png" href="Logo/logo.png">
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
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wild_space";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $inputID = $_POST["ID"];

    // Assume you have a column 'PaymentID', 'PaymentMethod', 'RSP' in your 'reservation' table
    $paymentID = generateUniquePaymentID(); // Implement a function to generate a unique payment ID
    $paymentMethod = "PayPal"; // You can modify this based on your logic to determine the payment method
    $rspAmount = 500; // Add RSP amount

    // Update the database with the transaction details and RSP
    $updateSql = "UPDATE reservation SET PaymentID = '$paymentID', PayMeth = '$paymentMethod', RSP = $rspAmount WHERE ID = '$inputID'";
    
    if ($conn->query($updateSql) === TRUE) {
        echo "Payment has been made. Thank you for availing a package from us!";
        echo '<br><a href="index.html">Return to Wildspace</a>';
    } else {
        echo "Error updating Payment Details on the server. Please contact Wild Space Studio. " . $conn->error;
    }
}

$conn->close();

// Function to generate a unique payment ID
function generateUniquePaymentID() {
    // Implement your logic to generate a unique payment ID (e.g., combination of timestamp and random string)
    return "PAY" . time() . rand(1000, 9999);
}
?>
</div>
</body>
</html>
