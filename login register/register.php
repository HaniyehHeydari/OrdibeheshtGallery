<?php include "./register-validation.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>register</title>
  <link rel="stylesheet" href="./register.css" />
</head>

<body dir="rtl">
  <div class="main">
    <form id="form-register" name="register" method="post">
      <div>
        <img src="https://ibolak.com/storage/image/2024/6/1718807353-TCMlDRbPFbA1CHFG.svg" 
             style="width: 285px; height: 90px; margin-right: 95px" />
      </div>

      <div id="fullnames">
        <label for="fullname">نام کاربری</label><br />
        <input type="text" id="fullname" name="fullname" placeholder="NegarKakavan" title="فقط حروف مجاز است" value="<?= htmlspecialchars($fullname ?? '') ?>" />
        <span class="error-message"><?= $errors['fullname'] ?? '' ?></span>
      </div>

      <div id="email">
        <label for="emailuser">ایمیل</label><br />
        <input type="text" id="emailuser" name="emailuser" placeholder="NegarKakavan@gmail.com" title="لطفا ایمیل معتبر وارد کنید" value="<?= htmlspecialchars($email ?? '') ?>" />
        <span class="error-message"><?= $errors['emailuser'] ?? '' ?></span>
      </div>

      <div id="password">
        <label for="pass">رمز عبور</label>
        <input type="password" id="pass" name="pass" placeholder="********" title="لطفا یک رمز عبور معتبر وارد کنید." />
        <span class="error-message"><?= $errors['pass'] ?? '' ?></span>
      </div>

      <select id="educationLevel" name="educationLevel">
        <option value="" disabled selected>مدرک تحصیلی</option>
        <option value="highschool" <?= isset($educationLevel) && $educationLevel == 'highschool' ? 'selected' : '' ?>>دیپلم</option>
        <option value="lisans" <?= isset($educationLevel) && $educationLevel == 'lisans' ? 'selected' : '' ?>>لیسانس</option>
        <option value="foghlisans" <?= isset($educationLevel) && $educationLevel == 'foghlisans' ? 'selected' : '' ?>>فوق لیسانس</option>
        <option value="doctor" <?= isset($educationLevel) && $educationLevel == 'doctor' ? 'selected' : '' ?>>دکترا</option>
      </select>

      <div id="Gender">
        <label>جنسیت:</label>
        <input type="radio" id="maleGender" name="gender" value="Male" <?= isset($gender) && $gender == 'Male' ? 'checked' : '' ?> />
        <label for="maleGender">مرد</label>
        <input type="radio" id="fameleGender" name="gender" value="Female" <?= isset($gender) && $gender == 'Female' ? 'checked' : '' ?> />
        <label for="fameleGender">زن</label>
        <span class="error-message"><?= $errors['gender'] ?? '' ?></span>
      </div>

      <button name="button" id="sabtnam" type="submit">ثبت نام</button>

    
      <p id="sabt">
        قبلا ثبت نام کرده اید؟<a href="./login.php" id="vorodhesab">ورود به حساب</a>
      </p>
    </form>
  </div>
</body>
</html>
