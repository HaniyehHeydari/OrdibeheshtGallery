<?php
session_start();

// اتصال به دیتابیس
$conn = new mysqli("localhost", "root", "", "ibolak");
if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

// دریافت اطلاعات سفارشات
$sql = "
    SELECT 
        final_orders.id AS order_id,
        users.fullname AS user_name,
        products.productname AS product_name,
        products.productimage AS product_image,
        final_orders.quantity AS quantity,
        final_orders.total_price AS total_price,
        final_orders.order_date AS order_date
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
    <title>لیست سفارشات</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border-radius: 16px;
            box-shadow: 0px 0px 20px 10px #ecebe9;
        }
        
        th,
        td {
            padding: 15px;
            text-align: center;
            border: 1px solid rgb(243, 237, 250);
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .image {
            border-radius: 8px;
            margin: 10px;
        }
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
            <h1>لیست سفارشات</h1>
            <table>
                <thead>
                    <tr>
                        <th>تصویر محصول</th>
                        <th>نام کاربر</th>
                        <th>نام محصول</th>
                        <th>شناسه سفارش</th>
                        <th>تعداد</th>
                        <th>قیمت کل</th>
                        <th>تاریخ سفارش</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <img class="image" src="uploads/<?php echo htmlspecialchars($row['product_image']); ?>" alt="تصویر محصول" width="100" height="100">
                                </td>
                                <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['order_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                                <td><?php echo number_format($row['total_price']); ?> تومان</td>
                                <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">هیچ سفارشی یافت نشد.</td>
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
