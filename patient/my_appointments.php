<?php
require "../includes/auth.php";
require "../includes/db.php";
require "../includes/header.php";

$id = $_SESSION["patient_id"];

$result = $conn->query(
  "SELECT a.*, d.name AS doctor_name
   FROM appointments a
   JOIN doctors d ON a.doctor_id = d.id
   WHERE patient_id = $id
   ORDER BY appointment_date DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Appointments</title>
  <link rel="stylesheet" href="/clinic-app/assets/css/my_appointments.css">
</head>
<body>

<div class="appointments-container">
  <h3>My Appointments</h3>

  <table class="appointments-table">
    <tr>
      <th>Doctor</th>
      <th>Date</th>
      <th>Time</th>
      <th>Status</th>
      <th>Action</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= htmlspecialchars($row["doctor_name"]); ?></td>
      <td><?= $row["appointment_date"]; ?></td>
      <td><?= $row["appointment_time"]; ?></td>
      <td>
        <span class="status <?= $row["status"]; ?>">
          <?= $row["status"]; ?>
        </span>
      </td>
<td>
  <?php if ($row["status"] === "Pending") { ?>
    <form method="POST" action="delete_appointment.php" onsubmit="return confirm('Are you sure you want to Delete this appointment?');">
      <input type="hidden" name="appointment_id" value="<?= $row['id']; ?>">
      <button  style="background-color:red;border-radius:5px;color:white;border:none;padding:5px 15px 5px 15px;">Delete</button>
    </form>
  <?php } ?>
</td>
    </tr>
    <?php } ?>
  </table>
</div>

</body>
</html>
