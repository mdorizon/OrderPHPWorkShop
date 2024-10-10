<?php require_once('./order/view/partials/header.php'); ?>
	
	<main>
		<p> Souhaiter vous payer la commande ? </p>


		<form method="POST" action="http://localhost:8888/workshopmethodo/process-payment">
			<button type="submit">Payer</button>
		</form>
	</main>

<?php require_once('./order/view/partials/footer.php'); ?>