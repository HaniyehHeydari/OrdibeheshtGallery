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

// کوئری برای دریافت داده‌ها از جدول محصولات و سبد خرید
$sql = "SELECT *, (products.productprice * cart.quantity) AS total_price
        FROM products 
        INNER JOIN cart ON products.id = cart.product_id 
        WHERE cart.user_id = ?";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("خطا در آماده‌سازی کوئری: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// محاسبه مجموع کل
$totalAmount = 0;
while ($row = $result->fetch_assoc()) {
    $totalAmount += $row['total_price'];
}
// بازگرداندن مجدد نتیجه برای نمایش در جدول
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سبد خرید</title>
    <link rel="stylesheet" href="./carts.css">
</head>

<body dir="rtl">
    <div class="header">
        <?php include('Header.php'); ?>
    </div>

    <div class="main">
        <?php include('userdashboard.php'); ?>

        <main class="main-content">
            <section class="basket_table">
                <?php if ($result->num_rows > 0): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>تصویر</th>
                                <th>محصول</th>
                                <th>قیمت</th>
                                <th>تعداد</th>
                                <th>جمع کل</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($userP = $result->fetch_assoc()): ?>
                                <tr>
                                    <td> <img style="border-radius: 16px;" width="150px" ; height="150px" ; src="uploads/<?php echo $userP['productimage']; ?>" alt="<?php echo htmlspecialchars($userP['productname']); ?>" class="product-details-imagee"></td>
                                    <td><?php echo htmlspecialchars($userP['productname']); ?></td>
                                    <td><?php echo number_format($userP['productprice']); ?> تومان</td>
                                    <td><?php echo $userP['quantity']; ?></td>
                                    <td><?php echo number_format($userP['productprice'] * $userP['quantity']); ?> تومان</td>
                                    <td>
                                        <form action="./remove-from-cart.php" method="POST">
                                            <input type="hidden" name="cart_id" value="<?php echo $userP['id']; ?>">
                                            <button type="submit">
                                                <img width="30px" height="30px" src="./img/4.jpg">
                                                <a>حذف</a>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>سبد خرید شما خالی است.</p>
                <?php endif; ?>
            </section>
        </main>
    </div>
    
    <?php include('Footer.php'); ?>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>