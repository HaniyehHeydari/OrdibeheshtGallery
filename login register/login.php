<?php include "./login-validation.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./login.css" />
    <title>login</title>
</head>

<body dir="rtl">
    <div class="main">
        <form id="form-sign" name="login" method="post">

            <div>
                <img src="https://ibolak.com/storage/image/2024/6/1718807353-TCMlDRbPFbA1CHFG.svg" style="width: 285px; height: 90px; margin-right: 95px" />
            </div>
            <div id="email">
                <label for="emaill">ایمیل</label><br />
                <input type="text" id="emailuser" name="email" placeholder="NegarKakavan@gmail.com" />
                <span id="emailError" class="error-message"><?php echo isset($emailError) ? $emailError : ''; ?></span>
            </div>
            <div id="password">
                <label for="passwordd">رمز عبور</label>
                <input type="password" id="pass" name="password" placeholder="********" />
                <span id="passwordError" class="error-message"><?php echo isset($passwordError) ? $passwordError : ''; ?></span>
            </div>
            <button type="submit" name="submit" id="open">ورود</button>
            <div class="accont">
                <a id="forget" href="#">کلمه عبور خود را فراموش کرده اید؟</a>
                <p id="sabt">
                    حساب کاربری ندارید؟<a href="./register.html" id="sabtnam">ثبت نام</a>
                </p>
            </div>
        </form>
    </div>
</body>

</html>