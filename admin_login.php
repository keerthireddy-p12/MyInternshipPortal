<?php

include 'header.php';

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if($user == "admin" && $pass == "admin123"){
        $_SESSION['admin'] = "yes";
        header("Location: admin_home.php");
        exit();
    } else {
        $error = "Invalid Admin Login!";
    }
}
?>

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="text-center mb-4">Admin Login</h3>

        <?php if(isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <form method="post">
            <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
            <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
            <button name="login" class="btn btn-danger w-100">Login</button>
        </form>
    </div>
</div>