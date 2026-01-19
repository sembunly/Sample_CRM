<?php include('includes/header.php'); ?>
<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: admin/");
    exit();
}
require_once "conn.php";

$msg = "";

if (isset($_POST['btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=? AND status=1");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['login'] = true;
        $_SESSION['username'] = $row['username'];
        header("Location: admin/");
        exit();
    } else {
        $msg = "Login failed";
    }
}
?>

<style>
html, body {
    height: 100%;
}
body {
    display: flex;
    justify-content: center;
    align-items: center;
    background: url('https://tectura.com/india/wp-content/uploads/2025/03/CRM.jpg') no-repeat center center fixed;
    background-size: cover;
}
.login-card {
    background: rgba(255, 255, 255, 0.95);
    padding: 2rem;
    border-radius: 10px;
    max-width: 400px;
    width: 100%;
    box-shadow: 0 0 15px rgba(0,0,0,0.3);
    text-align: center;
}
</style>

<div class="login-card">
    <h2 class="mb-3">Login to Your System</h2>
    <form method="post">
        <div class="mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="mb-3 form-check text-start">
            <input type="checkbox" class="form-check-input" name="remember" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <button type="submit" name="btn" class="btn btn-primary w-100">Login</button>
    </form>
    <?php if($msg != ""): ?>
        <div class="text-danger mt-3"><?= $msg ?></div>
    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>
