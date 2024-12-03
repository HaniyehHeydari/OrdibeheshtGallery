<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ibolak");

if ($conn->connect_error) {
    die("اتصال برقرار نشد: " . $conn->connect_error);
}
$conn->query("SET NAMES utf8");

$product_id = isset($_GET['id']) ? $_GET['id'] : 0;

$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./detailes-product.css" />
    <title><?php echo $product['productname']; ?></title>
</head>

<body dir="rtl">
    <?php include('Header.php') ?>

    <main>
        <div class="hii">
            <div class="product-detailss">
                <img src="uploads/<?php echo $product['productimage']; ?>" alt="<?php echo $product['productname']; ?>" class="product-details-imagee">
                <div class="product-details-infoo">
                    <h1><?php echo $product['productname']; ?></h1>
                    <p><?php echo $product['productdescription']; ?></p>
                    <h2><?php echo number_format($product['productprice']); ?> تومان</h2>
                </div>
            </div>
        </div>
    </main>

    <?php include('Footer.php') ?>
</body>

</html>