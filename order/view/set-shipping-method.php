<?php require_once('./order/view/partials/header.php'); ?>
	
	<main>
		<p>Remplissez la méthode de livraison : </p>


		<form method="POST" action="http://localhost:8888/workshopmethodo/process-shipping-method">

            <select id="method" name="shippingMethod">
				<option value="chronopost express">chronopost express</option>
				<option value="point relais">point relais</option>
				<option value="domicile">domicile</option>
			</select>
			<button type="submit">Ajouter</button>

		</form>
	</main>

<?php require_once('./order/view/partials/footer.php'); ?>