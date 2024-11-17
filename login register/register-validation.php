<?php
$conn = new mysqli("localhost", "root", "", "ibolak");
if ($conn->connect_error) {
    die("اتصال برقرار نشد");
}
$conn->query("SET NAMES utf8");

$errors = [];
$fullname = '';
$email = '';
$password = '';
$education = '';
$gender = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $education = isset($_POST['education']) ? $_POST['education'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
}

if (empty($email)) {
    $errors['email'] = 'لطفا یک ایمیل وارد کنید';
} else {
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    $users = mysqli_fetch_array($result);
    if ($users) {
        die("ایمیل  وجود دارد");
    }
}

if (!preg_match('/^(?![0-9])[A-Za-z0-9]{3,}$/u', $fullname)) {
    $errors['fullname'] = 'لطفا یک  نام کاربری معتبر وارد کنید';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'لطفا یک  ایمیل معتبر وارد کنید';
}

if (!preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}/', $password)) {
    $errors['password'] = 'لطفا یک رمز عبور معتبر وارد کنید';
}

if (empty($gender)) {
    $errors['gender'] = 'لطفا جنسیت خود را انتخاب کنید';
}

if (count($errors) === 0) {
    $sql = "INSERT INTO users (fullname, email, password, education, gender) VALUES (?, ?, ?, ?, ?)";
    $execute = $conn->prepare($sql);
    $result = $execute->execute([
        $fullname,
        $email,
        $password,
        $education,
        $gender
    ]);

    header("Location:./login.php");
}

$conn->close();
