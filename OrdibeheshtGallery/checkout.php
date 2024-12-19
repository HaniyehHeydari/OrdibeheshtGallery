<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // دریافت اطلاعات فرم و بررسی خالی بودن فیلدها
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $companyname = trim($_POST['companyname'] ?? '');
    $country = trim($_POST['country'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $apartment = trim($_POST['apartment'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $state = trim($_POST['state'] ?? '');
    $postcode = trim($_POST['postcode'] ?? '');

    if (empty($firstname)) $errors['firstname'] = "لطفاً نام را وارد کنید.";
    if (empty($lastname)) $errors['lastname'] = "لطفاً نام خانوادگی را وارد کنید.";
    if (empty($country)) $errors['country'] = "لطفاً کشور را وارد کنید.";
    if (empty($address)) $errors['address'] = "لطفاً آدرس خیابان را وارد کنید.";
    if (empty($city)) $errors['city'] = "لطفاً شهر را وارد کنید.";
    if (empty($state)) $errors['state'] = "لطفاً استان را وارد کنید.";

    // اگر خطا وجود نداشته باشد، به finalize-order.php انتقال می‌دهیم
    if (empty($errors)) {
        $_SESSION['checkout_data'] = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'companyname' => $companyname,
            'country' => $country,
            'address' => $address,
            'apartment' => $apartment,
            'city' => $city,
            'state' => $state,
            'postcode' => $postcode,
        ];
        header("Location: finalize-order.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جزئیات پرداخت</title>
    <link rel="stylesheet" href="./checkout.css">
</head>

<body dir="rtl">
    <?php include('Header.php'); ?>
    <main class="main-content">
        <section class="checkout-form">
            <h2>جزئیات پرداخت</h2>
            <form action="" method="POST">
                <?php if (isset($_SESSION['success'])): ?>
                    <p style="color: green;"><?php echo $_SESSION['success'];
                                                unset($_SESSION['success']); ?></p>
                <?php endif; ?>
                <?php if (isset($_SESSION['error'])): ?>
                    <p style="color: red;"><?php echo $_SESSION['error'];
                                            unset($_SESSION['error']); ?></p>
                <?php endif; ?>

                <label for="firstname">نام *</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname ?? ''); ?>" required>
                <?php if (isset($errors['firstname'])): ?>
                    <p style="color: red;"><?php echo $errors['firstname']; ?></p>
                <?php endif; ?>

                <label for="lastname">نام خانوادگی *</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname ?? ''); ?>" required>
                <?php if (isset($errors['lastname'])): ?>
                    <p style="color: red;"><?php echo $errors['lastname']; ?></p>
                <?php endif; ?>

                <label for="companyname">نام شرکت (اختیاری)</label>
                <input type="text" id="companyname" name="companyname" value="<?php echo htmlspecialchars($companyname ?? ''); ?>">

                <label for="country">کشور / منطقه *</label>
                <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($country ?? 'ایران'); ?>" required>
                <?php if (isset($errors['country'])): ?>
                    <p style="color: red;"><?php echo $errors['country']; ?></p>
                <?php endif; ?>

                <label for="address">آدرس خیابان *</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address ?? ''); ?>" required>
                <?php if (isset($errors['address'])): ?>
                    <p style="color: red;"><?php echo $errors['address']; ?></p>
                <?php endif; ?>

                <label for="apartment">آپارتمان، مجتمع واحد و... (اختیاری)</label>
                <input type="text" id="apartment" name="apartment" value="<?php echo htmlspecialchars($apartment ?? ''); ?>">

                <label for="city">شهر *</label>
                <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($city ?? ''); ?>" required>
                <?php if (isset($errors['city'])): ?>
                    <p style="color: red;"><?php echo $errors['city']; ?></p>
                <?php endif; ?>

                <label for="state">استان *</label>
                <select id="state" name="state" required>
                    <option value="">انتخاب کنید</option>
                    <option value="تهران" <?php echo isset($state) && $state == 'تهران' ? 'selected' : ''; ?>>تهران</option>
                    <option value="اصفهان" <?php echo isset($state) && $state == 'اصفهان' ? 'selected' : ''; ?>>اصفهان</option>
                    <!-- استان‌های دیگر -->
                </select>
                <?php if (isset($errors['state'])): ?>
                    <p style="color: red;"><?php echo $errors['state']; ?></p>
                <?php endif; ?>

                <label for="postcode">کد پستی (اختیاری)</label>
                <input type="text" id="postcode" name="postcode" value="<?php echo htmlspecialchars($postcode ?? ''); ?>">

                <button type="submit">پرداخت و ثبت نهایی سفارش</button>
            </form>
        </section>
    </main>
    <?php include('Footer.php'); ?>
</body>

</html>