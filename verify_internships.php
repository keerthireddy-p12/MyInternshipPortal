
<?php
include 'db.php';
include 'header.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

// Approve action (ONLY ONCE)
if(isset($_GET['approve'])){
    $id = $_GET['approve'];
    mysqli_query($conn, "UPDATE internships SET status='Approved' WHERE id=$id");
}

// Fetch from API when button clicked
if(isset($_POST['fetch_api'])){
    include 'fetch_api_internships.php';
}


?>



<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<br><br>
<h3 class="mb-4">Admin Dashboard — Verify Internships</h3>
<br>
<form method="post" class="mb-3">
    <button name="fetch_api" class="btn btn-primary">
        🔄 Load New Internships from API
    </button>
</form>
<br>
<hr>
<div class="row">
    
    <!-- LEFT SIDE — Pending -->
    <div class="col-md-6">
        <h4 class="text-danger">Pending Internships</h4>
        <hr>

        <?php
        $pending = mysqli_query($conn, "SELECT * FROM internships WHERE status='Pending'");

        if(mysqli_num_rows($pending)==0){
            echo "<p>No pending internships.</p>";
        }

        while($row = mysqli_fetch_assoc($pending)){
    echo "<div class='card p-3 mb-3 border-danger'>";

    echo "<h5>".$row['title']."</h5>";

    echo "<p><b>Company:</b> ".$row['company']."</p>";
    echo "<p><b>Location:</b> ".$row['location']."</p>";

    echo "<p><b>Domain:</b> ".$row['domain']."</p>";
    echo "<p><b>Mode:</b> ".$row['mode']."</p>";
    

    echo "<p><b>Description:</b> ".substr($row['description'], 0, 250)."...</p>";

    echo "<p><a href='".$row['apply_link']."' target='_blank' class='btn btn-outline-primary btn-sm'>
            🔗 Official Apply Link
          </a></p>";

    echo "<a href='?approve=".$row['id']."' class='btn btn-success'>Approve</a>";

    echo "</div>";
}
        ?>
    </div>
    
    <!-- RIGHT SIDE — Approved -->
    <div class="col-md-6">
        <h4 class="text-success">Approved Internships</h4>
        <hr>

        <?php
        $approved = mysqli_query($conn, "SELECT * FROM internships WHERE status='Approved'");

        if(mysqli_num_rows($approved)==0){
            echo "<p>No approved internships.</p>";
        }

        while($row = mysqli_fetch_assoc($approved)){
            while($row = mysqli_fetch_assoc($approved)){
    echo "<div class='card p-3 mb-3 border-success'>";

    echo "<h5>".$row['title']."</h5>";

    echo "<p><b>Company:</b> ".$row['company']."</p>";
    echo "<p><b>Location:</b> ".$row['location']."</p>";

    echo "<p><b>Domain:</b> ".$row['domain']."</p>";
    echo "<p><b>Mode:</b> ".$row['mode']."</p>";
    

    echo "<p><b>Description:</b> ".substr($row['description'], 0, 250)."...</p>";

    echo "<p><a href='".$row['apply_link']."' target='_blank' class='btn btn-outline-primary btn-sm'>
            🔗 Official Apply Link
          </a></p>";

    echo "<button class='btn btn-secondary' disabled>Approved</button>";

    echo "</div>";
}
        }
        ?>
    </div>

</div>

</body>
</html>