<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./UsersList.css" />
    <title>User List</title>
</head>

<body dir="ltr" style="overflow-x: hidden;">
    <div class="header">
        <?php include('Header.php') ?>
    </div>

    <div class="main">
        <div class="dashboard">
            <?php include('adminPanel.php') ?>
        </div>

        <div class="content">
            <?php
            // اتصال به دیتابیس
            $conn = new mysqli("localhost", "root", "", "ibolak");
            if ($conn->connect_error) {
                die("اتصال برقرار نشد");
            }
            $conn->query("SET NAMES utf8");

            // بررسی اگر درخواست حذف ارسال شده است
            if (isset($_GET['delete_id'])) {
                $delete_id = intval($_GET['delete_id']);
                $delete_sql = "DELETE FROM users WHERE id = $delete_id";
                if ($conn->query($delete_sql) === TRUE) {
                    echo "<p style='color: green;'>کاربر با موفقیت حذف شد.</p>";
                } else {
                    echo "<p style='color: red;'>خطا در حذف کاربر: " . $conn->error . "</p>";
                }
            }

            // کوئری برای گرفتن لیست کاربران به جز ادمین
            $sql = "SELECT id, fullname, email, password, addres FROM users WHERE type != '1'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='user-list'>";
                echo "<thead><tr><th>نام و نام خانوادگی</th><th>ایمیل</th><th>رمز عبور</th><th>آدرس</th><th>عملیات</th></tr></thead>";
                echo "<tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["fullname"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["password"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["addres"]) . "</td>";
                    echo "<td><a href='?delete_id=" . $row['id'] . "' class='delete-button'>حذف</a></td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No users found in the database.</p>";
            }

            // بستن اتصال
            $conn->close();
            ?>
        </div>
    </div>

    <div class="header">
        <?php include('Footer.php') ?>
    </div>
</body>

</html>