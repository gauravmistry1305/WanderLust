<?php
// session_start();

// Set your admin credentials (you can move this to a DB later)
$admin_username = "admin";
$admin_password = "admin123"; // You should hash this if using DB

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "❌ Invalid admin credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <title>Admin Login - WanderLust</title>
     <style>
     body {
          font-family: Arial, sans-serif;
          background: #f7f7f7;
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
     }

     .login-box {
          background: #fff;
          padding: 30px;
          border-radius: 10px;
          box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
          width: 300px;
     }

     h2 {
          margin-bottom: 20px;
          text-align: center;
          color: #333;
     }

     input[type="text"],
     input[type="password"] {
          width: 100%;
          padding: 10px;
          margin-bottom: 15px;
          border: 1px solid #ccc;
          border-radius: 6px;
     }

     button {
          width: 100%;
          background-color: #28a745;
          border: none;
          padding: 10px;
          color: white;
          font-weight: bold;
          border-radius: 6px;
          cursor: pointer;
     }

     button:hover {
          background-color: #218838;
     }

     .error {
          color: red;
          text-align: center;
          margin-bottom: 15px;
     }
     </style>
</head>

<body>

     <div class="login-box">
          <h2>Admin Login</h2>
          <?php if (!empty($error)): ?>
          <div class="error"><?php echo $error; ?></div>
          <?php endif; ?>
          <form method="post">
               <input type="text" name="username" placeholder="Admin Username" required>
               <input type="password" name="password" placeholder="Password" required>
               <button type="submit">Login</button>
          </form>
     </div>

</body>

</html>