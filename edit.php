<?php
include('db.php'); // Include database connection file

// Get user ID
$user_id = $_GET['id'];

// Fetch user data
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found!";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Update user data
    $sql = "UPDATE users SET username = ?, password = ?, email = ?, first_name = ?, last_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $username, $password, $email, $first_name, $last_name, $user_id);
    $stmt->execute();

    echo "User information updated!<br>";
    echo "<a href='index.php'>Go back to user list</a>";
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit User</title>
    </head>
    <body>
        <h1>Edit User</h1>
        <form method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br><br>

            <label for="first_name">First Name:</label><br>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required><br><br>

            <label for="last_name">Last Name:</label><br>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required><br><br>

            <input type="submit" value="Update User">
        </form>
    </body>
    </html>
    <?php
}
?>
