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
			<h1 class="text-center text-primary font-weight-bold mb-5">Remplissez l'adresse de livraison : </h1>
			<form method="POST" class="mb-4" action="http://localhost:8888/workshopmethodo/shipping-address">
				<div class="mb-3">
					<label for="shippingCountry" class="form-label">Pays de livraison</label>
					<input type="text" class="form-control" id="shippingCountry" name="shippingCountry" pattern="^[a-zA-Z0-9\s.-]{5,50}$" placeholder="Le pays doit contenir entre 5 et 50 caractères." required>
				</div>
				<div class="mb-3">
					<label for="shippingCity" class="form-label">Ville de livraison</label>
					<input type="text" class="form-control" id="shippingCity" name="shippingCity" pattern="^[a-zA-Z0-9\s.-]{5,50}$" placeholder="La ville doit contenir entre 5 et 50 caractères." required>
				</div>
				<div class="mb-3">
					<label for="shippingAdress" class="form-label">Adresse de livraison</label>
					<input type="text" class="form-control" id="shippingAdress" name="shippingAdress" pattern="^[a-zA-Z0-9\s.-]{5,50}$" placeholder="L'adresse doit contenir entre 5 et 50 caractères." required>
				</div>
				<button type="submit" class="btn btn-secondary btn-lg w-100">Passer à la méthode livraison</button>
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