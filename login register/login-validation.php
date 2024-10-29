<?php
$emailError = $passwordError = '';
$email = $password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isValid = true;

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailError = 'لطفا یک ایمیل معتبر وارد کنید';
        $isValid = false;
    } else {
        $email = trim($_POST['email']);
    }

    if (empty($_POST['password'])) {
        $passwordError = 'لطفا رمز عبور را وارد کنید';
        $isValid = false;
    } else {
        $password = trim($_POST['password']);
        $passwordPattern = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}/';
        if (!preg_match($passwordPattern, $password)) {
            $passwordError = 'لطفا یک رمز عبور معتبر وارد کنید';
            $isValid = false;
        }
    }

    if ($isValid) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        echo $email . "</br>";
        echo $password . "</br>";
        exit;
    }
}
