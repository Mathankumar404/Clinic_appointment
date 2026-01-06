<?php
session_start();
session_destroy();
header("Location: /clinic-app/login.php");
exit;
