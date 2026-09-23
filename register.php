<?php
include 'db.php';
include 'header.php';

if(isset($_POST['register'])){
    $name   = mysqli_real_escape_string($conn, $_POST['name']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $pass   = mysqli_real_escape_string($conn, $_POST['password']);
    $year   = $_POST['year'];
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $cgpa   = $_POST['cgpa'];

    // ✅ Check duplicate email
    $check = mysqli_query($conn, "SELECT id FROM students WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        echo "<script>alert('Email already registered');</script>";
    } else {

        $sql = "INSERT INTO students (name,email,password,year,branch,cgpa)
                VALUES ('$name','$email','$pass','$year','$branch','$cgpa')";

        if(mysqli_query($conn,$sql)){
            echo "<script>
                    alert('Registered Successfully');
                    window.location='login.php';
                  </script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<div class="container mt-5">
    <div class="card shadow-lg border-0 p-4 col-md-6 mx-auto">

        <h3 class="text-center text-primary mb-4">
            <i class="fa-solid fa-user-plus"></i> Student Registration
        </h3>

        <form method="post">

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Year</label>
                <select name="year" class="form-select" required>
                    <option value="">Select Year</option>
                    <option>1st Year</option>
                    <option>2nd Year</option>
                    <option>3rd Year</option>
                    <option>4th Year</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Branch</label>
                <input type="text" name="branch" class="form-control" placeholder="CSE / IT / ECE" required>
            </div>

            <div class="mb-3">
                <label class="form-label">CGPA</label>
                <input type="number" step="0.01" name="cgpa" class="form-control" required>
            </div>

            <button name="register" class="btn btn-primary w-100">
                Register
            </button>
        </form>
    </div>
</div>