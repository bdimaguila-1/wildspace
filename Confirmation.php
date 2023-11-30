<!DOCTYPE html>
<html>
<head>
    <title>Reservation Confirmation</title>
    <link rel="icon" type="image/png" href="Logo/logo.png">
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

        h1 {
            color: black;
        }

        p {
            color: black;
        }

        form {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            display: inline-block;
        }

        input[type="email"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: #333;
            margin-top: 10px;
            display: block;
        }

        .pay-now-btn {
            background-color: #4CAF50;
        }

        .ID {
            margin-top: 20px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
	
<body>
	<?php
        // Retrieve the ID from the URL parameter
        $ID = isset($_GET['ID']) ? $_GET['ID'] : 'N/A';
    ?>

    <h1>Thank you for your Reservation!</h1>
    <p>Your reservation has been successfully made. You have the following options:</p>
   <form action="payment_details.php" method="post">
    <input type="hidden" name="Name" value="<?php echo isset($_POST['Name']) ? $_POST['Name'] : ''; ?>">
    <input type="hidden" name="Email" value="<?php echo isset($_POST['Email']) ? $_POST['Email'] : ''; ?>">
    <input type="hidden" name="Date" value="<?php echo isset($_POST['Date']) ? $_POST['Date'] : ''; ?>">
    <input type="hidden" name="Design" value="<?php echo isset($_POST['Design']) ? $_POST['Design'] : ''; ?>">
    <input type="hidden" name="ID" value="<?php echo $ID; ?>">
    <p>Enter your email to receive payment details:&nbsp;</p>
    <input type="email" name="UserEmail" required>
	   <p>Note: By selecting Pay Later, you must enter your email to receive the payment details.</p>
	   <p> By choosing this option, you will make your payment manually. </p>
	   <p>Thank You!</p>
	   <br>

    <button type="submit">Pay Later</button>
	   <p> or </p>
    <button class="pay-now-btn" onclick="redirectToPayment()">Pay Now</button>
</form>


    <!-- Display Reservation ID -->
    <p class="ID">Your Reservation ID: <?php echo $ID; ?></p>

    <p>&nbsp;</p>

    <script>
        function redirectToPayment() {
            // Replace 'payment_now.php' with the actual URL where users should be redirected for immediate payment.
            window.location.href = 'payment_now.php';
        }
    </script>
</body>
</html>
