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
    header("Location: ../login_register/login.php");
    exit();
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>admin-dashboard</title>
    <link rel="stylesheet" href="./admin-dashboard.css" />

</head>

<body>
    <div class="sidebar">
        <h3>داشبورد ادمین</h3>
        <a href="./Main-Page.php">صفحه اصلی</a>
        <a href="./product.php">افزودن محصول</a>
        <a href="./logout-validation.php">خروج</a>
    </div>
    <div class="content">
        <h1>مدیریت محصولات</h1>
        <table class="product-table">
            <tr>
                <th>تصویر</th>
                <th>نام محصول</th>
                <th>قیمت</th>
                <th>توضیحات</th>
                <th>عملیات</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img src='uploads/" . $row['productimage'] . "' alt='Product Image'></td>";
                    echo "<td>" . $row['productname'] . "</td>";
                    echo "<td>" . $row['productprice'] . "</td>";
                    echo "<td>" . $row['productdescription'] . "</td>";
                    echo "<td>
                            <a href='edit_product.php?id=" . $row['id'] . "' class='btn-edit'>ویرایش</a>
                            <a href='delete_product.php?id=" . $row['id'] . "' class='btn-delete' onclick='return confirm(\"آیا مطمئنید؟\")'>حذف</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>هیچ محصولی یافت نشد</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>

<?php
$conn->close();
?>