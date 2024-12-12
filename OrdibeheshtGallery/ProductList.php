<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== true) {
    header("Location:login.php");
    exit();
}

// اتصال به دیتابیس
$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

// بررسی ورود ادمین
if (!isset($_SESSION['user']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
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
        <div class="dashboard">
            <?php include('adminPanel.php') ?>
        </div>

        <div class="content">
            <table class="product-table">
                <tr>
                    <th>تصویر</th>
                    <th>نام محصول</th>
                    <th>جنس</th>
                    <th>سایز</th>
                    <th>رنگ</th>
                    <th>قد</th>
                    <th>تعداد</th>
                    <th>قیمت</th>
                    <th>عملیات</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='uploads/" . $row['productimage'] .  "' alt='Product Image' ></td>";
                        echo "<td><h3 class='product-name'>" . $row['productname'] . "</h3></td>";
                        echo "<td><p class='product-material'>" . $row['productmaterial'] . "</p></td>";
                        echo "<td><p class='product-size'>" . $row['productsize'] . "</p></td>";
                        echo "<td><p class='product-color'>" . $row['productcolor'] . "</p></td>";
                        echo "<td><p class='product-height'>" . $row['productheight'] . "</p></td>";
                        echo "<td><p class='product-stock'>" . $row['productstock'] . "</p></td>";
                        echo "<td><h2 class='product-price'>" . number_format($row['productprice']) . " تومان </h2></td>";
                        echo "<td>
                        <div>
                            <a href='edit-product.php?id=" . $row['id'] . "' class='btn-edit'>ویرایش</a>
                        </div>
                        <div>
                            <a href='delete-product.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"آیا مطمئنید؟\")'>حذف</a>
                        </div>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>هیچ محصولی یافت نشد</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <div class="header">
        <?php include('Footer.php') ?>
    </div>
</body>

</html>