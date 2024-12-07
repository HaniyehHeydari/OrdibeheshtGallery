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

$errors = [];
$productName = $productDescription = $productMaterial = $productSize = $productColor = $productHeight = $productStock =  $productPrice = $productImage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = trim($_POST['product_name']);
    $productDescription = trim($_POST['product_description']);
    $productMaterial = trim($_POST['product_material']);
    $productSize = trim($_POST['product_size']);
    $productColor = trim($_POST['product_color']);
    $productHeight = trim($_POST['product_height']);
    $productStock = trim($_POST['product_stock']);
    $productPrice = trim($_POST['product_price']);
    $productImage = $_FILES['product_image']['name'];

    // اعتبارسنجی نام محصول
    if (empty($productName)) {
        $errors['product_name'] = "لطفا نام محصول را وارد کنید";
    }

    // اعتبارسنجی توضیحات محصول
    if (empty($productDescription)) {
        $errors['product_description'] = "لطفا توضیحات محصول را وارد کنید";
    }

    // اعتبارسنجی جنس محصول
    if (empty($productMaterial)) {
        $errors['product_material'] = "لطفا جنس محصول را وارد کنید";
    }

    // اعتبارسنجی سایز محصول
    if (empty($productSize)) {
        $errors['product_size'] = "لطفا سایز محصول را وارد کنید";
    }

    // اعتبارسنجی رنگ محصول
    if (empty($productColor)) {
        $errors['product_color'] = "لطفا رنگ محصول را وارد کنید";
    }

    // اعتبارسنجی قد محصول
    if (empty($productHeight)) {
        $errors['product_height'] = "لطفا قد محصول را وارد کنید";
    }

     // اعتبارسنجی موجودی محصول
     if (empty($productStock)) {
        $errors['product_stock'] = "لطفا تعداد محصول را وارد کنید";
    }

    // اعتبارسنجی قیمت محصول
    if (empty($productPrice)) {
        $errors['product_price'] = "لطفا قیمت محصول را وارد کنید";
    } elseif (!is_numeric($productPrice)) {
        $errors['product_price'] = "لطفا قیمت محصول را به عدد وارد کنید";
    }

    // اعتبارسنجی تصویر محصول
    if (empty($productImage)) {
        $errors['product_image'] = "لطفا تصویر محصول را آپلود کنید.";
    } else {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["product_image"]["name"]);
        if (!move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
            $errors['product_image'] = "خطا در آپلود تصویر.";
        }
    }

    // اگر هیچ خطایی وجود نداشت، محصول را در دیتابیس ثبت کن
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO products (productname, productdescription, productmaterial, productsize, productcolor, productheight, productprice, productimage) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            $_SESSION['message'] = "خطا در آماده‌سازی کوئری: " . $conn->error;
            header("Location: product.php");
            exit();
        }

        $stmt->bind_param("ssds", $productName, $productDescription, $productMaterial, $productSize, $productColor, $productHeight , $productPrice, $productImage);

        if ($stmt->execute()) {
            $_SESSION['message'] = "محصول با موفقیت ثبت شد.";
        } else {
            $_SESSION['message'] = "خطا در ثبت محصول: " . $stmt->error;
        }

        $stmt->close();
        header("Location: admindashboard.php");
        exit();
    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $_POST;  // ذخیره داده‌های وارد شده
        header("Location: product.php");
        exit();
    }
}

$conn->close();
