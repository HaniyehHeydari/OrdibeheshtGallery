<?php
session_start();

// اتصال به دیتابیس
$conn = new mysqli("localhost", "root", "", "ibolak");
if ($conn->connect_error) {
    die("اتصال به پایگاه داده برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

if (!isset($_SESSION['user']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

// بررسی ارسال درخواست با متد POST

// دریافت داده‌ها از فرم
$errors = [];
$productName = '';
$productDescription = '';
$productPrice = '';
$productImage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = isset($_POST['product_name']) ? $_POST['product_name'] : '';
    $productDescription = isset($_POST['product_description']) ? $_POST['product_description'] : '';
    $productPrice = isset($_POST['product_price']) ? $_POST['product_price'] : '';
    $productImage = isset($_POST['product_image']) ? $_POST['product_image'] : '';

    // متغیر برای ذخیره پیام‌های خطا

    // اعتبارسنجی نام محصول
    if (empty($productName)) {
        $errors['product_name'] = "نام محصول نمی‌تواند خالی باشد.";
    } elseif (strlen($productName) < 3) {
        $errors['product_name'] = "نام محصول باید حداقل 3 کاراکتر باشد.";
    }

    // اعتبارسنجی توضیحات محصول
    if (empty($productDescription)) {
        $errors['product_description'] = "توضیحات محصول نمی‌تواند خالی باشد.";
    }

    // اعتبارسنجی قیمت محصول
    if (empty($productPrice)) {
        $errors['product_price'] = "قیمت محصول نمی‌تواند خالی باشد.";
    } elseif (!is_numeric($productPrice)) {
        $errors['product_price'] = "قیمت باید عدد باشد.";
    } elseif ($productPrice <= 0) {
        $errors['product_price'] = "قیمت محصول باید بیشتر از صفر باشد.";
    }

    // اعتبارسنجی تصویر محصول
    if (empty($productImage['name'])) {
        $errors['product_image'] = "تصویر محصول نمی‌تواند خالی باشد.";
    } else {
        // بررسی فرمت تصویر
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($productImage['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $errors['product_image'] = "فرمت تصویر مجاز نیست. فقط فرمت‌های jpg, jpeg, png, gif قابل قبول است.";
        }

        // بررسی حجم تصویر (حداکثر 2 مگابایت)
        if ($productImage['size'] > 2 * 1024 * 1024) {
            $errors['product_image'] = "حجم تصویر باید کمتر از 2 مگابایت باشد.";
        }
    }

    // اگر خطاها وجود داشته باشد، پیام‌ها را نمایش بده
    if (!empty($errors)) {
        $_SESSION['message'] = implode("<br>", $errors);
        header("Location: product.php");
        exit();
    }

    // اگر هیچ خطایی نباشد، فایل را آپلود کرده و داده‌ها را در دیتابیس ذخیره کنیم
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($productImage["name"]);

    if (move_uploaded_file($productImage["tmp_name"], $targetFile)) {

        // آماده‌سازی و اجرای کوئری SQL
        $stmt = $conn->prepare("INSERT INTO products (productname, productdescription, productprice, productimage) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            $_SESSION['message'] = "خطا در آماده‌سازی کوئری: " . $conn->error;
            header("Location: product.php");
            exit();
        }

        $stmt->bind_param("ssds", $productName, $productDescription, $productPrice, $productImage['name']);

        if ($stmt->execute()) {
            $_SESSION['message'] = "محصول با موفقیت ثبت شد.";
        } else {
            $_SESSION['message'] = "خطا در ثبت محصول: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "خطا در آپلود تصویر.";
    }

    // هدایت به صفحه مدیریت محصولات
    header("Location: admindashboard.php");
    exit();
}

$conn->close();
