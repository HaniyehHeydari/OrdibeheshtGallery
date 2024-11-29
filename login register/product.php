<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>مدیریت محصولات</title>
    <link rel="stylesheet" href="product.css">
</head>

<body>
    <header>
        <div class="header-container">
            <nav>
                <a href="ibolak.php">صفحه اصلی</a>
                <a href="about.php">درباره ما</a>
                <a href="contact.php">ارتباط با ما</a>
                <a href="admin.php">مدیریت محصولات</a>
                <a href="logout.php">خروج از سایت</a>
            </nav>
        </div>
    </header>
    <main>
        <section class="admin-panel">
            <h1>صفحه ثبت محصولات</h1>
            <form action="product-validation.php" method="post" enctype="multipart/form-data">
                <label for="productname">نام کالا:</label>
                <input type="text" id="productname" name="productname" required><br>
                <label for="productdescription">توضیحات تکمیلی کالا:</label>
                <textarea id="productdescription" name="productdescription" required></textarea><br>
                <label for="productprice">قیمت کالا:</label>
                <input type="number" id="productprice" name="productprice" required><br>
                <label for="productimage">انتخاب تصویر کالا:</label>
                <input type="file" id="productimage" name="productimage" required><br>
                <input type="submit" value="ثبت کالا">
            </form>
        </section>
    </main>
</body>

</html>