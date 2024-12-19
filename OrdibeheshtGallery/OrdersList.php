<?php
session_start();

// اتصال به دیتابیس
$conn = new mysqli("localhost", "root", "", "ibolak");
if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

// بروزرسانی وضعیت سفارش
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $sql_update = "UPDATE final_orders SET status = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("si", $status, $order_id);
    $stmt_update->execute();
    $stmt_update->close();
}

// دریافت اطلاعات سفارشات
$sql = "
    SELECT 
        final_orders.id AS order_id,
        users.fullname AS user_name,
        products.productname AS product_name,
        products.productimage AS product_image,
        final_orders.quantity AS quantity,
        final_orders.total_price AS total_price,
        final_orders.order_date AS order_date,
        final_orders.status AS order_status
    FROM 
        final_orders
    JOIN 
        users ON final_orders.user_id = users.id
    JOIN 
        products ON final_orders.product_id = products.id
    ORDER BY final_orders.order_date DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./OrdersListt.css">
    <title>لیست سفارشات</title>
    <style>
        /* Styles remain unchanged */
    </style>
</head>

<body dir="rtl" style="overflow-x: hidden;">
    <div class="header">
        <?php include('Header.php') ?>
    </div>

    <div class="main">
        <div class="dashboard">
            <?php include('adminPanel.php') ?>
        </div>

        <div class="content">
            <table class="table">
                <thead>
                    <tr>
                        <th>تصویر </th>
                        <th>نام کاربر</th>
                        <th>نام سفارش</th>
                        <th>شناسه سفارش</th>
                        <th>تعداد</th>
                        <th>قیمت کل</th>
                        <th>تاریخ سفارش</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <img style="width: 150px; height: 185px; border-radius: 16px;" class="image" src="uploads/<?php echo htmlspecialchars($row['product_image']); ?>" alt="تصویر محصول" width="100" height="100">
                                </td>
                                <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                                <td style="color: red;"><?php echo number_format($row['total_price']); ?> تومان</td>
                                <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                                <td style="color: green;"><?php echo htmlspecialchars($row['order_status']); ?></td>
                                <td>
                                    <form method="post" action="">
                                        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                        <select name="status">
                                            <option value="در حال پردازش" <?php if ($row['order_status'] == 'در حال پردازش') echo 'selected'; ?>>در حال پردازش</option>
                                            <option value="در حال ارسال" <?php if ($row['order_status'] == 'در حال ارسال') echo 'selected'; ?>>در حال ارسال</option>
                                            <option value="عدم ارسال" <?php if ($row['order_status'] == 'عدم ارسال') echo 'selected'; ?>>عدم ارسال</option>
                                        </select>
                                        <button type="submit">به‌روزرسانی</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">هیچ سفارشی یافت نشد.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="header">
        <?php include('Footer.php') ?>
    </div>
</body>

</html>

<?php
$conn->close();
?>