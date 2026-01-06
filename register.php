<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Patient Registration</title>
  <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>

<div class="auth-card">
  <h2>Patient Registration</h2>

  <?php if (isset($_SESSION["error"])) { ?>
    <div class="error"><?= $_SESSION["error"]; ?></div>
    <?php unset($_SESSION["error"]); ?>
  <?php } ?>

  <form method="POST" action="process_register.php">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
<div class="password-wrapper">
            <input type="password" name="password" id="password" placeholder="Password" required>
            <span class="toggle-password" onclick="togglePassword()">👁️</span>
        </div>
            <button type="submit">Register</button>
  </form>

  <div class="link">
    Already registered? <a href="login.php">Login</a>
  </div>
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
