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

            // کوئری برای گرفتن لیست کاربران به جز ادمین
            $sql = "SELECT fullname, email, password, addres FROM users WHERE type != '1'"; // اضافه کردن پسورد و آدرس
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='user-list'>";
                echo "<thead><tr><th>Fullname</th><th>Email</th><th>Password</th><th>Address</th></tr></thead>";
                echo "<tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["fullname"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["password"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["addres"]) . "</td>";
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