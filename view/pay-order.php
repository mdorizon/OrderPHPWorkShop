<?php require_once('../view/partials/header.php'); ?>
	
	<main>
		<p> Souhaiter vous payer la commande ? </p>


		<form method="POST" action="../controller/process-order-payment.php">
			<button type="submit">Payer</button>
		</form>
	</main>

<?php require_once('../view/partials/footer.php'); ?>