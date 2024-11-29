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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['productname'];
    $productDescription = $_POST['productdescription'];
    $productPrice = $_POST['productprice'];
    $productImage = $_FILES['productimage']['name'];

    // مسیر ذخیره‌سازی تصویر
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["productimage"]["name"]);

    if (move_uploaded_file($_FILES["productimage"]["tmp_name"], $targetFile)) {
        // آماده‌سازی و اجرای کوئری SQL
        $stmt = $conn->prepare("INSERT INTO products (productname, productdescription, productprice, productimage) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            $_SESSION['message'] = "خطا در آماده‌سازی کوئری: " . $conn->error;
            header("Location: product.php");
            exit();
        }

        $stmt->bind_param("ssds", $productName, $productDescription, $productPrice, $productImage);

        if ($stmt->execute()) {
            $_SESSION['message'] = "محصول با موفقیت ثبت شد.";
        } else {
            $_SESSION['message'] = "خطا در ثبت محصول: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "خطا در آپلود تصویر.";
    }

    header("Location: product.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>مدیریت محصولات</title>
</head>

<body>
    <h1>مدیریت محصولات</h1>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']);
    }
    ?>
    <form method="post" enctype="multipart/form-data">
        نام محصول: <input type="text" name="productname" required><br>
        توضیحات محصول: <textarea name="productdescription" required></textarea><br>
        قیمت محصول: <input type="number" step="0.01" name="productprice" required><br>
        تصویر محصول: <input type="file" name="productimage" accept="image/*" required><br>
        <input type="submit" value="افزودن محصول">
    </form>
    <br>
    <a href="view-products.php">نمایش محصولات</a>
</body>

</html>