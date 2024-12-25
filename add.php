<?php
include('db.php'); // Include database connection file

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Password encryption
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    // Insert data into the database
    $sql = "INSERT INTO users (username, password, email, first_name, last_name) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $password, $email, $first_name, $last_name);
    $stmt->execute();

    echo "User added successfully!<br>";
    echo "<a href='index.php'>Go back to user list</a>";
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add User</title>
    </head>
    <body>
        <h1>Add New User</h1>
        <form method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="first_name">First Name:</label><br>
            <input type="text" id="first_name" name="first_name" required><br><br>

            <label for="last_name">Last Name:</label><br>
            <input type="text" id="last_name" name="last_name" required><br><br>

            <input type="submit" value="Add User">
        </form>
    </body>
    </html>
    <?php
}
?>
