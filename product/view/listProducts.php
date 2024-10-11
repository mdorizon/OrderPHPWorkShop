<?php require_once './order/view/partials/header.php'; ?>

    <style>
        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
    <div class="container mt-5">
        <div class="row">
        <?php foreach ($products as $product) : ?>
            <?php if ($product->getIsActive()) : ?>
            <div class="col-lg-3 col-md-6 mb-4 d-flex">
                <div class="card" style="width: 100%; border: 1px solid #e0e0e0; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                    <img src="https://m.media-amazon.com/images/I/71S3dsGafhL._AC_SX679_.jpg" class="card-img-top" alt="Product Image" style="padding: 15px;">
                    <div class="card-body d-flex flex-column">
                        <div>
                            <h5 class="card-title text-center" style="font-weight: bold;"><?= $product->getTitle(); ?></h5>
                            <p class="card-text text-center" style="color: #555; font-size: 14px;"><?= $product->getDescription(); ?></p>
                        </div>
                        <div style="height: -webkit-fill-available; display: flex; flex-direction: column; justify-content: flex-end;">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item text-center" style="font-size: 18px; font-weight: bold; color: #d9534f;">
                                    <?= $product->getPrice(); ?> €
                                </li>
                            </ul>
                            <div class="d-grid gap-2 mt-3">
                                <a href="#" class="btn btn-primary btn-lg">Ajouter au panier</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
    </div>

<?php require_once './order/view/partials/footer.php'; ?>