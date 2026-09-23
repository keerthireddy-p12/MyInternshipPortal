
<?php
include 'db.php';
include 'header.php';

if(isset($_GET['shortlist'])){
    $id = $_GET['shortlist'];
    mysqli_query($conn, "UPDATE applications SET status='Shortlisted' WHERE id=$id");
}

if(isset($_GET['reject'])){
    $id = $_GET['reject'];
    mysqli_query($conn, "UPDATE applications SET status='Rejected' WHERE id=$id");
}

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

$sql = "SELECT a.id, s.name, s.email,
               i.title, i.company,
               a.resume, a.status
        FROM applications a
        JOIN students s ON a.student_id = s.id
        JOIN internships i ON a.internship_id = i.id";


$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Applications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h3>Student Applications</h3>

    <table class="table table-hover table-bordered shadow">
        <tr>
            <th>Student</th><th>Email</th>
            <th>Internship</th><th>Company</th>
            <th>Resume</th>
            <th>Action</th>
        </tr>

        <?php while($row=mysqli_fetch_assoc($res)){ ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['company'] ?></td>
            <td>
                <a href="resumes/<?= $row['resume'] ?>" target="_blank">View Resume</a>
            </td>
            <td>
            <?php if($row['status']=='Pending' || $row['status']==''){ ?>
            
            <a href="?shortlist=<?= $row['id'] ?>" class="btn btn-success btn-sm">Shortlist</a>
            <a href="?reject=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Reject</a>
            <?php } else { ?>
            <span class="badge bg-secondary"><?= $row['status'] ?></span>
            <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>