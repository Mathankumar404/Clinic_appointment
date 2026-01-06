<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: /clinic-app/admin/login.php");
    exit;
}
