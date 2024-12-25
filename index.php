<?php
include('db.php'); // Include database connection file

// Fetch all users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>
    <h1>User List</h1>
    <a href="add.php">Add New User</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['username'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['first_name'] . "</td>
                            <td>" . $row['last_name'] . "</td>
                            <td>
                                <a href='edit.php?id=" . $row['id'] . "'>Edit</a> | 
                                <a href='delete.php?id=" . $row['id'] . "'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No users found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
