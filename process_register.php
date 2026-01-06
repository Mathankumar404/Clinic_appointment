<?php
session_start();
require "./includes/db.php";

$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$password = $_POST["password"];

if (strlen($password) < 6) {
    $_SESSION["error"] = "Password must be at least 6 characters";
    header("Location: register.php");
    exit;
}

$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO patients (name, email, password) VALUES (?, ?, ?)"
);
$stmt->bind_param("sss", $name, $email, $hashed);

if ($stmt->execute()) {
    header("Location: login.php");
    exit;
}

$_SESSION["error"] = "Email already exists";
header("Location: register.php");
exit;
