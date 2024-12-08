<?php
// شروع جلسه
session_start();

// اتصال به دیتابیس
$conn = new mysqli("localhost", "root", "", "ibolak");
if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8"); // تنظیم UTF-8 برای دیتابیس

// آرایه برای نگهداری خطاها
$errors = [];
$successMessage = "";

// بررسی ارسال فرم
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    echo $currentPassword;
    // بررسی وجود شناسه کاربر در جلسه
    if (!isset($_SESSION['user_id'])) {
        die("خطا: شناسه کاربر یافت نشد.");
    }
    $userId = $_SESSION['user_id'];

    // گرفتن کلمه عبور فعلی کاربر از دیتابیس
    $sql = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

   
    if ($user) {
        // بررسی مطابقت کلمه عبور فعلی
        if ($currentPassword !== $user['password']) {
            $errors['currentPassword'] = "کلمه عبور فعلی اشتباه است.";
        }

        // بررسی تطابق کلمه عبور جدید و تأییدیه آن
        if ($newPassword !== $confirmPassword) {
            $errors['confirmPassword'] = "کلمه عبور جدید با تکرار آن مطابقت ندارد.";
        }

        // اگر هیچ خطایی وجود نداشت
        if (empty($errors)) {
            // ذخیره کلمه عبور جدید در دیتابیس
            $updateSql = "UPDATE users SET password = ? WHERE id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("si", $newPassword, $userId);

            if ($updateStmt->execute()) {
                $successMessage = "کلمه عبور با موفقیت تغییر یافت.";
            } else {
                $errors['confirmPassword'] = "خطا در ذخیره کلمه عبور جدید.";
            }
        }
    } else {
        $errors['currentPassword'] = "کاربر یافت نشد.";
    }
}
?>