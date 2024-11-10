<?php
$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
    die("اتصال برقرار نشد");
}
$conn->query("SET NAMES utf8");

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($_POST['email'] && !empty($_POST['email'])) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        $users = mysqli_fetch_array($result);
        if ($users){
            if (($_POST['password']) && !empty($_POST['password'])) {
                if ($_POST['password'] == $users['password']) {  
                    header("Location: ../ibolak/ibolak.html");
                } else 
                    die("رمز عبور اشتباه است");
            } else 
                die("رمز عبور را وارد کنید");
        } else
            die("کاربر با این ایمیل وجود ندارد لطفا ثبت نام کنید");
    } else
        die("ایمیل را وارد کنید");
}

if (empty($email)) {
    $errors['email'] = 'لطفا ایمیل خود را وارد کنید';
}
if (empty($password)) {
    $errors['password'] = 'لطفا رمز عبور خود را وارد کنید';
}

$conn->close();
