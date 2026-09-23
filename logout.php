<?php
session_start();

// If admin is logged in
if(isset($_SESSION['admin'])){
    session_unset();
    session_destroy();
    header("Location: admin_login.php");
    exit();
}

// If student is logged in
if(isset($_SESSION['student_email'])){
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// Default fallback
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>