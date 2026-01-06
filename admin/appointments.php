<?php
require "../includes/db.php";

$res = $conn->query(
  "SELECT a.id, p.name AS patient, d.name AS doctor,
          a.appointment_date, a.appointment_time, a.status
   FROM appointments a
   JOIN patients p ON a.patient_id = p.id
   JOIN doctors d ON a.doctor_id = d.id
");

while ($r = $res->fetch_assoc()) {
  echo "
    {$r['patient']} - {$r['doctor']} - {$r['appointment_date']} {$r['appointment_time']}
    <a href='update.php?id={$r['id']}&s=Approved'>Approve</a>
    <a href='update.php?id={$r['id']}&s=Cancelled'>Cancel</a>
    <br>
  ";
}
