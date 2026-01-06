<?php
require "../includes/auth.php";
require "../includes/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/clinic-app/assets/css/dashboard.css">

  <title>Patient Dashboard</title>

</head>

<body>

<?php require "../includes/header.php"; ?>

<div class="dashboard">
  <div class="welcome">
    Welcome, <strong><?= htmlspecialchars($_SESSION["patient_name"]); ?></strong>
  </div>
<div class="card-container">

  <a href="/clinic-app/patient/book_appointment.php" class="card-link">
    <div class="card">
      <i class="fa-solid fa-calendar-plus"></i>
      <span>Book Appointment</span>
    </div>
  </a>

  <a href="/clinic-app/patient/my_appointments.php" class="card-link">
    <div class="card">
      <i class="fa-solid fa-notes-medical"></i>
      <span>My Appointments</span>
    </div>
  </a>

  <!-- <a href="#" class="card-link">
    <div class="card">
      <i class="fa-solid fa-user"></i>
      <span>My Profile (Coming Soon)</span>
    </div>
  </a> -->

</div>

</body>
</html>
