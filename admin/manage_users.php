<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

$error = "";

// Delete user
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $conn->query("DELETE FROM users WHERE id = $delete_id");
    $_SESSION['success'] = "User deleted successfully!";
    header("Location: manage_users.php");
    exit;
}

// Add user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $first_name = $conn->real_escape_string($_POST['firstname']);
    $last_name = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkPhone = $conn->query("SELECT id FROM users WHERE phone = '$phone'");
    if ($checkPhone->num_rows > 0) {
        $error = "Phone number already exists!";
    } else {
        $conn->query("INSERT INTO users (first_name, last_name, email, phone, password) 
                      VALUES ('$first_name', '$last_name', '$email', '$phone', '$password')");
        $_SESSION['success'] = "User added successfully!";
        header("Location: manage_users.php");
        exit;
    }
}

// Edit user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $id = intval($_POST['id']);
    $first_name = $conn->real_escape_string($_POST['firstname']);
    $last_name = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);

    $conn->query("UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone' WHERE id=$id");
    $_SESSION['success'] = "User updated successfully!";
    header("Location: manage_users.php");
    exit;
}

// Search functionality
$search = '';
$whereClause = '';
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = $conn->real_escape_string(trim($_GET['search']));
    $whereClause = "WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%'";
}

// Fetch users
$users = $conn->query("SELECT * FROM users $whereClause ORDER BY created_at ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <title>Manage Users</title>
     <link rel="stylesheet" href="manage_users.css">
</head>

<body>

     <!-- Navbar -->
     <nav>
          <h1>Admin Panel </h1>
          <a href="admin_dashboard.php">🏠 Dashboard</a>
          <a href="manage_users.php">👤 Manage Users</a>
          <a href="manage_destinations.php">🛣️ Manage Places</a>
          <a href="manage_trips.php">🧳 Manage Trips</a>
          <a href="manage_cars.php">🚗 Manage Cars</a>
          <a href="logout.php" class="logout">🔓 Logout</a>
     </nav>

     <h1>Manage Users</h1>

     <!-- Flash Success Message -->
     <?php if (isset($_SESSION['success'])): ?>
     <div class="success-msg">
          ✅ <?= $_SESSION['success']; ?>
     </div>
     <?php unset($_SESSION['success']); ?>
     <?php endif; ?>

     <!-- Search -->
     <form method="GET" style="margin-bottom: 20px;">
          <input type="text" name="search" placeholder="Search users..." value="<?= htmlspecialchars($search); ?>"
               style="padding: 8px; width: 300px;">
          <button type="submit" style="padding: 8px 12px;">Search</button>
          <a href="manage_users.php" style="margin-left: 10px; text-decoration: none; color: #2980b9;">Reset</a>
     </form>

     <!-- Export CSV -->
     <form method="POST" action="export_users.php" style="margin-bottom: 20px;">
          <button type="submit" name="export_csv"
               style="padding: 8px 12px; background-color: #27ae60; color: white; border: none; border-radius: 4px;">
               Export Users as CSV
          </button>
     </form>

     <!-- Users Table -->
     <table>
          <thead>
               <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Created At</th>
                    <th>
                         Action
                         <a href="manage_users.php?show=add" class="btn"
                              style="background-color: #1abc9c; padding: 5px 10px; margin-left: 10px;">+ Add</a>
                    </th>
               </tr>
          </thead>
          <tbody>
               <?php while ($row = $users->fetch_assoc()): ?>
               <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['first_name'] ?? ''); ?></td>
                    <td><?= htmlspecialchars($row['last_name'] ?? ''); ?></td>
                    <td><?= htmlspecialchars($row['email'] ?? ''); ?></td>
                    <td><?= htmlspecialchars($row['phone'] ?? ''); ?></td>
                    <td><?= $row['created_at'] ?? ''; ?></td>
                    <td>
                         <a href="manage_users.php?edit=<?= $row['id']; ?>" class="btn edit-btn">Edit</a>
                         <a href="?delete=<?= $row['id']; ?>" class="btn delete-btn"
                              onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
               </tr>
               <?php endwhile; ?>
          </tbody>
     </table>

     <!-- Form Section -->
     <div class="form-container">
          <?php
        if (isset($_GET['edit'])):
            $edit_id = intval($_GET['edit']);
            $edit_user = $conn->query("SELECT * FROM users WHERE id = $edit_id")->fetch_assoc();

            if ($edit_user): ?>
          <h2>
               Edit User
               <a href="manage_users.php" class="close-btn">✖</a>
          </h2>
          <form method="POST">
               <input type="hidden" name="id" value="<?= $edit_user['id']; ?>">
               <input type="text" name="firstname" placeholder="First Name"
                    value="<?= htmlspecialchars($edit_user['first_name']); ?>" required>
               <input type="text" name="lastname" placeholder="Last Name"
                    value="<?= htmlspecialchars($edit_user['last_name']); ?>" required>
               <input type="email" name="email" placeholder="Email"
                    value="<?= htmlspecialchars($edit_user['email']); ?>" required>
               <input type="text" name="phone" placeholder="Phone" value="<?= htmlspecialchars($edit_user['phone']); ?>"
                    required>
               <button type="submit" name="edit_user">Update User</button>
          </form>
          <?php else: ?>
          <div class="error-msg">⚠️ User not found.</div>
          <?php endif; ?>

          <?php elseif (isset($_GET['show']) && $_GET['show'] === 'add'): ?>
          <h2>
               Add New User
               <a href="manage_users.php" class="close-btn">✖</a>
          </h2>
          <?php if (!empty($error)): ?>
          <div class="error-msg"><?= htmlspecialchars($error); ?></div>
          <?php endif; ?>
          <form method="POST">
               <input type="text" name="firstname" placeholder="First Name" required>
               <input type="text" name="lastname" placeholder="Last Name" required>
               <input type="email" name="email" placeholder="Email" required>
               <input type="text" name="phone" placeholder="Phone" required>
               <input type="password" name="password" placeholder="Password" required>
               <button type="submit" name="add_user">Add User</button>
          </form>
          <?php endif; ?>
     </div>

</body>

</html>