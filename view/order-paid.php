<?php require_once('../view/partials/header.php'); ?>
	
	<main>
		<p>Votre commande à bien été enregistrée voici ce que vous avez commandé :</p>

        <?php foreach($order->getProducts() as $product) : ?>
            <p><?php echo $product ?></p>
        <?php endforeach; ?>
	</main>


<?php require_once('../view/partials/footer.php'); ?>