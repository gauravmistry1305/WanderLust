<?php
session_start();
include 'db.php'; // Include the database connection file   

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate password match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Check if the email already exists
        $check_email = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($check_email);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Email already registered!');</script>";
        } else {
            // Insert into database
            $sql = "INSERT INTO users (first_name, last_name, email, phone, password) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful!'); window.location.href = 'login.php';</script>";
            } else {
                echo "<script>alert('Something went wrong! Try again.');</script>";
            }
        }
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>User Registration</title>
     <link rel="stylesheet" href="register.css">
</head>

<body>
     <div class="register-container">
          <div class="form-container">
               <h2>User Registration</h2>
               <form method="POST" action="">
                    <div class="input-group">
                         <input type="text" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="input-group">
                         <input type="text" name="last_name" placeholder="Last Name" required>
                    </div>
                    <div class="input-group">
                         <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                         <input type="tel" name="phone" placeholder="Phone Number" required>
                    </div>
                    <div class="input-group">
                         <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="input-group">
                         <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" class="register-btn">REGISTER</button>

                    <!-- Already have an account? -->
                    <p class="login-link">Already have an account?
                         <a href="login.php">Login</a>
                    </p>
               </form>
          </div>
          <div class="image-container">
               <img src="https://storage.googleapis.com/a1aa/image/T72lYbzVWCVVdXXPBKzwxbYCZe26c5l76Tb2nMiIvi8.jpg"
                    alt="Registration Illustration">
          </div>
     </div>
</body>

</html>