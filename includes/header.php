<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="/clinic-app/assets/css/header.css">


<header class="app-header">
  <h2 class="logo">
    <i class="fa-solid fa-user-doctor"></i>
    Clinic App
  </h2>

  <nav>
    <a href="/clinic-app/patient/book_appointment.php">
      <i class="fa-solid fa-calendar-check"></i> Book
    </a>
    <a href="/clinic-app/patient/my_appointments.php">
      <i class="fa-solid fa-list"></i> Appointments
    </a>
   <a href="/clinic-app/logout.php"
   class="logout"
   onclick="return confirm('Do you really want to log out from your account?');">
   <i class="fa-solid fa-right-from-bracket"></i> Logout
</a>

  </nav>
</header>

