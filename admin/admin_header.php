<?php
// admin_header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* ================= ADMIN HEADER ================= */

/* ===== SIMPLE ADMIN HEADER ===== */
.admin-header {
  height: 60px;
  background-color: #2c3e50;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 24px;
}

/* LOGO */
.logo {
  font-size: 18px;
  font-weight: 700;
}

/* NAVBAR */
.nav-links {
  display: flex;
}

.nav-links a {
  color: #ecf0f1;
  text-decoration: none;
  padding: 10px 16px;
  font-weight: 600;
  transition: background 0.2s ease;
}

.nav-links a:hover {
  background-color: #34495e;
}

/* LOGOUT */
.nav-links .logout {
  background-color: #e74c3c;
  margin-left: 8px;
}

.nav-links .logout:hover {
  background-color: #c0392b;
}
.nav-links a.active {
  background-color: #1abc9c;
}
</style>
<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<header class="admin-header">
  <div class="logo">Clinic App Admin</div>

<nav class="nav-links">
  <a href="/clinic-app/admin/dashboard.php"
     class="<?= $currentPage === 'dashboard.php' ? 'active' : '' ?>">
     My Appointments
  </a>

  <a href="/clinic-app/admin/admin_doctors.php"
     class="<?= $currentPage === 'admin_doctors.php' ? 'active' : '' ?>">
     Doctor Management
  </a>

  <a href="/clinic-app/admin/logout.php" class="logout">
    <i class="fa-solid fa-right-from-bracket"></i>  Logout
  </a>
</nav>

</header>