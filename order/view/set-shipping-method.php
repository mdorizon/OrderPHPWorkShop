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
			<h1 class="text-center text-primary font-weight-bold mb-5">Remplissez la méthode de livraison : </h1>
			<form method="POST" class="mb-4" action="http://localhost:8888/workshopmethodo/shipping-method">
				<div class="mb-3">
					<label for="shippingCountry" class="form-label">Méthode de livraison</label>
					<select class="form-control" id="method" name="shippingMethod">
						<option value="chronopost express">chronopost express</option>
						<option value="point relais">point relais</option>
						<option value="domicile">domicile</option>
					</select>
				</div>
				<button type="submit" class="btn btn-secondary btn-lg w-100">Passer au paiement</button>
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