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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // دریافت اطلاعات فرم
    $firstname = $conn->real_escape_string(trim($_POST['firstname']));
    $lastname = $conn->real_escape_string(trim($_POST['lastname']));
    $companyname = $conn->real_escape_string(trim($_POST['companyname']));
    $country = $conn->real_escape_string(trim($_POST['country']));
    $address = $conn->real_escape_string(trim($_POST['address']));
    $apartment = $conn->real_escape_string(trim($_POST['apartment']));
    $city = $conn->real_escape_string(trim($_POST['city']));
    $state = $conn->real_escape_string(trim($_POST['state']));
    $postcode = $conn->real_escape_string(trim($_POST['postcode']));

    // ذخیره‌سازی اطلاعات پرداخت در دیتابیس
    $query = "INSERT INTO payments (user_id, firstname, lastname, companyname, country, address, apartment, city, state, postcode)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssssssss", $user_id, $firstname, $lastname, $companyname, $country, $address, $apartment, $city, $state, $postcode);
    $stmt->execute();

    // انتقال سفارش‌ها به جدول نهایی (final_orders)
    $sql = "INSERT INTO final_orders (user_id, product_id, quantity, total_price, order_date, status)
            SELECT cart.user_id, cart.product_id, cart.quantity, (products.productprice * cart.quantity) AS total_price, NOW(), 'در حال پردازش'
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

    $_SESSION['success'] = "سفارش شما با موفقیت ثبت شد!";
    header("Location: order-confirmation.php");
    exit();
} else {
    $_SESSION['error'] = "درخواست نامعتبر.";
    header("Location: checkout.php");
    exit();
}
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
            <?php if (isset($_SESSION['success'])): ?>
                <h2><?php echo $_SESSION['success'];
                    unset($_SESSION['success']); ?></h2>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <p style="color: red;"><?php echo $_SESSION['error'];
                                        unset($_SESSION['error']); ?></p>
            <?php endif; ?>
            <p>از خرید شما سپاسگزاریم. می‌توانید سفارشات خود را در بخش "سفارش‌های من" مشاهده کنید.</p>
            <a href="./my-orders.php"><button>سفارش های من</button></a>
        </section>
    </main>

    <?php include('Footer.php'); ?>
</body>

</html>