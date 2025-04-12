<?php
session_start();
include 'db.php'; // Include the database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize and validate the email and password
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check if the email exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Check if the user exists and the password matches
    if ($row) {
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // If successful, set session variables and redirect to index.php
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['first_name'] . " " . $row['last_name'];
            header("Location: index.php"); // Redirect to the homepage (index.php)
            exit();
        } else {
            // If password is incorrect
            $error_message = "Incorrect password!";
        }
    } else {
        // If email is not found
        $error_message = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>User Login</title>
     <link rel="stylesheet" href="login.css">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
     <div class="login-container">
          <div class="form-container">
               <h2>User Login</h2>
               <form method="POST">
                    <div class="input-group">
                         <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                         <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="options">
                         <label>
                              <input type="checkbox"> Remember me
                         </label>
                         <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>
                    <button type="submit" class="login-btn">SUBMIT</button>

                    <!-- Display error message if credentials are incorrect -->
                    <?php if (isset($error_message)) { echo "<p class='error-message'>$error_message</p>"; } ?>

                    <!-- Don't have an account? -->
                    <p class="register-link">Don't have an account?
                         <a href="register.php">Register</a>
                    </p>
               </form>
          </div>
          <div class="image-container">
               <img src="https://storage.googleapis.com/a1aa/image/T72lYbzVWCVVdXXPBKzwxbYCZe26c5l76Tb2nMiIvi8.jpg"
                    alt="Login Illustration">
          </div>
     </div>
</body>

</html>