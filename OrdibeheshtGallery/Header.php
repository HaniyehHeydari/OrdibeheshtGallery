<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="./Main-Page.css" />
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
                        <input class="Search_Key" type="text" maxlength="100" placeholder="جستجو " style="font-size: 20px;" />
                        <div class="Search-Img">
                            <img src="https://ibolak.com/assets/icons/search.svg" />
                        </div>
                    </div>
                    <div class="User-Account">
                        <img src="https://ibolak.com/assets/icons/user.svg" style="margin-right: 40px; margin-left:10px " />
                        <?php
                        if (isset($_SESSION['user']) && $_SESSION['user'] === true) {
                        ?>
                            <a href="./profile.php"><?php echo $_SESSION['fullname']; ?></a>
                        <?php } else { ?>
                            <a href="./register.php">ورود/ثبت نام</a>
                        <?php } ?>
                    </div>
                    <a class="Basket" href="./cart.php">
                        <img src="https://ibolak.com/assets/icons/basket.svg" style="margin-right: 58px" />
                        <p>سبد خرید</p>
                    </a>
                </div>
            </div>
            <nav class="Navbar">
                <div>
                    <a href="./MainPage.php">
                        <p>صفحه اصلی</p>
                    </a>
                </div>
                <div class="dropdown-container">
                    <a href="#">
                        <p>محصولات</p>
                        <img src="https://ibolak.com/assets/icons/arrow-down.svg" />
                    </a>
                    <div class="dropdown">
                        <a href="#">
                            <h4>محصولات 1</h4>
                            <p>مانتو و تن پوش پاییزه و زمستانه</p>
                            <p>مانتو و تن پوش بهاره و تابستانه</p>
                            <p>تخفیف ها</p>
                            <p>شال و روسری هنری</p>
                            <p>فروش ویژه</p>
                        </a>
                        <a href="#">
                            <h4>محصولات 2</h4>
                            <p>کیف دوشی</p>
                            <p>ساک دستی ها</p>
                            <p>کیف کارت</p>
                            <p>کیف پول</p>
                            <p>کوله پشتی</p>
                        </a>
                        <a href="#">
                            <h4>محصولات 3</h4>
                            <p>بند دوربین عکاسی</p>
                            <p>انگشتر و گوشواره</p>
                            <p>ماهی سه بعدی</p>
                            <p>تزئینی و دکور</p>
                            <p>صندوقچه چوبی</p>
                            <p>رومیزی و رانر</p>
                            <p>عروسک ها</p>
                        </a>
                    </div>
                </div>
                <div>
                    <a href="#">
                        <p>کد مرسولات پستی</p>

                    </a>
                </div>
                <div>
                    <a href="#">
                        <p>محصولات ارسال رایگان</p>
                    </a>
                </div>
                <div>
                    <a href="#">
                        <p>تخفیف ها</p>
                    </a>
                </div>
        </div>
        </nav>
        </div>
    </header>
</body>

</html>