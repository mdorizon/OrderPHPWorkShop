<?php require_once('./common/view/partials/header.php'); ?>
	
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
			<h1 class="text-center text-primary font-weight-bold mb-5">Souhaiter vous payer la commande ?</h1>
			<form method="POST" class="mb-4" action="http://localhost:8888/workshopmethodo/payment">
				<button type="submit" class="btn btn-secondary btn-lg w-100">Payer la commande</button>
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

<?php require_once('./common/view/partials/footer.php'); ?>