<?php
include 'db.php';
include 'header.php';

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass  = mysqli_real_escape_string($conn, $_POST['password']);

    $res = mysqli_query($conn,
        "SELECT * FROM students WHERE email='$email' AND password='$pass'"
    );

    if(mysqli_num_rows($res) > 0){
        $_SESSION['student_email'] = $email;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid Login');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="card shadow-lg border-0 p-4 col-md-5 mx-auto">

        <h3 class="text-center text-success mb-4">
            <i class="fa-solid fa-right-to-bracket"></i> Student Login
        </h3>

        <form method="post">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button name="login" class="btn btn-success w-100">
                Login
            </button>
        </form>

        <div class="text-center mt-3">
            <small>New student? <a href="register.php">Create account</a></small>
        </div>

    </div>
</div>