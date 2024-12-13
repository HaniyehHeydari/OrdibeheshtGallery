<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>مدیریت محصولات</title>
    <link rel="stylesheet" href="./productt.css">
</head>

<body dir="rtl">

    <div class="header">
        <?php include('Header.php') ?>
    </div>

    <div class="main">
        <div class="dashboard">
            <?php include('adminPanel.php') ?>
        </div>

        <main>

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
                <div id="material">
                    <label for="productprice">جنس</label><br />
                    <input type="text" id="product_material" name="product_material" value="<?php echo isset($_SESSION['old_data']['product_material']) ? $_SESSION['old_data']['product_material'] : ''; ?>">
                    <?php
                    if (isset($_SESSION['errors']['product_material'])) {
                        echo "<p style='color: red;     font-size: 12px;
    margin-top: 5px;'>" . $_SESSION['errors']['product_material'] . "</p>";
                        unset($_SESSION['errors']['product_material']);
                    }
                    ?>
                </div>
                <div id="size">
                    <label for="productprice">سایز</label><br />
                    <input type="text" id="product_size" name="product_size" value="<?php echo isset($_SESSION['old_data']['product_size']) ? $_SESSION['old_data']['product_size'] : ''; ?>">
                    <?php
                    if (isset($_SESSION['errors']['product_size'])) {
                        echo "<p style='color: red;     font-size: 12px;
    margin-top: 5px;'>" . $_SESSION['errors']['product_size'] . "</p>";
                        unset($_SESSION['errors']['product_size']);
                    }
                    ?>
                </div>
                <div id="color">
                    <label for="productprice">رنگ</label><br />
                    <input type="text" id="product_color" name="product_color" value="<?php echo isset($_SESSION['old_data']['product_color']) ? $_SESSION['old_data']['product_color'] : ''; ?>">
                    <?php
                    if (isset($_SESSION['errors']['product_color'])) {
                        echo "<p style='color: red;     font-size: 12px;
    margin-top: 5px;'>" . $_SESSION['errors']['product_color'] . "</p>";
                        unset($_SESSION['errors']['product_color']);
                    }
                    ?>
                </div>
                <div id="height">
                    <label for="productprice">قد</label><br />
                    <input type="text" id="product_height" name="product_height" value="<?php echo isset($_SESSION['old_data']['product_height']) ? $_SESSION['old_data']['product_height'] : ''; ?>">
                    <?php
                    if (isset($_SESSION['errors']['product_height'])) {
                        echo "<p style='color: red;     font-size: 12px;
    margin-top: 5px;'>" . $_SESSION['errors']['product_height'] . "</p>";
                        unset($_SESSION['errors']['product_height']);
                    }
                    ?>
                </div>
                <div id="stock">
                    <label for="productprice">تعداد</label><br />
                    <input type="text" id="product_stock" name="product_stock" value="<?php echo isset($_SESSION['old_data']['product_stock']) ? $_SESSION['old_data']['product_stock'] : ''; ?>">
                    <?php
                    if (isset($_SESSION['errors']['product_stock'])) {
                        echo "<p style='color: red;     font-size: 12px;
    margin-top: 5px;'>" . $_SESSION['errors']['product_stock'] . "</p>";
                        unset($_SESSION['errors']['product_stock']);
                    }
                    ?>
                </div>
                <div id="price">
                    <label for="productprice">قیمت</label><br />
                    <input type="text" id="product_price" name="product_price">
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

    </div>

    <div class="header">
        <?php include('Footer.php') ?>
    </div>
</body>

</html>