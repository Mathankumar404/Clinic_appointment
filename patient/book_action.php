<?php
require "../includes/auth.php";
require "../includes/db.php";

if (!isset($_POST["doctor_id"], $_POST["appointment_date"], $_POST["appointment_time"])) {
    die("Invalid form submission");
}

$patient_id = $_SESSION["patient_id"];
$doctor_id  = (int) $_POST["doctor_id"];
$date       = $_POST["appointment_date"];
$time       = $_POST["appointment_time"];
$today = date('Y-m-d');

if ($date < $today) {
    echo "You cannot book an appointment in the past";
    exit;
}
$stmt = $conn->prepare(
  "INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time)
   VALUES (?, ?, ?, ?)"
);
$stmt->bind_param("iiss", $patient_id, $doctor_id, $date, $time);

try {
    $stmt->execute();
    echo "Appointment booked (Pending approval)";
} catch (mysqli_sql_exception $e) {
    echo "This slot is already booked";
}
