<?php
include 'db.php';
include 'header.php';

if(!isset($_SESSION['student_email'])){
    header("Location: login.php");
    exit();
}

$email = $_SESSION['student_email'];
$stu   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE email='$email'"));
$student_id = $stu['id'];
?>

<div class="container page-container">

    <!-- Welcome Card -->
    <div class="card p-4 mb-4 border-0">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="fw-bold mb-1">Welcome, <?= $stu['name']; ?> 👋</h4>
                <small class="text-muted">
                    <?= $stu['year']; ?> Year | <?= $stu['branch']; ?> | CGPA: <?= $stu['cgpa']; ?>
                </small>
            </div>
            <div>
                <a href="my_applications.php" class="btn btn-outline-dark btn-sm me-2">
                    <i class="fa fa-file"></i> My Applications
                </a>
                <a href="student_profile.php" class="btn btn-outline-primary btn-sm">
                    <i class="fa fa-user"></i> Profile
                </a>
            </div>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="card p-4 mb-4 border-0 shadow-sm">
        <h5 class="text-primary mb-3">
            <i class="fa-solid fa-filter"></i> Search Internships
        </h5>

        <form method="GET">
            <div class="row g-3">

                <div class="col-md-3">
                    <input type="text" name="search" class="form-control"
                        placeholder="Internship or Company"
                        value="<?= $_GET['search'] ?? '' ?>">
                </div>

                <div class="col-md-2">
                    <input type="text" name="location" class="form-control"
                        placeholder="Location"
                        value="<?= $_GET['location'] ?? '' ?>">
                </div>

                <div class="col-md-2">
                    <select name="stipend" class="form-select">
                        <option value="">Stipend</option>
                        <option value="Yes" <?= (($_GET['stipend'] ?? '')=='Yes')?'selected':'' ?>>Yes</option>
                        <option value="No" <?= (($_GET['stipend'] ?? '')=='No')?'selected':'' ?>>No</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="domain" class="form-select">
                        <option value="">Domain</option>
                        <option>Web Development</option>
                        <option>Data Science</option>
                        <option>Artificial Intelligence</option>
                        <option>Java Development</option>
                        <option>General</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="mode" class="form-select">
                        <option value="">Mode</option>
                        <option>Online</option>
                        <option>Offline</option>
                    </select>
                </div>

                <div class="col-md-1 d-grid">
                    <button class="btn btn-primary">
                        <i class="fa fa-search"></i>
                    </button>
                </div>

            </div>
        </form>
    </div>

    <h4 class="mb-3 fw-bold">Available Internships</h4>

<?php
$query = "SELECT * FROM internships WHERE status='Approved'";

if(!empty($_GET['search'])){
    $s = mysqli_real_escape_string($conn, $_GET['search']);
    $query .= " AND (title LIKE '%$s%' OR company LIKE '%$s%')";
}

if(!empty($_GET['location'])){
    $l = mysqli_real_escape_string($conn, $_GET['location']);
    $query .= " AND location LIKE '%$l%'";
}

if(!empty($_GET['stipend'])){
    $stipend = mysqli_real_escape_string($conn, $_GET['stipend']);
    $query .= " AND stipend='$stipend'";
}

if(!empty($_GET['domain'])){
    $domain = mysqli_real_escape_string($conn, $_GET['domain']);
    $query .= " AND domain='$domain'";
}

if(!empty($_GET['mode'])){
    $mode = mysqli_real_escape_string($conn, $_GET['mode']);
    $query .= " AND mode='$mode'";
}

$res = mysqli_query($conn, $query);

if(mysqli_num_rows($res) == 0){
    echo "<div class='alert alert-info'>No internships available now.</div>";
} else {
?>

<div class="row">
<?php while($row = mysqli_fetch_assoc($res)){ ?>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 border-0 shadow-sm internship-card">
            <div class="card-body d-flex flex-column">

                <h5 class="fw-bold text-primary"><?= $row['title'] ?></h5>

                <p class="text-muted small">
                    <?= substr($row['description'],0,110) ?>...
                </p>

                <p class="mb-1"><i class="fa fa-building"></i> <?= $row['company'] ?></p>
                <p class="mb-2"><i class="fa fa-location-dot"></i> <?= $row['location'] ?></p>

                <div class="mb-3">
                    
                    <span class="badge bg-info text-dark"><?= $row['domain'] ?></span>
                    <span class="badge bg-warning text-dark"><?= $row['mode'] ?></span>
                </div>

                <div class="mt-auto">
                <?php
                $chk = mysqli_query($conn,
                    "SELECT * FROM applications 
                     WHERE student_id='$student_id' 
                     AND internship_id='".$row['id']."'"
                );

                if(mysqli_num_rows($chk)>0){
                    echo "<button class='btn btn-secondary w-100' disabled>Already Applied</button>";
                } else {
                    echo "<a href='apply.php?id=".$row['id']."' class='btn btn-primary w-100'>Apply Now</a>";
                }
                ?>
                </div>

            </div>
        </div>
    </div>

<?php } ?>
</div>

<?php } ?>

</div>

<style>
.internship-card:hover{
    transform: translateY(-6px);
    transition: 0.3s;
}
</style>