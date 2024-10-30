<?php
require_once 'php/ProductCatalog.php';

$catalog = new ProductCatalog();

$catalog->addProduct('Компьютер', 160000, 'Электроника');
$catalog->addProduct('Смартфон', 30000, 'Электроника');
$catalog->addProduct('Кеды', 12000, 'Одежда');
$catalog->addProduct('Свитер', 4000, 'Одежда');
$catalog->addProduct('Планшет', 30000, 'Электроника');
$catalog->addProduct('Флешка', 500, 'Электроника');

$keyword = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$products = $keyword ? $catalog->searchProducts($keyword) : $catalog->getProducts();

if ($category) {
    $products = $catalog->filterByCategory($category);
}

$categories = $catalog->getCategories();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Каталог товаров</h1>

        <form method="GET" action="index.php" class="search-form">
            <input type="text" name="search" placeholder="Поиск товаров..." value="<?= htmlspecialchars($keyword) ?>">
            <select name="category">
                <option value="">Все категории</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= htmlspecialchars($cat) ?>" <?= $cat === $category ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Искать</button>
        </form>

        <div class="product-list">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <h2><?= htmlspecialchars($product['name']) ?></h2>
                        <p>Цена: <?= htmlspecialchars($product['price']) ?> руб.</p>
                        <p>Категория: <?= htmlspecialchars($product['category']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Товары не найдены.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>