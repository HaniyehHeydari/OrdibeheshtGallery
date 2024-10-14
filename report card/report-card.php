<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./reportcard.css">
    <title>report-card</title>
</head>

<body dir="rtl">
    <div class="container">
        <table class="table">
            <tr>
                <td class="td-one">ترم: 022</td>
                <td class="td-one">وضعیت: عادي-ممتاز</td>
                <td class="td-one">سنوات: 6</td>
            </tr>
            <tr class="tr">
                <td class="td-two">نام درس</td>
                <td class="td-two">تعداد واحد</td>
                <td class="td-two">نمره</td>
            </tr>
            <?php
            $grades = [
                'آزمايشگاه سيستم‌­عامل 2' => 20,
                'آزمايشگاه مهندسي نرم‌افزار' => 19.5,
                'امنيت شبكه‌هاي كامپيوتري' => 17,
                'برنامه‌نويسی موبايل' => 19,
                'تحليل و طراحي سيستم' => 18.5,
                'طراحي صفحات وب پيشرفته' => 19,
                'هوش مصنوعي' => 15.5
            ];
            $units = [
                'آزمايشگاه سيستم‌­عامل 2' => 1,
                'آزمايشگاه مهندسي نرم‌افزار' => 1,
                'امنيت شبكه‌هاي كامپيوتري' => 3,
                'برنامه‌نويسی موبايل' => 3,
                'تحليل و طراحي سيستم' => 3,
                'طراحي صفحات وب پيشرفته' => 3,
                'هوش مصنوعي' => 3
            ];
            $jamvahed = 0;
            $jamKoli = 0;
            foreach ($grades as $subject => $grade) {
                $vahed = $units[$subject];
                echo "<tr>";
                echo "<td class='td-three'>{$subject}</td>";
                echo "<td class='td-three'>{$vahed}</td>";
                echo "<td class='td-three'>{$grade}</td>";
                echo "</tr>";
                $jamvahed += $vahed;
                $jamKoli += $grade * $vahed;
            }
            $avg = $jamKoli / $jamvahed;
            ?>
            <tr>
                <td class="td-four">معدل کل:</td>
                <td class="td-four"><?php echo ($jamvahed); ?></td>
                <td class="td-four"><?php echo number_format($avg, 2); ?></td>
            </tr>
        </table>
    </div>
</body>

</html>