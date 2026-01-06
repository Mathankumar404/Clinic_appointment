<?php
require "../includes/db.php";
date_default_timezone_set("Asia/Kolkata");

$doctor_id = $_GET["doctor_id"];
$date = $_GET["date"];

// Fetch doctor timing
$doc = $conn->query(
  "SELECT start_time, end_time FROM doctors WHERE id=$doctor_id"
)->fetch_assoc();

// Create full datetime timestamps
$start = strtotime("$date {$doc['start_time']}");
$end   = strtotime("$date {$doc['end_time']}");
$slot_duration = 15 * 60;

// Fetch booked slots (24-hour)
$booked = [];
$res = $conn->query(
  "SELECT appointment_time FROM appointments 
   WHERE doctor_id=$doctor_id AND appointment_date='$date'"
);
while ($r = $res->fetch_assoc()) {
  $booked[] = $r["appointment_time"];
}

$slots = [];
$currentTimestamp = time(); // current date + time

for ($time = $start; $time < $end; $time += $slot_duration) {

  // ❌ Skip past slots for today
  if ($date === date("Y-m-d") && $time <= $currentTimestamp) {
    continue;
  }

  $t24 = date("H:i:s", $time); // for DB comparison
  $t12 = date("h:i A", $time); // for UI

  if (!in_array($t24, $booked)) {
    $slots[] = $t12;
  }
}

echo json_encode($slots);
