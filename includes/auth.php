<?php
session_start();

if (!isset($_SESSION["patient_id"])) {
    header("Location: /clinic-app/login.php");
    exit;
}
?>
