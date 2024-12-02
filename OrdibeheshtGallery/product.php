<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>مدیریت محصولات</title>
    <link rel="stylesheet" href="./productt.css">
</head>

<body dir="rtl">
    <main>
        <h1>ثبت محصولات</h1>
        <form action="product-validation.php" method="post" enctype="multipart/form-data">
            <div id="name">
                <label for="product-name">نام</label><br />
                <input type="text" id="productname" name="productname" required>
            </div>
            <div id="description">
                <label for="product-description">توضیحات تکمیلی</label><br />
                <textarea id="productdescription" name="productdescription" required></textarea><br>
            </div>
            <div id="price">
                <label for="product-price">قیمت</label><br />
                <input type="text" id="productprice" name="productprice" required>
            </div>
            <div id="image">
                <label for="product-image">تصویر</label><br />
                <input type="file" id="productimage" name="productimage" required>
            </div>
            <button type="submit" name="submit">ثبت کالا</button>
        </form>
    </main>
</body>

</html>