<?php
session_start();
require_once "conn.php";

$msg = "";

if (isset($_POST['btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' AND status=1";
    $exec = mysqli_query($conn, $sql);

    if ($exec && mysqli_num_rows($exec) > 0) {
        $row = mysqli_fetch_assoc($exec);
        $_SESSION['login'] = true;
        $_SESSION['username'] = $row['username'];
        header("Location: crm/");
        exit();
    } else {
        $msg = "Login failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login System</title>
</head>
<body>
<div class="container">
    <h1>Login System</h1>
    <h4>Please enter your username and password</h4>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <p><input type="checkbox" name="remember"> Remember me</p>
        <button type="submit" name="btn">Login</button>
    </form>
    <?php if($msg != "") echo "<div class='msg'>$msg</div>"; ?>
</div>
</body>
<style>
    body {
        font-family: Arial, sans-serif;
        background: url('https://www.cxtoday.com/wp-content/uploads/2022/01/CRM-101-Customer-Relationship-Management.jpeg') no-repeat center center fixed;        
        background-size: cover;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .container {
        background: rgba(255,255,255,0.9);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
        width: 350px;
        text-align: center;
    }
    h1 { color: #2c3e50; margin-bottom: 10px; }
    h4 { font-weight: normal; color: #555; margin-bottom: 20px; }
    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 8px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    button {
        width: 100%;
        padding: 10px;
        background: #3498db;
        border: none;
        color: #fff;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover { background: #2980b9; }
    p { margin: 10px 0; }
    .msg {
        color: #e74c3c;
        margin-top: 15px;
        font-weight: bold;
    }
</style>
</html>
