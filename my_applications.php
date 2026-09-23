<?php 
include 'header.php'; 
include 'db.php';

if(!isset($_SESSION['student_email'])){
    header("Location: login.php");
    exit();
}

$email = $_SESSION['student_email'];
$stu = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM students WHERE email='$email'"));
$student_id = $stu['id'];

$sql = "SELECT i.title, i.company, i.location,
               a.resume, a.status
        FROM applications a
        JOIN internships i ON a.internship_id = i.id
        WHERE a.student_id = '$student_id'
        ORDER BY a.id DESC";

$res = mysqli_query($conn, $sql);
?>

<div class="container page-container">

    <div class="card p-4 border-0 shadow-lg">

        <h3 class="mb-4 text-primary">
            <i class="fa-solid fa-briefcase"></i> My Applications
        </h3>

        <?php if(mysqli_num_rows($res) == 0){ ?>
            <div class="alert alert-info text-center">
                <i class="fa-solid fa-circle-info"></i>
                You have not applied to any internships yet.
            </div>
        <?php } else { ?>

        <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Internship</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Resume</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

            <?php while($row=mysqli_fetch_assoc($res)){ ?>
            <tr>
                <td class="fw-semibold"><?= $row['title'] ?></td>
                <td><?= $row['company'] ?></td>
                <td>
                    <i class="fa-solid fa-location-dot text-danger"></i>
                    <?= $row['location'] ?>
                </td>
                <td>
                    <a href="resumes/<?= $row['resume'] ?>" 
                       target="_blank"
                       class="btn btn-sm btn-outline-primary">
                       <i class="fa-solid fa-file-lines"></i> View
                    </a>
                </td>
                <td>
                    <?php
                        if($row['status'] == 'Pending'){
                            echo "<span class='badge bg-warning text-dark px-3 py-2'>Pending</span>";
                        }
                        elseif($row['status'] == 'Shortlisted'){
                            echo "<span class='badge bg-success px-3 py-2'>Shortlisted</span>";
                        }
                        else{
                            echo "<span class='badge bg-danger px-3 py-2'>Rejected</span>";
                        }
                    ?>
                </td>
            </tr>
            <?php } ?>

            </tbody>
        </table>
        </div>

        <?php } ?>

    </div>

</div>

</body>
</html>