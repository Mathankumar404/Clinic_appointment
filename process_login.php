<?php
session_start();
require "./includes/db.php";

$email = trim($_POST["email"]);
$password = $_POST["password"];

$stmt = $conn->prepare(
    "SELECT id, name, password FROM patients WHERE email = ?"
);
$stmt->bind_param("s", $email);
$stmt->execute();

$res = $stmt->get_result();

if ($res->num_rows === 1) {
    $user = $res->fetch_assoc();
    if (password_verify($password, $user["password"])) {
        $_SESSION["patient_id"] = $user["id"];
        $_SESSION["patient_name"] = $user["name"];
        header("Location: patient/dashboard.php");
        exit;
    }
}

$_SESSION["error"] = "Invalid email or password";
header("Location: login.php");
exit;
