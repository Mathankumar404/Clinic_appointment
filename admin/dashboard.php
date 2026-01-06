<?php
require "admin_auth.php";
require "./admin_header.php";
require "./search_appointment.php"; // THIS sets $appointments
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin – Appointment Management</title>
  <link rel="stylesheet" href="../assets/css/admin_dash.css">
</head>
<body>

<div class="admin-container">
  <h2>Admin – Appointment Management</h2>

  <!-- SEARCH FORM (ONLY ONCE) -->
  <form method="GET" class="search-form">

  <div class="search-field">
    <input
      type="text"
      name="q"
      class="search-input"
      placeholder="Search patient or doctor"
      value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
    >
  </div>

  <div class="search-field">
    <select name="status" class="search-select">
      <option value="">All Status</option>
      <option value="Pending"   <?= ($_GET['status'] ?? '') === 'Pending' ? 'selected' : '' ?>>Pending</option>
      <option value="Approved"  <?= ($_GET['status'] ?? '') === 'Approved' ? 'selected' : '' ?>>Approved</option>
      <option value="Cancelled" <?= ($_GET['status'] ?? '') === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
    </select>
  </div>

  <button type="submit" class="search-btn">Search</button>

</form>


  <table class="admin-table">
    <tr>
      <th>Patient</th>
      <th>Doctor</th>
      <th>Date</th>
      <th>Time</th>
      <th>Status</th>
      <th>Action</th>
    </tr>

    <?php while ($row = $appointments->fetch_assoc()) { ?>
      <tr>
        <td><?= htmlspecialchars($row["patient"]) ?></td>
        <td><?= htmlspecialchars($row["doctor"]) ?></td>
        <td><?= $row["appointment_date"] ?></td>
        <td><?= $row["appointment_time"] ?></td>
        <td class="status-<?= $row["status"] ?>">
          <?= $row["status"] ?>
        </td>
        <td>
          <form method="POST" action="update_status.php">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <select name="status">
              <option value="Pending"   <?= $row["status"]=="Pending"?"selected":"" ?>>Pending</option>
              <option value="Approved"  <?= $row["status"]=="Approved"?"selected":"" ?>>Approved</option>
              <option value="Cancelled" <?= $row["status"]=="Cancelled"?"selected":"" ?>>Cancelled</option>
            </select>
            <button type="submit">Update</button>
          </form>
        </td>
      </tr>
    <?php } ?>
  </table>

</div>
</body>
</html>
