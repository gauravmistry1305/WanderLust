<?php
session_start();
require_once '../db.php'; // Include your database configuration file

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Handle Add Car
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price_per_day = $_POST['price_per_day'];
    $specs = $_POST['specs'];
    $imageName = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
    }

    $stmt = $conn->prepare("INSERT INTO cars (name, brand, price_per_day, image, specs, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssdss", $name, $brand, $price_per_day, $imageName, $specs);
    $stmt->execute();
    $stmt->close();
}

// Handle Delete Car
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $img = $conn->query("SELECT image FROM cars WHERE id = $id")->fetch_assoc();
    if ($img && !empty($img['image']) && file_exists($uploadDir . $img['image'])) {
        unlink($uploadDir . $img['image']);
    }
    $conn->query("DELETE FROM cars WHERE id = $id");
}

// Handle Edit Car
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price_per_day = $_POST['price_per_day'];
    $specs = $_POST['specs'];
    $imageName = $_POST['old_image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        if (!empty($imageName) && file_exists($uploadDir . $imageName)) {
            unlink($uploadDir . $imageName);
        }
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
    }

    $stmt = $conn->prepare("UPDATE cars SET name=?, brand=?, price_per_day=?, image=?, specs=? WHERE id=?");
    $stmt->bind_param("ssdssi", $name, $brand, $price_per_day, $imageName, $specs, $id);
    $stmt->execute();
    $stmt->close();
}

// Export to CSV
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=cars.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, ['ID', 'Name', 'Brand', 'Price/Day', 'Image', 'Specs', 'Created At']);
    $rows = $conn->query("SELECT * FROM cars");
    while ($row = $rows->fetch_assoc()) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}

// Search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM cars WHERE name LIKE '%$search%' OR brand LIKE '%$search%' ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
     <title>Manage Cars</title>
     <link rel="stylesheet" href="manage_trips.css"> <!-- Reuse trip styles -->
     <script>
     function toggleAddForm() {
          const form = document.getElementById("addCarForm");
          form.style.display = form.style.display === "none" ? "block" : "none";
     }

     function toggleEditForm(id) {
          const formRow = document.getElementById("editForm" + id);
          formRow.style.display = formRow.style.display === "none" ? "table-row" : "none";
     }

     function exportTableToPDF() {
          window.print();
     }
     </script>
</head>

<body>

     <!-- Navbar -->
     <nav>
          <h1>Admin Panel</h1>
          <a href="admin_dashboard.php">🏠 Dashboard</a>
          <a href="manage_users.php">👤 Manage Users</a>
          <a href="manage_destinations.php">🛣️ Manage Places</a>
          <a href="manage_trips.php">🧳 Manage Trips</a>
          <a href="manage_cars.php">🚗 Manage Cars</a>
          <a href="logout.php" class="logout">🔓 Logout</a>
     </nav>

     <h2>Manage Cars</h2>

     <form method="GET">
          <input type="text" name="search" placeholder="Search cars..." value="<?= htmlspecialchars($search) ?>">
          <button type="submit">Search</button>
     </form>

     <h3>All Cars</h3>
     <table>
          <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Brand</th>
               <th>Price/Day</th>
               <th>Image</th>
               <th>Specs</th>
               <th>Created At</th>
               <th>
                    Actions <button type="button" class="add-btn" onclick="toggleAddForm()">➕ Add</button>
               </th>
          </tr>
          <?php while ($row = $result->fetch_assoc()) { ?>
          <tr>
               <td><?= $row['id'] ?></td>
               <td><?= htmlspecialchars($row['name']) ?></td>
               <td><?= htmlspecialchars($row['brand']) ?></td>
               <td>₹<?= number_format($row['price_per_day'], 2) ?></td>
               <td>
                    <?php if (!empty($row['image'])): ?>
                    <img src="<?= $uploadDir . $row['image'] ?>" alt="Car Image" style="width: 80px;">
                    <?php else: ?> No image <?php endif; ?>
               </td>
               <td><?= htmlspecialchars($row['specs']) ?></td>
               <td><?= $row['created_at'] ?></td>
               <td>
                    <button onclick="toggleEditForm(<?= $row['id'] ?>)">✏️ Edit</button>
                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure to delete this car?')">🗑️
                         Delete</a>
               </td>
          </tr>
          <tr id="editForm<?= $row['id'] ?>" style="display: none; background-color: #f9f9f9;">
               <td colspan="8">
                    <form method="POST" enctype="multipart/form-data">
                         <input type="hidden" name="id" value="<?= $row['id'] ?>">
                         <input type="hidden" name="old_image" value="<?= $row['image'] ?>">

                         <label>Car Name:</label><br>
                         <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required><br>

                         <label>Brand:</label><br>
                         <input type="text" name="brand" value="<?= htmlspecialchars($row['brand']) ?>" required><br>

                         <label>Price/Day:</label><br>
                         <input type="number" step="0.01" name="price_per_day" value="<?= $row['price_per_day'] ?>"
                              required><br>

                         <label>Specs:</label><br>
                         <textarea name="specs" rows="3"><?= htmlspecialchars($row['specs']) ?></textarea><br>

                         <label>New Image (optional):</label><br>
                         <input type="file" name="image" accept="image/*"><br><br>

                         <button type="submit" name="edit">✅ Save Changes</button>
                         <button type="button" onclick="toggleEditForm(<?= $row['id'] ?>)">❌ Cancel</button>
                    </form>
               </td>
          </tr>
          <?php } ?>
     </table>

     <div class="export-btns">
          <a href="?export=csv"><button type="button">Export to CSV</button></a>
          <button onclick="exportTableToPDF()">Print / Export to PDF</button>
     </div>

     <!-- ADD CAR FORM -->
     <div id="addCarForm" style="display: none;">
          <h3>Add New Car</h3>
          <form method="POST" enctype="multipart/form-data">
               <input type="text" name="name" placeholder="Car Name" required><br>
               <input type="text" name="brand" placeholder="Brand" required><br>
               <input type="number" step="0.01" name="price_per_day" placeholder="Price per day" required><br>
               <textarea name="specs" placeholder="Specifications" rows="3"></textarea><br>
               <input type="file" name="image" accept="image/*" required><br>
               <button type="submit" name="add">Add Car</button>
          </form>
     </div>

</body>

</html>