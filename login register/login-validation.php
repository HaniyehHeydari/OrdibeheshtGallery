<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
    die("اتصال برقرار نشد");
}
$conn->query("SET NAMES utf8");

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';


    if (empty($email)) {
        $errors['email'] = 'لطفا ایمیل خود را وارد کنید';
    }
    if (empty($password)) {
        $errors['password'] = 'لطفا رمز عبور خود را وارد کنید';
    }

    if (empty($errors)) {

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $users = mysqli_fetch_assoc($result);
            if ($password == $users['password']) {
                $_SESSION["user"] = true;
                $_SESSION['email'] = $email;
                $_SESSION['fullname'] = $users['fullname'];
                header("Location: ../ibolak/ibolak.php");
                exit();
            } else {
                $errors['password'] = "رمز عبور اشتباه است";
            }
        } else {
            $errors['email'] = "کاربر با این ایمیل وجود ندارد لطفا ثبت نام کنید";
        }
    }
}

$conn->close();
