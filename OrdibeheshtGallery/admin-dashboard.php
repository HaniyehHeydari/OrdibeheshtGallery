<?php
session_start();

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
    <title>داشبورد ادمین</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            margin: 0;
        }

        .sidebar {
            width: 200px;
            background-color: #f4f4f4;
            padding: 20px;
            height: 100vh;
        }

        .content {
            padding: 20px;
            flex-grow: 1;
        }

        .sidebar a {
            display: block;
            text-decoration: none;
            color: #333;
            margin: 10px 0;
            padding: 10px;
            background-color: #ddd;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #bbb;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-table th,
        .product-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .product-table img {
            width: 100px;
        }

        .btn-edit,
        .btn-delete {
            background-color: #f4f4f4;
            padding: 5px 10px;
            margin: 5px;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #ff9800;
        }

        .btn-delete {
            background-color: #f44336;
        }
    </style>
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