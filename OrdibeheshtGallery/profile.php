<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== true) {
    header("Location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./profile.css" />
    <title>profile</title>
</head>

<body dir="ltr">
    <div class="header">
        <?php include('Header.php') ?>
    </div>

    <div class="main">
        <?php include('userdashboard.php') ?>
        <div class="content">

        </div>
    </div>

    <div class="header">
        <?php include('Footer.php') ?>
    </div>
</body>

</html>