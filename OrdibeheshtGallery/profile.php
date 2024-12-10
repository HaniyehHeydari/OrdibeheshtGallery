<?php
$conn = new mysqli("localhost", "root", "", "ibolak");
if ($conn->connect_error) {
    die("اتصال برقرار نشد");
}
$conn->query("SET NAMES utf8");

session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== true) {
    header("Location:login.php");
    exit();
}

// دریافت نام کاربری یا ID از session
$username = $_SESSION['fullname']; // فرض می‌کنیم نام کاربری در session ذخیره شده باشد

// گرفتن اطلاعات کاربر از دیتابیس
$sql = "SELECT * FROM users WHERE fullname = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

if (!$userData) {
    echo "اطلاعات کاربر یافت نشد.";
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
            <form class="profileForm">
                <h2>اطلاعات پروفایل</h2>
                <p><strong>نام کامل:</strong> <?php echo htmlspecialchars($userData['fullname']); ?></p>
                <p><strong>جنسیت:</strong> <?php echo htmlspecialchars($userData['gender']); ?></p>
                <p><strong>ایمیل:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>
                <p><strong>آدرس:</strong> <?php echo htmlspecialchars($userData['addres']); ?></p>
                <p><strong>مدرک تحصیلی:</strong> <?php echo htmlspecialchars($userData['education']); ?></p>
            </form>
        </div>
    </div>

    <div class="header">
        <?php include('Footer.php') ?>
    </div>
</body>

</html>