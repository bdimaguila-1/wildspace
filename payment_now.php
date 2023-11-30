<?php
// Connect to the database
$servername = "localhost"; // Change this to your database server
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
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
    $inputName = $_POST["Name"];
    $inputEmail = $_POST["Email"];

    // Query the database for the reservation
    $sql = "SELECT * FROM reservation WHERE ID = '$inputID' AND Name = '$inputName' AND Email = '$inputEmail'";
    $result = $conn->query($sql);

    
}

$conn->close();
?>

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
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            text-align: center;
        }

        h2 {
            color: black;
        }

        form {
            background-color: #fff;
            border-radius: 5px;
            padding: 25px;
            display: inline-block;
        }

        label {
            display: inline-block;
            width: 80px;
            /* Adjust the width as needed */
            text-align: center;
            margin-right: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="text"][readonly] {
            width: 200px;
            /* Adjust the width as needed */
            padding: 10px;
			margin-top: 2px;
            margin-bottom: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: block;
        }

        button {
            background-color: #60D335;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .ID,
        .Name,
        .Email {
            margin-top: 5px;
            font-weight: bold;
            color: #333;
            display: block;
            /* Display as block to move to a new line */
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
    <title>Wild Space Payment</title>
    <link rel="icon" type="image/png" href="Logo/logo.png">
</head>

<body>
    <h2>You've selected Pay Now option!</h2>
    <p>Please input the details you entered previously from the reservation page, and you will be redirected to our
        payment merchant.</p>
    <p>Thank you for making a reservation with us!</p>
    <form method="post" action="proceed.php">
        <label for="ID">ID:</label>
        <input type="text" name="ID" id="ID" required><br>
        <small class="text-danger ID"></small>
        <!-- Moved error message display under the ID input -->

        <label for="Name">Name:</label>
        <input type="text" name="Name" id="Name" required><br>
        <small class="text-danger Name"></small>
        <!-- Moved error message display under the Name input -->

        <label for="Email">Email:</label>
        <input type="email" name="Email" id="Email" required><br>
        <small class="text-danger Email"></small>
        <!-- Moved error message display under the Email input -->

        <label for="Price">Price:</label>
        <input type="text" name="Price" value="&#8369;500 / $10" readonly><br>

        <div id="paypal-button-container"></div>

        <button type="submit" id="proceedButton" style="display: none;">Proceed</button>
        
    </form>
</body>

</html>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=AV0JYiMa8DsB21PQAMoFlG9I93mn6qnGwGYiJbtyiCLos3mUNBwUp_6kXulQlBOQ-Qn9uTWqjMoHrMip"></script>

<script>
    paypal.Buttons({
        onClick: function () {
            var ID = $('#ID').val();
            var Name = $('#Name').val();
            var Email = $('#Email').val();

            // Validate ID, Name, and Email
            if (ID.length === 0 || Name.length === 0 || Email.length === 0) {
                // Display error messages
                if (ID.length === 0) {
                    $('.ID').text("This field is required.");
                } else {
                    $('.ID').text("");
                }

                if (Name.length === 0) {
                    $('.Name').text("This field is required.");
                } else {
                    $('.Name').text("");
                }

                if (Email.length === 0) {
                    $('.Email').text("This field is required.");
                } else {
                    $('.Email').text("");
                }

                return false;
            } else {
                // Clear error messages if fields are not empty
                $('.ID, .Name, .Email').text("");
            }

            return true; // Proceed to PayPal if all fields are not empty
        },
        createOrder: function (data, actions) {
            // Set up the transaction
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '10.00' // Set the amount to be paid
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            // Capture the funds from the transaction
            return actions.order.capture().then(function (orderData) {
                  console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
				const transaction = orderData.purchase_units[0].payments.captures[0];
                
                
                // Show the "Proceed" button after payment is completed
                $('#proceedButton').show();

                // You can also perform additional actions here, e.g., store transaction details in the database
            });
        },
        onError: function (err) {
            // Handle errors
            console.error('Error during PayPal checkout:', err);
            alert('Payment failed. Please try again.');
        }
    }).render('#paypal-button-container');
</script>

