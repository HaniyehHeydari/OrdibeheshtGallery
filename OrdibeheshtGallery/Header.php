<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="./MainPage.css" />
</head>

<body>
    <header>
        <div class="Container">
            <div class="Container-One">
                <a class="Logo-One">
                    <img src="./img/logo-1.png" width="200" height="68" />
                </a>
                <div class="Container-One-Left">
                    <div class="Search">
                        <input class="Search_Key" type="text" maxlength="100" placeholder="جستجو " />
                        <div class="Search-Img">
                            <img src="https://ibolak.com/assets/icons/search.svg" />
                        </div>
                    </div>
                    <a class="User-Account" href="./register.php">
                        <img src="https://ibolak.com/assets/icons/user.svg" style="margin-right: 30px; margin-left:10px " />
                        <?php
                        if (isset($_SESSION['user']) && $_SESSION['user'] === true) {
                        ?>
                            <span><?php echo 'حساب کاربری'; ?></span>
                        <?php } else { ?>
                            <p>ورود / ثبت نام</p>
                        <?php } ?>
                    </a>
                    <a class="Basket" href="#">
                        <img src="https://ibolak.com/assets/icons/basket.svg" style="margin-right: 40px" />
                        <p>سبد خرید</p>
                        <p class="Zero">o</p>
                    </a>
                </div>
            </div>
    </header>
</body>

</html>