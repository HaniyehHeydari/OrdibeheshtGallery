<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

if (!isset($_SESSION['user']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['product_price'];
    $productImage = $_FILES['product_image']['name'];

    // مسیر ذخیره‌سازی تصویر
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["product_image"]["name"]);

    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
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

    header("Location: admindashboard.php");
    exit();
}

$conn->close();
