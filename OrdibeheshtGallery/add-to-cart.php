<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

// بررسی اطلاعات کاربر در سشن
if (!isset($_SESSION['user_id'])) {
    die("اطلاعات کاربر در سشن یافت نشد. لطفاً وارد حساب کاربری شوید.");
}

$user_id = $_SESSION['user_id']; // تغییر این خط
if (!$user_id) {
    die("شناسه کاربر یافت نشد. اطلاعات سشن: " . print_r($_SESSION, true));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    if ($product_id <= 0 || $quantity <= 0) {
        die("اطلاعات نامعتبر ارسال شده است.");
    }

    // افزودن به سبد خرید
    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $user_id, $product_id, $quantity);
    $stmt->execute();

    header("Location: cart.php");
    exit();
}
