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
        <?php
        // بررسی اینکه آیا کاربر ادمین است یا خیر
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin') {
        ?>
            <a href="./ProductList.php">
                <img src="./img/9.png" width="20px" height="20px" />
                <h3>پنل ادمین</h3>
            </a>
        <?php } ?>
        <a href="./my-orders.php">
            <img src="./img/7.png" width="20px" height="20px" />
            <h3>لیست سفارشات</h3>
        </a>
        <a href="./editpassword.php">
            <img src="./img/6.jpg" width="28px" height="26px" />
            <h3>تغییر رمز عبور</h3>
        </a>
        <a href="./logout-validation.php">
            <img src="./img/3.png" width="20px" height="20px" />
            <h3>خروج</h3>
        </a>
    </div>
</body>

</html>