<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] !== true || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

// گرفتن شناسه محصول از URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "محصولی با این شناسه یافت نشد.";
        exit();
    }
} else {
    echo "شناسه محصول مشخص نشده است.";
    exit();
}

// بروزرسانی اطلاعات محصول
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_material = $_POST['product_material'];
    $product_size = $_POST['product_size'];
    $product_color = $_POST['product_color'];
    $product_height = $_POST['product_height'];
    $product_stock = $_POST['product_stock'];
    $product_price = $_POST['product_price'];

    // اگر کاربر تصویری جدید آپلود کرد
    if ($_FILES['product_image']['name']) {
        $product_image = $_FILES['product_image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($product_image);
        move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);
    } else {
        $product_image = $row['productimage']; // اگر تصویر جدید آپلود نشد از تصویر قبلی استفاده کن
    }

    $update_sql = "UPDATE products SET productname = '$product_name', productdescription = '$product_description', productmaterial = '$product_material', productsize = '$product_size' , productcolor = '$product_color' , productheight = '$product_height', productstock = '$product_stock', productprice = '$product_price',productimage = '$product_image' WHERE id = $product_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "محصول با موفقیت ویرایش شد.";
        header("Location: admindashboard.php");
    } else {
        echo "خطا در ویرایش محصول: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>edit-product</title>
    <link rel="stylesheet" href="./product.css" />
</head>

<body dir="rtl">
    <main>
        <h1>ویرایش محصول</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div id="name">
                <label for="productname">نام محصول:</label>
                <input type="text" id="product_name" name="product_name" value="<?php echo $row['productname']; ?>"><br>
            </div>
            <div id="description">
                <label for="productdescription">توضیحات محصول:</label>
                <textarea id="product_description" name="product_description"><?php echo $row['productdescription']; ?></textarea><br>
            </div>
            <div id="material">
                <label for="productmaterial">جنس محصول:</label>
                <input type="text" id="product_material" name="product_material" value="<?php echo $row['productmaterial']; ?>"><br>
            </div>
            <div id="size">
                <label for="productsize">سایز محصول:</label>
                <input id="product_size" name="product_size" value="<?php echo $row['productsize']; ?>"><br>
            </div>
            <div id="color">
                <label for="productcolor">رنگ محصول:</label>
                <input type="text" id="product_color" name="product_color" value="<?php echo $row['productcolor']; ?>"><br>
            </div>
            <div id="height">
                <label for="productheight">قد محصول:</label>
                <input type="text" id="product_height" name="product_height" value="<?php echo $row['productheight']; ?>"><br>
            </div>
            <div id="stock">
                <label for="productprice">تعداد محصول:</label><br />
                <input type="text" id="product_stock" name="product_stock" value="<?php echo $row['productstock']; ?>">
            </div>
            <div id="price">
                <label for="productprice">قیمت محصول:</label>
                <input type="text" id="product_price" name="product_price" value="<?php echo $row['productprice']; ?>"><br>
            </div>
            <div id="image">
                <label for="productimage">تصویر محصول:</label>
                <input type="file" id="product_image" name="product_image"><br>
            </div>
            <button type="submit">ثبت تغییرات</button>
        </form>
    </main>
</body>

</html>

<?php
$conn->close();
?>