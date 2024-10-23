<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./sales-invoice.css">
    <title>sales-invoice</title>
</head>

<body>
    <div class="container">
        <h2>فاکتور فروش</h2>
        <?php
        $items = [

            ['name' => 'دفتر', 'price' => 150000, 'quantity' => 2],
            ['name' => 'خودکار', 'price' => 30000, 'quantity' => 3],
            ['name' => 'مداد', 'price' => 15000, 'quantity' => 10],
            ['name' => 'پاکن', 'price' => 20000, 'quantity' => 2],
            ['name' => 'تراش', 'price' => 30000, 'quantity' => 1],
        ];

        $totalPrice = 0;
        $Tax = 0.10;

        foreach ($items as $item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $totalPrice += $itemTotal;
        }
        ?>
        <table>
            <tr>
                <th>نام کالا</th>
                <th>قیمت کالا</th>
                <th>تعداد کالا</th>
                <th>قیمت کل</th>
            </tr>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo number_format($item['price']); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo number_format($item['price'] * $item['quantity']); ?></td>
                </tr>
                <?php $totalTax = $totalPrice * $Tax; ?>
            <?php endforeach; ?>
        </table>
        <h3>جمع کل:<?php echo number_format($totalPrice); ?> تومان</h3>
        <h3>نرخ مالیات:<?php echo number_format($totalTax); ?> تومان</h3>
        <h3>مبلغ قابل پرداخت:<?php echo number_format($totalPrice + $totalTax); ?> تومان</h3>
    </div>
</body>

</html>