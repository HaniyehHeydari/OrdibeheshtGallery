<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== true || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

// گرفتن شناسه محصول از URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // ابتدا باید بررسی کنیم که محصول موجود است یا نه
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // حذف محصول
        $delete_sql = "DELETE FROM products WHERE id = $product_id";
        if ($conn->query($delete_sql) === TRUE) {
            // در صورت حذف موفقیت‌آمیز، به صفحه مدیریت محصولات برمی‌گردیم
            echo "محصول با موفقیت حذف شد.";
            header("Location: ProductList.php");
        } else {
            echo "خطا در حذف محصول: " . $conn->error;
        }
    } else {
        echo "محصولی با این شناسه یافت نشد.";
    }
} else {
    echo "شناسه محصول مشخص نشده است.";
}

$conn->close();
