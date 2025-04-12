<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "wanderlust";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Handle Add Trip
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $imageName = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
    }

    $stmt = $conn->prepare("INSERT INTO trips (name, image, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $imageName, $price);
    $stmt->execute();
    $stmt->close();
}

// Handle Delete Trip
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $img = $conn->query("SELECT image FROM trips WHERE id = $id")->fetch_assoc();
    if ($img && !empty($img['image']) && file_exists($uploadDir . $img['image'])) {
        unlink($uploadDir . $img['image']);
    }
    $conn->query("DELETE FROM trips WHERE id = $id");
}

// Handle Edit Trip
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $imageName = $_POST['old_image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        if (!empty($imageName) && file_exists($uploadDir . $imageName)) {
            unlink($uploadDir . $imageName);
        }
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
    }

    $stmt = $conn->prepare("UPDATE trips SET name=?, image=?, price=? WHERE id=?");
    $stmt->bind_param("ssdi", $name, $imageName, $price, $id);
    $stmt->execute();
    $stmt->close();
}

// Handle Export CSV
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=trips.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, ['ID', 'Name', 'Image', 'Price', 'Created Date']);
    $rows = $conn->query("SELECT * FROM trips");
    while ($row = $rows->fetch_assoc()) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}

// Search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM trips WHERE name LIKE '%$search%' ORDER BY created_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
     <title>Manage Trips</title>
     <link rel="stylesheet" href="manage_trips.css">

     <script>
     function toggleAddForm() {
          const form = document.getElementById("addTripForm");
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

     <h2>Manage Trips</h2>

     <form method="GET">
          <input type="text" name="search" placeholder="Search trips..." value="<?= htmlspecialchars($search) ?>">
          <button type="submit">Search</button>
     </form>

     <h3>All Trips</h3>
     <table>
          <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Image</th>
               <th>Price</th>
               <th>Created Date</th>
               <th>
                    Actions <button type="button" class="add-btn" onclick="toggleAddForm()">➕ Add</button>
               </th>
          </tr>
          <?php while ($row = $result->fetch_assoc()) { ?>
          <tr>
               <td><?= $row['id'] ?></td>
               <td><?= htmlspecialchars($row['name']) ?></td>
               <td>
                    <?php if (!empty($row['image'])): ?>
                    <img src="<?= $uploadDir . $row['image'] ?>" alt="Trip Image" style="width: 80px;">
                    <?php else: ?>
                    No image
                    <?php endif; ?>
               </td>
               <td><?= number_format($row['price'], 2) ?></td>
               <td><?= $row['created_date'] ?></td>
               <td>
                    <button onclick="toggleEditForm(<?= $row['id'] ?>)">✏️ Edit</button>
                    <a href="?delete=<?= $row['id'] ?>"
                         onclick="return confirm('Are you sure to delete this trip?')">🗑️ Delete</a>
               </td>
          </tr>
          <tr id="editForm<?= $row['id'] ?>" style="display: none; background-color: #f9f9f9;">
               <td colspan="6">
                    <form method="POST" enctype="multipart/form-data">
                         <input type="hidden" name="id" value="<?= $row['id'] ?>">
                         <input type="hidden" name="old_image" value="<?= $row['image'] ?>">

                         <label>Trip Name:</label><br>
                         <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required><br>

                         <label>Price:</label><br>
                         <input type="number" step="0.01" name="price" value="<?= $row['price'] ?>" required><br>

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

     <!-- ADD TRIP FORM (Initially Hidden) -->
     <div id="addTripForm" style="display: none;">
          <h3>Add New Trip</h3>
          <form method="POST" enctype="multipart/form-data">
               <input type="text" name="name" placeholder="Trip Name" required><br>
               <input type="file" name="image" accept="image/*" required><br>
               <input type="number" step="0.01" name="price" placeholder="Price" required><br>
               <button type="submit" name="add">Add Trip</button>
          </form>
     </div>

</body>

</html>