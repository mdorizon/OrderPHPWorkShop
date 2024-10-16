<?php require_once './common/view/partials/header.php'; ?>
	
    <main>
		<style>
			.card {
				height: 100%;
				display: flex;
				flex-direction: column;
				justify-content: space-between;
			}
		</style>
		<div class="container mt-5">
			<h1 class="text-center text-primary font-weight-bold mb-5">Voici le récapitulatif de votre commande : 0 € (à réparer un jour ;)</h1>
			<div class="row">
				<?php foreach ($productsInCart as $product) : ?>
					<div class="col-lg-3 col-md-6 mb-4 d-flex">
						<div class="card" style="width: 100%; border: 1px solid #e0e0e0; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
							<img <?= 'src="' . $product->getImage() . '"' ?> class="card-img-top" alt="Product Image" style="padding: 15px;">
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
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
		</div>
	</main>

<?php require_once './common/view/partials/footer.php'; ?>