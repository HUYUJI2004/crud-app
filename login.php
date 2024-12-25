<?php
// 开启 session
session_start();

// 包含数据库连接文件
include('db.php'); // 引入数据库连接文件

// 检查数据库连接是否成功
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单数据
    $username = $_POST['user'];
    $password = $_POST['pass'];

    // 防止 SQL 注入
    $username = mysqli_real_escape_string($conn, $username);

    // 查询数据库获取用户信息
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // 用户名存在，获取用户数据
        $user = mysqli_fetch_assoc($result);
        
        // 使用 password_verify() 来验证密码
        if (password_verify($password, $user['password'])) {
            // 密码匹配，登录成功
            $_SESSION['user_id'] = $user['id'];  // 这里的 id 是用户的唯一标识
            $_SESSION['username'] = $user['username'];
            header('Location: welcome.php'); // 登录成功后跳转到欢迎页面
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>

    <h1>Login</h1>
    
    <form action="login.php" method="POST">
        Username: <input type="text" name="user" required><br><br>
        Password: <input type="password" name="pass" required><br><br>
        <button type="submit">Login</button>
    </form>

    <?php
    // 如果有错误信息则显示
    if (isset($error)) {
        echo "<p style='color:red;'>$error</p>";
    }
    ?>

    <p><a href="add.php">Sign up</a></p>  <!-- 引导用户去注册页面 -->

</body>
</html>
