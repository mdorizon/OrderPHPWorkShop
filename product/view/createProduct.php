<?php require_once './order/view/partials/header.php'; ?>

    <main>

		<form method="POST" action="http://localhost:8888/workshopmethodo/process-create-product">
			<label for="title">Titre du produit</label>
			<input type="text" id="title" name="title" required>
			<br>

			<label for="price">Prix</label>
            <input type="number" name="price" id="price" min="3" max="500" step="0.01">
			<br>
            
			<label for="description">Description</label>
            <input type="text" name="description" id="description">
			<br>
            
			<label for="isActive">Le produit est il actif par défaut ?</label>
            <input type="checkbox" name="isActive" id="isActive">
			<br>

			<button type="submit">Créer</button>
		</form>

	</main>

<?php require_once './order/view/partials/footer.php'; ?>