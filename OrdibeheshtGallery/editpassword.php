<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "ibolak");
if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

$user_id = $_SESSION['user_id'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['currentPassword'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // دریافت رمز عبور فعلی از دیتابیس
    $sql = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($storedPassword);
    $stmt->fetch();
    $stmt->close();

    // بررسی رمز عبور فعلی
    if ($currentPassword !== $storedPassword) {
        $errors['currentPassword'] = "رمز عبور فعلی اشتباه است.";
    }

    // بررسی پیچیدگی رمز عبور جدید
    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $newPassword)) {
        $errors['newPassword'] = "لطفا یک رمز معتبر وارد کنید";
    }

    // بررسی تطابق رمز عبور جدید و تکرار آن
    if ($newPassword !== $confirmPassword) {
        $errors['confirmPassword'] = "رمز عبور جدید با تکرار آن مطابقت ندارد.";
    }

    // اگر خطایی وجود نداشت، رمز عبور را به‌روزرسانی کن
    if (empty($errors)) {
        $updateSql = "UPDATE users SET password = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("si", $newPassword, $user_id);

        if ($updateStmt->execute()) {
            $_SESSION['success_message'] = "رمز عبور با موفقیت تغییر یافت.";
            header("Location: ./profile.php");
            exit();
        } else {
            $errors['general'] = "خطایی در به‌روزرسانی رمز عبور رخ داده است.";
        }

        $updateStmt->close();
    }
}

$conn->close();
?>




<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditPassword</title>
    <link rel="stylesheet" href="./editepassword.css" />
</head>

<body dir="ltr" style=" overflow-x: hidden;">
    <div class="header">
        <?php include('Header.php'); ?>
    </div>

    <div class="main">
        <?php include('userdashboard.php'); ?>
        <div class="content">
            <form action="" method="post" class="passwordForm">
                <div class="form-group">
                    <label for="currentPassword">کلمه عبور فعلی:</label><br>
                    <input type="password" id="currentPassword" name="currentPassword" required><br>
                    <span id="currentError" class="error">
                        <?php echo isset($errors['currentPassword']) ? htmlspecialchars($errors['currentPassword']) : ''; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="newPassword">کلمه عبور جدید:</label><br>
                    <input type="password" id="newPassword" name="newPassword" required><br>
                    <span id="newPasswordError" class="error">
                        <?php echo isset($errors['newPassword']) ? htmlspecialchars($errors['newPassword']) : ''; ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="confirmPassword">تکرار کلمه عبور:</label><br>
                    <input type="password" id="confirmPassword" name="confirmPassword" required><br>
                    <span id="confirmError" class="error">
                        <?php echo isset($errors['confirmPassword']) ? htmlspecialchars($errors['confirmPassword']) : ''; ?>
                    </span>
                </div>
                <button type="submit" class="btn btn-green">ثبت</button>
                <button type="button" class="btn btn-orange" onclick="window.location.href='./profile.php';">انصراف</button>
            </form>
        </div>
        <div class="Conditions">
            <ul>:رمز عبور باید شامل موارد زیر باشد</ul>
            <li>شامل 8 کاراکتر</li>
            <li>استفاده از عدد</li>
            <li>استفاده از حروف بزرگ و کوچک</li>
            <li>استفاده از کاراکتر خاص مانند @ # $ % ! *</li>
        </div>
    </div>

    <div class="header">
        <?php include('Footer.php'); ?>
    </div>
</body>

</html>