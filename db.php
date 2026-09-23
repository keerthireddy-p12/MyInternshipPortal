<?php
$conn = mysqli_connect("localhost", "root", "", "MyInternshipPortal");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>