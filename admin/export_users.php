<?php
require_once '../db.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="users_export.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['ID', 'First Name', 'Last Name', 'Email', 'Phone', 'Created At']);

$users = $conn->query("SELECT * FROM users ORDER BY id ASC");

while ($row = $users->fetch_assoc()) {
    fputcsv($output, [
        $row['id'],
        $row['first_name'],
        $row['last_name'],
        $row['email'],
        $row['phone'],
        $row['created_at']
    ]);
}

fclose($output);
exit;