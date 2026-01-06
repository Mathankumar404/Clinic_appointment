<?php
require "admin_auth.php";
require "../includes/db.php";

$appointments = $conn->query(
  "SELECT a.id, a.appointment_date, a.appointment_time, a.status,
          p.name AS patient,
          d.name AS doctor
   FROM appointments a
   JOIN patients p ON a.patient_id = p.id
   JOIN doctors d ON a.doctor_id = d.id
   ORDER BY a.appointment_date DESC, a.appointment_time ASC"
);
?>

<?php
require "admin_auth.php";
require "../includes/db.php";

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request method");
}

// Check required POST data
if (!isset($_POST["id"], $_POST["status"])) {
    die("Missing required data");
}

$id = (int) $_POST["id"];
$status = trim($_POST["status"]);

// Allow only valid ENUM values
$allowedStatuses = ["Pending", "Approved", "Cancelled"];
if (!in_array($status, $allowedStatuses, true)) {
    die("Invalid status value");
}

// Prepare update query
$stmt = $conn->prepare(
    "UPDATE appointments 
     SET status = ? 
     WHERE id = ?"
);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("si", $status, $id);

// Execute
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

// Optional safety check
// If affected_rows === 0, either ID is wrong or status was unchanged
// Not an error, so we don't die here

// Redirect back to dashboard
header("Location: dashboard.php");
exit;
?>

<h2>Admin – Appointment Management</h2>

<table border="1" cellpadding="8">
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
  <td><?= $row["patient"]; ?></td>
  <td><?= $row["doctor"]; ?></td>
  <td><?= $row["appointment_date"]; ?></td>
  <td><?= $row["appointment_time"]; ?></td>
  <td><?= $row["status"]; ?></td>
  <td>
    <form method="POST" action="update_status.php" style="display:inline;">
      <input type="hidden" name="id" value="<?= $row['id']; ?>">
      <select name="status">
        <option <?= $row["status"]=="Pending"?"selected":"" ?>>Pending</option>
        <option <?= $row["status"]=="Approved"?"selected":"" ?>>Approved</option>
        <option <?= $row["status"]=="Cancelled"?"selected":"" ?>>Cancelled</option>
      </select>
      <button type="submit">Update</button>
    </form>
  </td>
</tr>
<?php } ?>
</table>

<a href="logout.php">Logout</a>
