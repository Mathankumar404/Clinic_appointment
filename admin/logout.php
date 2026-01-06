<?php
session_start();
session_destroy();
header("Location: /clinic-app/admin/login.php");
exit;
