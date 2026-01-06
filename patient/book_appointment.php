<?php
require "../includes/auth.php";
require "../includes/db.php";
require "../includes/header.php";

$doctors = $conn->query("SELECT * FROM doctors");

?>

<!DOCTYPE html>
<html>
<head>
  <title>Book Appointment</title>
  <link rel="stylesheet" href="/clinic-app/assets/css/book_appointment.css">
</head>
<body>

<div class="appointment-container">
  <h3>Book Appointment</h3>

  <form id="appointmentForm" method="POST" >

    <label>Doctor</label>
    <select id="doctor_id" name="doctor_id" required>
      <option value="">Select Doctor</option>
      <?php while ($d = $doctors->fetch_assoc()) { ?>
        <option value="<?= $d['id']; ?>">
          <?= htmlspecialchars($d['name']); ?> (<?= htmlspecialchars($d['specialization']); ?>)
        </option>
      <?php } ?>
    </select>

    <label>Date</label>
    <input type="date" id="appointment_date" name="appointment_date"  min="<?= date('Y-m-d'); ?>" required>

    <label>Available Slots</label>
    <select id="appointment_time" name="appointment_time" required>
      <option value="">Select Slot</option>
    </select>

    <button type="submit">Book Appointment</button>
  </form>

  <div id="msg"></div>
</div>

</body>
</html>
<script src="/clinic-app/assets/js/slots.js"></script>
<script src="/clinic-app/assets/js/book_appointment.js"></script>


