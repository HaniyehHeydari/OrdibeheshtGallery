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
    <main class="main-content">
        <section class="checkout-form">
            <h2>جزئیات پرداخت</h2>
            <form action="finalize-order.php" method="POST">
                <?php if (isset($_SESSION['success'])): ?>
                    <p style="color: green;"><?php echo $_SESSION['success'];
                                                unset($_SESSION['success']); ?></p>
                <?php endif; ?>
                <?php if (isset($_SESSION['error'])): ?>
                    <p style="color: red;"><?php echo $_SESSION['error'];
                                            unset($_SESSION['error']); ?></p>
                <?php endif; ?>

                <label for="firstname">نام *</label>
                <input type="text" id="firstname" name="firstname" required>

                <label for="lastname">نام خانوادگی *</label>
                <input type="text" id="lastname" name="lastname" required>

                <label for="companyname">نام شرکت (اختیاری)</label>
                <input type="text" id="companyname" name="companyname">

                <label for="country">کشور / منطقه *</label>
                <input type="text" id="country" name="country" value="ایران" required>

                <label for="address">آدرس خیابان *</label>
                <input type="text" id="address" name="address" required>

                <label for="apartment">آپارتمان، مجتمع واحد و... (اختیاری)</label>
                <input type="text" id="apartment" name="apartment">

                <label for="city">شهر *</label>
                <input type="text" id="city" name="city" required>

                <label for="state">استان *</label>
                <select id="state" name="state" required>
                    <option value="">انتخاب کنید</option>
                    <option value="تهران">تهران</option>
                    <option value="اصفهان">اصفهان</option>
                    <!-- استان‌های دیگر -->
                </select>

                <label for="postcode">کد پستی (اختیاری)</label>
                <input type="text" id="postcode" name="postcode">

                <button type="submit">پرداخت و ثبت نهایی سفارش</button>
            </form>
        </section>
    </main>
    <?php include('Footer.php'); ?>
</body>

</html>