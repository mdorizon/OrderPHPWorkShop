<?php require_once './common/view/partials/header.php'; ?>

<main class="d-flex justify-content-center vh-80 mt-5">
	<div class="card shadow-sm p-4" style="width: 100%; max-width: 500px; height: fit-content;">
		<h2 class="text-center mb-4">Créer un produit</h2>
        <form method="POST" class="mb-4" action="http://localhost:8888/workshopmethodo/create-product">
			<div class="mb-3">
				<label for="title" class="form-label">Titre du produit</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="un titre rapide entre <?= Product::$MIN_TITLE_LENGTH ?> et <?= Product::$MAX_TITLE_LENGTH ?> caractères" required pattern="^[a-zA-Z0-9\s]{<?= Product::$MIN_TITLE_LENGTH ?>,<?= Product::$MAX_TITLE_LENGTH ?>}$">
            </div>
			
            <div class="mb-3">
				<label for="image" class="form-label">Lien de l'image</label>
                <input type="url" class="form-control" name="image" id="image" placeholder="https://">
				</div>
				
				<div class="mb-3">
					<label for="price" class="form-label">Prix</label>
					<input type="number" class="form-control" name="price" id="price" min="<?= Product::$MIN_PRICE ?>" max="<?= Product::$MAX_PRICE ?>" step="0.01" placeholder="<?= Product::$DEFAULT_PRICE ?> € par défault !">
				</div>
				
				<div class="mb-3">
					<label for="description" class="form-label">Description</label>
					<textarea class="form-control" name="description" id="description" rows="4" placeholder="décris rapidement le produit, ces spécificitées"></textarea>
				</div>
				
				<div class="form-check mb-3">
					<input class="form-check-input" type="checkbox" name="isActive" id="isActive">
					<label class="form-check-label" for="isActive">Le produit est-il actif par défaut ?</label>
				</div>
				
				<button type="submit" class="btn btn-primary w-100">Créer</button>
			</form>
			<?php if(isset($error)) : ?>
				<div class="alert alert-danger">
					<?php echo htmlspecialchars($error); ?>
				</div>
			<?php endif; ?>
			
			<?php if(isset($success)) : ?>
				<div class="alert alert-success">
				<?php echo htmlspecialchars($success); ?>
				</div>
			<?php endif; ?>
    </div>
</main>

<?php require_once './common/view/partials/footer.php'; ?>