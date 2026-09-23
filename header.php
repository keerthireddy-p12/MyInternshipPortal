<?php
session_start();
?>

<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body{
    background: #f4f6f9;
    font-family: 'Segoe UI', sans-serif;
}

/* Navbar */
.navbar{
    background: linear-gradient(90deg,#0d6efd,#0a58ca);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.navbar-brand{
    font-size: 22px;
    font-weight: 600;
    letter-spacing: .5px;
}

.nav-link{
    color: #fff !important;
    font-weight: 500;
    margin-left: 10px;
    transition: 0.3s ease;
}

.nav-link:hover{
    transform: translateY(-2px);
    color: #ffd54f !important;
}

/* Cards */
.card{
    border-radius: 14px;
    border: none;
    box-shadow: 0 6px 16px rgba(0,0,0,0.08);
}

/* Container spacing */
.page-container{
    margin-top: 40px;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">

        <!-- Logo & Title -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="images/internshipLOGO.jpeg" width="55" class="me-2 rounded">
            MyInternshipPortal
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto align-items-center">

                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>

                <?php if(isset($_SESSION['admin'])){ ?>
                    <!-- Admin Menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="admin_home.php">
                            <i class="fa fa-user-shield"></i> Admin Panel
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="logout.php">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </a>
                    </li>

                <?php } elseif(isset($_SESSION['student_email'])){ ?>
                    <!-- Student Menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="fa fa-briefcase"></i> Internships
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="student_profile.php">
                            <i class="fa fa-user-circle"></i> My Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="logout.php">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </a>
                    </li>

                <?php } else { ?>
                    <!-- Guest Menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">
                            <i class="fa fa-user-plus"></i> Register
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            <i class="fa fa-sign-in-alt"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-info" href="admin_login.php">
                            <i class="fa fa-user-shield"></i> Admin
                        </a>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </div>
</nav>