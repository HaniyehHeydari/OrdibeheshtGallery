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
        cart.id AS cart_id,
        users.fullname AS user_name,
        products.productname AS product_name,
        products.productimage AS product_image, -- اضافه کردن ستون تصویر
        cart.quantity AS quantity
    FROM 
        cart
    JOIN 
        users ON cart.user_id = users.id
    JOIN 
        products ON cart.product_id = products.id
    ORDER BY cart.id DESC
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
        tr {
            padding: 20px;
            text-align: center;

        }
        tr{
            padding: 20px;
            border: 1px solid rgb(243, 237, 250);
        }

        .image {
            border-radius: 8px;
            margin: 20px;
        }
    </style>
</head>

<body dir="ltr">
    <div class="header">
        <?php include('Header.php') ?>
    </div>

    <div class="main">
        <div class="dashboard">
            <?php include('adminPanel.php') ?>
        </div>

        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>تصویر محصول</th>
                        <th>نام کاربر</th>
                        <th>نام محصول</th>
                        <th>شناسه سفارش</th>
                        <th>تعداد</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <img class="image" src="uploads/<?php echo htmlspecialchars($row['product_image']); ?>" alt="تصویر محصول" width="150" height="150">
                                </td>
                                <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['cart_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">هیچ سفارشی یافت نشد.</td>
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