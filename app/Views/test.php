<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Catalog</title>
</head>
<body>
    <h1>Product Catalog</h1>
    <ul>
        <?php foreach ($productCatalog as $productId => $product): ?>
            <li>
                <strong><?= $product['model']; ?></strong><br>
                Price: $<?= $product['price']; ?><br>
                Category:<?=$product['category']?><br>
                <!-- Add more product details as needed -->
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
