<?php include "./login-validation.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./login.css" />
    <title>login</title>
</head>

<body dir="rtl">
    <?php include('Header.php') ?>
    <div class="main">
        <form id="form-sign" name="login" method="POST">

            <div>
                <img class="image" src="../OrdibeheshtGallery/img/logo-1.png" style="width: 200px; height: 68px; margin-right: 130px" />
            </div>
            <div id="email">
                <label for="emaill">ایمیل</label><br />
                <input type="text" id="emailuser" name="email" placeholder="NegarKakavan@gmail.com" />
                <span class="error-message"><?= $errors['email'] ?? '' ?></span>
            </div>
            <div id="password">
                <label for="passwordd">رمز عبور</label>
                <input type="password" id="pass" name="password" placeholder="********" />
                <span class="error-message"><?= $errors['password'] ?? '' ?></span>
            </div>
            <button type="submit" name="submit" id="open">ورود</button>
            <div class="accont">
                <a id="forget" href="#">کلمه عبور خود را فراموش کرده اید؟</a>
                <p id="sabt">
                    حساب کاربری ندارید؟<a href="register.php" id="sabtnam"> ثبت نام</a>
                </p>
            </div>
        </form>
        <?php include('Footer.php') ?>
    </div>
    <script src="/login.js"></script>

</body>

</html>