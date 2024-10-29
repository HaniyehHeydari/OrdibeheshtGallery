<?php
$errors = [];
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['emailuser']);
    $password = trim($_POST['pass']);
    $educationLevel = $_POST['educationLevel'] ?? '';
    $gender = $_POST['gender'] ?? '';

    if (!preg_match('/^(?![0-9])[A-Za-z0-9]{3,}$/u', $fullname)) {
        $errors['fullname'] = 'لطفا یک نام کاربری مناسب وارد کنید';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['emailuser'] = 'لطفا یک ایمیل معتبر وارد کنید';
    }

    if (!preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}/', $password)) {
        $errors['pass'] = 'لطفا یک رمز عبور معتبر وارد کنید';
    }

    if (empty($gender)) {
        $errors['gender'] = 'لطفا جنسیت خود را انتخاب کنید';
    }

 
    if (count($errors) === 0) {

        
        echo ($fullname) . "<br />";
        echo ($email) . "<br />";
        echo ($password) . "<br />";
        echo ($gender) . "<br />";
        

        exit();
    }
}
?>