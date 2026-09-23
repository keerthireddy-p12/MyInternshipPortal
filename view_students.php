<?php
include 'db.php';
include 'header.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

/* Submit to Company Action */
if(isset($_GET['submit'])){
    $id = $_GET['submit'];
    mysqli_query($conn, "UPDATE applications SET submit_status='Submitted' WHERE id=$id");
}
?>

<div class="container mt-4">

    <h3 class="mb-4 text-primary">Students Management</h3>

    <!-- 1. Registered Students -->
    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white">
            Registered Students
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Name</th><th>Email</th>
                    <th>Year</th><th>Branch</th><th>CGPA</th>
                </tr>

                <?php
                $res = mysqli_query($conn, "SELECT * FROM students");
                while($row=mysqli_fetch_assoc($res)){
                ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['year'] ?></td>
                    <td><?= $row['branch'] ?></td>
                    <td><?= $row['cgpa'] ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <!-- 2. Shortlisted Students -->
    <div class="card shadow">
        <div class="card-header bg-warning">
            Shortlisted Students — Submit to Company
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Student</th><th>Email</th>
                    <th>Internship</th><th>Company</th>
                    <th>Resume</th><th>Action</th>
                </tr>

                <?php
                $sql = "SELECT a.id, s.name, s.email,
                               i.title, i.company,
                               a.resume, a.submit_status
                        FROM applications a
                        JOIN students s ON a.student_id=s.id
                        JOIN internships i ON a.internship_id=i.id
                        WHERE a.status='Shortlisted'";

                $res = mysqli_query($conn, $sql);

                while($row=mysqli_fetch_assoc($res)){
                ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['company'] ?></td>
                    <td>
                        <a href="resumes/<?= $row['resume'] ?>" target="_blank">
                            View Resume
                        </a>
                    </td>
                    <td>
                        <?php if($row['submit_status']=='Pending'){ ?>
                            <a href="?submit=<?= $row['id'] ?>" 
                               class="btn btn-primary btn-sm">
                               Submit to Company
                            </a>
                        <?php } else { ?>
                            <span class="badge bg-success">Submitted</span>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</div>

</body>
</html>