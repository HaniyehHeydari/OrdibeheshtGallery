<?php include "./register-validation.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>register</title>
  <link rel="stylesheet" href="./registerr.css" />
</head>

<body dir="rtl">


  <div class="main">
    <form id="form-register" name="register" method="post">
      <div>
        <img src="../OrdibeheshtGallery/img/logo-1.png" style="width: 200px; height: 68px; margin-right: 130px" />
      </div>

      <div id="fullnames">
        <label for="fullname">نام کاربری</label><br />
        <input type="text" id="fullname" name="fullname" placeholder="NegarKakavan" title="فقط حروف مجاز است" value="<?= htmlspecialchars($fullname ?? '') ?>" />
        <?php if (isset($errors['fullname'])): ?>
          <span class="error-message"><?= $errors['fullname'] ?></span>
        <?php endif; ?>
      </div>

      <div id="email">
        <label for="emailuser">ایمیل</label><br />
        <input type="text" id="emailuser" name="email" placeholder="NegarKakavan@gmail.com" title="لطفا ایمیل معتبر وارد کنید" value="<?= htmlspecialchars($email ?? '') ?>" />
        <?php if (isset($errors['email'])): ?>
          <span class="error-message"><?= $errors['email'] ?></span>
        <?php endif; ?>
      </div>

      <div id="password">
        <label for="pass">رمز عبور</label>
        <input type="password" id="pass" name="password" placeholder="********" title="لطفا یک رمز عبور معتبر وارد کنید." />
        <?php if (isset($errors['password'])): ?>
          <span class="error-message"><?= $errors['password'] ?></span>
        <?php endif; ?>
      </div>

      <select id="educationLevel" name="education">
        <option value="" disabled selected>مدرک تحصیلی</option>
        <option value="highschool" <?= isset($education) && $education == 'highschool' ? 'selected' : '' ?>>دیپلم</option>
        <option value="lisans" <?= isset($education) && $education == 'lisans' ? 'selected' : '' ?>>لیسانس</option>
        <option value="foghlisans" <?= isset($education) && $education == 'foghlisans' ? 'selected' : '' ?>>فوق لیسانس</option>
        <option value="doctor" <?= isset($education) && $education == 'doctor' ? 'selected' : '' ?>>دکترا</option>
      </select>

      <div id="Gender">
        <label>جنسیت:</label>
        <input type="radio" id="maleGender" name="gender" value="Male" <?= isset($gender) && $gender == 'Male' ? 'checked' : '' ?> />
        <label for="maleGender">مرد</label>
        <input type="radio" id="fameleGender" name="gender" value="Female" <?= isset($gender) && $gender == 'Female' ? 'checked' : '' ?> />
        <label for="fameleGender">زن</label>
        <?php if (isset($errors['gender'])): ?>
          <span class="error-message"><?= $errors['gender'] ?></span>
        <?php endif; ?>
      </div>

      <button name="button" id="sabtnam" type="submit">ثبت نام</button>

      <p id="sabt">
        قبلا ثبت نام کرده اید؟<a href="login.php" id="vorodhesab">ورود به حساب</a>
      </p>
    </form>
  </div>



  <script src="/register.js"></script>
</body>

</html>