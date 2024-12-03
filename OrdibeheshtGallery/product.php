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
                <label for="productname">نام</label><br />
                <input type="text" id="product_name" name="product_name" required>
            </div>
            <div id="description">
                <label for="productdescription">توضیحات تکمیلی</label><br />
                <textarea id="product_description" name="product_description" required></textarea><br>
            </div>
            <div id="price">
                <label for="productprice">قیمت</label><br />
                <input type="text" id="product_price" name="product_price" required>
            </div>
            <div id="image">
                <label for="productimage">تصویر</label><br />
                <input type="file" id="product_image" name="product_image" required>
            </div>
            <button type="submit" name="submit">ثبت کالا</button>
        </form>
    </main>
</body>

</html>