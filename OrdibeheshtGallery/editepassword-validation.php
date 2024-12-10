<?php
session_start();

// Initialize error variables and messages
$errors = [];
$successMessage = "";

// Connect to the database
$conn = new mysqli("localhost", "root", "", "ibolak");
if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8"); // Set UTF-8 encoding

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    die("اطلاعات کاربر در سشن یافت نشد. لطفاً وارد حساب کاربری شوید.");
}

$user_id = $_SESSION['user'];
if (!$user_id) {
    die("شناسه کاربر یافت نشد. اطلاعات سشن: " . print_r($_SESSION, true));
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Retrieve the current password from the database
    $sql = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Check if the current password matches
        if ($currentPassword !== $user['password']) {
            $errors['currentPassword'] = "کلمه عبور فعلی اشتباه است.";
        }

        // Check if the new password matches the confirmation
        if ($newPassword !== $confirmPassword) {
            $errors['confirmPassword'] = "کلمه عبور جدید با تکرار آن مطابقت ندارد.";
        }

        // If there are no errors, update the password
        if (empty($errors)) {
            $updateSql = "UPDATE users SET password = ? WHERE id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("si", $newPassword, $user_id);

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
