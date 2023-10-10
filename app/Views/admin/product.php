<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<!-- admin/product/add.php -->

<!-- admin/add_product.php -->

<!-- Add product form -->
<form method="post">
    <label for="name">Product Name:</label>
    <input type="text" name="name" required>

    <label for="category_id">Category:</label>
    <select name="category_id" required>
        <?php foreach ($categories as $category): ?>
            <option value="<?= $category['id'] ?>"><?= $category['label'] ?></option>
        <?php endforeach; ?>
    </select>

    <label for="description">Description:</label>
    <textarea name="description"></textarea>

    <label for="price">Price:</label>
    <input type="number" name="price" required>

    <!-- Loop through fields and options -->
    <?php foreach ($fields as $field): ?>
        <label><?= $field['label'] ?>:</label>
        <select name="attributes[<?= $field['id'] ?>]">
            <?php foreach ($options[$field['id']] as $option): ?>
                <option value="<?= $option['id'] ?>"><?= $option['label'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="attribute_values[<?= $field['id'] ?>]">
    <?php endforeach; ?>

    <button type="submit">Add Product</button>
</form>

    
</body>
</html>