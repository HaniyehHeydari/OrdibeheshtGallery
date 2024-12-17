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
    <link rel="stylesheet" href="./details-product.css" />
    <title><?php echo $product['productname']; ?></title>
</head>

<body dir="rtl">
    <?php include('Header.php') ?>

    <main>
        <div class="hii">
            <div class="product-detailss">
                <img src="uploads/<?php echo $product['productimage']; ?>" alt="<?php echo $product['productname']; ?>" class="product-details-imagee">
                <div class="product-details-infoo">
                    <div class="title">
                        <h1><?php echo $product['productname']; ?></h1>
                    </div>
                    <p><?php echo $product['productmaterial']; ?></p>
                    <p><?php echo $product['productsize']; ?></p>
                    <p><?php echo $product['productcolor']; ?></p>
                    <p><?php echo $product['productheight']; ?></p>
                    <h2><?php echo number_format($product['productprice']); ?> تومان</h2>

                    <?php if ($product['productstock'] > 0): ?>
                        <p>وضعیت: موجود</p>
                        <?php if (isset($_SESSION['user'])): ?>
                            <form action="add-to-cart.php" method="POST" class="add-to-cart-form">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <button type="submit">
                                    <img src="https://ibolak.com/assets/icons/basket.svg" /> افزودن به سبد خرید
                                </button>
                                <input type="number" id="quantity" name="quantity" value="1" min="1" required>
                            </form>

                        <?php else: ?>
                            <p>برای افزودن به سبد خرید، لطفاً <a href="./login.php" style="text-decoration: none;">وارد شوید</a>.</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>وضعیت: ناموجود</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <?php include('Footer.php') ?>
</body>

</html>