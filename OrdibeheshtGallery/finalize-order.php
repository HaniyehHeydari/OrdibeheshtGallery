<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

// بررسی لاگین بودن کاربر
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// انتقال سفارش‌ها به جدول نهایی (final_orders)
$sql = "INSERT INTO final_orders (user_id, product_id, quantity, total_price, order_date)
        SELECT user_id, product_id, quantity, (products.productprice * cart.quantity) AS total_price, NOW()
        FROM cart
        INNER JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

// حذف سفارش‌ها از جدول سبد خرید
$sql_delete = "DELETE FROM cart WHERE user_id = ?";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bind_param("i", $user_id);
$stmt_delete->execute();

// بستن اتصال
$stmt->close();
$stmt_delete->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأیید سفارش</title>
    <link rel="stylesheet" href="./carts.css">
</head>

<body dir="rtl">
    <?php include('Header.php'); ?>

    <main class="main-content">
        <section class="basket_table">
            <h2>سفارش شما با موفقیت ثبت شد!</h2>
            <p>از خرید شما سپاسگزاریم. می‌توانید سفارشات خود را در بخش "سفارش‌های من" مشاهده کنید.</p>
            <a href="./my-orders.php"><button>سفارش های من</button></a>
        </section>
    </main>

    <?php include('Footer.php'); ?>
</body>

</html>
