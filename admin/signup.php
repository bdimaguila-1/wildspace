<?php
$Nickname = "";  // Initialize the $Nickname variable

$nicknameError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = $_POST["Name"];
    $Nickname = $_POST["Nickname"];
    $Email = $_POST["Email"];
    $Password = $_POST["Password"]; // Note: This is not secure, do not use in production
    $ConfirmPassword = $_POST["confirm_password"];

    // Perform additional validation if needed

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

    // Check if the nickname is already taken
    $checkNicknameQuery = "SELECT * FROM sign_up WHERE Nickname = '$Nickname'";
    $result = $conn->query($checkNicknameQuery);

    if ($result->num_rows > 0) {
        // Nickname is already taken, set error message
        $nicknameError = "Nickname is already taken.";
    } else {
        // Insert user data into the database
        $sql = "INSERT INTO sign_up (Name, Nickname, Email, Password) VALUES ('$Name', '$Nickname', '$Email', '$Password')";

        if ($conn->query($sql) === TRUE) {
            // User registered successfully
            header("Location: index.html");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

<!-- Rest of the HTML code remains the same -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Sign Up</title>
  <link rel="icon" type="image/png" href="../Logo/logo.png">
  <link rel="stylesheet" href="./assets/styles/styles.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" />
</head>

<body>
  <div class="login-container">
    <div class="login-wrapper">
      <div class="profile">
        <img src="../BG/bg.png" alt="" width="90" />
      </div>
      
      <form action="" method="POST">
        <div class="form-wrapper">
          <p>Name</p>
          <input type="text" name="Name" placeholder="Type your name" required />
        </div>
        <div class="form-wrapper">
          <p>Nickname</p>
          <input type="text" name="Nickname" placeholder="Type your nickname" value="<?php echo $Nickname; ?>" required />
          <small style="color: red;"><?php echo $nicknameError; ?></small>
        </div>
        <div class="form-wrapper">
          <p>Email</p>
          <input type="email" name="Email" placeholder="Type your email" required />
        </div>
        <div class="form-wrapper">
          <p>Password</p>
          <input type="password" name="Password" placeholder="Type your password" required />
        </div>
        <div class="form-wrapper">
          <p>Confirm Password</p>
          <input type="password" name="confirm_password" placeholder="Confirm your password" required />
        </div>
        <div class="login-btn">
          <button type="submit">Sign Up</button>
        </div>
      </form>

      <div class="signup">
        <p>Already have an account? <a href="index.html">Login</a></p>
      </div>
    </div>
  </div>
</body>
<style>
  .signup {
    margin-top: auto;
    height: 50px;
    color: #d885dc;
    cursor: pointer;
    font-weight: 400;
    display: flex;
    justify-content: center;
    align-items: flex-end;
  }
</style>
</html>
