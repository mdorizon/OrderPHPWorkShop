<?php require_once './order/view/partials/header.php'; ?>

<?php foreach ($products as $product) : ?>
    <h1><?= $product->getTitle(); ?></h1>
<?php endforeach; ?>

<?php require_once './order/view/partials/footer.php'; ?>