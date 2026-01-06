<?php
session_start();
require "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $res = $stmt->get_result();
    if ($res->num_rows === 1) {
        $admin = $res->fetch_assoc();
        if (password_verify($password, $admin["password"])) {
            $_SESSION["admin_id"] = $admin["id"];
            header("Location: dashboard.php");
            exit;
        }
    }
    $error = "Invalid login";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/admin_login.css">
</head>
<body>
    <div class="adminlogin">
        <h1  >
        Admin Login
   </h1>
    <form method="POST">
  <input name="username" placeholder="Admin Username" required>
  <div class="password-wrapper">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <span class="toggle-password" onclick="togglePassword()">👁️</span>
        </div>
  <button>Login</button>
</form>
<?php if (!empty($error)) : ?>
  <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
</div>

<script>
      function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.textContent = '🙈';  // Eye closed when visible
            } else {
                passwordField.type = 'password';
                toggleIcon.textContent = '👁️';  // Eye open when hidden
            }
        }
</script>
</body>
 
</html>


