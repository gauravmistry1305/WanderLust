<?php
session_start();
require_once '../db.php';

$uploadDir = 'uploads/';

// Add destination
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $imageName = '';
    if ($_FILES['image']['error'] == 0) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
    }

    $stmt = $conn->prepare("INSERT INTO destinations (name, description, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $description, $imageName);
    $stmt->execute();
    $stmt->close();
}

// Update destination
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $imageName = $_POST['existing_image'];
    if ($_FILES['image']['error'] == 0) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
    }

    $stmt = $conn->prepare("UPDATE destinations SET name=?, description=?, image=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $description, $imageName, $id);
    $stmt->execute();
    $stmt->close();
}

// Delete destination
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $img = $conn->query("SELECT image FROM destinations WHERE id=$id")->fetch_assoc();
    if (!empty($img['image']) && file_exists($uploadDir . $img['image'])) {
        unlink($uploadDir . $img['image']);
    }
    $conn->query("DELETE FROM destinations WHERE id=$id");
}

// Fetch all destinations
$result = $conn->query("SELECT * FROM destinations ORDER BY created_time ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <title>Manage Destinations</title>
     <link rel="stylesheet" href="manage_destinations.css">
     <style>
     .search-bar {
          margin: 10px 0;
          padding: 8px;
          width: 100px;
     }

     .export-btns {
          margin: 10px 0;
     }

     table,
     th,
     td {
          border-collapse: collapse;
     }
     </style>
     <script>
     function toggleForm() {
          const form = document.getElementById("add-form");
          form.style.display = form.style.display === "block" ? "none" : "block";
     }

     function openEditForm(id, name, description, image) {
          document.getElementById("edit-form").style.display = "block";
          document.getElementById("edit-id").value = id;
          document.getElementById("edit-name").value = name;
          document.getElementById("edit-description").value = description;
          document.getElementById("existing-image").value = image;
     }

     function closeEditForm() {
          document.getElementById("edit-form").style.display = "none";
     }

     function searchTable() {
          const input = document.getElementById("searchInput").value.toLowerCase();
          const rows = document.querySelectorAll("#destinationsTable tbody tr");
          rows.forEach(row => {
               const text = row.innerText.toLowerCase();
               row.style.display = text.includes(input) ? "" : "none";
          });
     }

     function exportTableToCSV(filename = 'destinations.csv') {
          const rows = document.querySelectorAll("table tr");
          let csv = [];
          rows.forEach(row => {
               const cols = row.querySelectorAll("td, th");
               let rowData = [];
               cols.forEach(col => rowData.push('"' + col.innerText.replace(/"/g, '""') + '"'));
               csv.push(rowData.join(","));
          });

          const csvBlob = new Blob([csv.join("\n")], {
               type: "text/csv"
          });
          const url = URL.createObjectURL(csvBlob);
          const link = document.createElement("a");
          link.setAttribute("href", url);
          link.setAttribute("download", filename);
          link.click();
     }

     function exportTableToPDF() {
          window.print();
     }
     </script>
</head>

<body>

     <nav>
          <h1>Admin Panel</h1>
          <a href="admin_dashboard.php">🏠 Dashboard</a>
          <a href="manage_users.php">👤 Manage Users</a>
          <a href="manage_destinations.php">🛣️ Manage Places</a>
          <a href="manage_trips.php">🧳 Manage Trips</a>
          <a href="manage_cars.php">🚗 Manage Cars</a>
          <a href="logout.php" class="logout">🔓 Logout</a>
     </nav>

     <h2>Manage Destinations</h2>

     <input type="text" id="searchInput" onkeyup="searchTable()" class="search-bar"
          placeholder="Search destinations...">

     <div class="export-btns">
          <button onclick="exportTableToCSV()">Export to CSV</button>
          <button onclick="exportTableToPDF()">Print / Export to PDF</button>
     </div>

     <table id="destinationsTable" border="1" cellpadding="10">
          <thead>
               <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Created Time</th>
                    <th>
                         Actions
                         <button onclick="toggleForm()">➕ Add</button>
                    </th>
               </tr>
          </thead>
          <tbody>
               <?php while ($row = $result->fetch_assoc()): ?>
               <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td>
                         <?php if (!empty($row['image'])): ?>
                         <img src="<?= $uploadDir . $row['image'] ?>" width="100">
                         <?php else: ?>
                         No image
                         <?php endif; ?>
                    </td>
                    <td><?= $row['created_time'] ?></td>
                    <td>
                         <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this destination?')"
                              class="delete-btn">Delete</a>
                         <button onclick="openEditForm('<?= $row['id'] ?>', 
                                               '<?= htmlspecialchars($row['name'], ENT_QUOTES) ?>', 
                                               '<?= htmlspecialchars($row['description'], ENT_QUOTES) ?>', 
                                               '<?= $row['image'] ?>')">✏️ Edit</button>
                    </td>
               </tr>
               <?php endwhile; ?>
          </tbody>
     </table>

     <!-- Add Form -->
     <div class="form-destination" id="add-form" style="display: none;">
          <div class="form-header">
               <h3>Add New Destination</h3>
               <button onclick="toggleForm()">❌</button>
          </div>
          <form method="POST" enctype="multipart/form-data">
               <input type="text" name="name" placeholder="Destination Name" required><br>
               <textarea name="description" placeholder="Description" required></textarea><br>
               <input type="file" name="image" accept="image/*"><br>
               <button type="submit" name="add">Add Destination</button>
          </form>
     </div>

     <!-- Edit Form -->
     <div class="form-destination" id="edit-form" style="display: none;">
          <div class="form-header">
               <h3>Edit Destination</h3>
               <button onclick="closeEditForm()">❌</button>
          </div>
          <form method="POST" enctype="multipart/form-data">
               <input type="hidden" name="id" id="edit-id">
               <input type="text" name="name" id="edit-name" required><br>
               <textarea name="description" id="edit-description" required></textarea><br>
               <input type="file" name="image" accept="image/*"><br>
               <input type="hidden" name="existing_image" id="existing-image">
               <button type="submit" name="update">Update Destination</button>
          </form>
     </div>

</body>

</html>