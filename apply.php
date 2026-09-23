<?php
include 'db.php';
include 'header.php';

if(!isset($_SESSION['student_email'])){
    header("Location: login.php");
    exit();
}

$internship_id = $_GET['id'];

// Fetch internship
$intern = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM internships WHERE id='$internship_id'")
);

// Get student id
$email = $_SESSION['student_email'];
$stu = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT id FROM students WHERE email='$email'")
);
$student_id = $stu['id'];

/* ✅ Check already applied (for button + security) */
$already = mysqli_query($conn,
    "SELECT id FROM applications 
     WHERE student_id='$student_id' 
     AND internship_id='$internship_id'"
);

if(isset($_POST['apply'])){

    if(mysqli_num_rows($already) > 0){
        echo "<script>
                alert('You have already applied for this internship');
                window.location='dashboard.php';
              </script>";
        exit();
    }

    // ✅ Resume validation
    $resume = $_FILES['resume']['name'];
    $tmp    = $_FILES['resume']['tmp_name'];
    $size   = $_FILES['resume']['size'];
    $ext    = strtolower(pathinfo($resume, PATHINFO_EXTENSION));

    if($ext != "pdf"){
        echo "<script>alert('Only PDF resumes allowed');</script>";
    }
    elseif($size > 2000000){
        echo "<script>alert('File too large. Max 2MB');</script>";
    }
    else{
        $newname = time() . "_" . $resume;
        move_uploaded_file($tmp, "resumes/".$newname);

        mysqli_query($conn,
            "INSERT INTO applications (student_id, internship_id, resume, status)
             VALUES ('$student_id', '$internship_id', '$newname', 'Pending')"
        );

        echo "<script>
                alert('Applied Successfully');
                window.location='dashboard.php';
              </script>";
    }
}
?>

<div class="container page-container">

    <!-- Internship Details Card -->
    <div class="card p-4 mb-4 border-0 shadow-lg">

        <h4 class="text-primary mb-3">
            <i class="fa-solid fa-briefcase"></i> Internship Details
        </h4>

        <p><i class="fa-solid fa-heading text-secondary"></i>
           <b>Title:</b> <?= $intern['title'] ?></p>

        <p><i class="fa-solid fa-building text-secondary"></i>
           <b>Company:</b> <?= $intern['company'] ?></p>

        <p><i class="fa-solid fa-location-dot text-danger"></i>
           <b>Location:</b> <?= $intern['location'] ?></p>

        <p class="mt-3">
           <b>Description:</b><br>
           <span class="text-muted">
               <?= nl2br($intern['description']) ?>
           </span>
        </p>
    </div>

    <!-- Resume Upload Card -->
    <div class="card p-4 border-0 shadow">

        <h5 class="mb-3 text-success">
            <i class="fa-solid fa-file-arrow-up"></i> Upload Resume (PDF only)
        </h5>

        <?php if(mysqli_num_rows($already) > 0){ ?>
            <button class="btn btn-secondary w-100" disabled>
                Already Applied
            </button>
        <?php } else { ?>
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="resume" 
                       class="form-control mb-3" required>

                <button name="apply" 
                        class="btn btn-success w-100"
                        onclick="return confirm('Do you want to submit this application?')">
                    <i class="fa-solid fa-paper-plane"></i> Submit Application
                </button>
            </form>
        <?php } ?>

    </div>

</div>

</body>
</html>