<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

if (!isset($_SESSION['user']) || $_SESSION['user'] !== true) {
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
    <title>نمایش محصولات</title>
</head>

<body>
<div class="Container-tree" style="
  background-color: #333;
  color: #fff;
  padding: 10px 0;">
        <div class="header-container">
            <nav style="  display: flex;
  justify-content: center;
  gap: 20px;">
                <a href="./ibolak.php" style="  color: #fff;
  text-decoration: none;
  padding: 10px;">صفحه اصلی</a>
                <a href="../login register/./view-products.php" style="  color: #fff;
  text-decoration: none;
  padding: 10px;">مدیریت محصولات</a>
                <a href="../login register/./logout-validation.php" style="  color: #fff;
  text-decoration: none;
  padding: 10px;">خروج از سایت</a>
                  <a href="about.php" style="  color: #fff;
  text-decoration: none;
  padding: 10px;">درباره ما</a>
                <a href="contact.php" style="  color: #fff;
  text-decoration: none;
  padding: 10px;">ارتباط با ما</a>
            </nav>
        </div>
    </div>
  </header>

    <h1>محصولات</h1>
    <table border="1">
        <tr>
            <th>تصویر</th>
            <th>نام</th>
            <th>قیمت</th>
            <th>توضیحات</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><img src='uploads/" . $row['productimage'] . "' width='100'></td>";
                echo "<td>" . $row['productname'] . "</td>";
                echo "<td>" . $row['productprice'] . "</td>";
                echo "<td>" . $row['productdescription'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>هیچ محصولی یافت نشد</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="product.php">افزودن محصول جدید</a>
</body>

</html>

<?php
$conn->close();
?>