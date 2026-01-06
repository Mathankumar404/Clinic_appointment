<?php
require "../includes/auth.php";
require "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $appointment_id = (int) $_POST["appointment_id"];
    $patient_id = $_SESSION["patient_id"];

    // Only allow deleting OWN pending appointments
    $stmt = $conn->prepare(
        "DELETE FROM appointments
         WHERE id = ? AND patient_id = ? AND status = 'Pending'"
    );

    $stmt->bind_param("ii", $appointment_id, $patient_id);
    $stmt->execute();
}

header("Location: my_appointments.php");
exit;
