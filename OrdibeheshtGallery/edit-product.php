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
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];

    // اگر کاربر تصویری جدید آپلود کرد
    if ($_FILES['product_image']['name']) {
        $product_image = $_FILES['product_image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($product_image);
        move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);
    } else {
        $product_image = $row['productimage']; // اگر تصویر جدید آپلود نشد از تصویر قبلی استفاده کن
    }

    $update_sql = "UPDATE products SET productname = '$product_name', productprice = '$product_price', productdescription = '$product_description', productimage = '$product_image' WHERE id = $product_id";

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
    <title>ویرایش محصول</title>
    <link rel="stylesheet" href="./admindashboard.css" />
</head>

<body>
    <div class="content">
        <h2>ویرایش محصول</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="product_name">نام محصول:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo $row['productname']; ?>" required><br>

            <label for="product_price">قیمت محصول:</label>
            <input type="text" id="product_price" name="product_price" value="<?php echo $row['productprice']; ?>" required><br>

            <label for="product_description">توضیحات محصول:</label>
            <textarea id="product_description" name="product_description" required><?php echo $row['productdescription']; ?></textarea><br>

            <label for="product_image">تصویر محصول:</label>
            <input type="file" id="product_image" name="product_image"><br>

            <button type="submit">ثبت تغییرات</button>
        </form>
    </div>
</body>

</html>

<?php
$conn->close();
?>