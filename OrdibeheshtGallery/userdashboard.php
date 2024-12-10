<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./profile.css" />
</head>

<body>
    <div class="sidebar">
        <div class="user">
            <img src="./img/user.jpg">
            <?php
            if (isset($_SESSION['user']) && $_SESSION['user'] === true) {
            ?>

                <span><?php echo $_SESSION['fullname']; ?></span>
            <?php } ?>
        </div>
        <a href="./profile.php">
            <img src="./img/1.png" width="20px" height="20px" />
            <h3>صفحه نخست</h3>
        </a>
        <a href="#">
            <img src="./img/7.png" width="20px" height="20px" />
            <h3>سفارش ها</h3>
        </a>
        <a href="#">
            <img src="./img/8.png" width="20px" height="20px" />
            <h3>علاقه مندی ها</h3>
        </a>
        <a href="./editpassword.php">
            <img src="./img/6.jpg" width="30px" height="25px" />
            <h3>تغییر رمز عبور</h3>
        </a>
        <a href="./logout-validation.php">
            <img src="./img/3.png" width="20px" height="20px" />
            <h3>خروج</h3>
        </a>
    </div>
</body>

</html>