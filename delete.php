<?php
include('db.php'); // Include database connection file

// Get user ID
$user_id = $_GET['id'];

// Delete user data
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

echo "User deleted!<br>";
echo "<a href='index.php'>Go back to user list</a>";
?>
