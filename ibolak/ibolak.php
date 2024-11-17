<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] !== true) {
  header("Location: ../login register/login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./ibolak.css" />
  <title>ibolak</title>
</head>

<body>
  <picture>
    <img src="https://ibolak.com/storage/image/2024/8/1723454409-8xNmPrzWuTw3diVt.gif"
      style="height: 60px; width: 100%" />
  </picture>
  <!-- Header -->
  <header>
    <div class="Container">
      <div class="Container-One">
        <div class="Container-One-Right">
          <a class="Basket" href="#">
            <img src="https://ibolak.com/assets/icons/basket.svg" style="margin-right: 30px" />
            <p>سبد خرید</p>
            <p class="Zero">o</p>
          </a>
          <a class="User-Account" href="login.html">
            <img src="https://ibolak.com/assets/icons/user.svg" style="margin-right: 30px" />
            <?php
            if (isset($_SESSION['user']) && $_SESSION['user'] === true) {
            ?>
              <span><?php echo $_SESSION['fullname']; ?></span>
            <?php } else { ?>
              <p>حساب کاربری</p>
            <?php } ?>
          </a>
          <div class="Search">
            <div class="Search-Img">
              <img src="https://ibolak.com/assets/icons/search.svg" />
            </div>
            <input class="Search_Key" type="text" maxlength="100" placeholder="جستجو در آی‌بولک" />
          </div>
        </div>
        <a class="Logo-One">
          <img src="https://ibolak.com/assets/images/ibolak-logo.svg"
            style="height: 65%; width: 15%; margin-top: 15px; cursor: pointer" />
        </a>
      </div>
      <nav class="Container-Two">
        <div class="Container-Two-Right">
          <div>
            <a href="#">
              <p>زنانه</p>
              <img src="https://ibolak.com/assets/icons/arrow-down.svg" />
            </a>
          </div>
          <div>
            <a href="#">
              <p>مردانه</p>
              <img src="https://ibolak.com/assets/icons/arrow-down.svg" />
            </a>
          </div>
          <div>
            <a href="#">
              <p>بچگانه</p>
              <img src="https://ibolak.com/assets/icons/arrow-down.svg" />
            </a>
          </div>
          <div>
            <a href="#">
              <p>کیف</p>
            </a>
          </div>
          <div class="Hat-Shawl-Scarf">
            <a href="#">
              <p>کلاه/شال/روسری</p>
              <img src="https://ibolak.com/assets/icons/arrow-down.svg" />
            </a>
          </div>
          <div>
            <a href="#">
              <p>عطر</p>
            </a>
          </div>
          <div>
            <a href="#">
              <p>حراجی</p>
            </a>
          </div>
        </div>
        <div class="Container-Two-Left">
          <a class="Download-Application" href="#">
            <img src="https://ibolak.com/assets/icons/download.svg" style="margin-right: 20px" />
            <p>دانلود اپلیکیشن</p>
          </a>
          <a class="Ibulk-Instagram" href="#">
            <img src="https://ibolak.com/assets/icons/instagram.svg" style="margin-right: 20px" />
            <p>اینستاگرام آی‌بولک</p>
          </a>
        </div>
      </nav>
    </div>
  </header>

  <!-- Main -->
  <main style="background-color: rgba(250, 250, 250, 1);">
    <div class="Row">
      <div class="Row-Top">
        <div class="Row-Top-One">
          <img src="https://ibolak.com/storage/image/2024/7/1721816527-8TBF2MYdTQlotWyM.webp" width="100%"
            style="border-radius: 16px;">
        </div>
        <div class="Row-Top-Two">
          <img src="https://ibolak.com/storage/image/2024/7/1721731387-3eLaOlzuxAPhTNYd.webp" width="100%"
            style="border-radius: 16px;">
        </div>
        <div class="Row-Top-Three">
          <img src="https://ibolak.com/storage/image/2024/7/1721731387-7hucXpvrzgNGqXPj.webp" width="100%"
            style="border-radius: 16px;">
        </div>
        <div class="Row-Top-Four">
          <img src="https://ibolak.com/storage/image/2024/7/1721731387-1OVhZaKqR0b4WYqF.webp" width="100%"
            style="border-radius: 16px;">
        </div>
      </div>
      <div class="Row-Down">
        <div class="Row-Top-One">
          <img src="https://ibolak.com/storage/image/2024/9/1725949731-3BuGTMgqiKL85LRp.webp" width="100%"
            style="border-radius: 16px;">
        </div>
        <div class="Row-Top-Two">
          <img src="https://ibolak.com/storage/image/2024/9/1725952416-tLIvWHRaNGdeHmmq.webp" width="100%"
            style="border-radius: 16px;">
        </div>
        <div class="Row-Top-Three">
          <img src="https://ibolak.com/storage/image/2024/9/1725949731-VY1E0CpY8MXXOcgL.webp" width="100%"
            style="border-radius: 16px;">
        </div>
        <div class="Row-Top-Four">
          <img src="https://ibolak.com/storage/image/2024/9/1725952416-0XVJCmDlrT3AP8L5.webp" width="100%"
            style="border-radius: 16px;">
        </div>
      </div>
    </div>
  </main>
  <!-- Footer -->
  <footer class="Footer">
    <div class="Footer-Top">
      <div class="Footer-Top-Right">
        <div class="Footer-Top-Right-Right">
          <div class="Footer-Top-Right-Right-Top">
            <h3>دسترسی سریع</h3>
          </div>
          <div class="Footer-Top-Right-Right-botton">
            <ul class="Ul-Right">
              <li class="li-Right">
                <p>صفحه اصلی</p>
              </li>
              <li class="li-Right">
                <p>پیگیری شکایات</p>
              </li>
              <li class="li-Right">
                <p>شرایط مرجوعی</p>
              </li>
              <li class="li-Right">
                <p>تماس با ما</p>
              </li>
              <li class="li-Right">
                <p>درباره ما</p>
              </li>
            </ul>
          </div>
        </div>
        <div class="Footer-Top-Right-Left">
          <div class="Footer-Top-Right-Right-Top">
            <h3></h3>
          </div>
          <div class="Footer-Top-Right-Right-botton">
            <ul class="Ul-Right">
              <li class="li-Right">
                <p>سوالات متداول</p>
              </li>
              <li class="li-Right">
                <p>قوانین</p>
              </li>
              <li class="li-Right">
                <p>مردانه</p>
              </li>
              <li class="li-Right">
                <p>زنانه</p>
              </li>
              <li class="li-Right">
                <p>کودکانه</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="Footer-Top-Left">
        <div class="Footer-Top-Left-Right-Top">
          <h3>فروشگاه اینترنتی آی‌بولک</h3>
        </div>
        <div class="Footer-Top-Left-Right-Top-Top">
          <p class="P">
            <b>آدرس فروشگاه: </b>گرگان، بلوار ناهارخوران، بالاتر از عدالت 56،
            نرسیده به میدان گلشهر، فروشگاه آی‌بولک
          </p>
          <p class="P" style="cursor: pointer;"><b>آدرس ایمیل: </b>info@ibolak.com</p>
          <p class="P"><b>شماره های تماس : </b>9-01732534106</p>
        </div>
        <div class="Footer-Top-Left-Right-Top-Botton">
          <div class="Footer-Top-Left-Right-Top-Botton-Right">
            <img src="./img-ibolak/logo.png" style="cursor: pointer;">
          </div>
          <div class="Footer-Top-Left-Right-Top-Botton-Left">
            <img src="./img-ibolak/logoo.png" style="cursor: pointer;">
          </div>
        </div>
      </div>
    </div>
    <div class="Footer-Botton">
      کلیه حقوق متعلق به سایت آی‌بولک می‌باشد. | طراحی و توسعه: توکان تک
    </div>
  </footer>
</body>

</html>