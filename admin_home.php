<?php

include 'header.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}
?>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="text-center mb-4">ADMIN CONTROL PANEL</h3>

        <div class="d-grid gap-3">

            <a href="verify_internships.php" class="btn btn-warning btn-lg">
                <i class="fa-solid fa-check"></i> Verify Internships
            </a>

            <a href="view_applications.php" class="btn btn-primary btn-lg">
                <i class="fa-solid fa-users"></i> Student Applications
            </a>

            <a href="view_students.php" class="btn btn-info btn-lg">
                <i class="fa-solid fa-user-graduate"></i> Students
            </a>

            <a href="logout.php" class="btn btn-dark btn-lg">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>

        </div>
    </div>
</div>