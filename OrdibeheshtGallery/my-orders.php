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

// گرفتن سفارش‌های کاربر از جدول final_orders
$sql = "SELECT final_orders.id AS order_id, products.productname, products.productimage, final_orders.quantity, 
        final_orders.total_price, final_orders.order_date, final_orders.status AS order_status
        FROM final_orders 
        INNER JOIN products ON final_orders.product_id = products.id 
        WHERE final_orders.user_id = ?
        ORDER BY final_orders.order_date DESC";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("خطا در آماده‌سازی کوئری: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سفارش‌های من</title>
    <link rel="stylesheet" href="./orders.css">
</head>

<body dir="rtl">
    <?php include('Header.php'); ?>

    <div class="main">
        <?php include('userdashboard.php') ?>
        <div class="content">
            <?php if ($result->num_rows > 0): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>تصویر</th>
                            <th>نام محصول</th>
                            <th>تعداد</th>
                            <th>قیمت کل</th>
                            <th>تاریخ سفارش</th>
                            <th>وضعیت</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($order = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <img src="uploads/<?php echo $order['productimage']; ?>"
                                        alt="<?php echo htmlspecialchars($order['productname']); ?>"
                                        width="150" height="185"
                                        style="border-radius: 16px;">
                                </td>
                                <td><?php echo htmlspecialchars($order['productname']); ?></td>
                                <td><?php echo $order['quantity']; ?></td>
                                <td style="color: red;"><?php echo number_format($order['total_price']); ?> تومان</td>
                                <td><?php echo $order['order_date']; ?></td>
                                <td style="color: green;"><?php echo htmlspecialchars($order['order_status']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>شما تاکنون سفارشی ثبت نکرده‌اید.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include('Footer.php'); ?>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>