<?php
require "../includes/auth.php";
require "../includes/db.php";
require "./admin_header.php";
/* ================= ADD DOCTOR ================= */
if (isset($_POST['add_doctor'])) {
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $stmt = $conn->prepare(
        "INSERT INTO doctors (name, specialization, start_time, end_time)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssss", $name, $specialization, $start_time, $end_time);
    $stmt->execute();

    header("Location: admin_doctors.php");
    exit;
}

/* ================= DELETE DOCTOR ================= */
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    $conn->query("DELETE FROM doctors WHERE id = $id");

    header("Location: admin_doctors.php");
    exit;
}

/* ================= UPDATE DOCTOR ================= */
if (isset($_POST['update_doctor'])) {
    $id = (int) $_POST['id'];
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $stmt = $conn->prepare(
        "UPDATE doctors
         SET name = ?, specialization = ?, start_time = ?, end_time = ?
         WHERE id = ?"
    );
    $stmt->bind_param("ssssi", $name, $specialization, $start_time, $end_time, $id);
    $stmt->execute();

    header("Location: admin_doctors.php");
    exit;
}

/* ================= FETCH DOCTORS ================= */
$doctors = $conn->query(
    "SELECT * FROM doctors ORDER BY created_at DESC"
);

/* ================= FETCH SINGLE DOCTOR FOR EDIT ================= */
$editDoctor = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $editDoctor = $conn->query(
        "SELECT * FROM doctors WHERE id = $id"
    )->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin – Doctors Management</title>
  <style>
    body { font-family: Arial; background:#f4f6f8; }
    .container { max-width:1000px; margin:30px auto; background:#fff; padding:20px; border-radius:6px; }
    table { width:100%; border-collapse:collapse; margin-top:20px; }
    th, td { padding:10px; border:1px solid #ddd; text-align:center; }
    th { background:#f0f0f0; }
    input, button { padding:7px; width:100%; margin-bottom:10px; }
    button { cursor:pointer; }
    .delete { color:red; }
    .actions a { margin:0 5px; }
  </style>
  <link rel="stylesheet" href="../assets/css/admin_doctors.css">
</head>
<body>

<div class="container">
  <h2>Admin – Doctor Management</h2>

  <!-- ADD / EDIT FORM -->
  <form method="POST">
    <input type="hidden" name="id" value="<?= $editDoctor['id'] ?? '' ?>">

    <label>Doctor Name</label>
    <input type="text" name="name" required
           value="<?= $editDoctor['name'] ?? '' ?>">

    <label>Specialization</label>
    <input type="text" name="specialization" required
           value="<?= $editDoctor['specialization'] ?? '' ?>">

   <label>
  Start Time
  <input type="time" name="start_time" required
         value="<?= $editDoctor['start_time'] ?? '' ?>">
</label>

    <label>End Time</label>
    <input type="time" name="end_time" required
           value="<?= $editDoctor['end_time'] ?? '' ?>">

    <?php if ($editDoctor) { ?>
      <button name="update_doctor">Update Doctor</button>
      <a href="admin_doctors.php" class="cancelbtn">Cancel</a>
    <?php } else { ?>
      <button name="add_doctor">Add Doctor</button>
    <?php } ?>
  </form>

  <!-- DOCTORS LIST -->
  <table>
    <tr>
      <th>Name</th>
      <th>Specialization</th>
      <th>Start Time</th>
      <th>End Time</th>
      <th>Created At</th>
      <th>Actions</th>
    </tr>

    <?php while ($row = $doctors->fetch_assoc()) { ?>
    <tr>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['specialization']) ?></td>
      <td><?= $row['start_time'] ?></td>
      <td><?= $row['end_time'] ?></td>
      <td><?= $row['created_at'] ?></td>
      <td class="actions">
        <a href="?edit=<?= $row['id'] ?>">Edit</a> |
        <a href="?delete=<?= $row['id'] ?>"
           class="delete"
           onclick="return confirm('Delete this doctor?');">
           Delete
        </a>
      </td>
    </tr>
    <?php } ?>
  </table>

</div>

</body>
</html>
