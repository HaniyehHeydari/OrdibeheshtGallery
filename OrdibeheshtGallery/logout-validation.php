<?php
session_start();
session_unset(); // همه متغیرهای نشست را خالی می‌کند
session_destroy(); // نشست را به طور کامل از بین می‌برد
header("Location: login.php"); // کاربر را به صفحه ورود هدایت می‌کند
exit();
