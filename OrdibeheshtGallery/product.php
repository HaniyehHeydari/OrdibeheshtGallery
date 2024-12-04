<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>مدیریت محصولات</title>
    <link rel="stylesheet" href="./product.css">
</head>

<body dir="rtl">
    <main>
        <h1>ثبت محصولات</h1>

        <!-- نمایش پیغام‌های عمومی -->
        <?php
        if (isset($_SESSION['message'])) {
            echo "<p style='color: red;     font-size: 12px;
    margin-top: 5px;'>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        ?>

        <form action="product-validation.php" method="post" enctype="multipart/form-data">
            <div id="name">
                <label for="productname">نام</label><br />
                <input type="text" id="product_name" name="product_name" value="<?php echo isset($_SESSION['old_data']['product_name']) ? $_SESSION['old_data']['product_name'] : ''; ?>">
                <?php
                if (isset($_SESSION['errors']['product_name'])) {
                    echo "<p style='color: red;     font-size: 12px;
    margin-top: 5px;'>" . $_SESSION['errors']['product_name'] . "</p>";
                    unset($_SESSION['errors']['product_name']);
                }
                ?>
            </div>
            <div id="description">
                <label for="productdescription">توضیحات تکمیلی</label><br />
                <textarea id="product_description" name="product_description"><?php echo isset($_SESSION['old_data']['product_description']) ? $_SESSION['old_data']['product_description'] : ''; ?></textarea><br>
                <?php
                if (isset($_SESSION['errors']['product_description'])) {
                    echo "<p style='color: red;     font-size: 12px;
    margin-top: 5px;'>" . $_SESSION['errors']['product_description'] . "</p>";
                    unset($_SESSION['errors']['product_description']);
                }
                ?>
            </div>
            <div id="price">
                <label for="productprice">قیمت</label><br />
                <input type="text" id="product_price" name="product_price" value="<?php echo isset($_SESSION['old_data']['product_price']) ? $_SESSION['old_data']['product_price'] : ''; ?>">
                <?php
                if (isset($_SESSION['errors']['product_price'])) {
                    echo "<p style='color: red;     font-size: 12px;
    margin-top: 5px;'>" . $_SESSION['errors']['product_price'] . "</p>";
                    unset($_SESSION['errors']['product_price']);
                }
                ?>
            </div>
            <div id="image">
                <label for="productimage">تصویر</label><br />
                <input type="file" id="product_image" name="product_image">
                <?php
                if (isset($_SESSION['errors']['product_image'])) {
                    echo "<p style='color: red;     font-size: 12px;
    margin-top: 5px;'>" . $_SESSION['errors']['product_image'] . "</p>";
                    unset($_SESSION['errors']['product_image']);
                }
                ?>
            </div>
            <button type="submit" name="submit">ثبت کالا</button>
        </form>
    </main>
</body>

</html>