<?php
session_start();

$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
  die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./Main-Page.css" />
  <title>ibolak</title>
</head>

<body>

  <?php include('Header.php') ?>

  <nav class="Navbar">
    <div>
      <a href="./Main-Page.php">
        <p>صفحه اصلی</p>
      </a>
    </div>
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
      <a href="./logout-validation.php">
        <p>خروج</p>
      </a>
    </div>
    </div>
  </nav>
  </div>

  <!-- Main -->
  <main>
    <div class="carousel">
      <div class="carousel-slide active">
        <img src="./img/Label-1.jpg">
      </div>
      <div class="carousel-slide">
        <img src="./img/Label-2.jpg">
      </div>
      <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
      <button class="next" onclick="moveSlide(1)">&#10095;</button>
    </div>
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
    <h1>محصولات</h1>
    <table border="1">
      <tr>
        <th>تصویر</th>
        <th>نام</th>
        <th>قیمت</th>
        <th>توضیحات</th>
      </tr>
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td><img src='uploads/" . $row['productimage'] . "' width='100'></td>";
          echo "<td>" . $row['productname'] . "</td>";
          echo "<td>" . $row['productprice'] . "</td>";
          echo "<td>" . $row['productdescription'] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='4'>هیچ محصولی یافت نشد</td></tr>";
      }
      ?>
    </table>
  </main>

  <?php include('Footer.php') ?>

  <script src="./Main-Page.js"></script>
</body>

</html>