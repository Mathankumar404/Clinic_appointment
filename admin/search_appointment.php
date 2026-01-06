<?php
require_once "../includes/db.php";

$q = $_GET['q'] ?? '';
$status = $_GET['status'] ?? '';

$sql = "
SELECT a.id, a.appointment_date, a.appointment_time, a.status,
       p.name AS patient,
       d.name AS doctor
FROM appointments a
JOIN patients p ON a.patient_id = p.id
JOIN doctors d ON a.doctor_id = d.id
WHERE 1=1
";

$params = [];
$types = "";

if ($q !== '') {
    $sql .= " AND (p.name LIKE ? OR d.name LIKE ?)";
    $params[] = "%$q%";
    $params[] = "%$q%";
    $types .= "ss";
}

if ($status !== '') {
    $sql .= " AND a.status = ?";
    $params[] = $status;
    $types .= "s";
}

$sql .= " ORDER BY a.appointment_date DESC, a.appointment_time ASC";

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$appointments = $stmt->get_result();