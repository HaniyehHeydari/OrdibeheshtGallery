<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات پرداخت</title>
    <link rel="stylesheet" href="./checkout.css">
</head>

<body dir="rtl">
    <?php include('Header.php'); ?>
    <div class="main">

        <form action="finalize-order.php" method="POST" class="form">

            <div class="fulname">
                <div class="firstname">
                    <label for="firstname">نام</label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>

                <div class="lastname">
                    <label for="lastname">نام خانوادگی</label>
                    <input type="text" id="lastname" name="lastname" required>
                </div>
            </div>
            <div class="mobile">
                <label for="mobile">شماره تماس</label>
                <input type="number" id="mobile" name="mobile">
            </div>

            <div class="province">
                <label for="province">استان</label>
                <input type="text" id="province" name="province" required>
            </div>

            <div class="city">
                <label for="city">شهر</label>
                <input type="text" id="city" name="city" required>
            </div>

            <div class="address">
                <label for="address"> آدرس کامل </label>
                <input type="text" id="address" name="address" required>
            </div>

            <div class="postcode">
                <label for="postcode">کد پستی (اختیاری)</label>
                <input type="text" id="postcode" name="postcode">
            </div>

            <button type="submit" class="open">پرداخت و ثبت نهایی سفارش</button>
        </form>
    </div>
    <?php include('Footer.php'); ?>
</body>

</html>