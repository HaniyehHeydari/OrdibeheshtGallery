<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== true) {
    header("Location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditPassword</title>
    <link rel="stylesheet" href="./editepassword.css" />
</head>

<body dir="ltr">
    <div class="header">
        <?php include('Header.php') ?>
    </div>

    <div class="main">
        <div class="sidebar">
            <div class="user">
                <img src="./img/user.jpg">
                <?php
                if (isset($_SESSION['user']) && $_SESSION['user'] === true) {
                ?>

                    <span><?php echo $_SESSION['fullname']; ?></span>
                <?php } ?>
            </div>
            <a href="./product.php">
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
        <div class="content">
            <form action="editepassword-validation" method="post" class="passwordForm">
                <div class="form-group">
                    <label for="currentPassword">کلمه عبور فعلی:</label><br>
                    <input type="password" id="currentPassword" name="currentPassword" required>
                    <span id="currentError" class="error">
                        <!-- <?php echo htmlspecialchars($currentError); ?> -->
                    </span>
                </div>
                <div class="form-group">
                    <label for="newPassword">کلمه عبور جدید:</label><br>
                    <input type="password" id="newPassword" name="newPassword" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">تکرار کلمه عبور:</label><br>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                    <span id="confirmError" class="error">
                        <!-- <?php echo htmlspecialchars($confirmError); ?> -->
                    </span>
                </div>
                
                    <button type="submit" class="btn btn-green">ثبت</button>
                    <button type="button" class="btn btn-orange" onclick="window.location.href='/dashboard';">انصراف</button>
             
            </form>
        </div>
    </div>

    <div class="header">
        <?php include('Footer.php') ?>
    </div>
</body>

</html>