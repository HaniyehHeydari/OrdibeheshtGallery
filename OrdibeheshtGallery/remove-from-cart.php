<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ibolak");

// بررسی اتصال به پایگاه داده
if ($conn->connect_error) {
    die("اتصال به پایگاه داده ناموفق بود: " . $conn->connect_error);
}

// بررسی وجود شناسه سبد خرید در درخواست POST
if (isset($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];

    // بررسی وجود سبد خرید در پایگاه داده
    if ($stmt = $conn->prepare("SELECT * FROM cart WHERE id = ?")) {
        $stmt->bind_param("i", $cart_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // حذف محصول
            if ($delete_stmt = $conn->prepare("DELETE FROM cart WHERE id = ?")) {
                $delete_stmt->bind_param("i", $cart_id);
                
                if ($delete_stmt->execute() === TRUE) {
                    // در صورت حذف موفقیت‌آمیز
                    header("Location: cart.php");
                    exit();
                } else {
                    echo "خطا در حذف محصول: " . $conn->error;
                }
                
                $delete_stmt->close();
            } else {
                echo "خطا در اجرای کوئری حذف: " . $conn->error;
            }
        } else {
            echo "محصولی با این شناسه یافت نشد.";
        }

        $stmt->close();
    } else {
        echo "خطا در اجرای کوئری بررسی سبد خرید: " . $conn->error;
    }
} else {
    echo "شناسه محصول مشخص نشده است.";
}

$conn->close();
?>
