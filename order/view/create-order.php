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
			<form method="POST" class="mb-4" action="http://localhost:8888/workshopmethodo/create-order">
				<div class="mb-3">
					<label for="customerName" class="form-label">nom du client</label>
					<input type="text" class="form-control" id="customerName" name="customerName" pattern="^[a-zA-Z0-9\s.-]{5,50}$" required>
				</div>
				<button type="submit" class="btn btn-secondary btn-lg w-100">Créer le client</button>
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