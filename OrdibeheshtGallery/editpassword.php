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
    <link rel="stylesheet" href="./edite-password.css" />
</head>
<body dir="ltr">
    <div class="header">
        <?php include('Header.php'); ?>
    </div>

    <div class="main">
        <?php include('userdashboard.php'); ?>
        <div class="content">
            <form action="./editepassword-validation.php" method="post" class="passwordForm">
                <div class="form-group">
                    <label for="currentPassword">کلمه عبور فعلی:</label><br>
                    <input type="password" id="currentPassword" name="currentPassword" required>
                    <span id="currentError" class="error">
                        <?php echo isset($errors['currentPassword']) ? htmlspecialchars($errors['currentPassword']) : ''; ?>
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
                        <?php echo isset($errors['confirmPassword']) ? htmlspecialchars($errors['confirmPassword']) : ''; ?>
                    </span>
                </div>
                <button type="submit" class="btn btn-green">ثبت</button>
                <button type="button" class="btn btn-orange" onclick="window.location.href='/dashboard';">انصراف</button>
            </form>
        </div>
    </div>

    <div class="header">
        <?php include('Footer.php'); ?>
    </div>
</body>
</html>
