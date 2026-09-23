<?php include 'header.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>MyInternshipPortal - Home</title>
    

    <style>


        body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #e0f2ff, #f7f9fc);
    min-height: 100vh;
}

        .hero-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 60vh;
}

.hero-card {
    text-align: center;
    padding: 50px 40px;
    border-radius: 20px;
    
    /* glass effect */
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);

    border: 1px solid rgba(255, 255, 255, 0.3);

    box-shadow: 0 10px 40px rgba(0,0,0,0.15);

    max-width: 700px;

    animation: fadeIn 1s ease-in-out;
}

.hero-card h1 {
    font-size: 40px;
    font-weight: 700;
    color: #1e3a8a;
    margin-bottom: 15px;
}

.hero-card p {
    font-size: 18px;
    color: #334155;
}

/* animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
    </style>
</head>
<body>

<div class="banner">
    <div class="banner-text">
    <div class="hero-container">
    <div class="hero-card">
        <h1>Welcome to MyInternshipPortal</h1>
        <p>"Internships are the bridge between education and career."</p>
    </div>
</div>
</div>

<div class="container mt-5">
    <h3 class="text-center">Why Internships Matter?</h3>
    <p class="text-center">
        Our portal connects students with verified internship opportunities,
        allows centralized applications, and enables proper screening by admin
        before forwarding candidates to companies.
    </p>
</div>

</body>
</html>